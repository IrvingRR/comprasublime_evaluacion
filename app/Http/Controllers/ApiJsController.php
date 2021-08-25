<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config, Auth;
use App\Http\Models\Product;
use App\Http\Models\Favorite;
use App\Http\Models\Car;
use App\Http\Models\Order;
use App\Http\Models\Message;


class ApiJsController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['getProductsSection']);
    }

    function getProductsSection($section, Request $request) {
        $items_x_page = Config::get('cms.products_per_page');
        $items_x_page_random = Config::get('cms.products_per_page_random');
        switch ($section):
            case 'home':
                $products = Product::where('status', 1)->inRandomOrder()->paginate($items_x_page_random);
                break;
            
            default:
            $products = Product::where('status', 1)->inRandomOrder()->paginate($items_x_page_random);
                break;
        endswitch;

        return $products;
    }

    function postFavoriteAdd($object, $module, Request $request) {
        $query = Favorite::where('user_id', Auth::id())->where('module', $module)->where('object_id', $object)->count();
        if($query > 0): 
            $data = ['status' => 'error', 'msg' => 'Este producto ya está guardado en sus favoritos'];
        else:
            $favorite = new Favorite;
            $favorite->user_id = Auth::id();
            $favorite->module = $module;
            $favorite->object_id = $object;
            if($favorite->save()):
                $data = ['status' => 'success', 'msg' => 'Producto guardado en favoritos'];
            endif;
        endif;
        return response()->json($data);
    }

    public function postUserFavorites(Request $request) {
        $objects = json_decode($request->input('objects'), true);
        $query = Favorite::where('user_id', Auth::id())->where('module', $request->input('module'))->whereIn('object_id', explode(",", $request->input('objects')))->pluck('object_id');
        if(count(collect($query)) > 0):
            $data = ['status' => 'success', 'count' => count(collect($query)), 'objects' => $query];
        else:
            $data = ['status' => 'success', 'count' => count(collect($query))]; 
        endif;
        return response()->json($data);
        // return response()->json($request->input('objects'));
    }


    // postCarAdd
    function postCarAdd($object, $module, Request $request) {
        $query = Car::where('user_id', Auth::id())->where('module', $module)->where('object_id', $object)->count();
        if($query > 0):
            $data = ['status' => 'error', 'msg' => 'Este producto ya se encuentra dentro del carrito'];
        else:
            $car = new Car;
            $car->user_id = Auth::id();
            $car->module = $module;
            $car->object_id = $object;
    
            if($car->save()):
                $data = ['status' => 'success', 'msg' => 'Producto agregado al carrito'];
            endif;
        endif;
        return response()->json($data);
    }

    public function getCarUserProducts($id) {
        $car_products = Car::where('user_id', $id)->get();
        $products = Product::join('car', 'car.object_id', '=', 'products.id')->where('car.user_id', $id)->get();
        $data = ['car_products' => $car_products, 'products' => $products];
        return response()->json($data);
    }


    public function postOrdersAdd($id_user, $module, $total, $cantidad, $direction, $paid_out, Request $request) {
        $order = new Order;
        $order->user_id = Auth::id();
        $order->module = $module;
        $order->amount_products = $cantidad;
        $order->total = $total;
        $order->direction = $direction;
        $order->paid_out = $paid_out;
        if($order->save()):
            $data = ['status' => 'success', 'msg' => 'Orden realizada'];
        endif;
        return response()->json($data);
    }   

    public function getDeleteAllCarProducts($id_user) {
        $car_products = Car::where('user_id', $id_user)->get();
        $c = Car::findOrFail($id_user);
        if($c->delete()):
            $data = ['status' => 'success', 'msg' => 'Carrito vaciado'];
        endif;
        return response()->json($data);
    }

    public function postSendMessage($name, $lastname, $email, $mensaje, Request $request) {
        $message = new Message;
        $message->name = $name;
        $message->lastname = $lastname;
        $message->email = $email;
        $message->message = $mensaje;

        if($message->save()):
            $data = ['status' => 'success', 'msg' => 'Mensaje enviado'];
        endif;
        return response()->json($data);
    }
}
