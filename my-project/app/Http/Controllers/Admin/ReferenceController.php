<?php

namespace App\Http\Controllers\Admin;

use App\Models\BodyType;
use App\Models\Country;
use App\Models\DriveType;
use App\Models\EngineType;
use App\Models\Branch;
use App\Models\TransmissionType;
use App\Models\Equipment;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;

class ReferenceController extends Controller
{
    public function index(Request $request)
    {
        // Поиск
        $search = $request->input('search');
    
        // Получаем номера страниц
        $bodyTypePage = $request->input('page_body_type', 1);
        $countryPage = $request->input('page_country', 1);
        $driveTypePage = $request->input('page_drive_type', 1);
        $engineTypePage = $request->input('page_engine_type', 1);
        $transmissionTypePage = $request->input('page_transmission_type', 1);
        $branchPage = $request->input('page_branch', 1);
    
        // Фильтрация и пагинация для каждого
        $bodyTypes = BodyType::when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->paginate(10, ['*'], 'page_body_type', $bodyTypePage);
    
        $countries = Country::when($search, fn($q) => $q->where('name', 'like', "%$search%")->orWhere('code', 'like', "%$search%"))
            ->paginate(10, ['*'], 'page_country', $countryPage);
    
        $driveTypes = DriveType::when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->paginate(10, ['*'], 'page_drive_type', $driveTypePage);
    
        $engineTypes = EngineType::when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->paginate(10, ['*'], 'page_engine_type', $engineTypePage);
    
        $transmissionTypes = TransmissionType::when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->paginate(10, ['*'], 'page_transmission_type', $transmissionTypePage);
    
        $branches = Branch::when($search, fn($q) => $q->where('name', 'like', "%$search%")->orWhere('address', 'like', "%$search%"))
            ->paginate(10, ['*'], 'page_branch', $branchPage);
    
        return view('admin.references.index', compact(
            'bodyTypes',
            'countries',
            'driveTypes',
            'engineTypes',
            'transmissionTypes',
            'branches'
        ));
    }

