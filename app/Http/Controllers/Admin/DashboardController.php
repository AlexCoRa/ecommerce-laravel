<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getDashboard() {
        $users = User::count();
        $products = Product::where('status', '1')->count();
        $data = ['users' => $users, 'products' => $products];
        return view('admin.dashboard',$data);
    }
}
