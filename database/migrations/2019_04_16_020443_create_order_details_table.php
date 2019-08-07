<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('product_id');
            $table->string('ProductName');
            $table->string('ProductCode');
            $table->bigInteger('ProductPrice');
            $table->bigInteger('LKPP')->nullable();
            $table->bigInteger('ProposedPrice');
            $table->integer('Quantity');
            $table->boolean('Accepted')->nullable();
            $table->bigInteger('RecommendedPrice')->nullable();
            $table->boolean('Status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
