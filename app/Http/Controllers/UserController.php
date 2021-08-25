<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Image, Auth, Config, Str, Hash;
use App\User;
use App\Http\Models\Favorite;
use App\Http\Models\Product;
use App\Http\Models\Car;
use App\Http\Models\Order;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __Construct() {
        $this->middleware('auth');
    }

    public function getAccountEdit() {
      $birthday = (is_null(Auth::user()->birthday)) ? [null, null, null] : explode("-", Auth::user()->birthday);
        
      $data = ['birthday' => $birthday];
      return view('user.account_edit', $data);
    }

    public function postAccountAvatar(Request $request) {
        $rules = [
            'avatar' => 'required'
          ];
        
          $messages = [
            'avatar.required' => 'Es necesario una imagen'
          ];
        
          $validator = Validator::make($request->all(), $rules, $messages);
        
          if($validator->fails()):
              return back()->withErrors($validator)->with('message', 'Oops, ocurrio un error, es necesario que cumpla con lo siguiente:')->with('typealert', 'danger')->withInput();
          else:
            if($request->hasFile('avatar')):
              $path = '/'.Auth::id();
              $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
              $upload_path = Config::get('filesystems.disks.uploads_user.root');
              $name = Str::slug(str_replace($fileExt,'',$request->file('avatar')->getClientOriginalName()));
        
              $filename = rand(1,999).'_'.$name.'.'.$fileExt;
              $file_file = $upload_path.'/'.$path.'/'.$filename;
                
              $u = User::find(Auth::id());
              $aa = $u->avatar;
              $u->avatar = $filename;
        
              if($u->save()):
                if($request->hasFile('avatar')):
                  $fl = $request->avatar->storeAs($path, $filename, 'uploads_user');
                  $img = Image::make($file_file);
                  $img->fit(256, 256, function($constraint){
                  $constraint->upsize();
                  });
                  $img->save($upload_path.'/'.$path.'/av_'.$filename);
                endif;
                unlink($upload_path.'/'.$path.'/'.$aa);
                unlink($upload_path.'/'.$path.'/av_'.$aa);
                return back()->with('message', '¡Avatar actualizado exitosamente!')->with('typealert', 'success');
              endif;
            endif;
          endif;
    }


    public function postAccountPassword(Request $request) {
      $rules = [
        'apassword' => 'required|min:8',
        'password' => 'required|min:8',
        'cpassword' => 'required|min:8|same:password'
      ];
    
      $messages = [
        'apassword.required' => 'Escribe tu contraseña actual.',
        'apassword.min' => 'La contraseña no puede tener menos de 8 caracteres.',
        'password.required' => 'Escribe tu nueva contraseña.',
        'password.min' => 'La nueva contraseña no puede tener menos de 8 caracteres.',
        'cpassword.required' => 'Confirmar nueva contraseña.',
        'cpassword.min' => 'La contraseña no puede tener menos de 8 caracteres.',
        'cpassword.same' => 'Las contraseñas no coinciden.',
      ];
    
      $validator = Validator::make($request->all(), $rules, $messages);
    
      if($validator->fails()):
          return back()->withErrors($validator)->with('message', 'Oops, ocurrio un error, es necesario que cumpla con lo siguiente:')->with('typealert', 'danger')->withInput();
      else:
        $u = User::find(Auth::id());
        if(Hash::check($request -> input('apassword'), $u->password)):
          $u->password = Hash::make($request->input('password'));
          if($u->save()):
            return back()->withErrors($validator)->with('message', 'Contraseña actualizada exitosamente.')->with('typealert', 'success')->withInput();
          endif;
          else:
          return back()->withErrors($validator)->with('message', 'La contraseña actual es incorrecta.')->with('typealert', 'danger')->withInput();
        endif;
      endif;
        }

        public function postAccountInfo(Request $request) {
          $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|min:10',
            'year' => 'required',
            'day' => 'required',
          ];
        
          $messages = [
            'name.required' => 'Es necesario que ingrese su nombre.',
            'lastname.required' => 'Es necesario que ingrese su apellido.',
            'phone.required' => 'Es necesario que ingrese su teléfono.',
            'phone.min' => 'El teléfono no puede tener menos de 10 dígitos.',
            'year.required' => 'Es necesario que ingrese su año de nacimiento.',
            'day.required' => 'Es necesario que ingrese su día de nacimiento.',
          ];
        
          $validator = Validator::make($request->all(), $rules, $messages);
        
          if($validator->fails()):
              return back()->withErrors($validator)->with('message', 'Oops, ocurrio un error, es necesario que cumpla con lo siguiente:')->with('typealert', 'danger')->withInput();
          else:
            $date = $request->input('year')."-".$request->input('month')."-".$request->input('day');
            $u = User::find(Auth::id());
            $u->name = e($request->input('name'));
            $u->lastname = e($request->input('lastname'));
            $u->phone = e($request->input('phone'));
            $u->gender = e($request->input('gender'));
            $u->birthday = date("Y-m-d", strtotime($date)); 
            if($u->save()):
              return back()->withErrors($validator)->with('message', 'Información actualizada exitosamente.')->with('typealert', 'success')->withInput();
            else:
            endif;
          endif;
        }

        public function getFavorites($id) {
          
          $favorites = Favorite::where('user_id', $id)->get();
          $products = Product::join('user_favorites', 'user_favorites.object_id', '=', 'products.id')->where('user_favorites.user_id', $id)->get();
          $data = ['favorites' => $favorites, 'products' => $products];
          return view('user.favorites', $data);
        }

        public function getDeleteFavorite($id) {
          $f = Favorite::findOrFail($id);
          if($f->delete()):
            return back()->with("message", "Producto retirado de tus favoritos")->with("typealert", "success");
          endif;
        }

        public function getCarProducts($id) {
          $car_products = Car::where('user_id', $id)->get();
          $products = Product::join('car', 'car.object_id', '=', 'products.id')->where('car.user_id', $id)->get();
          $data = ['car_products' => $car_products, 'products' => $products];
          return view('user.car', $data);
        }

        public function getDeleteCarProduct($id) {
          $car_products = Car::where('user_id', $id)->get();
          $c = Car::findOrFail($id);
          if($c->delete()):
              $data = ['status' => 'success', 'msg' => 'Producto retirado del carrito'];
          endif;
          return response()->json($data);
        }

        public function getOrdersView($id) {
          $orders = Order::where('user_id', $id)->get();
          // $products = Product::join('car', 'car.object_id', '=', 'products.id')->where('car.user_id', $id)->get();
          $data = ['orders' => $orders];
          return view('user.orders', $data);
        }

        public function getOrdersUser($id) {
          $orders = Order::where('user_id', $id)->get();
          // $products = Product::join('car', 'car.object_id', '=', 'products.id')->where('car.user_id', $id)->get();
          $data = ['orders' => $orders];
          return response()->json($data);
        }

        public function postEditOrderDirection($id_order, $new_direction, Request $request) {
          $order = Order::findOrFail($id_order);
          $order->direction = $new_direction;
          if($order->save()):
            $data = ['status' => 'success', 'msg' => 'Dirección modificada'];
          endif;
          return response()->json($data);
        }

        public function getDeleteOrder($id) {
          $o = Order::findOrFail($id);
          if($o->delete()):
              $data = ['status' => 'success', 'msg' => 'Orden cancelada'];
          endif;
          return response()->json($data);
        }

        public function getPaidNowOrder($id) {
          $user = User::find(Auth::id());
          $order = Order::findOrFail($id);
          $car_products = Car::where('user_id', Auth::id())->get();
          $products = Product::join('car', 'car.object_id', '=', 'products.id')->where('car.user_id', Auth::id())->get();
          $data = ['order' => $order, 'user' => $user, 'products' => $products];
          return view('user.order.paid', $data);
        }
}

