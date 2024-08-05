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
        Schema::table('equipements', function (Blueprint $table) {

            $table->unsignedBigInteger('bureau_poste_id');
            $table->foreign('bureau_poste_id')->references('id')->on('bureau_postes');

            $table->unsignedBigInteger('type_equipement_id');

            $table->foreign('type_equipement_id')->references('id')->on('type_equipements');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipements', function (Blueprint $table) {
            //
        });
    }
};
