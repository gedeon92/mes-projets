<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign(['etudiant_id']); // Supprime la contrainte étrangère sur etudiant_id
            $table->dropColumn('etudiant_id'); // Supprime la colonne etudiant_id
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Ajoute user_id
        });
    }

    public function down()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
        });
    }

};
