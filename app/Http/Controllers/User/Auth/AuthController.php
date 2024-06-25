<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Hash;

class AuthController extends Controller
{
    public function showLoginForm() {
        if(Auth::check()) {
            return redirect('user/dashboard');
        }

        return view('backend.auth.user.login');
    }

    public function userLogin(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8|max:20',
        ]);

        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
    
            return redirect('user/dashboard');
        }else {
            return redirect()->back()->with('error', 'Incorrect email or password.');
        }
    }

    public function showRegisterForm() {
        return view('backend.auth.user.register');
    }

    public function userRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect('user/dashboard')->with('success', 'Registration successful!');
    }

    public function logout() {
        if(Auth::check()) {
            Auth::logout();
        }

        return redirect('/user/login');
    }
}
