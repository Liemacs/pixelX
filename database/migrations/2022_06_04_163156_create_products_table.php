<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('title');
            $table->string('slug')->unique();
            $table->mediumText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->integer('stock')->default(0);
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('child_cat_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->string('photo');
            $table->string('photo_bg')->nullable();
            $table->float('price')->default(0);
            $table->float('offer_price')->default(0);
            $table->float('discount')->default(0);
            $table->date('release')->format('d/m/Y');
            $table->enum('multiplayer', ['multiplayer', 'single'])->default('single');
            $table->string('system');
            $table->string('CPU');
            $table->integer('memory');
            $table->string('graph');
            $table->integer('size');
            $table->enum('status', ['active', 'inactive'])->default('inactive');

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('child_cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
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
};
