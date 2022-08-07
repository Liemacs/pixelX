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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('photo')->nullable();
            $table->string('character_bg')->nullable();
            $table->boolean('is_parent')->default(false);
            $table->mediumText('summary')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('SET NULL');
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
        Schema::dropIfExists('categories');
    }
};
