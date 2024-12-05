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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->date('loan_start_date');
            $table->date('loan_expiration_date');
            $table->date('loan_real_end_date')->nullable();
            $table->unsignedBigInteger('fk_copy')->nullable();
            $table->unsignedBigInteger('fk_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
