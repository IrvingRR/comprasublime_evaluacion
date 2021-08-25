<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $table = 'car';
    protected $hidden = ['created_at', 'updated_at'];

    public function product() {
        return $this->hasMany(Product::class, 'id', 'object_id');
    }
}
