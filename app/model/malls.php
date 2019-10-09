<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class malls extends Model
{
    //
	protected $table='malls';
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
		'country_id'
	];

	public function country_id()
	{
		return $this->hasOne('App\model\Country','id','country_id');
	}
}
