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
        Schema::create('note_de_services', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->unique();
            $table->string('pdf');
            $table->string('auteur');
            $table->date('date_creation');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('visibilite_id');
            $table->unsignedBigInteger('etat_id');

            $table->foreign('visibilite_id')->references('id')->on('visibilites')->onDelete('cascade');
            $table->foreign('etat_id')->references('id')->on('etats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_de_services');
    }
};
