<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminController extends Controller
{
    // Отображение формы входа
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Обработка входа
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Проверяем, является ли пользователь администратором
            if (Auth::user()->is_admin) {
                return redirect()->intended('/admin/users');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'У вас нет прав доступа к административной панели.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Неверные учетные данные.',
        ]);
    }

    // Выход
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Отображение списка пользователей
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }


    public function create()
    {
        return view('admin.users.create');
    }

    // Сохранение нового пользователя
    public function store(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Создание нового пользователя
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' =>false,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно добавлен!');
    }



    public function destroy(User $user)
    {
        // Проверка, чтобы не удалить администратора, если это не предусмотрено
        if ($user->is_admin) {
            return redirect()->route('admin.users.index')->withErrors('Невозможно удалить администратора.');
        }

        // Удаление пользователя
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно удален!');
    }

}