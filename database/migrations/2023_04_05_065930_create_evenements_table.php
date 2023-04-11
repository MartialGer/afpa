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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('resume');
            $table->text('contenu');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('visibilite_id');
            $table->unsignedBigInteger('etat_id');
            $table->unsignedBigInteger('template_id');

            $table->foreign('visibilite_id')->references('id')->on('visibilites')->onDelete('cascade');
            $table->foreign('etat_id')->references('id')->on('etats')->onDelete('cascade');
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiche_evenements');
    }
};
