<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function getUsers() {
        $users = User::orderBy('id', 'Desc')->get();
        $data = ['users' => $users];
        return view('admin.users.home', $data);

    }

    public function getUsersEdit($id) {
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.user_edit', $data);
    }

}
