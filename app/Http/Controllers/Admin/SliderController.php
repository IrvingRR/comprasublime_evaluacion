<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Slider;
use Illuminate\Http\Request;
use Validator, Auth, Config, Str;

class SliderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    
    public function getHome() {
        $sliders = Slider::orderBy('sorder', 'Asc')->get();
        $data = ['sliders' => $sliders];
        return view('admin.slider.home', $data);
    }

    public function postSliderAdd(Request $request) {
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'content' => 'required',
            'sorder' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre del slider es requerido',
            'img.required' => 'Selecciona una imagen para el slider',
            'content.required' => 'El contenido del slider es requerido',
            'sorder.required' => 'Es necesario indicar un orden de aparición'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'Oops, ocurrio un error, es necesario que cumpla con lo siguiente:')->with('typealert', 'danger')->withInput();
        else:
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt,'',$request->file('img')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $file_file = $upload_path.'/'.$path.'/'.$filename;

            $slider = new Slider;
            $slider->user_id = Auth::id();
            $slider->status = $request->input('visible');
            $slider->name = $request->input('name');
            $slider->file_path = date('Y-m-d');
            $slider->file_name = $filename;
            $slider->content = $request->input('content');
            $slider->sorder = $request->input('sorder');
        
            if($slider->save()):
                if($request->hasFile('img')):
                  $fl = $request->img->storeAs($path, $filename, 'uploads');
                endif;
                return back()->with('message', '¡Guardado exitosamente!')->with('typealert', 'success')->withInput();
            endif;
        endif;
    }

    public function getSliderEdit($id) {
        $slider = Slider::findOrFail($id);
        $data = ['slider' => $slider];
        return view('admin.slider.edit', $data);

    }

    public function postSliderEdit(Request $request, $id) {
        $rules = [
            'name' => 'required',
            'content' => 'required',
            'sorder' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre del slider es requerido',
            'content.required' => 'El contenido del slider es requerido',
            'sorder.required' => 'Es necesario indicar un orden de aparición'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'Oops, ocurrio un error, es necesario que cumpla con lo siguiente:')->with('typealert', 'danger')->withInput();
        else:
          
            $slider = Slider::find($id);
            $slider->status = $request->input('visible');
            $slider->content = $request->input('content');
            $slider->sorder = $request->input('sorder');
        
            if($slider->save()):
                if($request->hasFile('img')):
                  $fl = $request->img->storeAs($path, $filename, 'uploads');
                endif;
                return back()->with('message', '¡Guardado exitosamente!')->with('typealert', 'success')->withInput();
            endif;
        endif;
    }

    public function getSliderDelete($id) {
        $slider = Slider::findOrFail($id);
        if($slider->delete()):
          return back()->with("message", "¡Slider eliminado exitosamente! ")->with("typealert", "success");
        endif;
    }
    
}
