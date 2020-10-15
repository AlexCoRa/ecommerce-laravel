<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConnectController extends Controller
{
    public function getLogin() {
        return view('connect.login');
    }

    public function getRegister() {
        return view('connect.register');
    }

    public function postRegister(Request $request) {

        //reglas de validacion
        $rules = [
          'name' => 'required',
          'lastname' => 'required',
          'email' => 'required|email|unique:App\Models\User,email',
          'password' => 'required|min:8',
          'cpassword' => 'required|same:password'
        ];

        //almacenar el resultado de toda la validacion de arriba
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger');
        else:
        endif;
    }
}
