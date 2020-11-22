<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
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
            $c = new Category();
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->icono = e($request->input('icono'));
            if($c->save()):
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
            'icono' => 'required'
        ];

        $messages = [
            'name.required' => 'Se require de un nombre para la categoría',
            'icono.required' => 'Se requiere un ícono para la categoría'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error al editar')->with('typealert', 'danger');
        else:
            $c = Category::find($id);
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->icono = e($request->input('icono'));
            if($c->save()):
                return  redirect('/admin/categories/0')->with('message','La categoria ' .$c->name. ' se ha editado con éxito.')->with('typealert', 'success');
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
