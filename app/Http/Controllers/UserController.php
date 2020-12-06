<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getAccountEdit() {
        $birthday = (is_null(Auth::user()->birthday)) ? [null,null,null] : explode('-',Auth::user()->birthday);
        $data = ['birthday' => $birthday];
        return view('user.account_edit', $data);
    }

    public function postAccountAvatar(Request $request) {
        $rules = [
            'avatar' => 'required',
        ];

        $messages = [
            'avatar.required' => 'Selecciona una imagen',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:
            if($request->hasFile('avatar')):
                /*en la carpeta config/filesystems.php agregar la ruta de la nueva carpeta que se va a crear cuando
                un usuario suba una foto de perfil*/
                $path = '/'.Auth::id();
                $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads_users.root');
                $name = Str::slug(str_replace($fileExt,'',$request->file('avatar')->getClientOriginalName()));

                $filename = rand(1,999).'_'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;

                $u = User::find(Auth::id());
                $actual_avatar = $u->avatar;
                $u->avatar = $filename;

                if($u->save()):
                    if($request->hasFile('avatar')):
                        $fl = $request->avatar->storeAs($path, $filename, 'uploads_users');
                        $img = Image::make($final_file);
                        $img->fit(256, 256, function (Constraint $constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/av_'.$filename);
                    endif;
                    //eliminar la foto de perfil anterior
                    unlink($upload_path.'/'.$path.'/'.$actual_avatar);
                    unlink($upload_path.'/'.$path.'/av_'.$actual_avatar);
                    return back()->with('message','Foto de perfil actualizado con exito.')->with('typealert', 'success');
                endif;
            endif;
        endif;
    }

    public function postAccountPassword(Request $request) {
        $rules = [
            'apassword' => 'required|min:8',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password',
        ];

        $messages = [
            'apassword.required' => 'Escriba su contraseña actual',
            'apassword.min' => 'La contraseña actual debe tener al menos 8 caracteres',
            'password.required' => 'Escriba su nueva contraseña',
            'password.min' => 'Su nueva contraseña debe tener al menos 8 caracteres',
            'cpassword.required' => 'Confirme su nueva contraseña',
            'cpassword.min' => 'La confirmacion de su nueva contraseña debe tener al menos 8 caracteres',
            'cpassword.same' => 'Las contraseña no coinciden.'

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:
            $u = User::find(Auth::id());
            if (Hash::check($request->input('apassword'),$u->password)):
               $u->password = Hash::make($request->input('password'));
                if ($u->save()):
                    return back()->with('message','La contraseña se actualizó con éxito.')->with('typealert', 'success');
                endif;
            else:
                return back()->with('message','Su contraseña actual es errónea.')->with('typealert', 'danger');
            endif;
        endif;
    }

    public function postAccountInfo(Request $request) {
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|min:9|max:9',
            'year' => 'required',
            'day' => 'required',
        ];

        $messages = [
            'name.required' => 'Su nombre es requerído.',
            'lastname.required' => 'Sus apellidos son requerídos',
            'phone.required' => 'Su número telefónico es requerído.',
            'phone.min' => 'Su número telefónico debe tener como mínimo 9 caracteres',
            'phone.max' => 'Su número telefónico debe tener como maximo 9 caracteres',
            'year.required' => 'Su año de nacimiento es requerído.',
            'day.required' => 'Su día de nacimiento es requerído.'

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:
            $date = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
            $u = User::find(Auth::id());
            $u->name = e($request->input('name'));
            $u->lastname = e($request->input('lastname'));
            $u->phone = e($request->input('phone'));
            $u->birthday = date("Y-m-d", strtotime($date));
            $u->gender = e($request->input('gender'));
            if ($u->save()):
                return back()->with('message','Su información personal se actualizó con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }
}

