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
            $table->enum('status', ['pass', 'reject', 'complete'])->default('pass')->collation('utf8_unicode_ci');
            $table->string('image_url')->collation('utf8_unicode_ci');
            $table->string('size')->collation('utf8_unicode_ci');
            $table->integer('x_pos');
            $table->integer('y_pos');
            $table->integer('width');
            $table->integer('height');
            $table->string('identifier')->collation('utf8_unicode_ci');
            $table->timestamps();

            $table->integer('ps_id')->unsigned();
            $table->foreign('ps_id')->references('id')->on('print_sheet');
            $table->integer('order_item_id')->unsigned();
            $table->foreign('order_item_id')->references('id')->on('order_item');
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
