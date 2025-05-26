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
        $search = $request->input('search');

        // Получаем номера страниц
        $brandPage = $request->input('page_brands', 1);
        $modelPage = $request->input('page_models', 1);
        $generationPage = $request->input('page_generations', 1);

        // Запрашиваем данные с поиском и пагинацией
        $brandsQuery = Brand::query();
        if ($search) {
            $brandsQuery->where('name', 'like', "%$search%");
        }
        $brands = $brandsQuery->paginate(10, ['*'], 'page_brands', $brandPage)->appends([
            'search' => $search,
            'page_models' => $modelPage,
            'page_generations' => $generationPage,
        ]);

        $modelsQuery = CarModel::with('brand');
        if ($search) {
            $modelsQuery->where('name', 'like', "%$search%")
                ->orWhereHas('brand', fn($q) => $q->where('name', 'like', "%$search%"));
        }
        $models = $modelsQuery->paginate(10, ['*'], 'page_models', $modelPage)->appends([
            'search' => $search,
            'page_brands' => $brandPage,
            'page_generations' => $generationPage,
        ]);

        $generationsQuery = Generation::with('carModel.brand');
        if ($request->input('search')) {
            $generationsQuery->where('name', 'like', "%$search%")
                ->orWhereHas('carModel', fn($q) => $q->where('name', 'like', "%$search%"))
                ->orWhereHas('carModel.brand', fn($q) => $q->where('name', 'like', "%$search%"));
        }

        $generations = $generationsQuery->paginate(10, ['*'], 'page_generations', $generationPage)->appends([
            'search' => $search,
            'page_brands' => $brandPage,
            'page_models' => $modelPage,
        ]);

        return view('admin.car-structure.index', compact('brands', 'models', 'generations'));
    }

    // CRUD для Brand
    public function storeBrand(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'name' => 'required|string|max:50',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('name');

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
        ]);

        CarModel::create($request->only('brand_id', 'name'));
        return redirect()->route('admin.car-structure.index')->with('success', 'Модель добавлена');
    }

    public function updateModel(Request $request, CarModel $carModel)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:50',
        ]);

        $carModel->update($request->only('brand_id', 'name'));
        return redirect()->route('admin.car-structure.index')->with('success', 'Модель обновлена');
    }

    public function destroyModel(CarModel $carModel)
    {
        if ($carModel->generations()->exists()) {
            return back()->with('error', 'Невозможно удалить модель, так как у нее есть поколения');
        }

        $carModel->delete();
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
        ]);

        Generation::create($request->only('car_model_id', 'name', 'year_from', 'year_to'));
        return redirect()->route('admin.car-structure.index')->with('success', 'Поколение добавлено');
    }

    public function updateGeneration(Request $request, Generation $generation)
    {
        $currentYear = date('Y');

        $request->validate([
            'car_model_id' => 'required|exists:car_models,id',
            'name' => 'required|string|max:50',
            'year_from' => "required|integer|min:1900|max:" . ($currentYear + 10),
            'year_to' => "nullable|integer|min:1900|max:" . ($currentYear + 10) . "|gte:year_from",
        ]);

        $generation->update($request->only('car_model_id', 'name', 'year_from', 'year_to'));
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