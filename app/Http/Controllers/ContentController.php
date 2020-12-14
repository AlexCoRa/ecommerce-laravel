<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function getHome() {
        $categories = Category::where('module', '0')->orderBy('name', 'Asc')->get();
        $data = ['categories' => $categories];

        return view('home',$data);
    }
}
