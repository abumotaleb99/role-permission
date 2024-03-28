<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('backend.auth.login');
    }

    public function login(Request $request) {
        return $request->all();
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
        return 'logout';
    }


}
