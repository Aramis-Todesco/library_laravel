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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_blocked')->default(false); /* true=bloccato al prestito, false=non bloccato */
            $table->date('blocked_until')->nullable();
            $table->smallInteger('role')->nullable(); /* 0=admin,1=direttore,2=bibliotecario,3=lettore */
            $table->boolean('status')->default(true); /* true=attivo, false=disattivo */
            $table->unsignedBigInteger('fk_personal_data')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_blocked');
            $table->dropColumn('blocked_until');
            $table->dropColumn('role');
            $table->dropColumn('status');
            $table->dropColumn('fk_personal_data');

        });
    }
};
