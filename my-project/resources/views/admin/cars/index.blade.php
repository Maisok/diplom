@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto bg-white shadow p-6 rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Автомобили</h1>

        <!-- Форма поиска -->
        <form method="GET" action="{{ route('admin.cars.index') }}" class="mb-4 flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Поиск по VIN, марке, модели, поколению" 
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                🔍 Найти
            </button>
            @if(request('search'))
                <a href="{{ route('admin.cars.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                    ✖ Сбросить
                </a>
            @endif
        </form>

        <!-- Добавить авто -->
        <a href="{{ route('admin.cars.create') }}" class="inline-block mb-6 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            ➕ Добавить автомобиль
        </a>
        <a href="{{ route('admin.cars.export.not_sold') }}" 
            class="px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-all">
            Экспортировать авто в продаже
            </a>

        <!-- Таблица -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">VIN</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Марка / Модель / Поколение</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Цвет</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Цена</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Пробег</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Филиал</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Статус</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Действия</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($cars as $car)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $car->vin }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ optional($car->equipment->generation->carModel->brand)->name }}
                                {{ optional($car->equipment->generation->carModel)->name }}
                                {{ optional($car->equipment->generation)->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($car->color)
                                    <span style="width: 16px; height: 16px; background-color: {{ $car->color->hex_code }};" class="inline-block mr-2 rounded-full"></span>
                                    {{ $car->color->name }}
                                @elseif ($car->custom_color_name)
                                    <span style="width: 16px; height: 16px; background-color: {{ $car->custom_color_hex }};" class="inline-block mr-2 rounded-full"></span>
                                    {{ $car->custom_color_name }}
                                @else
                                    <span class="text-gray-500">Нет данных</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($car->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $car->mileage ?: '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ optional($car->branch)->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 rounded-full text-sm
                                    {{ $car->is_sold ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $car->is_sold ? 'Продан' : 'На продаже' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                <a href="{{ route('admin.cars.edit', $car) }}" class="text-blue-600 hover:text-blue-900">Редактировать</a> |
                                <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Вы уверены?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Пагинация -->
        <div class="mt-6">
            {{ $cars->links() }}
        </div>
    </div>
@endsection