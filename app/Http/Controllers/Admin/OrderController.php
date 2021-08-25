<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Order;
use App\Http\Models\Product;
use App\Http\Models\Car;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome() {
        $orders = Order::orderBy('id', 'Desc')->paginate(30);
        $data = ['orders' => $orders];
        return view('admin.orders.home', $data);
    }

    public function getOrderDelete($id) {
        $o = Order::find($id);
        if($o->delete()):
            return back()->with('message', '¡Orden eliminada exitosamente!')->with('typealert', 'success');
        endif;
    }
    

}
