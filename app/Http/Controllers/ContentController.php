<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function getHome() {
        $categories = Category::where('module', '0')->orderBy('name', 'Asc')->get();
        $sliders = Slider::where('status', 1)->orderBy('sorder', 'Asc')->get();
        $data = ['categories' => $categories, 'sliders' => $sliders];

        return view('home',$data);
    }
}
