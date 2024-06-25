<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }

    public function dashboard() {

        $data['header_title'] = 'Dashboard';
        
        if(Auth::guard('admin')->check()) {
            if (is_null($this->user) || !$this->user->can('dashboard.view')) {
                abort(403, 'Access Denied: You do not have permission to view the admin dashboard.');
            }
            
            return view('backend.admin.dashboard', $data);

        }elseif(Auth::check()) {
            return view('backend.user.dashboard', $data);

        }

    }
    
}
