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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->string('body',200);
            $table->string('image_url');
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
             $table->foreignId('category_id')->constrained()->onDelete('cascade');
             $table->decimal('latitude', 10, 8);
             $table->decimal('longitude', 11, 8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
