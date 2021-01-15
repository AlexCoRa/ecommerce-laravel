<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PGallery;
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
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($status) {
        switch ($status) {
            case '0':
                $products = Product::with(['cat'])->where('status', '0')->orderBy('id', 'desc')->paginate(3);
            break;
            case '1':
                $products = Product::with(['cat'])->where('status', '1')->orderBy('id', 'desc')->paginate(3);
            break;
            case 'all':
                $products = Product::with(['cat'])->orderBy('id', 'desc')->paginate(3);
            break;
            case 'trash':
                $products = Product::with(['cat'])->onlyTrashed()->orderBy('id', 'desc')->paginate(3);
            break;
        }
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
            $product->code = e($request->input('code'));
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('name'));
            $product->category_id = $request->input('category');
            $product->file_path = date('Y-m-d');
            $product->image = $filename;
            $product->price = $request->input('price');
            $product->inventory = e($request->input('inventory'));
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
                return redirect('/admin/products/all')->with('message','El producto '.$product->name.' se guardó con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getProductEdit($id) {
        $p = Product::findOrFail($id);
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
            $product = Product::findOrFail($id);
            $ipp = $product->file_path;
            $ip = $product->image;
            $product->status = $request->input('status');
            $product->code = e($request->input('code'));
            $product->name = e($request->input('name'));
            $product->category_id = $request->input('category');
            if($request->hasFile('img')):
                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('img')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = str::slug(str_replace($fileExt,'',$request->file('img')->getClientOriginalName()));

                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;

                $product->file_path = date('Y-m-d');
                $product->image = $filename;
            endif;
            $product->price = $request->input('price');
            $product->inventory = e($request->input('inventory'));
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
                    unlink($upload_path.'/'.$ipp.'/'.$ip);
                    unlink($upload_path.'/'.$ipp.'/t_'.$ip);
                endif;
                return redirect('/admin/products/all')->with('message','El producto '.$product->name.' se he editado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function postProductGalleryAdd(Request $request, $id) {
        $rules = [
            'file_image' => 'required',
        ];

        $messages = [
            'file_image.required' => 'Selecciona una imagen',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:
            if($request->hasFile('file_image')):
                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = str::slug(str_replace($fileExt,'',$request->file('file_image')->getClientOriginalName()));

                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;

                $g = new PGallery();
                $g->product_id = $id;
                $g->file_path = date('Y-m-d');
                $g->file_name = $filename;

                if($g->save()):
                    if($request->hasFile('file_image')):
                        $fl = $request->file_image->storeAs($path, $filename, 'uploads');
                        $img = Image::make($final_file);
                        $img->fit(256, 256, function (Constraint $constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    endif;
                    return back()->with('message','La imagen se ha subido con exito.')->with('typealert', 'success');
                endif;
            endif;
        endif;
    }

    public function getProductGalleryDelete($id, $gid) {
        $g = PGallery::findOrFail($gid);
        $path = $g->file_path;
        $file = $g->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');

        if($g->product_id != $id):
            return back()->with('message','La imagen no se puede eliminar')->with('typealert', 'danger');
        else:
            if($g->delete()):
                return back()->with('message','La imagen ha sido borrada con exito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function postProductSearch (Request $request) {
        $rules = [
            'search' => 'required',
        ];

        $messages = [
            'search.required' => 'El campo buscar es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect('/admin/products/1')->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $products = Product::with(['cat'])->where('name', 'LIKE', '%'.$request
                            ->input('search').'%')->where('status', $request->input('status'))
                            ->orderBy('id', 'desc')
                            ->get();
                break;
                case '1':
                    $products = Product::with(['cat'])->where('code',$request
                            ->input('search'))->orderBy('id', 'desc')->get();
                break;
            endswitch;
            $data = ['products' => $products];
            return view('admin.products.search', $data);
        endif;
    }

    public function getProductDelete($id) {
        $p = Product::findOrfail($id);
        if($p->delete()):
            return back()->with('message','El Producto '.$p->name. ' se eliminó con exito.')->with('typealert', 'success');
        endif;
    }

    public function getProductRestore($id) {
        $p = Product::onlyTrashed()->where('id', $id)->first();
        $p->restore();
        if($p->restore()):
            return redirect('/admin/product/'.$p->id.'/edit')->with('message','El Producto '.$p->name. ' se restauró con éxito.')->with('typealert', 'success');
        endif;
    }
}
