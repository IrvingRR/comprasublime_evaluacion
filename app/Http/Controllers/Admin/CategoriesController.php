<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Models\Category;
use Validator, Str, Config;

class CategoriesController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
    $this->middleware('user.status');
    $this->middleware('user.permissions');
    $this->middleware('isadmin');
  }

  public function getHome($section) {
    $cats = Category::where('section', $section)->where('parent', '0')->orderBy('name', 'Asc')->get();
    $data = ['cats' => $cats, 'section' => $section];
    return view('admin.categories.home', $data);
  }

  public function postCategoryAdd(Request $request, $section) {
    $rules = [
      'name' => 'required',
      'icon' => 'required'
    ];

    $messages = [
      'name.required' => 'Es necesario un nombre para la categoria',
      'icon.required' => 'Es necesario un icono para la categoria'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'Oops, ocurrio un error, es necesario que cumpla con lo siguiente:')->with('typealert', 'danger');

    else:
      $path = '/'.date('Y-m-d');
      $fileExt = trim($request->file('icon')->getClientOriginalExtension());
      $upload_path = Config::get('filesystems.disks.uploads.root');
      $name = Str::slug(str_replace($fileExt,'',$request->file('icon')->getClientOriginalName()));
      $filename = rand(1,999).'-'.$name.'.'.$fileExt;

      $c = new Category;
      $c->section = $section;
      $c->parent = $request->input('parent');
      $c->name = e($request->input('name'));
      $c->slug = Str::slug($request->input('name'));
      $c->file_path = date('Y-m-d');
      $c->icono = $filename;
      if($c->save()):
        if($request->hasFile('icon')):
          $fl = $request->icon->storeAs($path, $filename, 'uploads');
        endif;
        return back()->with('message', '¡Categoria creada exitosamente!')->with('typealert', 'success');
      endif;
     endif;
  }

  public function getCategoryEdit($id) {
    $cat = Category::find($id);
    $data = ['cat' => $cat];
    return view('admin.categories.edit', $data);
  }

  public function postCategoryEdit(Request $request, $id) {
    $rules = [
      'name' => 'required'
    ];

    $messages = [
      'name.required' => 'Es necesario un nombre para la categoria',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'Oops, ocurrio un error, es necesario que cumpla con lo siguiente:')->with('typealert', 'danger');

    else:
     
      $c = Category::find($id);
      $c->name = e($request->input('name'));
      $c->slug = Str::slug($request->input('name'));
      if($request->hasFile('icon')):
        $actual_icon = $c->icono;
        $actual_path = $c->file_path;
        $path = '/'.date('Y-m-d');
        $fileExt = trim($request->file('icon')->getClientOriginalExtension());
        $upload_path = Config::get('filesystems.disks.uploads.root');
        $name = Str::slug(str_replace($fileExt,'',$request->file('icon')->getClientOriginalName()));
        $filename = rand(1,999).'-'.$name.'.'.$fileExt;
        $fl = $request->icon->storeAs($path, $filename, 'uploads');
        $c->file_path = date('Y-m-d');
        $c->icono = $filename;
        if(is_null($actual_icon)):
          unlink($upload_path.'/'.$actual_path.'/'.$actual_icon);
        endif; 
      endif;
      $c->order = $request->input('order');
      if($c->save()):
        return back()->with('message', '¡Categoria modificada exitosamente!')->with('typealert', 'success');
      endif;
     endif;
  }

  public function getCategoryDelete($id) {
    $c = Category::find($id);
    if($c->delete()):
      return back()->with('message', '¡Categoria eliminada exitosamente!')->with('typealert', 'success');
    endif;
  }


  public function getSubCategories($id) {
    $cat = Category::findOrFail($id);
    $data = ['category' => $cat];
    return view('admin.categories.subs_categories', $data);
  }
}
