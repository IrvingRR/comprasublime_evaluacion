<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Message;

class MessageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome() {
        $messages = Message::orderBy('id', 'Desc')->paginate(30);
        $data = ['messages' => $messages];
        return view('admin.messages.home', $data);
    }

    public function getMessageDelete($id) {
        $m = Message::find($id);
        if($m->delete()):
            return back()->with('message', '¡Mensaje eliminado exitosamente!')->with('typealert', 'success');
        endif;
    }
}
