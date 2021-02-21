<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_number')->unsigned();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->float('total_price')->default(0);
            $table->string('fulfillment_status')->nullable();
            $table->timestamp('fulfilled_date')->nullable();
            $table->enum('order_status', ['pending', 'active', 'done', 'cancelled', 'resend'])->nullable();
            $table->int('customer_order_count')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
