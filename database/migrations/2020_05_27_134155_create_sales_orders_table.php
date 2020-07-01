<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->date('order_date');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('category_id');
            $table->string('details');
            $table->integer('quantity');
            $table->integer('unit_price');
            $table->integer('paid_amount')->default(0);
            $table->integer('balance')->nullable();;
            $table->date('due_date');
            $table->string('payment_status')->default('Unpaid');
            $table->string('order_status')->default('Pending');
            $table->string('layout_status')->default('Pending');
            $table->timestamps();

            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_orders');
    }
}
