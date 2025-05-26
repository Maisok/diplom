@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow p-6 rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Добавить автомобиль</h1>
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
        <form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Комплектация -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Комплектация</label>
                <select name="equipment_id" id="equipment-select-create" required class="mt-1 block w-full border border-gray-300 rounded p-2">
                    <option value="">Выберите комплектацию</option>
                    @foreach ($equipments as $eq)
                        <option value="{{ $eq->id }}">
                            {{ optional($eq->generation->carModel->brand)->name }}
                            {{ optional($eq->generation->carModel)->name }}
                            {{ optional($eq->generation)->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- VIN -->
            <div>
                <label class="block text-sm font-medium text-gray-700">VIN (17 символов)</label>
                <input type="text" name="vin" maxlength="17" minlength="17"
                       pattern="[A-HJ-NPR-Z0-9]{17}" required
                       title="Должен быть 17 символов без I, O, Q (латинские буквы и цифры)"
                       class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Пробег -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Пробег (км)</label>
                <input type="number" name="mileage" min="0" max="999999"
                       placeholder="Например: 12000" class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Цена -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Цена</label>
                <input type="number" step="0.01" name="price" min="1" max="999999999"
                       required class="mt-1 block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Описание -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Описание</label>
                <textarea name="description" maxlength="1000"
                          class="mt-1 block w-full border border-gray-300 rounded p-2"></textarea>
                <p class="text-xs text-gray-500 mt-1">Максимум 1000 символов</p>
            </div>

            <!-- Филиал -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Филиал</label>
                <select name="branch_id" required class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Изображения -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Изображения</label>
                <input type="file" name="images[]" multiple accept="image/*"
                       required class="mt-1 block w-full border border-gray-300 rounded p-2">
                <p class="text-xs text-gray-500 mt-1">Поддерживаются форматы: JPEG, PNG, WEBP</p>
                <p class="text-xs text-gray-500 mt-1">Максимум 10 файлов</p>
            </div>

            <!-- Цвета по комплектации -->
            <div id="color-options" class="mt-4"></div>

            <!-- Свой цвет -->
            <div id="custom-color-fields" class="mt-4 hidden">
                <strong>Свой цвет:</strong><br>
                <input type="text" name="custom_color_name" placeholder="Название цвета"
                       maxlength="50" class="border border-gray-300 p-2 rounded mt-1 w-1/3">
                <input type="text" name="custom_color_hex" placeholder="#FF5733"
                       maxlength="7" pattern="#[A-Fa-f0-9]{6}"
                       class="border border-gray-300 p-2 rounded mt-1 w-1/3">
            </div>

            <!-- Переключатель на "свой цвет" -->
            <button type="button" id="use-custom-color-btn" class="mt-3 px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                ➕ Указать свой цвет
            </button>

            <!-- Сохранить -->
            <button type="submit" class="mt-6 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Добавить автомобиль
            </button>
        </form>
    </div>

    <!-- JS: динамическая подгрузка цветов по комплектации -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const equipmentSelect = document.getElementById('equipment-select-create');
            const colorOptions = document.getElementById('color-options');
            const customColorFields = document.getElementById('custom-color-fields');
            const useCustomColorBtn = document.getElementById('use-custom-color-btn');

            // Подгрузка цветов по комплектации
            if (equipmentSelect && colorOptions) {
                equipmentSelect.addEventListener('change', function () {
                    const equipmentId = this.value;

                    if (!equipmentId) {
                        colorOptions.innerHTML = '';
                        return;
                    }

                    fetch(`/api/equipment/${equipmentId}/colors`)
                        .then(res => res.json())
                        .then(colors => {
                            let html = `<strong>Цвета комплектации:</strong><br>`;
                            html += `<div class="flex flex-wrap gap-2 mt-2">`;

                            colors.forEach(color => {
                                html += `
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio" name="color_id" value="${color.id}">
                                        <span style="width: 16px; height: 16px; background-color: ${color.hex_code};" class="inline-block mr-2 rounded-full"></span>
                                        <span>${color.name}</span>
                                    </label>
                                `;
                            });

                            html += '</div>';
                            colorOptions.innerHTML = html;
                            customColorFields.style.display = 'none';
                        });
                });
            }

            // Кнопка "Указать свой цвет"
            useCustomColorBtn?.addEventListener('click', function () {
                // Очищаем цвета из комплектации
                const radioButtons = colorOptions.querySelectorAll('input[type="radio"]');
                radioButtons.forEach(rb => rb.checked = false);

                colorOptions.innerHTML = '';
                customColorFields.style.display = 'block';

                // Также очищаем поля, если они уже были заполнены
                const nameInput = customColorFields.querySelector('input[name="custom_color_name"]');
                const hexInput = customColorFields.querySelector('input[name="custom_color_hex"]');

                if (nameInput && hexInput) {
                    nameInput.value = '';
                    hexInput.value = '';
                }
            });
        });
    </script>
@endsection