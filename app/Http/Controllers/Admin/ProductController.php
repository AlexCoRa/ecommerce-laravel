<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function getHome() {
        return view('/admin/products/home');
    }

    public function getProductAdd() {
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.products.add', $data);
    }

    public function postProductAdd(Request $request) {
        $rules = [
              'name' => 'required',
              'img' => 'required',
              'price' => 'required',
              'content' => 'required'
        ];

        $messages = [
              'name.required' => 'El nombre del producto es requerido',
              'img.required' => 'Selecciones una imagen destacada',
              'img.image' => 'El archivo no es una imagen',
              'price.required' => 'Ingrese el precio del producto',
              'content.required' => 'Ingrese una descripción del producto'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:
            $path = '/'.date('Y-m-d'); //2020-10-21
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disk.uploads.root');
            $name = str::slug(str_replace($fileExt,'',$request->file('img')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            return  $filename;
            $product = new Product();
            $product->status = '0';
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('name'));
            $product->category_id = $request->input('category');
            $product->image = "image.png";
            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));

            if($product->save()):
                return redirect('/admin/products')->with('message','El producto '.$product->name.' se guardó con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }
}
