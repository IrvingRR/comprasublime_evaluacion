<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Models\Product;
use App\Http\Models\Order;
use App\Http\Models\Message;

class DashboardController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
      $this->middleware('user.status');
      $this->middleware('user.permissions');
      $this->middleware('isadmin');
    }

    public function getDashboard() {
      $users = User::count();
      $products = Product::where('status', '1')->count();
      $orders = Order::count();
      $messages = Message::count();
      $data = ['users' => $users, 'products' => $products, 'orders' => $orders, 'messages' => $messages]; 

      return view('admin.dashboard', $data);
    }
}
