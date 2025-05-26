<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ManagerController extends Controller
{

    public function index()
    {
        $managers = User::where('role', 'manager')->get();
        return view('admin.managers.index', compact('managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'manager',
        ]);

        return redirect()->route('admin.managers.index')->with('success', 'Менеджер успешно добавлен');
    }

    public function update(Request $request, User $manager)
    {
        // Валидация данных
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $manager->id,
            'phone' => 'required|string|max:20|unique:users,phone,' . $manager->id,
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
        ];
    
        $request->validate($rules);
    
        // Подготовка данных для обновления
        $data = $request->only(['name', 'email', 'phone']);
    
        // Если пароль указан — добавляем его
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
    
        // Обновление пользователя
        $manager->update($data);
    
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'manager' => $manager
            ]);
        }
    
        return redirect()->route('admin.managers.index')->with('success', 'Менеджер успешно обновлен');
    }

    public function destroy(User $manager)
    {
        $manager->delete();
        return redirect()->route('admin.managers.index')->with('success', 'Менеджер успешно удален');
    }
}