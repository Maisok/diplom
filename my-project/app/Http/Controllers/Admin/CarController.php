<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Equipment;
use App\Models\Color;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    // Список всех машин
    public function index(Request $request)
{
    // Получаем запрос от пользователя
    $search = $request->input('search');

    // Базовый запрос с eager loading
    $query = Car::with(['equipment.generation.carModel.brand', 'branch', 'color']);

    // Поиск
    if ($search) {
        $query->where(function ($q) use ($search) {
            // По VIN
            $q->orWhere('vin', 'like', "%$search%")
              ->orWhere('price', 'like', "%$search%")
              ->orWhere('mileage', 'like', "%$search%");

            // По марке, модели, поколению через equipment
            $q->orWhereHas('equipment.generation.carModel.brand', function ($brandQuery) use ($search) {
                $brandQuery->where('name', 'like', "%$search%");
            });
            $q->orWhereHas('equipment.generation.carModel', function ($modelQuery) use ($search) {
                $modelQuery->where('name', 'like', "%$search%");
            });
            $q->orWhereHas('equipment.generation', function ($genQuery) use ($search) {
                $genQuery->where('name', 'like', "%$search%");
            });
        });
    }

    // Пагинация
    $cars = $query->paginate(10)->appends(['search' => $search]);

    return view('admin.cars.index', compact('cars'));
}

    // Форма создания авто
    public function create()
    {
        $equipments = Equipment::with(['generation.carModel.brand'])->get();
        $colors = Color::all();
        $branches = Branch::all();
        return view('admin.cars.create', compact('equipments', 'colors', 'branches'));
    }

    // Сохранение новой машины
    public function store(Request $request)
    {
        $data = $request->validate([
            'equipment_id' => [
                'required',
                'exists:equipment,id'
            ],
            'vin' => [
                'required',
                'string',
                'size:17',
                'unique:cars,vin'
            ],
            'mileage' => [
                'nullable',
                'integer',
                'min:0',
                'max:9999999'
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],
            'branch_id' => [
                'required',
                'exists:branches,id'
            ],
            'color_id' => [
                'nullable',
                'exists:colors,id'
            ],
            'custom_color_name' => [
                'nullable',
                'string',
                'max:50'
            ],
            'custom_color_hex' => [
                'nullable',
                'regex:/^#([A-Fa-f0-9]{6})$/i'
            ],
            'images.*' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg,webp',
                'max:2048'
            ],
            'is_sold' => 'boolean',
        ], [
            'vin.required' => 'VIN обязателен для заполнения',
            'vin.size' => 'VIN должен содержать ровно 17 символов',
            'vin.unique' => 'VIN должен быть уникальным',
            'equipment_id.required' => 'Комплектация обязательна',
            'price.required' => 'Цена обязательна',
            'price.numeric' => 'Введите корректную цену',
            'price.min' => 'Цена не может быть отрицательной',
            'mileage.integer' => 'Пробег должен быть числом',
            'mileage.max' => 'Пробег слишком большой',
            'custom_color_name.max' => 'Название цвета не должно превышать 50 символов',
            'custom_color_hex.regex' => 'HEX-код должен быть в формате #FF5733',
            'images.*.image' => 'Файл должен быть изображением',
            'images.*.mimes' => 'Поддерживаются только форматы jpeg, png, jpg, gif, svg',
            'images.*.max' => 'Размер файла не должен превышать 2 Мб',
            'description.max' => 'Описание не должно превышать 1000 символов',
        ]);
    
        // Проверка: либо выбран color_id, либо задан свой цвет
        if (!$request->filled('color_id') && !($request->filled('custom_color_name') || $request->filled('custom_color_hex'))) {
            return back()->withErrors(['color_id' => 'Выберите цвет из списка или укажите свой'])->withInput();
        }
    
        // Если указан свой цвет → очищаем color_id
        if ($request->filled('custom_color_name') || $request->filled('custom_color_hex')) {
            $data['color_id'] = null;
        }
    
        $car = Car::create($data);

        // Проверяем, есть ли пользователи, у которых эта комплектация в избранном
        $equipment = Equipment::with('favoritedByUsers')->find($data['equipment_id']);
    
        if ($equipment && $equipment->favoritedByUsers->isNotEmpty()) {
            foreach ($equipment->favoritedByUsers as $user) {
                // Создаём уведомление
                $user->notifications()->create([
                    'car_id' => $car->id,
                    'type' => 'favorite_car_available',
                    'message' => "Появился в продаже автомобиль {$car->full_name}",
                    'url' => route('cars.show', $car->id), // Добавляем URL
                ]);
            }
        }
    
        // Загрузка изображений
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create([
                    'path' => $path,
                    'is_main' => $key === 0,
                ]);
            }
        }
    
        return redirect()->route('admin.cars.index')->with('success', 'Автомобиль успешно добавлен');
    }

    // Форма редактирования авто
    public function edit(Car $car)
    {
        $car->load(['equipment.generation.carModel.brand', 'branch', 'color']);
        $equipments = Equipment::with(['generation.carModel.brand'])->get();
        $branches = Branch::all();
        return view('admin.cars.edit', compact('car', 'equipments', 'branches'));
    }

    public function update(Request $request, Car $car)
    {
        $data = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'vin' => [
                'required',
                'string',
                'size:17',
                Rule::unique('cars')->ignore($car->id),
            ],
            'mileage' => 'nullable|integer|min:0|max:9999999',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:5000',
            'branch_id' => 'required|exists:branches,id',
            'color_id' => 'nullable|exists:colors,id',
            'custom_color_name' => 'nullable|string|max:50',
            'custom_color_hex' => 'nullable|regex:/^#([A-Fa-f0-9]{6})$/i',
            'is_sold' => 'boolean',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'vin.size' => 'VIN должен содержать ровно 17 символов',
            'vin.unique' => 'VIN уже используется другим автомобилем',
            'price.min' => 'Цена не может быть отрицательной',
            'mileage.max' => 'Пробег слишком большой',
            'custom_color_name.max' => 'Название цвета не должно превышать 50 символов',
            'custom_color_hex.regex' => 'HEX-код должен быть в формате #FF5733',
            'new_images.*.mimes' => 'Поддерживаются только форматы: jpeg, png, jpg, gif, svg',
            'new_images.*.max' => 'Фото не должно превышать 2 Мб',
        ]);
    
        // Логика: либо color_id, либо custom_color_*
        if ($request->filled('color_id')) {
            $data['custom_color_name'] = null;
            $data['custom_color_hex'] = null;
        } else {
            $data['color_id'] = null;
        }
    
        // Обновляем данные авто
        $car->update($data);
    
        // Загрузка новых изображений
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $key => $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create([
                    'path' => $path,
                    'is_main' => $car->images()->count() === 0 && $key === 0, // Если это первое фото, то оно главная
                ]);
            }
        }
    
        if ($request->has('delete_images')) {
            $imagesToDelete = $car->images()
                ->whereIn('id', $request->input('delete_images'))
                ->get();

            // Проверяем, не пытаемся ли удалить все фото
            if ($car->images->count() - count($imagesToDelete) < 1) {
                return back()->withErrors(['delete_images' => 'Невозможно удалить все изображения. Оставьте хотя бы одно.']);
            }

            foreach ($imagesToDelete as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }
    
        // Изменение главного фото
        if ($request->has('main_image_id')) {
            $car->images()->update(['is_main' => false]);
            $car->images()
                ->where('id', $request->input('main_image_id'))
                ->update(['is_main' => true]);
        }
    
        return redirect()->route('admin.cars.index')->with('success', 'Автомобиль обновлён');
    }

    // Удаление автомобиля
    public function destroy(Car $car)
    {
        foreach ($car->images as $img) {
            Storage::disk('public')->delete($img->path);
            $img->delete();
        }

        $car->delete();
        return back()->with('success', 'Автомобиль удалён');
    }

    public function favorite(Car $car, Request $request)
    {
        $user = $request->user();
        $equipment = $car->equipment;
        $isFavorite = false;
    
        if ($user->favoriteEquipments()->where('equipment_id', $equipment->id)->exists()) {
            $user->favoriteEquipments()->detach($equipment->id);
        } else {
            $user->favoriteEquipments()->attach($equipment->id);
            $isFavorite = true;
        }
    
        return response()->json([
            'is_favorite' => $isFavorite,
            'message' => $isFavorite ? 'Добавлено в избранное' : 'Удалено из избранного'
        ]);
    }

    public function removeFromFavorites(Request $request, $equipment)
    {
        $user = auth()->user();

        // Удалить конкретное оборудование из избранного
        $user->removeFromFavorites($equipment);

        return redirect()->back()->with('success', 'Оборудование удалено из избранного');
    }
}