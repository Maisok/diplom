<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Facades\Log;
use App\Models\Generation;
use App\Models\BodyType;
use App\Models\EngineType;
use App\Models\TransmissionType;
use App\Models\DriveType;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Zipper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Equipment::with(['generation.carModel.brand']);

        // Поиск по марке
        if ($request->filled('brand_id')) {
            $query->whereHas('generation.carModel', function ($q) use ($request) {
                $q->where('brand_id', $request->input('brand_id'));
            });
        }

        // Поиск по модели
        if ($request->filled('model_id')) {
            $query->whereHas('generation', function ($q) use ($request) {
                $q->where('car_model_id', $request->input('model_id'));
            });
        }

        $colors = Color::with('equipments')->get();
        $equipments = $query->paginate(10);

        $brands = Brand::all();
        $models = collect(); // по умолчанию пустой список

        // если бренд выбран — загрузи модели
        if ($request->filled('brand_id')) {
            $models = CarModel::where('brand_id', $request->input('brand_id'))->get();
        }

        return view('admin.equipments.index', compact('equipments', 'brands', 'models', 'colors'));
    }

    // Форма создания
    public function create()
    {
        $brands = Brand::all();
        $generations = Generation::all();
        $bodyTypes = BodyType::all();
        $engineTypes = EngineType::all();
        $transmissionTypes = TransmissionType::all();
        $driveTypes = DriveType::all();
        $countries = Country::all();
        $colors = Color::all();
    
        return view('admin.equipments.create', compact(
            'brands', 'generations', 'bodyTypes', 'engineTypes',
            'transmissionTypes', 'driveTypes', 'countries', 'colors'
        ));
    }

    // Сохранение новой комплектации
    public function store(Request $request)
    {
        // Проверка прав
        if (!auth()->user()->isAdmin()) {
            return back()->with('error', 'Доступ запрещён');
        }
    
        // Валидация
        $data = $request->validate([
            'generation_id' => 'required|exists:generations,id',
            'body_type_id' => 'required|exists:body_types,id',
            'engine_type_id' => 'required|exists:engine_types,id',
            'engine_name' => 'nullable|string|max:50',
            'engine_volume' => 'nullable|numeric|min:0.8|max:8.0',
            'engine_power' => 'nullable|integer|min:40|max:2000',
            'transmission_type_id' => 'required|exists:transmission_types,id',
            'transmission_name' => 'nullable|string|max:50',
            'drive_type_id' => 'required|exists:drive_types,id',
            'country_id' => 'required|exists:countries,id',
            'description' => 'nullable|string|max:1000',
            'weight' => 'nullable|numeric|min:500|max:10000',
            'load_capacity' => 'nullable|integer|min:0|max:3000',
            'seats' => 'nullable|integer|min:2|max:9',
            'fuel_consumption' => 'nullable|numeric|min:0.1|max:50',
            'fuel_tank_volume' => 'nullable|integer|min:30|max:200',
            'battery_capacity' => 'nullable|integer|min:10|max:200',
            'range' => 'nullable|integer|min:50|max:1000',
            'max_speed' => 'nullable|numeric|min:50|max:450',
            'clearance' => 'nullable|numeric|min:100|max:400',
            'model_folder' => 'nullable|file|mimes:zip|max:51200',
            // Цвета
            'new_colors' => 'array|nullable',
            'new_colors.*.name' => 'required_with:new_colors.*.hex|string|max:255',
            'new_colors.*.hex' => [
                'required_with:new_colors.*.name',
                'regex:/^#([A-Fa-f0-9]{6})$/i'
            ],
        ]);
    
        DB::beginTransaction();
    
        try {
            // 1. Создание комплектации
            $equipment = Equipment::create($data);
    
            // 2. Обработка модели (если загружена)
            if ($request->hasFile('model_folder')) {
                $this->process3dModel($request->file('model_folder'), $equipment);
            }
    
            // 3. Обработка цветов
            $this->processColors($request, $equipment);
    
            DB::commit();
    
            return redirect()->route('admin.equipments.index')
                ->with('success', 'Комплектация добавлена');
    
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Ошибка при создании комплектации: ' . $e->getMessage());
    
            return back()->withInput()
                ->with('error', 'Ошибка: ' . $e->getMessage());
        }
    }


    protected function process3dModel($file, $equipment)
    {
        // Явные пути с обратными слешами
        $tempDir = str_replace('/', '\\', storage_path('app\\temp'));
        $publicDir = str_replace('/', '\\', storage_path('app\\public'));
        
        // Создаем temp директорию если нет
        if (!File::exists($tempDir)) {
            File::makeDirectory($tempDir, 0755, true);
        }
        
        // Сохраняем временный файл
        $tempName = 'model_'.$equipment->id.'_'.time().'.zip';
        $tempPath = $tempDir.'\\'.$tempName;
        file_put_contents($tempPath, file_get_contents($file->getRealPath()));
        
        // Распаковываем
        $extractPath = $publicDir.'\\3d_models\\equipment_'.$equipment->id;
        
        if (File::exists($extractPath)) {
            File::deleteDirectory($extractPath);
        }
        File::makeDirectory($extractPath, 0755, true);
        
        $zip = new \ZipArchive;
        if ($zip->open($tempPath) !== true) {
            unlink($tempPath);
            throw new \Exception("Ошибка открытия ZIP");
        }
        
        $zip->extractTo($extractPath);
        $zip->close();
        unlink($tempPath);
        
        // Проверяем наличие scene.gltf
        if (!File::exists($extractPath.'\\scene.gltf')) {
            File::deleteDirectory($extractPath);
            throw new \Exception("Не найден scene.gltf");
        }
        
        // Сохраняем путь с обычными слешами для БД
        $equipment->update([
            'model_path' => '3d_models/equipment_'.$equipment->id
        ]);
    }
    
    protected function getZipErrorMessage($code)
    {
        $errors = [
            \ZipArchive::ER_EXISTS => 'Файл уже существует',
            \ZipArchive::ER_INCONS => 'Архив противоречив',
            \ZipArchive::ER_INVAL => 'Некорректный аргумент',
            \ZipArchive::ER_MEMORY => 'Ошибка выделения памяти',
            \ZipArchive::ER_NOENT => 'Нет такого файла',
            \ZipArchive::ER_NOZIP => 'Не ZIP архив',
            \ZipArchive::ER_OPEN => 'Не удалось открыть файл',
            \ZipArchive::ER_READ => 'Ошибка чтения',
            \ZipArchive::ER_SEEK => 'Ошибка поиска',
        ];
        
        return $errors[$code] ?? 'Неизвестная ошибка';
    }

    protected function processColors($request, $equipment)
    {
        if ($request->has('colors')) {
            $equipment->colors()->sync($request->input('colors'));
        }
        
        if ($request->has('new_colors')) {
            foreach ($request->input('new_colors', []) as $colorData) {
                if (!empty($colorData['name']) && !empty($colorData['hex'])) {
                    $color = Color::firstOrCreate(
                        ['name' => $colorData['name']],
                        ['hex_code' => $colorData['hex']]
                    );
                    $equipment->colors()->attach($color);
                }
            }
        }
    }



    // Редактирование
    public function edit(Equipment $equipment)
    {
        // Все марки для селекта
        $brands = Brand::all();

        // Модели текущей марки (если комплектация уже имеет generation)
        $models = collect(); // по умолчанию пустой список
        if ($equipment->generation && $equipment->generation->carModel && $equipment->generation->carModel->brand) {
            $models = $equipment->generation->carModel->brand->carModels;
        }

        // Поколения текущей модели
        $generations = collect(); // по умолчанию пустой список
        if ($equipment->generation && $equipment->generation->carModel) {
            $generations = $equipment->generation->carModel->generations;
        }

        // Все цвета для множественного выбора
        $colors = Color::all();

        // Вернуть представление с данными
        return view('admin.equipments.edit', compact(
            'equipment',
            'brands',
            'models',
            'generations',
            'colors'
        ));
    }

    // Обновление
    public function update(Request $request, Equipment $equipment)
    {
        // Валидация
        $data = $request->validate([
            'generation_id' => 'required|exists:generations,id',
            'body_type_id' => 'required|exists:body_types,id',
            'engine_type_id' => 'required|exists:engine_types,id',
            'engine_name' => 'nullable|string|max:50',
            'engine_volume' => 'nullable|numeric|min:0.8|max:8.0',
            'engine_power' => 'nullable|integer|min:40|max:2000',
            'transmission_type_id' => 'required|exists:transmission_types,id',
            'transmission_name' => 'nullable|string|max:50',
            'drive_type_id' => 'required|exists:drive_types,id',
            'country_id' => 'required|exists:countries,id',
            'description' => 'nullable|string',
            'weight' => 'nullable|numeric|min:500|max:10000',
            'load_capacity' => 'nullable|integer|min:0|max:3000',
            'seats' => 'nullable|integer|min:2|max:9',
            'fuel_consumption' => 'nullable|numeric|min:0.1|max:50',
            'fuel_tank_volume' => 'nullable|integer|min:30|max:200',
            'battery_capacity' => 'nullable|integer|min:10|max:200',
            'range' => 'nullable|integer|min:50|max:1000',
            'max_speed' => 'nullable|numeric|min:50|max:450',
            'clearance' => 'nullable|numeric|min:100|max:400',
            'model_folder' => 'nullable|file|mimes:zip|max:51200', // 50MB
            'remove_model' => 'nullable|boolean',
    
            // Валидация новых цветов
            'new_colors' => 'array|nullable',
            'new_colors.*.name' => 'required_with:new_colors.*.hex|string|max:255',
            'new_colors.*.hex' => [
                'required_with:new_colors.*.name',
                'regex:/^#([A-Fa-f0-9]{6})$/i'
            ],
        ]);
    
        DB::beginTransaction();
    
        try {
            // Удаление модели, если отмечено
            if ($request->has('remove_model')) {
                $this->delete3dModel($equipment);
            }
    
            // Обновление модели, если загружена новая
            if ($request->hasFile('model_folder')) {
                $this->process3dModel($request->file('model_folder'), $equipment);
            }
    
            // Обновляем основные данные комплектации
            $equipment->update($request->except(['colors', 'new_colors', 'model_folder', 'remove_model']));
    
            // Прикрепляем новые цвета
            if ($request->has('new_colors')) {
                foreach ($request->input('new_colors', []) as $colorData) {
                    if (!empty($colorData['name']) && !empty($colorData['hex'])) {
                        $color = Color::firstOrCreate(
                            ['name' => $colorData['name']],
                            ['hex_code' => $colorData['hex']]
                        );
                        $equipment->colors()->attach($color);
                    }
                }
            }
    
            DB::commit();
    
            return redirect()
                ->route('admin.equipments.index')
                ->with('success', 'Комплектация обновлена');
    
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Equipment update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return back()->withInput()
                ->with('error', 'Ошибка: '.$e->getMessage());
        }
    }
    
    protected function delete3dModel(Equipment $equipment)
    {
        if ($equipment->model_path) {
            $path = storage_path('app/public/' . $equipment->model_path);
            
            if (File::exists($path)) {
                File::deleteDirectory($path);
            }
            
            $equipment->update(['model_path' => null]);
        }
    }


    public function detachColor(Equipment $equipment, Color $color)
    {
        $equipment->colors()->detach($color);
        return back()->with('success', 'Цвет удален');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return back()->with('success', 'Комплектация удалена');
    }


    public function updateColor(Request $request)
    {
        $validator = Validator::make($request->only('name', 'hex_code', 'color_id'), [
            'name' => 'required|string|max:50',
            'hex_code' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'color_id' => 'required|exists:colors,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors(['colorErrors' => $validator->errors()->all()])
                ->withInput();
        }

        $color = Color::findOrFail($request->input('color_id'));
        $color->update([
            'name' => $request->input('name'),
            'hex_code' => $request->input('hex_code'),
        ]);

        return back()->with('success', 'Цвет успешно обновлён');
    }

    /**
     * Удаление цвета
     */
    public function deleteColor(Request $request)
    {
        $request->validate([
            'color_id' => 'required|exists:colors,id',
        ]);

        $color = Color::findOrFail($request->input('color_id'));
        $color->delete();

        return back()->with('success', 'Цвет успешно удалён');
    }
}