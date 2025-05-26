@extends('layouts.admin')
@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow p-6 rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Редактировать комплектацию</h1>
        <form method="POST" action="{{ route('admin.equipments.update', $equipment) }}" class="space-y-4" enctype="multipart/form-data">
            @csrf @method('PUT')

            <!-- Марка -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Марка</label>
                <select name="brand_id" id="brand-select-edit" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    <option value="">Выберите марку</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == optional($equipment->generation->carModel->brand)->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Модель -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Модель</label>
                <select name="model_id" id="model-select-edit" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    <option value="">Выберите модель</option>
                    @if ($equipment->generation?->carModel?->brand?->carModels)
                        @foreach ($equipment->generation->carModel->brand->carModels as $model)
                            <option value="{{ $model->id }}" {{ $model->id == optional($equipment->generation)->car_model_id ? 'selected' : '' }}>
                                {{ $model->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Поколение -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Поколение</label>
                <select name="generation_id" id="generation-select-edit" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    <option value="">Выберите поколение</option>
                    @foreach ($generations as $gen)
                        <option value="{{ $gen->id }}" {{ $gen->id == optional($equipment->generation)->id ? 'selected' : '' }}>
                            {{ optional($gen->carModel->brand)->name }} {{ optional($gen->carModel)->name }} {{ $gen->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Тип кузова -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Тип кузова</label>
                <select name="body_type_id" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach (\App\Models\BodyType::all() as $type)
                        <option value="{{ $type->id }}" {{ $type->id == optional($equipment->bodyType)->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Тип двигателя -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Тип двигателя</label>
                <select name="engine_type_id" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach (\App\Models\EngineType::all() as $type)
                        <option value="{{ $type->id }}" {{ $type->id == optional($equipment->engineType)->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Название двигателя -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Название двигателя</label>
                <input type="text" name="engine_name" value="{{ old('engine_name', $equipment->engine_name) }}"
                       maxlength="50" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Объем двигателя -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Объем двигателя (л)</label>
                <input type="number" step="0.1" name="engine_volume"
                       value="{{ old('engine_volume', $equipment->engine_volume) }}"
                       min="0.8" max="8.0" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Мощность -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Мощность (л.с.)</label>
                <input type="number" name="engine_power"
                       value="{{ old('engine_power', $equipment->engine_power) }}"
                       min="40" max="2000" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Тип КПП -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Тип КПП</label>
                <select name="transmission_type_id" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach (\App\Models\TransmissionType::all() as $type)
                        <option value="{{ $type->id }}" {{ $type->id == optional($equipment->transmissionType)->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Название КПП -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Название КПП</label>
                <input type="text" name="transmission_name"
                       value="{{ old('transmission_name', $equipment->transmission_name) }}"
                       maxlength="50" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Привод -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Привод</label>
                <select name="drive_type_id" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach (\App\Models\DriveType::all() as $type)
                        <option value="{{ $type->id }}" {{ $type->id == optional($equipment->driveType)->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Страна производства -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Страна производства</label>
                <select name="country_id" class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach (\App\Models\Country::all() as $country)
                        <option value="{{ $country->id }}" {{ $country->id == optional($equipment->country)->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Описание -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Описание</label>
                <textarea name="description" class="mt-1 block w-full border border-gray-300 rounded p-2" maxlength="1000">{{ old('description', $equipment->description) }}</textarea>
            </div>

            <!-- Вес -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Вес (кг)</label>
                <input type="number" name="weight"
                       value="{{ old('weight', $equipment->weight) }}"
                       min="500" max="10000" step="0.1" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Грузоподъемность -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Грузоподъемность (кг)</label>
                <input type="number" name="load_capacity"
                       value="{{ old('load_capacity', $equipment->load_capacity) }}"
                       min="0" max="3000" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Число мест -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Число мест</label>
                <input type="number" name="seats"
                       value="{{ old('seats', $equipment->seats) }}"
                       min="2" max="9" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Расход топлива -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Расход топлива (л/100 км)</label>
                <input type="number" step="0.1" name="fuel_consumption"
                       value="{{ old('fuel_consumption', $equipment->fuel_consumption) }}"
                       min="0.1" max="50" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Объем бака -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Объем бака (л)</label>
                <input type="number" name="fuel_tank_volume"
                       value="{{ old('fuel_tank_volume', $equipment->fuel_tank_volume) }}"
                       min="30" max="200" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Емкость батареи -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Емкость батареи (кВт·ч)</label>
                <input type="number" name="battery_capacity"
                       value="{{ old('battery_capacity', $equipment->battery_capacity) }}"
                       min="10" max="200" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Запас хода -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Запас хода (км)</label>
                <input type="number" name="range"
                       value="{{ old('range', $equipment->range) }}"
                       min="50" max="1000" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Макс. скорость -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Макс. скорость (км/ч)</label>
                <input type="number" step="0.1" name="max_speed"
                       value="{{ old('max_speed', $equipment->max_speed) }}"
                       min="50" max="450" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Клиренс -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Клиренс (мм)</label>
                <input type="number" step="0.1" name="clearance"
                       value="{{ old('clearance', $equipment->clearance) }}"
                       min="100" max="400" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Цвета -->
            <div id="edit-{{ $equipment->id }}-colors" class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Цвета</label>
                <div id="equipment-colors-list-{{ $equipment->id }}" class="flex flex-wrap gap-3 mt-2">

                </div>
                <button type="button" data-eq-id="{{ $equipment->id }}" class="add-equipment-color-btn mt-3 px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                    ➕ Добавить новый цвет
                </button>
            </div>

            <!-- 3D модель -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">3D модель</label>
                @if($equipment->model_path)
                    <div class="mt-1 mb-3 flex items-center">
                        <span class="text-green-600 mr-3">✓ Модель загружена</span>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remove_model" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                            <span class="ml-2 text-sm text-gray-600">Удалить текущую модель</span>
                        </label>
                    </div>
                @endif
                <div class="mt-1 flex items-center">
                    <input type="file" name="model_folder" accept=".zip" class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100">
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    Оставьте пустым, если не хотите изменять модель. Макс. размер: 50MB.
                </p>
            </div>

            <!-- Сохранить -->
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition mt-4">
                Сохранить изменения
            </button>
        </form>
        @foreach ($equipment->colors as $color)
        <div class="flex items-center border p-2 rounded bg-gray-50">
            <span style="width: 16px; height: 16px; background-color: {{ $color->hex_code }};" class="inline-block mr-2 rounded-full"></span>
            <span>{{ $color->name }}</span>
            <form method="POST" action="{{ route('admin.equipment.colors.detach', [$equipment, $color]) }}">
                @csrf
                @method("DELETE")
                <button type="submit" class="text-red-500 ml-2">×</button>
            </form>
        </div>
    @endforeach
    </div>

    <!-- JS для связей -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const brandSelect = document.getElementById('brand-select-edit');
            const modelSelect = document.getElementById('model-select-edit');
            const generationSelect = document.getElementById('generation-select-edit');

            if (brandSelect && modelSelect && generationSelect) {
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
                                const option = document.createElement('option');
                                option.value = model.id;
                                option.textContent = model.name;
                                if (model.id == "{{ optional($equipment->generation->carModel)->id }}") {
                                    option.setAttribute('selected', 'selected');
                                }
                                modelSelect.appendChild(option);
                            });
                            const event = new Event('change');
                            modelSelect.dispatchEvent(event);
                        });
                });

                modelSelect.addEventListener('change', function () {
                    const modelId = this.value;
                    generationSelect.innerHTML = '<option value="">Загрузка...';
                    if (!modelId) {
                        generationSelect.innerHTML = '<option value="">Выберите модель</option>';
                        return;
                    }
                    fetch(`/model/${modelId}/generations`)
                        .then(res => res.json())
                        .then(gens => {
                            generationSelect.innerHTML = '<option value="">Выберите поколение</option>';
                            gens.forEach(gen => {
                                const option = document.createElement('option');
                                option.value = gen.id;
                                option.textContent = gen.name;
                                if (gen.id == "{{ optional($equipment->generation)->id }}") {
                                    option.setAttribute('selected', 'selected');
                                }
                                generationSelect.appendChild(option);
                            });
                        });
                });

                const initialBrandId = brandSelect.value;
                if (initialBrandId) {
                    const event = new Event('change');
                    brandSelect.dispatchEvent(event);
                }
            }

            // Цвета
            document.querySelectorAll('.add-equipment-color-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const equipmentId = this.getAttribute('data-eq-id');
                    const container = document.getElementById(`equipment-colors-list-${equipmentId}`);
                    if (!container) return;

                    const index = container.children.length;
                    const wrapper = document.createElement('div');
                    wrapper.className = "flex items-center gap-2 mt-2";
                    wrapper.innerHTML = `
                        <input type="text" name="new_colors[${index}][name]" placeholder="Название цвета" required maxlength="255" class="border border-gray-300 rounded p-1 w-1/3">
                        <input type="text" name="new_colors[${index}][hex]" placeholder="#FF5733" maxlength="7" required pattern="#[A-Fa-f0-9]{6}" class="border border-gray-300 rounded p-1 w-1/3">
                        <button type="button" onclick="this.parentNode.remove()" class="px-2 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200">✖</button>
                    `;
                    container.appendChild(wrapper);
                });
            });
        });
    </script>
@endsection