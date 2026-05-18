<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('content'); 
    $table->string('slug')->unique();
    $table->string('image')->nullable();
    $table->foreignId('category_id')->constrained();
    $table->enum('status', ['draft', 'published'])->default('draft');
    $table->softDeletes();
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};