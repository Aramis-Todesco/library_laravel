<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('isbn',13)->unique();
            $table->year('publish_year')->nullable();
            $table->integer('number_pages')->nullable();
            $table->string('language',50)->nullable();
            $table->unsignedBigInteger('fk_category')->nullable();
            $table->unsignedBigInteger('fk_publisher')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
