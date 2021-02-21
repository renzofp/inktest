<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('');
            $table->string('vendor')->nullable();
            $table->string('type')->nullable();
            $table->string('size')->nullable();
            $table->float('price')->default(0);
            $table->string('handle')->nullable();
            $table->integer('inventory_quantity')->default(0);
            $table->string('sku')->nullable();
            $table->string('design_url')->nullable();
            $table->enum('published_state', ['inactive', 'active'])->default('active');
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
        Schema::dropIfExists('products');
    }
}
