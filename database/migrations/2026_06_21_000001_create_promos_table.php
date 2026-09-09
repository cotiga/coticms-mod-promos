<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Table `promos` à son état final — création consolidée (2026-09-09).
 *
 * Remplace la création d'origine et toutes ses retouches. Ne fait rien là où la
 * table existe déjà : les sites en place gardent leur schéma, seule une
 * installation neuve passe par ici.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('promos')) {
            return;
        }

        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 150)->nullable();
            $table->text('contenu')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->boolean('onl')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
