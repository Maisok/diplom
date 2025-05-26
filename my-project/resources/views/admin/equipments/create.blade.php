@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow p-6 rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Добавить комплектацию</h1>
        <form method="POST" action="{{ route('admin.equipments.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
        
            <!-- Марка -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Марка</label>
                <select name="brand_id" id="brand-select-create" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    <option value="">Выберите марку</option>
                    @foreach (\App\Models\Brand::all() as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <!-- Модель -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Модель</label>
                <select name="model_id" id="model-select-create" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    <option value="">Выберите модель</option>
                </select>
            </div>
        
            <!-- Поколение -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Поколение</label>
                <select name="generation_id" id="generation-select-create" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    <option value="">Выберите поколение</option>
                </select>
            </div>
        
            <!-- Тип кузова -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Тип кузова</label>
                <select name="body_type_id" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach (\App\Models\BodyType::all() as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <!-- Тип двигателя -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Тип двигателя</label>
                <select name="engine_type_id" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach (\App\Models\EngineType::all() as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <!-- Название двигателя -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Название двигателя</label>
                <input type="text" name="engine_name" placeholder="Например: Twin Turbo"
                       maxlength="50" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- Объем двигателя -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Объем двигателя (л)</label>
                <input type="number" step="0.1" name="engine_volume" min="0.8" max="8.0"
                       placeholder="Например: 2.0" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- Мощность -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Мощность (л.с.)</label>
                <input type="number" name="engine_power" min="40" max="2000"
                       placeholder="Например: 450" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- Тип КПП -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Тип КПП</label>
                <select name="transmission_type_id" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach (\App\Models\TransmissionType::all() as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <!-- Название КПП -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Название КПП</label>
                <input type="text" name="transmission_name" placeholder="Например: 8-speed automatic"
                       maxlength="50" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- Привод -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Привод</label>
                <select name="drive_type_id" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach (\App\Models\DriveType::all() as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <!-- Страна производства -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Страна производства</label>
                <select name="country_id" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach (\App\Models\Country::all() as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <!-- Описание -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Описание</label>
                <textarea name="description" class="mt-1 block w-full border border-gray-300 rounded p-2" maxlength="1000"></textarea>
            </div>
        
            <!-- Вес -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Вес (кг)</label>
                <input type="number" name="weight" min="500" max="10000" step="0.1"
                       placeholder="Например: 1500" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- Грузоподъемность -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Грузоподъемность (кг)</label>
                <input type="number" name="load_capacity" min="0" max="3000"
                       placeholder="Например: 500" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- Число мест -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Число мест</label>
                <input type="number" name="seats" min="2" max="9"
                       placeholder="Например: 5" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- Расход топлива -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Расход топлива (л/100 км)</label>
                <input type="number" step="0.1" name="fuel_consumption" min="0.1" max="50"
                       placeholder="Например: 9.5" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- Объем бака -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Объем бака (л)</label>
                <input type="number" name="fuel_tank_volume" min="30" max="200"
                       placeholder="Например: 70" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- Емкость батареи -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Емкость батареи (кВт·ч)</label>
                <input type="number" name="battery_capacity" min="10" max="200"
                       placeholder="Например: 80" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- Запас хода -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Запас хода (км)</label>
                <input type="number" name="range" min="50" max="1000" required
                       placeholder="Например: 500" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- Макс. скорость -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Макс. скорость (км/ч)</label>
                <input type="number" step="0.1" name="max_speed" min="50" max="450"
                       placeholder="Например: 250" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- Клиренс -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Клиренс (мм)</label>
                <input type="number" step="0.1" name="clearance" min="100" max="400"
                       placeholder="Например: 150" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>
        
            <!-- 3D модель -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">3D модель</label>
                <div class="mt-1">
                    <input type="file" name="model_folder" accept=".zip"
                           class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700
                                  hover:file:bg-blue-100">
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    Загрузите ZIP архив с 3D моделью. Должен содержать scene.gltf в корне.
                </p>
            </div>
        
            <!-- Цвета -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Цвета</label>
                <div id="new-colors-container" class="space-y-3 mt-2"></div>
                <button type="button" id="add-color-btn" class="mt-2 px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                    ➕ Добавить цвет
                </button>
            </div>
        
            <!-- Сохранить -->
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition mt-4">
                Добавить комплектацию
            </button>
        </form>
    </div>

    <!-- JS для связанных данных -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const brandSelect = document.getElementById('brand-select-create');
            const modelSelect = document.getElementById('model-select-create');
            const generationSelect = document.getElementById('generation-select-create');

            // Подгрузка моделей по марке
            if (brandSelect && modelSelect) {
                brandSelect.addEventListener('change', function () {
                    const brandId = this.value;
                    modelSelect.innerHTML = '<option value="">Загрузка...';
                    if (!brandId) {
                        modelSelect.innerHTML = '<option value="">Выберите марку</option>';
                        generationSelect.innerHTML = '<option value="">Выберите модель</option>';
                        return;
                    }

                    fetch(`/brand/${brandId}/models`)
                        .then(res => res.json())
                        .then(models => {
                            modelSelect.innerHTML = '<option value="">Выберите модель</option>';
                            models.forEach(model => {
                                modelSelect.innerHTML += `<option value="${model.id}">${model.name}</option>`;
                            });
                        })
                        .catch(() => {
                            modelSelect.innerHTML = '<option value="">Ошибка загрузки</option>';
                        });
                });
            }

            // Подгрузка поколений по модели
            if (modelSelect && generationSelect) {
                modelSelect.addEventListener('change', function () {
                    const modelId = this.value;
                    generationSelect.innerHTML = '<option value="">Загрузка...';

                    if (!modelId) {
                        generationSelect.innerHTML = '<option value="">Выберите модель</option>';
                        return;
                    }

                    fetch(`/model/${modelId}/generations`)
                        .then(res => res.json())
                        .then(generations => {
                            generationSelect.innerHTML = '<option value="">Выберите поколение</option>';
                            generations.forEach(gen => {
                                generationSelect.innerHTML += `<option value="${gen.id}">${gen.name}</option>`;
                            });
                        })
                        .catch(() => {
                            generationSelect.innerHTML = '<option value="">Ошибка загрузки</option>';
                        });
                });
            }
        });
    </script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-color-btn');
    const container = document.getElementById('new-colors-container');
    let colorCount = 0;

    if (!addBtn || !container) return;

    addBtn.addEventListener('click', function () {
        const wrapper = document.createElement('div');
        wrapper.className = "flex items-center gap-2 mt-2";
        wrapper.innerHTML = `
            <input type="text" name="new_colors[${colorCount}][name]" placeholder="Название цвета"
                   maxlength="255" required class="border border-gray-300 p-1 rounded w-1/3">
            <input type="text" name="new_colors[${colorCount}][hex]" placeholder="#FF5733"
                   pattern="#[A-Fa-f0-9]{6}" maxlength="7" required
                   class="border border-gray-300 p-1 rounded w-1/3">
            <button type="button" onclick="this.parentNode.remove()"
                    class="px-2 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200">✖</button>
        `;
        container.appendChild(wrapper);
        colorCount++;
    });
});
</script>
@endsection