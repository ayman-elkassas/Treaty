<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            //pk
        	$table->increments('id');

	        $table->string('dep_name_en');
	        $table->string('dep_name_ar');
	        $table->string('icon')->nullable();
	        $table->string('description')->nullable();
	        $table->string('keyword')->nullable();

	        //fk
	        $table->integer('parent_id')->unsigned()->nullable();

            $table->timestamps();

	        //Self Relationship (parent dep contains on some deps)
	        $table->foreign('parent_id')
		        ->references('id')->on('departments')->onDelele('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
