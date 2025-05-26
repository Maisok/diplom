@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow p-6 rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Редактировать автомобиль</h1>

        <!-- Сообщения -->
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <strong class="font-bold">Исправьте следующие ошибки:</strong>
                <ul class="mt-2 list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.cars.update', $car) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')

            <!-- Комплектация -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Комплектация</label>
                <select name="equipment_id" id="equipment-select" required class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach ($equipments as $eq)
                        <option value="{{ $eq->id }}" {{ $eq->id == $car->equipment_id ? 'selected' : '' }}>
                            {{ optional($eq->generation->carModel->brand)->name }}
                            {{ optional($eq->generation->carModel)->name }}
                            {{ optional($eq->generation)->name }}
                        </option>
                    @endforeach
                </select>
                @error('equipment_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- VIN -->
            <div>
                <label class="block text-sm font-medium text-gray-700">VIN (17 символов)</label>
                <input type="text" name="vin" value="{{ old('vin', $car->vin) }}" maxlength="17" required class="mt-1 block w-full border border-gray-300 rounded p-2">
                @error('vin')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Пробег -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Пробег (км)</label>
                <input type="number" name="mileage" value="{{ old('mileage', $car->mileage) }}" min="0" max="9999999" class="mt-1 block w-full border border-gray-300 rounded p-2">
                @error('mileage')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Цена -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Цена</label>
                <input type="number" step="0.01" name="price" min="1" max="999999999" name="price" value="{{ old('price', $car->price) }}" required class="mt-1 block w-full border border-gray-300 rounded p-2">
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Описание -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Описание</label>
                <textarea name="description" maxlength="1000" class="mt-1 block w-full border border-gray-300 rounded p-2">{{ old('description', $car->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Филиал -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Филиал</label>
                <select name="branch_id" required class="mt-1 block w-full border border-gray-300 rounded p-2">
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ $branch->id == $car->branch_id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
                @error('branch_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Цвета комплектации -->
            <div id="color-options" class="mt-4"></div>

            <!-- Свой цвет -->
            <div id="custom-color-fields" class="mt-4 hidden">
                <strong>Свой цвет:</strong><br>
                <input type="text" name="custom_color_name" placeholder="Название цвета"
                       value="{{ old('custom_color_name', $car->custom_color_name) }}" class="border border-gray-300 p-2 rounded mt-1 w-1/3">
                <input type="text" name="custom_color_hex" placeholder="#FF5733"
                       value="{{ old('custom_color_hex', $car->custom_color_hex) }}" maxlength="7" class="border border-gray-300 p-2 rounded mt-1 w-1/3">
            </div>

            <!-- Кнопка переключения на "свой цвет" -->
            <button type="button" id="use-custom-color-btn" class="mt-3 px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                ➕ Указать свой цвет
            </button>

            <!-- Статус: продано / не продано -->
            <div class="flex items-center mt-4">
                <label class="inline-flex items-center mr-4">
                    <input type="radio" name="is_sold" value="0" {{ $car->is_sold === false ? 'checked' : '' }} class="mr-2">
                    На продаже
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="is_sold" value="1" {{ $car->is_sold === true ? 'checked' : '' }} class="mr-2">
                    Продан
                </label>
                @error('is_sold')
                    <span class="text-red-500 text-sm ml-4">{{ $message }}</span>
                @enderror
            </div>

            <!-- Текущие изображения -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Текущие изображения</label>
                <div class="flex flex-wrap gap-3 mt-2" id="current-images-container">
                    @foreach ($car->images as $image)
                        <div class="relative image-wrapper group">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Photo" width="100" class="rounded shadow-sm">
                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="absolute top-0 right-0 delete-image-checkbox">
                            <input type="radio" name="main_image_id" value="{{ $image->id }}" class="absolute bottom-0 left-0 main-image-radio" {{ $image->is_main ? 'checked' : '' }}>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="delete-selected-images-btn" class="mt-3 px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200">
                    🗑 Удалить выбранные фото
                </button>
            </div>

            <!-- Новые изображения -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Загрузить новые изображения</label>
                <input type="file" name="new_images[]" multiple accept="image/*" class="mt-1 block w-full border border-gray-300 rounded p-2">
                @error('new_images.*')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Сохранить -->
            <button type="submit" class="mt-6 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Обновить автомобиль
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const equipmentSelect = document.getElementById('equipment-select');
            const colorOptions = document.getElementById('color-options');
            const customColorFields = document.getElementById('custom-color-fields');
    
            // Подгрузка цветов по комплектации
            if (equipmentSelect && colorOptions) {
                equipmentSelect.addEventListener('change', function () {
                    const equipmentId = this.value;
                    fetch(`/api/equipment/${equipmentId}/colors`)
                        .then(res => res.json())
                        .then(colors => {
                            let html = `<strong>Цвета комплектации:</strong><br>`;
                            html += `<div class="flex flex-wrap gap-2 mt-2">`;
                            colors.forEach(color => {
                                html += `
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio" name="color_id" value="${color.id}" onchange="clearCustomColorFields()">
                                        <span style="width: 16px; height: 16px; background-color: ${color.hex_code};" class="inline-block mr-2 rounded-full"></span>
                                        <span>${color.name}</span>
                                    </label>
                                `;
                            });
                            html += '</div>';
                            colorOptions.innerHTML = html;
                            customColorFields.classList.add('hidden'); // Используем классы, а не style
                        });
                });
    
                // Автоматическая загрузка цветов при открытии формы
                const event = new Event('change');
                equipmentSelect.dispatchEvent(event);
            }
    
            // Переключение на "свой цвет"
            document.getElementById('use-custom-color-btn')?.addEventListener('click', function () {
                colorOptions.innerHTML = '';
                customColorFields.classList.remove('hidden');
                const radios = document.querySelectorAll('input[name="color_id"]');
                radios.forEach(rb => rb.checked = false);
            });
    
            // Очистка кастомных полей при выборе цвета из списка
            window.clearCustomColorFields = function () {
                document.querySelector('[name="custom_color_name"]').value = '';
                document.querySelector('[name="custom_color_hex"]').value = '';
            };
    
            // Удаление отмеченных фото
            document.getElementById('delete-selected-images-btn')?.addEventListener('click', function () {
                const checkboxes = document.querySelectorAll('.delete-image-checkbox:checked');
                const totalImages = document.querySelectorAll('.image-wrapper').length;
    
                if (totalImages - checkboxes.length < 1) {
                    alert('Невозможно удалить все изображения. Оставьте хотя бы одно.');
                    return;
                }
    
                checkboxes.forEach(cb => cb.closest('.image-wrapper').remove());
            });
        });
    </script>
@endsection