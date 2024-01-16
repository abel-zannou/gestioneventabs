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
        Schema::table('nomines', function (Blueprint $table) {
            // $table->string('email_nomine');
            // $table->string('code_connexion', 6); // Champ pour stocker le code à 6 chiffres
            // $table->string('attrib_nomine')->nullable(); // Champ pour stocker le code à 6 chiffres
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nomines', function (Blueprint $table) {
            //
        });
    }
};
