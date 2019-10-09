<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('malls', function (Blueprint $table) {
            $table->increments('id');

	        $table->string('name_en');
	        $table->string('name_ar');
	        $table->string('facebook')->nullable();
	        $table->string('twitter')->nullable();
	        $table->string('website')->nullable();
	        $table->string('contact_name')->nullable();
	        $table->string('mobile')->nullable();
	        $table->string('email')->nullable();
	        $table->float('lat')->nullable();
	        $table->float('lng')->nullable();
	        $table->string('logo')->nullable();

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
        Schema::dropIfExists('malls');
    }
}
