<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
	/*
	 * $table->increments('id');
		        $table->string('title');
		        $table->string('photo');
		        $table->string('');

		        $table->integer('dept_id')->unsigned()->nullable();
		        $table->integer('trade_id')->unsigned()->nullable();
		        $table->integer('manu_id')->unsigned()->nullable();
		        $table->integer('currency_id')->unsigned()->nullable();
		        $table->integer('color_id')->unsigned()->nullable();
		        $table->integer('size_id')->unsigned()->nullable();
		        $table->integer('weight_id')->unsigned()->nullable();

		        $table->longText('other_data');
		        $table->string('weight');
		        $table->integer('stock')->default(0);
		        $table->decimal('price',5,2)->default(0);

		        $table->enum('status',['pending','refused','active'])->default('pending');
		        $table->longText('reason')->nullable();

		        $table->date('start_at')->nullable();
		        $table->date('end_at')->nullable();

		        $table->date('start_offer_at')->nullable();
		        $table->date('end_offer_at')->nullable();
		        $table->decimal('price_offer',5,2)->default(0);
	 */

	protected $table='products';
	protected $fillable=[
		'title',
		'photo',
		'content',
		'dept_id',
		'trade_id',
		'manu_id',
		'currency_id',
		'color_id',
		'size_id',
		'weight_id',
		'other_data',
		'weight',
		'stock',
		'price',
		'status',
		'reason',
		'start_at',
		'end_at',
		'start_offer_at',
		'end_offer_at',
		'price_offer',
	];

	public function files()
    {
        return $this->hasMany('App\File','relation_id','id')
            ->where('file_type','product');
    }


}
