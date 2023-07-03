<?php

namespace App\Http\Controllers;

use App\Mail\RegisterSuccessMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function registerPage()
    {
        return view('auth.register');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'=>'required|min:2',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'same:password',
            'captcha' => 'required|captcha'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request-> password),
        ]);
        
        $user->syncRoles('user');

        $pass = $user->password;

        Mail::to($user->email)->send(new RegisterSuccessMail($user, $pass));

        return redirect()->route('auth.login-page')->with("success_register", "Вы успешно зарегестрировались! Войдите в аккаунт");
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function createNewUser(){
        return view('users.create');
    }
    public function storeUserByAdmin(Request $request)
    {
        $request->validate([
            'name'=>'required|min:2',
            'email' =>'required|email|unique:users',
        ]);

        $pass = Str::random(6);

        $user = User::create([
            'name'=>$request->name,
            'email' => $request->email,
            'password' => Hash::make($pass),
        ]);

        $user->syncRoles('user');

        Mail::to($user->email)->send(new RegisterSuccessMail($user, $pass));

        return redirect()->route('users.index')->with("success_register", "Пользователь успешно создан");
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => "Логин или пароль введен неверно!"
        ])->onlyInput("email");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
