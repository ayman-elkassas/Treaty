<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('photo');
            $table->longText('content');

            $table->integer('dept_id')->unsigned()->nullable();
            $table->integer('trade_id')->unsigned()->nullable();
            $table->integer('manu_id')->unsigned()->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->integer('color_id')->unsigned()->nullable();
            $table->integer('size_id')->unsigned()->nullable();
            $table->integer('weight_id')->unsigned()->nullable();

            $table->longText('other_data');
            $table->string('weight')->nullable();;
            $table->integer('stock')->default(0);
            $table->decimal('price',5,2)->default(0);

            $table->enum('status',['pending','refused','active'])->default('pending');
            $table->longText('reason')->nullable();

            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();

            $table->date('start_offer_at')->nullable();
            $table->date('end_offer_at')->nullable();
            $table->decimal('price_offer',5,2)->default(0);


	        $table->timestamps();

            //relationships
	        $table->foreign('dept_id')->references('id')
		        ->on('departments')->onDelete('cascade');

	        $table->foreign('trade_id')->references('id')
		        ->on('trade_marks')->onDelete('cascade');

	        $table->foreign('manu_id')->references('id')
		        ->on('manufacts')->onDelete('cascade');

	        $table->foreign('currency_id')->references('id')
		        ->on('countries');

	        $table->foreign('color_id')->references('id')
		        ->on('colors')->onDelete('cascade');

	        $table->foreign('size_id')->references('id')
		        ->on('sizes')->onDelete('cascade');

	        $table->foreign('weight_id')->references('id')
		        ->on('weights')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
