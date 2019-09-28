<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
	protected $table='states';
	protected $fillable=[
		'state_name_en',
		'state_name_ar',
		'country_id',
		'city_id',
	];

	public function country_id()
	{
		return $this->hasOne('App\model\Country','id','country_id');
	}

	public function city_id()
	{
		return $this->hasOne('App\model\City','id','city_id');
	}


}
