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
        Schema::create('meteos', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->json('json');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('visibilite_id');

            $table->foreign('visibilite_id')->references('id')->on('visibilites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meteos');
    }
};
