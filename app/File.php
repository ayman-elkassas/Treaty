<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    //
	//$table->string('name');
	//$table->string('size');
	//$table->string('file');
	//$table->string('path');
	//$table->string('full_file');
	//$table->string('mime_type');
	//$table->string('file_type');
	//$table->integer('relation_id');
	protected $table='files';
	protected $fillable=[
		'name',
		'size',
		'file',
		'path',
		'full_file',
		'mime_type',
		'file_type',
		'relation_id'
	];
}
