<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiJsController extends Controller
{
    public function getProductsSection($section, Request $request) {
        switch ($section):
            case 'home':
                $products = Product::where('status', 1)->inRandomOrder()->paginate(15);
            break;

            default:
                $products = Product::where('status', 1)->inRandomOrder()->paginate(10);
            break;
       endswitch;
       return $products;
    }
}
