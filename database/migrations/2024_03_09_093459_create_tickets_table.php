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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('titre_ticket');
            $table->string('contenu');
            $table->dateTime('date_estime');
            $table->dateTime('date_realisation');

    
            // Define projet_id first to avoid foreign key constraint error

            $table->foreignId('projet_id')->references('id')->on('projets');

            $table->foreignId('realisateur_id')->references('id')->on('users');

            $table->foreignId('categorie_id')->references('id')->on('categories');

            $table->foreignId('priorite_id')->references('id')->on('priorites');
    
            $table->foreignId('etat_id')->references('id')->on('etats');
    
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
