<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    protected $table='colors';
    protected $fillable=[
        'name_en',
        'name_ar',
        'color',
    ];
}
