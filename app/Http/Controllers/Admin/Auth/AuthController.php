<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm() {
        if(Auth::guard('admin')->check()) {
            return redirect('admin/dashboard');
        }

        return view('backend.auth.login');
    }

    public function adminLogin(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8|max:20',
        ]);

        $remember = !empty($request->remember) ? true : false;

        if(Auth::guard("admin")->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('admin/dashboard');
        }else {
            return redirect()->back()->with('error', 'Incorrect email or password.');
        }
    }

    public function showForgetPasswordForm() {
        return view('backend.auth.forget_password');
    }

    public function sendResetPasswordEmail(Request $request) {
        return $request->all();
    }

    public function showResetPasswordForm() {
        return view('backend.auth.reset_password');
    }

    public function resetPassword(Request $request) {
        return $request->all();
    }

    public function logout() {
        if(Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        return redirect('/');
    }


}
