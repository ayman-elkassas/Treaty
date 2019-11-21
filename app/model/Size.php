<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    //
    protected $table='sizes';
    protected $fillable=[
        'name_en',
        'name_ar',
        'is_public',
        'dept_id'
    ];

    public function dept_id()
    {
        return $this->hasOne('App\model\Department','id','dept_id');
    }
}
