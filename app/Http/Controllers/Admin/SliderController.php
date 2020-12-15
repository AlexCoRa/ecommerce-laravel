<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); //si está autenticado
        $this->middleware('user.status'); //si no está baneado
        $this->middleware('user.permissions'); //si tiene los permisos
        $this->middleware('isadmin'); //si es admin
    }

    public function getHome() {
        $slider = Slider::orderBy('sorder', 'Asc')->get();
        $data = ['sliders' => $slider];
        return view('admin.slider.home', $data);
    }

    public function postSliderAdd(Request $request) {
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'content' => 'required',
            'sorder' => 'required'
        ];
        $messages = [
            'name.required' => 'El nombre es requerído.',
            'img.required' => 'Seleccione una imagen para el slider.',
            'content.required' => 'El contenído del slider es requerído.',
            'sorder.required' => 'Es necesario definir un orden de aparición.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:
            $path = '/'.date('Y-m-d'); //2020-10-21
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = str::slug(str_replace($fileExt,'',$request->file('img')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;

            $slider = new Slider();
            $slider->user_id = Auth::id();
            $slider->status = $request->input('visible');
            $slider->name = e($request->input('name'));
            $slider->file_path = date('Y-m-d');
            $slider->file_name = $filename;
            $slider->content = e($request->input('content'));
            $slider->sorder = e($request->input('sorder'));

            if ($slider->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                endif;
                return back()->with('message','Guardado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getSliderEdit($id) {
        $slider = Slider::findOrFail($id);
        $data = ['slider' => $slider];
        return view('admin.slider.edit', $data);
    }

    public function postSliderEdit(Request $request, $id) {
        $rules = [
            'name' => 'required',
            'content' => 'required',
            'sorder' => 'required'
        ];
        $messages = [
            'name.required' => 'El nombre es requerído.',
            'content.required' => 'El contenído del slider es requerído.',
            'sorder.required' => 'Es necesario definir un orden de aparición.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:
            $slider = Slider::find($id);
            $slider->status = $request->input('visible');
            $slider->name = e($request->input('name'));
            $slider->content = e($request->input('content'));
            $slider->sorder = e($request->input('sorder'));

            if ($slider->save()):
                return back()->with('message','Guardado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getSliderDelete($id) {
        $slider = Slider::findOrfail($id);
        if($slider->delete()):
            return back()->with('message','El Slider se eliminó con exito.')->with('typealert', 'success');
        endif;
    }
}
