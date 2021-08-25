<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Category;
use App\Http\Models\Product;
use App\Http\Models\Favorite;
use Validator;

class StoreController extends Controller
{
     // postProductSearch
    public function postProductSearch(Request $request) {
        $rules = [
            'search_query' => 'required'
        ];
    
        $messages = [
            'search_query.required' => "El campo busqueda es requerido"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return redirect('/store')->withErrors($validator)->with('message', 'Oops, ocurrio un error es necesario que cumpla con lo siguiente:')->with('typealert', 'danger')->withInput();
        else:
            $products = Product::with(['cat'])->where('name', 'LIKE', '%'.$request->input('search_query').'%')->orderBy('id', 'desc')->get();
            $categories = Category::where('section', '0')->orderBy('name', 'Asc')->get();
            $data =['products' => $products, 'categories' => $categories];
            return view('store.search', $data);
        endif;
    }

    
      // getProductsCategory
    function getProductsCategory($id, $slug) {
        $products = Product::with(['cat'])->where('category_id', $id)->where('status', '1')->orderBy('id', 'desc')->paginate(10);
        $categories = Category::where('section', '0')->orderBy('name', 'Asc')->get();
        $products_favorite_user = Product::join('user_favorites', 'user_favorites.object_id', '=', 'products.id')->where('user_favorites.user_id', $id)->get();
        $favorites = Favorite::where('user_id', $id)->get();
        $data =['products' => $products, 'categories' => $categories, 'favorites' => $favorites];
        return view('store.category', $data);
    }
    
}
