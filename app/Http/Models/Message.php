<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $table = 'messages';
    protected $hidden = ['created_at', 'updated_at'];
}
