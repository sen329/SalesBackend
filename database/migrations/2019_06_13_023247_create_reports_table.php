<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('sales_id');
            $table->string('SalesName');
            $table->string('CustomerName');
            $table->string('CustomerAddress');
            $table->bigInteger('CustomerContact');
            $table->unsignedBigInteger('by_userId');
            $table->string('name');
            $table->unsignedBigInteger('product_id');
            $table->string('ProductName');
            $table->string('ProductCode');
            $table->bigInteger('ProductPrice');
            $table->bigInteger('ProposedPrice');
            $table->integer('Quantity');
            $table->decimal('Margin',4,2);
            $table->bigInteger('Total');
            $table->boolean('Accepted')->nullable();
            $table->bigInteger('RecommendedPrice')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