    // --- BodyType ---
    public function storeBodyType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:body_types,name'
        ]);
        
        BodyType::create($request->only('name'));
        return redirect()->route('admin.references.index')->with('success', 'Тип кузова успешно добавлен');
    }

    public function updateBodyType(Request $request, BodyType $bodyType)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('body_types')->ignore($bodyType->id)
            ]
        ]);
        
        $bodyType->update($request->only('name'));
        return redirect()->route('admin.references.index')->with('success', 'Тип кузова успешно обновлен');
    }

    public function destroyBodyType(BodyType $bodyType)
    {
        if ($bodyType->equipments()->exists()) {
            return back()->with('error', 'Невозможно удалить тип кузова, так как он используется в комплектациях');
        }

        $bodyType->delete();
        return redirect()->route('admin.references.index')->with('success', 'Тип кузова успешно удален');
    }

    // --- Country ---
    public function storeCountry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:countries,name',
            'code' => 'required|string|size:2|unique:countries,code|alpha|uppercase',
        ]);
        
        Country::create([
            'name' => $request->name,
            'code' => strtoupper($request->code)
        ]);
        
        return redirect()->route('admin.references.index')->with('success', 'Страна успешно добавлена');
    }

    public function updateCountry(Request $request, Country $country)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('countries')->ignore($country->id)
            ],
            'code' => [
                'required',
                'string',
                'size:2',
                'alpha',
                'uppercase',
                Rule::unique('countries')->ignore($country->id)
            ],
        ]);
        
        $country->update([
            'name' => $request->name,
            'code' => strtoupper($request->code)
        ]);
        
        return redirect()->route('admin.references.index')->with('success', 'Страна успешно обновлена');
    }

    public function destroyCountry(Country $country)
    {
        if ($country->equipments()->exists()) {
            return back()->with('error', 'Невозможно удалить страну, так как она используется в комплектациях');
        }

        $country->delete();
        return redirect()->route('admin.references.index')->with('success', 'Страна успешно удалена');
    }

    // --- DriveType ---
    public function storeDriveType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:drive_types,name'
        ]);
        
        DriveType::create($request->only('name'));
        return redirect()->route('admin.references.index')->with('success', 'Тип привода успешно добавлен');
    }

    public function updateDriveType(Request $request, DriveType $driveType)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('drive_types')->ignore($driveType->id)
            ]
        ]);
        
        $driveType->update($request->only('name'));
        return redirect()->route('admin.references.index')->with('success', 'Тип привода успешно обновлен');
    }

    public function destroyDriveType(DriveType $driveType)
    {
        if ($driveType->equipments()->exists()) {
            return back()->with('error', 'Невозможно удалить привод, так как он используется в комплектациях');
        }

        $driveType->delete();
        return redirect()->route('admin.references.index')->with('success', 'Тип привода успешно удален');
    }

    // --- EngineType ---
    public function storeEngineType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:engine_types,name'
        ]);
        
        EngineType::create($request->only('name'));
        return redirect()->route('admin.references.index')->with('success', 'Тип двигателя успешно добавлен');
    }

    public function updateEngineType(Request $request, EngineType $engineType)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('engine_types')->ignore($engineType->id)
            ]
        ]);
        
        $engineType->update($request->only('name'));
        return redirect()->route('admin.references.index')->with('success', 'Тип двигателя успешно обновлен');
    }

    public function destroyEngineType(EngineType $engineType)
    {
        if ($engineType->equipments()->exists()) {
            return back()->with('error', 'Невозможно удалить тип двигателя, так как он используется в комплектациях');
        }

        $engineType->delete();
        return redirect()->route('admin.references.index')->with('success', 'Тип двигателя успешно удален');
    }

    // --- TransmissionType ---
    public function storeTransmissionType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:transmission_types,name'
        ]);
        
        TransmissionType::create($request->only('name'));
        return redirect()->route('admin.references.index')->with('success', 'Тип КПП успешно добавлен');
    }

    public function updateTransmissionType(Request $request, TransmissionType $transmissionType)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('transmission_types')->ignore($transmissionType->id)
            ]
        ]);
        
        $transmissionType->update($request->only('name'));
        return redirect()->route('admin.references.index')->with('success', 'Тип КПП успешно обновлен');
    }

    public function destroyTransmissionType(TransmissionType $transmissionType)
    {
        if ($transmissionType->equipments()->exists()) {
            return back()->with('error', 'Невозможно удалить тип КПП, так как он используется в комплектациях');
        }

        $transmissionType->delete();
        return redirect()->route('admin.references.index')->with('success', 'Тип КПП успешно удален');
    }

    // --- Branch ---
    public function storeBranch(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50|unique:branches,name',
            'address' => [
                'required',
                'string',
                'max:100',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[а-яА-ЯёЁ\s\d\-\,\.\\/\(\)]{5,100}$/u', $value)) {
                        $fail('Введите корректный адрес (например: Москва, Велозаводская улица, 13с1)');
                    }
                },
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('branches', 'public');
        }

        Branch::create($data);
        return redirect()->route('admin.references.index')->with('success', 'Филиал успешно добавлен');
    }

    public function updateBranch(Request $request, Branch $branch)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('branches')->ignore($branch->id)
            ],
            'address' => [
                'required',
                'string',
                'max:100',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[а-яА-ЯёЁ\s\d\-\,\.\\/\(\)]{5,100}$/u', $value)) {
                        $fail('Введите корректный адрес (например: Москва, Велозаводская улица, 13с1)');
                    }
                },
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($branch->image) {
                Storage::disk('public')->delete($branch->image);
            }
            $data['image'] = $request->file('image')->store('branches', 'public');
        }

        $branch->update($data);
        return redirect()->route('admin.references.index')->with('success', 'Филиал успешно обновлен');
    }

    public function destroyBranch(Branch $branch)
    {
        if ($branch->cars()->exists()) {
            return back()->with('error', 'Невозможно удалить филиал, так как он используется в автомобилях');
        }

        if ($branch->image) {
            Storage::disk('public')->delete($branch->image);
        }

        $branch->delete();
        return redirect()->route('admin.references.index')->with('success', 'Филиал успешно удален');
    }
}