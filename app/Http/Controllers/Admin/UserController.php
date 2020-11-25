<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
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

    public function getUserBanned($id) {
        $u = User::findOrFail($id);
        if($u->status == 100):
            $u->status = "0";
            $msg = "El Usuario ".$u->name." se ha activo nuevamente.";
        else:
            $u->status = "100";
            $msg = "El Usuario ".$u->name." se ha suspendido con exito.";
        endif;
        if($u->save()):
            return back()->with('message',$msg)->with('typealert', 'success');
        endif;
    }

    public function getUserPermissions($id) {
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.user_permissions', $data);
    }

    public function postUserPermissions(Request $request, $id) {
        $u = User::findOrFail($id);
        $permissions = [
            'dashboard' => $request->input('dashboard'),
            'products' => $request->input('products')
        ];
        $permissions = json_encode($permissions);
        $u->permissions = $permissions;
        if ($u->save()):
            return back()->with('message','Los permisos del usuario fueron actualizados con éxito.')->with('typealert', 'success');
        endif;
    }

}
