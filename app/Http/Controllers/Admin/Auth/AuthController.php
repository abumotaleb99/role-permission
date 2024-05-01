<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Mail;
use Str;
use App\Mail\ForgetPasswordMail;
use Hash;

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
            $admin = Auth::guard('admin')->user();
            if ($admin->status === 1) {
                Auth::guard('admin')->logout();
                return redirect()->back()->with('error', 'Your account has been banned.');
            }
    
            return redirect('admin/dashboard');
        }else {
            return redirect()->back()->with('error', 'Incorrect email or password.');
        }
    }

    public function showForgetPasswordForm() {
        return view('backend.auth.forget_password');
    }

    public function sendResetPasswordEmail(Request $request) {
        $request->validate([
            'email' => ['required', 'email', 'max:255', Rule::exists(Admin::class, 'email')],
        ]);

        $admin = Admin::where('email', '=', $request->email)->first();

        if(!empty($admin)) {
            $admin->remember_token = Str::random(30);
            $admin->save();

            Mail::to($admin->email)->send(new ForgetPasswordMail($admin));

            return redirect()->back()->with("success", "Password reset link sent successfully. Please check your email.");

        }else {
            return redirect()->back()->with("error", "This email doesn't exist. Enter a different email.");
        }
    }

    public function showResetPasswordForm($token) {
        $admin = Admin::where('remember_token', '=', $token)->first();

        if(!empty($admin)) {
            return view('backend.auth.reset_password');
        }else {
            abort(404);
        }
    }

    public function resetPassword(Request $request, $token) {
        $request->validate([
            'password' => 'required|confirmed|min:8|max:20',
        ]);

        $admin = Admin::where('remember_token', '=', $token)->first();

        $admin->password = Hash::make($request->password);
        $admin->remember_token = Str::random(30);
        $admin->save();

        return redirect(url('/login'))->with("success", "Your password has been changed successfully.");
    }

    public function logout() {
        if(Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        return redirect('/');
    }


}
