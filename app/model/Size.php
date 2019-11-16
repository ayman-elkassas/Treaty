<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    //
    protected $table='colors';
    protected $fillable=[
        'name_en',
        'name_ar',
        'is_public',
        'dept_id'
    ];
}
