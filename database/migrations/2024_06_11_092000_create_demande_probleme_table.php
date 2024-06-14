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
        Schema::create('demande_probleme', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_id');
            $table->foreignId('probleme_id');
            $table->enum('etat',
             ['en attente',
              'en cours', 
              'resolu']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_probleme');
    }
};
