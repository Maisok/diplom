<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $status;
    public function collection()
    {
        $query = Booking::with('user', 'car.equipment.generation.carModel.brand');
    
        if ($this->status) {
            $query->where('status', $this->status);
        }
    
        return $query->get();
    }

    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->booking_date,
            $booking->appointment_date,
            $booking->user->name ?? '-',
            $booking->user->email ?? '-',
            $booking->car->vin ?? '-',
            $booking->car->equipment->generation->carModel->brand->name ?? '-',
            $booking->car->equipment->generation->carModel->name ?? '-',
            $booking->car->equipment->generation->name ?? '-',
            $booking->car->price ?? '-',
            $booking->car->mileage ?? '-',
            $booking->manager_comment ?? '-',
            $booking->status ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Дата бронирования',
            'Дата визита',
            'Имя клиента',
            'Email клиента',
            'VIN авто',
            'Марка',
            'Модель',
            'Поколение',
            'Цена',
            'Пробег',
            'Комментарий менеджера',
             'Статус'
        ];
    }
}