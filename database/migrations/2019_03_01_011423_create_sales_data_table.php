<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ProjectClass');
            $table->string('SalesName');
            $table->string('CustomerName');
            $table->string('CustomerAddress');
            $table->bigInteger('CustomerContact');
            $table->string('ThreeMonths');
            $table->unsignedBigInteger('ProductUsedId');
            $table->string('ProductQuantity');
            $table->bigInteger('ProposedPrice');
            $table->unsignedBigInteger('by_userId');
            $table->string('name');
            $table->boolean('Accepted')->nullable();
            $table->foreign('by_userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ProductUsedId')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_data');
    }
}
