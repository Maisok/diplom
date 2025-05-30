<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ManagerBookingController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
    
        $query = Booking::with(['user', 'car.equipment.generation.carModel.brand', 'manager']);
    
        if ($user->role === 'manager') {
            // Если указан тип, применяем его приоритетно
            if ($request->filled('type')) {
                if ($request->type === 'mine') {
                    $query->where('manager_id', $user->id);
                } elseif ($request->type === 'free') {
                    $query->whereNull('manager_id');
                }
            } else {
                // По умолчанию показываем и свои, и свободные
                $query->whereNull('manager_id')->orWhere('manager_id', $user->id);
            }
        }
    
        $bookings = $query
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->date_from, fn($q) => $q->where('booking_date', '>=', $request->date_from))
            ->when($request->date_to, fn($q) => $q->where('booking_date', '<=', $request->date_to))
            ->orderByDesc('booking_date')
            ->paginate(15)
            ->appends($request->query());
    
        return view('manager.bookings.index', compact('bookings'));
    }

    public function assignToManager(Booking $booking)
    {
        $user = auth()->user();

        if (!$booking->manager_id) {
            $booking->update(['manager_id' => $user->id]);
            return redirect()->back()->with('success', 'Бронирование взято в работу');
        }

        return redirect()->back()->with('error', 'Это бронирование уже назначено другому менеджеру');
    }

    public function edit(Booking $booking)
    {
        $user = auth()->user();
    
        if ($booking->manager_id && $booking->manager_id !== $user->id) {
            abort(403, 'Доступ запрещён');
        }
    
        return view('manager.bookings.edit', compact('booking'));
    }

        public function update(Request $request, Booking $booking)
        {
            $user = auth()->user();

            if ($booking->manager_id && $booking->manager_id !== $user->id) {
                abort(403, 'Вы не можете редактировать это бронирование');
            }
    
            $now = \Carbon\Carbon::now();
            $maxDate = $now->copy()->addDays(7);

            $validated = $request->validate([
                'status' => 'required|in:pending,confirmed,rejected,completed',
                'appointment_date' => [
                    'required',
                    'date',
                    "after_or_equal:" . $now->format('Y-m-d'),
                    "before_or_equal:" . $maxDate->format('Y-m-d')
                ],
                'manager_comment' => 'nullable|string|max:1000',
            ]);

            $oldStatus = $booking->status;
            $newStatus = $validated['status'];
            $carName = $booking->car?->equipment?->generation?->carModel?->name ?? 'автомобиль';

            // --- ОТПРАВКА УВЕДОМЛЕНИЯ ---
            $message = '';
            $type = '';

            switch ($newStatus) {
                case 'confirmed':
                    case 'completed':
                        $message = "Ваше бронирование автомобиля {$carName} было подтверждено.";
                        $type = 'booking_confirmed';
                    
                        // Отменяем другие активные брони
                        Booking::where('car_id', $booking->car_id)
                            ->where('id', '!=', $booking->id)
                            ->whereIn('status', ['pending', 'confirmed'])
                            ->update([
                                'status' => 'rejected',
                                'manager_comment' => 'Автомобиль продан другому клиенту'
                            ]);
                    
                        $booking->car->update(['is_sold' => true]);
                        break;
                    
                    case 'rejected':
                        $message = "Ваше бронирование автомобиля {$carName} было отклонено.";
                    
                        if (!empty($validated['manager_comment'])) {
                            $message .= " Комментарий: {$validated['manager_comment']}";
                        }
                    
                        $type = 'booking_rejected';
                    
                        // Возвращаем авто в продажу
                        $booking->car->update(['is_sold' => false]);
                        break;
                    
                    case 'pending':
                        $message = "Ваше бронирование автомобиля {$carName} переведено в статус ожидания.";
                        if (!empty($validated['manager_comment'])) {
                            $message .= " Комментарий: {$validated['manager_comment']}";
                        }
                    
                        $type = 'booking_pending';
                    
                        // Возвращаем авто в продажу
                        $booking->car->update(['is_sold' => false]);
                        break;

                default:
                    $changes = [];

                    if ($booking->appointment_date != $validated['appointment_date']) {
                        $changes[] = "дата встречи изменена на {$validated['appointment_date']}";
                    }

                    if ($booking->status != $validated['status']) {
                        $changes[] = "статус изменён на '{$validated['status']}'";
                    }

                    if (!empty($validated['manager_comment']) && $booking->manager_comment != $validated['manager_comment']) {
                        $changes[] = "оставлен комментарий: \"{$validated['manager_comment']}\"";
                    }

                    if (empty($changes)) {
                        break; // Нет изменений — не отправляем уведомление
                    }

                    $message = "Изменения по вашему бронированию автомобиля {$carName}: " . implode(', ', $changes) . '.';
                    $type = 'booking_updated';
                    break;
            }

            if (!empty($message)) {
                Notification::create([
                    'user_id' => $booking->user_id,
                    'car_id' => $booking->car_id,
                    'type' => $type,
                    'message' => $message,
                    'url' => route('bookings.show', $booking),
                ]);
            }

            // --- ОБНОВЛЯЕМ БРОНИРОВАНИЕ ---
            $booking->update($validated);

            return redirect()->route('manager.bookings.index')
                ->with('success', 'Бронирование успешно обновлено');
        }
    public function destroy(Booking $booking)
    {
        try {
            $booking->delete();
            return redirect()->route('manager.bookings.index')
                ->with('success', 'Бронирование #' . $booking->id . ' успешно удалено');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ошибка при удалении бронирования: ' . $e->getMessage());
        }
    }
}