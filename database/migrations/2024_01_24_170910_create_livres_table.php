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
        if (!Schema::hasTable('livres')) {
        Schema::create('livres', function (Blueprint $table) {
             $table->id();
            $table->string('titre');
            $table->string('isbn')->unique()->nullable();
            $table->year('annee_publication')->nullable();
            $table->string('genre')->nullable();
            $table->text('description')->nullable();
            $table->text('resume')->nullable();
            $table->string('langue')->nullable();
            $table->integer('nombre_exemplaires')->default(0);
            $table->boolean('disponible')->default(true);
            $table->string('image_couverture')->nullable();
            $table->foreignId('auteur_id')->constrained('auteurs')->onDelete('cascade');
            $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livres');
    }
};
