<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Category;
use App\Http\Models\Slider;
use App\Http\Models\Product;
use App\Http\Models\Order;
use Validator;

class ContentController extends Controller
{

  // getHome
    public function getHome() {
        $categories = Category::where('section', '0')->orderBy('name', 'Asc')->get();
        $sliders = Slider::where('status', 1)->orderBy('sorder','Asc')->get();
        $data = ['categories' => $categories, 'sliders' => $sliders];
        return view('home', $data);
    }

    // getStore
    public function getStore() {
        $categories = Category::where('section', '0')->orderBy('name', 'Asc')->get();
        $data = ['categories' => $categories];
        return view('store.home', $data);
    }

    // Car number
    public function getCarProductsUser($id) {
        $car_products = Car::where('user_id', $id)->get()->count;
        $data = ['car_products' => $car_products];
        return response()->json($data);
        // return $data;
    }

    public function getAboutUs() {
        return view('aboutUs');
    }

    public function getContact() {
        return view('contact');
    }
}
