<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }
    public function getHome($module) {
        $cats = Category::where('module', $module)->orderBy('name', 'Asc')->get();
        $data = ['cats'=>$cats];
        return view('admin.categories.home', $data);
    }

    public function postCategoryAdd(Request $request) {
        $rules = [
            'name' => 'required',
            'icono' => 'required'
        ];

        $messages = [
            'name.required' => 'Se require de un nombre para la categoría',
            'icono.required' => 'Se requiere un ícono para la categoría'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger');
        else:
            $path = '/'.date('Y-m-d'); //2020-10-21
            $fileExt = trim($request->file('icono')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = str::slug(str_replace($fileExt,'',$request->file('icono')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;

            $c = new Category();
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->file_path = date('Y-m-d');
            $c->icono = $filename;
            if($c->save()):
                if($request->hasFile('icono')):
                    $fl = $request->icono->storeAs($path, $filename, 'uploads');
                endif;
                return back()->with('message','Guardado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCategoryEdit($id) {
        $cat = Category::find($id);
        $data = ['cat' => $cat];
        return view('admin.categories.edit', $data);
    }

    public function postCategoryEdit(Request $request, $id) {
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'Se require de un nombre para la categoría',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error al editar')->with('typealert', 'danger');
        else:
            $c = Category::find($id);
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            if ($request->hasFile('icono')):
                $actual_icon = $c->icono;
                $actual_file_path = $c->file_path;
                $path = '/'.date('Y-m-d'); //2020-10-21
                $fileExt = trim($request->file('icono')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = str::slug(str_replace($fileExt,'',$request->file('icono')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $fl = $request->icono->storeAs($path, $filename, 'uploads');
                $c->file_path = date('Y-m-d');
                $c->icono =$filename;
                if (!is_null($actual_icon)):
                    unlink($upload_path.'/'.$actual_file_path.'/'.$actual_icon);
                endif;
            endif;
            if($c->save()):
                return back()->with('message','La categoria ' .$c->name. ' se ha editado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCategoryDelete($id) {
        $c = Category::find($id);
        if($c->delete()):
            return back()->with('message','La categoria '.$c->name .' fue eliminada exitosamente.')->with('typealert', 'success');
        endif;
    }
}
