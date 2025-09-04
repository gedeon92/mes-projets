<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_votes_table.php
public function up()
{
    Schema::create('votes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
        $table->foreignId('candidat_id')->constrained('candidats')->onDelete('cascade');
        $table->timestamps();

        // Contrainte d'unicité pour empêcher un étudiant de voter plusieurs fois
        $table->unique(['etudiant_id']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
