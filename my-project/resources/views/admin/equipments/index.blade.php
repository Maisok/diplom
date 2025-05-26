@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto bg-white shadow p-6 rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Комплектации</h1>


        
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <strong class="font-bold">Произошли ошибки:</strong>
                <ul class="mt-2 list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- Поиск -->
        <form method="GET" action="{{ route('admin.equipments.index') }}" class="mb-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Марка -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Марка</label>
                    <select name="brand_id" id="brand-select" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option value="">Все марки</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            
                <!-- Модель -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Модель</label>
                    <select name="model_id" id="model-select" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option value="">Все модели</option>
                        @if (!empty($models))
                            @foreach ($models as $model)
                                <option value="{{ $model->id }}" {{ request('model_id') == $model->id ? 'selected' : '' }}>
                                    {{ $model->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                🔍 Найти
            </button>
        </form>

        <!-- Добавить комплектацию -->
        <a href="{{ route('admin.equipments.create') }}" class="inline-block mb-6 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            ➕ Добавить комплектацию
        </a>

        <!-- Список комплектаций -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th>Марка</th>
                        <th>Модель</th>
                        <th>Поколение</th>
                        <th>Двигатель</th>
                        <th>Привод</th>
                        <th>Цвета</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipments as $eq)
                        <tr>
                            <td>{{ optional($eq->generation->carModel->brand)->name }}</td>
                            <td>{{ optional($eq->generation->carModel)->name }}</td>
                            <td>{{ optional($eq->generation)->name }}</td>
                            <td>{{ optional($eq->engineType)->name }}</td>
                            <td>{{ optional($eq->driveType)->name }}</td>
                            <td>
                                @foreach ($eq->colors as $color)
                                    <span style="width: 16px; height: 16px; background-color: {{ $color->hex_code }};" class="inline-block mr-2 rounded-full"></span>
                                    {{ $color->name }}<br>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.equipments.edit', $eq) }}">Редактировать</a>
                                |
                                <form action="{{ route('admin.equipments.destroy', $eq) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="mt-12">
            <h2 class="text-xl font-bold mb-4">Цвета</h2>
        
            <!-- Таблица цветов -->
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th>Название</th>
                        <th>Цвет</th>
                        <th>HEX код</th>
                        <th>Комплектации</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($colors as $color)
                        <tr>
                            <form method="POST" action="{{ route('admin.colors.update') }}" class="w-full">
                                @csrf
                                <input type="hidden" name="color_id" value="{{ $color->id }}">
        
                                <td>
                                    <input type="text" name="name" value="{{ old('name', $color->name) }}"
                                           class="w-full border border-gray-300 rounded p-1 text-sm">
                                </td>
                                <td>
                                    <span style="width: 20px; height: 20px; background-color: {{ $color->hex_code }};"
                                          class="inline-block mr-2 rounded-full"></span>
                                </td>
                                <td>
                                    <input type="text" name="hex_code" value="{{ old('hex_code', $color->hex_code) }}"
                                           maxlength="7" placeholder="#FF5733"
                                           class="w-full border border-gray-300 rounded p-1 text-sm">
                                </td>
                                <td>
                                    @foreach ($color->equipments as $eq)
                                        <div class="text-sm">
                                            {{ optional($eq->generation->carModel->brand)->name }}
                                            → {{ optional($eq->generation->carModel)->name }}
                                            ({{ optional($eq->generation)->name }})
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm mr-2">💾 Сохранить</button>
                                </td>
                            </form>
                            <td>
                            <!-- Форма удаления -->
                            <form method="POST" action="{{ route('admin.colors.delete') }}" class="inline">
                                @csrf
                                <input type="hidden" name="color_id" value="{{ $color->id }}">
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">🗑️ Удалить</button>
                            </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Цветов пока нет</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Пагинация -->
        <div class="mt-4">
            {{ $equipments->appends(request()->except('page'))->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const brandSelect = document.getElementById('brand-select');
            const modelSelect = document.getElementById('model-select');
    
            if (!brandSelect || !modelSelect) return;
    
            // Функция для загрузки моделей по марке
            function loadModels(brandId) {
                modelSelect.innerHTML = '<option value="">Загрузка...</option>';
                if (!brandId) {
                    modelSelect.innerHTML = '<option value="">Все модели</option>';
                    return;
                }
    
                fetch(`/brand/${brandId}/models`)
                    .then(res => res.json())
                    .then(models => {
                        modelSelect.innerHTML = '<option value="">Выберите модель</option>';
    
                        models.forEach(model => {
                            const option = document.createElement('option');
                            option.value = model.id;
                            option.textContent = model.name;
    
                            // Если изначально выбрана конкретная модель → установим selected
                            if ("{{ request('model_id') }}" == model.id.toString()) {
                                option.setAttribute('selected', 'selected');
                            }
    
                            modelSelect.appendChild(option);
                        });
                    })
                    .catch(err => {
                        console.error('Ошибка загрузки моделей:', err);
                        modelSelect.innerHTML = '<option value="">Ошибка загрузки</option>';
                    });
            }
    
            // Событие изменения марки
            brandSelect.addEventListener('change', function () {
                const brandId = this.value;
                loadModels(brandId);
            });
    
            // Загрузка моделей при загрузке страницы
            const initialBrandId = "{{ request('brand_id') }}";
            if (initialBrandId) {
                loadModels(initialBrandId);
            } else {
                modelSelect.innerHTML = '<option value="">Выберите модель</option>';
            }
        });
    </script>
    
@endsection