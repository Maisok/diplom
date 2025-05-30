@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Редактирование бронирования #{{ $booking->id }}</h1>

        <!-- Уведомления -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm mb-6">
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-red-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-red-800">Произошли ошибки:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Информация о бронировании -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200 mb-6">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-sm sm:text-base font-medium text-gray-700">Информация о бронировании</h3>
            </div>
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Информация о клиенте -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Клиент</h4>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><strong>Имя:</strong> {{ $booking->user->name }}</p>
                            <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                            <p><strong>Телефон:</strong> {{ $booking->user->phone ?? 'Не указан' }}</p>
                        </div>
                    </div>

                    <!-- Информация об автомобиле -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Автомобиль</h4>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p>
                                <strong>Автомобиль:</strong> 
                                {{ $booking->car->equipment->generation->carModel->brand->name }}
                                {{ $booking->car->equipment->generation->carModel->name }}
                            </p>
                            <p><strong>VIN:</strong> {{ $booking->car->vin }}</p>
                            <p><strong>Цена:</strong> {{ number_format($booking->car->price, 0, '', ' ') }} ₽</p>
                            <p><strong>Филиал:</strong> {{ $booking->car->branch->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Форма редактирования -->
                <form action="{{ route('manager.bookings.update', $booking) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Статус -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Статус бронирования</label>
                            <select id="status" name="status" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Ожидание</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Подтверждено</option>
                                <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>Отклонено</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Завершено</option>
                            </select>
                        </div>

                        <!-- Дата визита -->
                        <div>
                            <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-1">Дата визита</label>
                            <input type="date" name="appointment_date" value="{{ old('appointment_date', $booking->appointment_date) }}"
                                   min="{{ now()->format('Y-m-d') }}" max="{{ now()->addDays(7)->format('Y-m-d') }}" required
                                   class="w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                    </div>

                    <!-- Комментарий менеджера -->
                    <div class="mb-6">
                        <label for="manager_comment" class="block text-sm font-medium text-gray-700 mb-1">Комментарий менеджера</label>
                        <textarea id="manager_comment" name="manager_comment" rows="4" maxlength="1000"
                                  class="w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('manager_comment', $booking->manager_comment) }}</textarea>
                    </div>

                    <!-- Кнопки -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('manager.bookings.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Назад
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Сохранить изменения
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection