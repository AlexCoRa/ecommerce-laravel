<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ConnectController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except(['logout']);
    }

    public function getLogin() {
        return view('connect.login');
    }

    public function postLogin(Request $request) {
        //reglas de validacion
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];

        //mensajes de validacion
        $messages = [
            'email.required' => 'Su correo electrónico es obligatorio.',
            'email.email' => 'El formato de su correo electrónico es invalido',
            'password.required' => 'Contraseña obligatoria',
            'password.min' => 'La contraseña debe de tener al menos 8 caracteres.'
        ];

        //almacenar el resultado de toda la validacion de arriba
        //si da error lanza los errores de validacion
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger');
        else:
            //autenticar si existe el usuario con el email y password
            if (Auth::attempt(['email'=> $request->input('email'), 'password' => $request->input('password')], true)):
                if(Auth::user()->status == "100"):
                    return redirect('/logout');
                else:
                    return redirect('/');
                endif;
            else:
                return back()->with('message','Correo electrónico o contraseña incorrecta')->with('typealert', 'danger');
            endif;
        endif;
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
              'cpassword' => 'required|min:8|same:password'
        ];

        //mensajes de validacion
        $messages = [
              'name.required' => 'Su nombre es obligatorio.',
              'lastname.required' => 'Su apellido es obligatorio.',
              'email.required' => 'Su correo electrónico es obligatorio.',
              'email.email' => 'El formato de su correo electrónico es invalido',
              'email.unique' => 'Ya existe un usuario con este correo electrónico',
              'password.required' => 'Contraseña obligatoria',
              'password.min' => 'La contraseña debe de tener al menos 8 caracteres.',
              'cpassword.required' => 'Es necesario confirmar la contraseña',
              'cpassword.min' => 'La confirmación de la contraseña debe de tener al menos 8 caracteres.',
              'cpassword.same' => 'Las contraseñas no coinciden.'
        ];

        //almacenar el resultado de toda la validacion de arriba
        //si da error lanza los errores de validacion
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger');

        //si no da ningun error se guarda en la base de datos
        else:
            $user = new User();
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->email = e($request->input('email'));
            $user->password = Hash::make($request->input('password'));
            if($user->save()):
                return redirect('/login')->with('message','Registro Existóso, Inicie Sesión')->with('typealert', 'success');
            endif;
        endif;
    }
    public function logout() {
        $status = Auth::user()->status;
        Auth::logout();
        if($status == "100"):
            return redirect('login')->with('message','Su usuario fue suspendido')->with('typealert', 'danger');
        else:
            return redirect('/');
        endif;
    }

    public function getRecover() {
        return view('connect.recover');
    }

    public function postRecover(Request $request) {
        //reglas de validacion
        $rules = [
            'email' => 'required|email'
        ];

        //mensajes de validacion
        $messages = [
            'email.required' => 'Su correo electrónico es obligatorio.',
            'email.email' => 'El formato de su correo electrónico es invalido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger');
        else:
            $user = User::where('email', $request->input('email'))->count();
            if($user == "1"):
                $user = User::where('email', $request->input('email'))->first();
                $code = rand(100000, 999999);
                $data = ['name' => $user->name, 'email' => $user->email, 'lastname'=> $user->lastname, 'code' => $code];
                return view('emails.user_password_recover', $data);
            else:
                return back()->with('message','Este correo electrónico no existe')->with('typealert', 'danger');
            endif;
        endif;
    }
}
