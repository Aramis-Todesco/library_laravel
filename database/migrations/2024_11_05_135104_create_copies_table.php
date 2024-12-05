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
        Schema::create('copies', function (Blueprint $table) {
            $table->id();
            $table->integer('inventory')->unique();
            $table->smallInteger('status'); //1=disponibile,2=non disponibile
            $table->smallInteger('condition'); //1=ok, 2=danneggiato, 3=smarrito
            $table->string('position',50);
            $table->date('buy_date')->nullable();
            $table->unsignedBigInteger('fk_book')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copies');
    }
};
