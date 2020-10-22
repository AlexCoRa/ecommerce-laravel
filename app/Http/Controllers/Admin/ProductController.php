<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function getHome() {
        $products = Product::with(['cat'])->orderBy('id', 'Desc')->paginate(25);
        $data = ['products' => $products];
        return view('/admin/products/home', $data);
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
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = str::slug(str_replace($fileExt,'',$request->file('img')->getClientOriginalName()));

            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $final_file = $upload_path.'/'.$path.'/'.$filename;

            $product = new Product();
            $product->status = '0';
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('name'));
            $product->category_id = $request->input('category');
            $product->file_path = date('Y-m-d');
            $product->image = $filename;
            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));

            if($product->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function (Constraint $constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                endif;
                return redirect('/admin/products')->with('message','El producto '.$product->name.' se guardó con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getProductEdit($id) {
        $p = Product::find($id);
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats, 'p' => $p];

        return view('admin.products.edit', $data);
    }

    public function postProductEdit($id, Request $request) {
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'content' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre del producto es requerido',
            'img.image' => 'El archivo no es una imagen',
            'price.required' => 'Ingrese el precio del producto',
            'content.required' => 'Ingrese una descripción del producto'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:
            $product = Product::find($id);
            $product->status = $request->input('status');
            $product->name = e($request->input('name'));
            $product->category_id = $request->input('category');
            if($request->hasFile('img')):
                $path = '/'.date('Y-m-d'); //2020-10-21
                $fileExt = trim($request->file('img')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = str::slug(str_replace($fileExt,'',$request->file('img')->getClientOriginalName()));

                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;

                $product->file_path = date('Y-m-d');
                $product->image = $filename;
            endif;
            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));

            if($product->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function (Constraint $constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                endif;
                return redirect('/admin/products')->with('message','El producto '.$product->name.' se he editado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }
}
