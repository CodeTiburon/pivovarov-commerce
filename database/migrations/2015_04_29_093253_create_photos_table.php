<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('photos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('product_id')->references('id')->on('products');;
            $table->string('image');
            $table->timestamps();

            // Add needed columns here (f.ex: name, slug, path, etc.)
            // $table->string('name', 255);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('photos');
	}

}
