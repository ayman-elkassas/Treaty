<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cities', function (Blueprint $table) {
			$table->increments('id');
			$table->string('city_name_en');
			$table->string('city_name_ar');
			$table->integer('country_id')->unsigned();
			$table->timestamps();

			//Relationship
			$table->foreign('country_id')
				->references('id')->on('countries')->onDelele('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('cities');
	}
}
