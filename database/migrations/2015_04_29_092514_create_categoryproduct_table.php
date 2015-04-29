<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryproductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('category_product', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('categoris');
            $table->integer('product_id')->references('id')->on('products');
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
        Schema::drop('category_product');
	}

}
