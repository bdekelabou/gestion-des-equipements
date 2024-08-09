<?php

 
use App\Enums\EtapesEnums;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("equipement_id");
            // $table->foreignId('user_id')->constrained()->nullable()->onDelete('set null');
            $table->text("details")->nullable();
            $table->date("date_renvoi")->nullable();
            $table->date("date_reception")->nullable();
            $table->foreign("equipement_id")->references("id")->on("equipements");
            $table->enum("etape", 
            [
                EtapesEnums::Equipement_envoye()->value,
                EtapesEnums::Equipement_receptionne()->value,
                EtapesEnums::Equipement_traite()->value,
                EtapesEnums::Equipement_renvoye()->value,
                EtapesEnums::Cloture()->value,
                
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
