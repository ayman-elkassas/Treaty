<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->integer('user_id')->unsigned();
	        $table->float('lat')->nullable();
	        $table->float('lng')->nullable();
	        $table->string('logo')->nullable();

            $table->timestamps();

            //relations
	        //Self Relationship (parent dep contains on some deps)
	        $table->foreign('user_id')
		        ->references('id')->on('users')->onDelele('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippings');
    }
}
