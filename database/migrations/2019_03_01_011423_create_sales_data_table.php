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
            $table->string('SalesName');
            $table->string('CustomerName');
            $table->string('ContactPerson');
            $table->string('CustomerAddress');
            $table->integer('Postcode');
            $table->bigInteger('CustomerContact');
            $table->unsignedBigInteger('by_userId');
            $table->string('branch');
            $table->string('warehouse');
            $table->string('nolang');
            $table->string('DeliveryMethod')->nullable();
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
