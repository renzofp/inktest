<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintSheetItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_sheet_item', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pass', 'reject', 'complete'])->default('pass');
            $table->string('image_url');
            $table->string('size');
            $table->integer('x_pos');
            $table->integer('y_pos');
            $table->integer('width');
            $table->integer('height');
            $table->string('identifier');
            $table->timestamps();
        });

        Schema::table('print_sheet_item', function (Blueprint $table) {
            // $table->unsignedBigInteger('ps_id');
            // $table->unsignedBigInteger('order_item_id');
            // $table->foreign('ps_id')->references('id')->on('print_sheet');
            // $table->foreign('order_item_id')->references('id')->on('order_item');
            $table->foreignId('ps_id')->constrained('print_sheets');
            $table->foreignId('order_product_id')->constrained('order_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_sheet_item');
    }
}
