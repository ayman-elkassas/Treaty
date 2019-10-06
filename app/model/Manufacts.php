<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Manufacts extends Model
{
    //
	protected $table='manufacts';
	protected $fillable=[
		'name_en',
		'name_ar',
		'mobile',
		'email',
		'facebook',
		'twitter',
		'website',
		'contact_name',
		'lat',
		'lng',
		'logo',
	];
}
