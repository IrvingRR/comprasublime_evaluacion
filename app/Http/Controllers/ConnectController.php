<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash, Auth, Mail, Str;
use App\Mail\UserSendRecover;
use App\Mail\UserSendNewPassword;
use App\User;

class ConnectController extends Controller
{
  public function __construct() {
    $this->middleware('guest')->except(['getLogout']);
  }

    public function getLogin() {
        return view('connect.login');
    }

    public function postLogin(Request $request) {
        $rules = [
          'email' => 'required|email',
          'password' => 'required|min:8'
        ];

        $messages = [
          'email.required' => 'Ingrese su correo electrónico.',
          'email.email' => 'El formato de su correo electrónico es invalido.',
          'password.required' => 'Ingrese su contraseña.',
          'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Oops, ocurrio un error, es necesario que cumpla con lo siguiente:')->with('typealert', 'danger');
        else:

          if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)):
            if(Auth::user()->status == "100"):
              return redirect('/logout');
            else:
              return redirect('/');
            endif;
          else:
            return back()->with('message', 'Oops, el correo o la contraseña son incorrectos')->with('typealert', 'danger');
          endif;

        endif;
    }

    public function getRegister() {
        return view('connect.register');
    }

    public function postRegister(Request $request) {
        $rules = [
            'name'  => "required",
            'lastname'  => 'required',
            'email'  => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'cpassword' =>'required|min:8|same:password'
        ];

        $messages = [
          'name.required' => 'Necesitamos que ingrese su nombre.',
          'lastname.required' => 'Necesitamos que ingrese su apellido.',
          'email.required' => 'Necesitamos que ingrese su correo electrónico.',
          'email.email' => 'El formato de su correo electrónico es invalido.',
          'email.unique' => 'Ya existe un usuario con ese correo electrónico.',
          'password.required' => 'Necesitamos que ingrese una contraseña.',
          'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
          'cpassword.required' => 'Es necesario que confirme la contraseña.',
          'cpassword.min' => 'La contraseña debe tener al menos 8 caracteres.',
          'cpassword.same' => 'Las contraseñas no coincíden.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Oops, ocurrio un error')->with('typealert', 'danger');
        else:
          $user = new User;
          $user->name = e($request->input('name'));
          $user->lastname = e($request->input('lastname'));
          $user->email = e($request->input('email'));
          $user->password = Hash::make($request->input('password'));
          $user->cpassword = Hash::make($request->input('cpassword'));

          if($user->save()):
              return redirect('/login')->with('message', '¡Cuenta creada exitosamente!')->with('typealert', 'success');
          endif;
        endif;
    }

    public function getLogout() {
      $status = Auth::user()->status;
      Auth::logout();
      if($status == "100"):
        return redirect('/login')->with('message', 'Su cuenta ha sido suspendida')->with('typealert', 'danger');
      else:
        return redirect('/');
      endif;
    }

    public function getRecover() {
      return view('connect.recover');
    }

    public function postRecover(Request $request) {
      $rules = [
          'email'  => 'required|email|email'
      ];

      $messages = [
        'email.required' => 'Necesitamos que ingrese su correo electrónico.',
        'email.email' => 'El formato de su correo electrónico es invalido.',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);
      if($validator->fails()):
          return back()->withErrors($validator)->with('message', 'Oops, ocurrio un error')->with('typealert', 'danger');
      else:
        $user = User::where('email', $request->input("email"))->count();
        if($user == "1"):
          $user = User::where('email', $request->input('email'))->first();
          $code = rand(100000, 999999);
          $data = ['name'=>$user->name, 'email'=>$user->name, 'lastname'=>$user->lastname, 'code' => $code];
          $u = User::find($user->id);
          $u->password_code = $code;
          if($u->save()):
          Mail::to($user->email)->send(new UserSendRecover($data));
          return redirect('/reset?email='.$user->email)->with('message', 'Ingrese el código que le fue enviado a su correo electrónico.')->with('typealert', 'success');
        endif;
        else:
          return back()->with('message', 'El correo electrónico ingresado no existe en la base de datos del sistema.')->with('typealert', 'danger');
        endif;
      endif;
    }


    public function getReset(Request $request) {
      $data = ['email'=> $request->get('email')];
      return view('connect.reset', $data);
    }


    public function postReset(Request $request) {
      $rules = [
          'email'  => 'required|email',
          'code' => 'required'
      ];

      $messages = [
        'email.required' => 'Necesitamos que ingrese su correo electrónico.',
        'email.email' => 'El formato de su correo electrónico es invalido.',
        'code.required' => 'Es necesario que ingrese el código de recuperación'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);
      if($validator->fails()):
          return back()->withErrors($validator)->with('message', 'Oops, ocurrio un error')->with('typealert', 'danger');
      else:
        $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))->count();

        if($user == "1"):
                $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))->first();
          $new_password = Str::random(8);
          $user->password = Hash::make($new_password);
          $user->password_code = null;
          if($user->save()):
            $data = ['name' => $user->name, 'password' => $new_password, 'lastname' => $user->lastname];
            Mail::to($user->email)->send(new UserSendNewPassword($data));
            return redirect('/login')->with('message', '¡La contraseña fue reestablecida exitosamente!, le hemos enviado un correo electrónico con su nueva contraseña para que pueda ahora iniciar sesión.')->with('typealert', 'success');
          endif;
        else:
          return back()->with('message','El correo electrónico o código de recuperación son incorrectos')->with('typealert', 'danger');
        endif;

      endif;
    }


    // FUNCIONES DE LAS PLANTILLAS A MOSTRAR AL PROFESOR
    public function getPlantillaPassword() {
      return view('emails.password_plantilla');
    }

    public function getPlantillaSend() {
      return view('emails.send_plantilla');
    }

     public function getPlantillaCorreo() {
      return view('emails.correo_plantilla');
    }
}
