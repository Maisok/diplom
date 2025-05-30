<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Generation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CarStructureController extends Controller
{

    public function index(Request $request)
    {
        $brands = Brand::paginate(10);
        $allModels = CarModel::all(); // Остается как есть
        return view('admin.car-structure.index', compact('brands', "allModels"));
    }

    public function getModelsByBrand(Request $request)
    {
        $brandId = $request->query('brand_id');
        $page = $request->query('page', 1);
        $perPage = 10;
    
        if (!$brandId) return response()->json([]);
    
        $models = CarModel::where('brand_id', $brandId)->paginate($perPage, ['*'], 'page', $page);
    
        return response()->json([
            'data' => $models->items(),
            'next_page_url' => $models->hasMorePages() ? $models->url($models->currentPage() + 1) : null
        ]);
    }
    
    public function getGenerationsByModel(Request $request)
    {
        $modelId = $request->query('model_id');
        $page = $request->query('page', 1);
        $perPage = 10;
    
        if (!$modelId) return response()->json([]);
    
        $generations = Generation::where('car_model_id', $modelId)->paginate($perPage, ['*'], 'page', $page);
    
        return response()->json([
            'data' => $generations->items(),
            'next_page_url' => $generations->hasMorePages() ? $generations->url($generations->currentPage() + 1) : null
        ]);
    }

    public function getAllModels(Request $request)
    {
        $brandId = $request->query('brand_id');
        if (!$brandId) return response()->json([]);

        return response()->json(CarModel::where('brand_id', $brandId)->get());
    }

    public function getAllGenerations(Request $request)
    {
        $modelId = $request->query('model_id');
        if (!$modelId) return response()->json([]);

        return response()->json(Generation::where('car_model_id', $modelId)->get());
    }

    public function getPaginatedModels(Request $request)
    {
        $brandId = $request->query('brand_id');
        $highlightId = $request->query('highlight_id');
        $page = $request->query('page', 1);
        $perPage = 10;
    
        $query = CarModel::where('brand_id', $brandId);
    
        $models = $query->paginate($perPage, ['*'], 'page', $page);
    
        $items = $models->items();
    
        // Исключаем выделенную модель из текущего списка
        if ($highlightId && $page === 1) {
            $items = collect($items)->reject(fn($item) => $item->id == $highlightId)->values()->all();
        }
    
        return response()->json([
            'data' => $items,
            'next_page_url' => $models->hasMorePages() ? $models->url($models->currentPage() + 1) : null
        ]);
    }

    public function getModelById(Request $request)
    {
        $id = $request->query('id');
    
        $model = CarModel::find($id);
    
        return response()->json($model);
    }

    // CarStructureController.php
    public function getGenerationById(Request $request)
    {
        $id = $request->query('id');
    
        $gen = Generation::find($id);
    
        if (!$gen) {
            return response()->json(null, 404);
        }
    
        return response()->json($gen);
    }
    

    public function getPaginatedGenerations(Request $request)
    {
        $modelId = $request->query('model_id');
        $highlightId = $request->query('highlight_id');
        $page = $request->query('page', 1);
        $perPage = 10;
    
        $query = Generation::where('car_model_id', $modelId);
        $generations = $query->paginate($perPage, ['*'], 'page', $page);
    
        $items = $generations->items();
    
        // Исключаем поколение, которое уже вставлено
        if ($highlightId && $page === 1) {
            $items = collect($items)->reject(fn($item) => $item->id == $highlightId)->values()->all();
        }
    
        return response()->json([
            'data' => $items,
            'next_page_url' => $generations->hasMorePages() ? $generations->url($generations->currentPage() + 1) : null
        ]);
    }

    // CRUD для Brand
    public function storeBrand(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Поле "Название марки" обязательно для заполнения.',
            'name.string' => 'Название марки должно быть строкой.',
            'name.max' => 'Название марки не должно превышать 50 символов.',
            'logo.image' => 'Логотип должен быть изображением.',
            'logo.mimes' => 'Логотип должен быть в формате jpeg, png, jpg или gif.',
            'logo.max' => 'Логотип не должен превышать 2 МБ.',
        ]);

        $data = $request->only('name');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('brands', 'public');
        }

        Brand::create($data);
        return redirect()->route('admin.car-structure.index')->with('success', 'Марка добавлена');
    }

    public function updateBrand(Request $request, Brand $brand)
    {
        $request->validate([
            'brand_name' => 'required|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'brand_name.required' => 'Поле "Название марки" обязательно для заполнения.',
            'brand_name.string' => 'Поле "Название марки" должно быть строкой.',
            'brand_name.max' => 'Поле "Название марки" не должно превышать 50 символов.',
            'logo.image' => 'Логотип должен быть изображением (jpeg, png, jpg или gif).',
            'logo.mimes' => 'Логотип должен быть в формате jpeg, png, jpg или gif.',
            'logo.max' => 'Логотип не должен превышать 2 МБ.',
        ]);
    
        $data = ['name' => $request->input('brand_name')];
    
        if ($request->hasFile('logo')) {
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $data['logo'] = $request->file('logo')->store('brands', 'public');
        }
    
        $brand->update($data);
    
        return redirect()->route('admin.car-structure.index')->with('success', 'Марка обновлена');
    }

    public function destroyBrand(Brand $brand)
    {
        if ($brand->models()->exists()) {
            return back()->with('error', 'Невозможно удалить марку, так как у нее есть модели');
        }

        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();
        return redirect()->route('admin.car-structure.index')->with('success', 'Марка успешно удалена');
    }

    // CRUD для CarModel
    public function storeModel(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:50',
        ], [
            'brand_id.required' => 'Поле "Марка" обязательно для заполнения.',
            'brand_id.exists' => 'Указанная марка не существует.',
            'name.required' => 'Поле "Название модели" обязательно для заполнения.',
            'name.string' => 'Название модели должно быть строкой.',
            'name.max' => 'Название модели не должно превышать 50 символов.',
        ]);

        CarModel::create($request->only('brand_id', 'name'));
        return redirect()->route('admin.car-structure.index')->with('success', 'Модель добавлена');
    }

    public function updateModel(Request $request, CarModel $model)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'model_name' => 'required|string|max:50',
        ], [
            'brand_id.required' => 'Поле "Марка" обязательно для выбора.',
            'brand_id.exists' => 'Выбранная марка не существует.',
            'model_name.required' => 'Поле "Название модели" обязательно для заполнения.',
            'nammodel_namee.string' => 'Поле "Название модели" должно быть строкой.',
            'model_name.max' => 'Поле "Название модели" не должно превышать 50 символов.',
        ]);
    
        $model->update([
            'brand_id' => $request->input('brand_id'),
            'name' => $request->input('model_name')
        ]);
    
        return redirect()->route('admin.car-structure.index')->with('success', 'Модель обновлена');
    }

    public function destroyModel(CarModel $model)
    {
    
        if ($model->generations()->exists()) {
            return back()->with('error', 'Невозможно удалить модель, так как у нее есть поколения');
        }
    
        $model->delete();
        return redirect()->route('admin.car-structure.index')->with('success', 'Модель удалена');
    }

    // CRUD для Generation
    public function storeGeneration(Request $request)
    {
        $currentYear = date('Y');

        $request->validate([
            'car_model_id' => 'required|exists:car_models,id',
            'name' => 'required|string|max:50',
            'year_from' => "required|integer|min:1900|max:" . ($currentYear + 10),
            'year_to' => "nullable|integer|min:1900|max:" . ($currentYear + 10) . "|gte:year_from",
        ], [
            'car_model_id.required' => 'Поле "Модель" обязательно для заполнения.',
            'car_model_id.exists' => 'Указанная модель не существует.',
            'name.required' => 'Поле "Название поколения" обязательно для заполнения.',
            'name.string' => 'Название поколения должно быть строкой.',
            'name.max' => 'Название поколения не должно превышать 50 символов.',
            'year_from.required' => 'Поле "Год начала выпуска" обязательно для заполнения.',
            'year_from.integer' => 'Год начала выпуска должен быть числом.',
            'year_from.min' => 'Год начала выпуска не может быть меньше 1900.',
            'year_from.max' => 'Год начала выпуска не может быть больше {{ $currentYear + 10 }}.',
            'year_to.integer' => 'Год окончания выпуска должен быть числом.',
            'year_to.min' => 'Год окончания выпуска не может быть меньше 1900.',
            'year_to.max' => 'Год окончания выпуска не может быть больше {{ $currentYear + 10 }}.',
            'year_to.gte' => 'Год окончания выпуска должен быть позже года начала.',
        ]);

        Generation::create($request->only('car_model_id', 'name', 'year_from', 'year_to'));
        return redirect()->route('admin.car-structure.index')->with('success', 'Поколение добавлено');
    }

    public function updateGeneration(Request $request, Generation $generation)
    {
        $currentYear = date('Y');
    
        $request->validate([
            'car_model_id' => 'required|exists:car_models,id',
            'generation_name' => 'required|string|max:50',
            'year_from' => "required|integer|min:1900|max:" . ($currentYear + 10),
            'year_to' => "nullable|integer|min:1900|max:" . ($currentYear + 10) . "|gte:year_from",
        ], [
            'car_model_id.required' => 'Поле "Модель" обязательно для выбора.',
            'car_model_id.exists' => 'Выбранная модель не существует.',
            'generation_name.required' => 'Поле "Название поколения" обязательно для заполнения.',
            'generation_name.string' => 'Поле "Название поколения" должно быть строкой.',
            'generation_name.max' => 'Поле "Название поколения" не должно превышать 50 символов.',
            'year_from.required' => 'Поле "Год начала выпуска" обязательно для заполнения.',
            'year_from.integer' => 'Поле "Год начала выпуска" должно быть числом.',
            'year_from.min' => 'Поле "Год начала выпуска" не может быть меньше 1900.',
            'year_from.max' => 'Поле "Год начала выпуска" не может быть больше ' . ($currentYear + 10),
            'year_to.integer' => 'Поле "Год окончания выпуска" должно быть числом.',
            'year_to.min' => 'Поле "Год окончания выпуска" не может быть меньше 1900.',
            'year_to.max' => 'Поле "Год окончания выпуска" не может быть больше ' . ($currentYear + 10),
            'year_to.gte' => 'Год окончания выпуска должен быть позже года начала.',
        ]);
    
        $generation->update([
            'car_model_id' => $request->input('car_model_id'),
            'name' => $request->input('generation_name'),
            'year_from' => $request->input('year_from'),
            'year_to' => $request->input('year_to'),
        ]);
    
        return redirect()->route('admin.car-structure.index')->with('success', 'Поколение обновлено');
    }

    public function destroyGeneration(Generation $generation)
    {
        if ($generation->equipments()->exists()) {
            return back()->with('error', 'Невозможно удалить поколение, так как у него есть комплектации');
        }

        $generation->delete();
        return redirect()->route('admin.car-structure.index')->with('success', 'Поколение удалено');
    }
}