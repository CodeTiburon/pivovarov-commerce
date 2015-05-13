<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersSessionTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_session', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('order_id')->references('id')->on('orders');
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
        Schema::drop('orders_session');
    }

}
