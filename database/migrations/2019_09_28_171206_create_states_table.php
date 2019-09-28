<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('state_name_en');
	        $table->string('state_name_ar');
	        $table->integer('country_id')->unsigned();
	        $table->integer('city_id')->unsigned();
	        $table->timestamps();

	        //Relationship
	        $table->foreign('country_id')
		        ->references('id')->on('countries')->onDelele('cascade');

	        $table->foreign('city_id')
		        ->references('id')->on('cities')->onDelele('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
