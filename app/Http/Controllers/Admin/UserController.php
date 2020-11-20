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

    public function getUsers($status) {
        if($status == 'all'):
            $users = User::orderBy('id', 'Desc')->paginate(10);
        else:
            $users = User::where('status', $status)->orderBy('id', 'Desc')->paginate(10);
        endif;
        $data = ['users' => $users];
        return view('admin.users.home', $data);

    }

    public function getUsersEdit($id) {
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.user_edit', $data);
    }

}
