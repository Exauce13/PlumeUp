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
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expediteur');
            $table->unsignedBigInteger('destinataire');

            // Clés étrangères
            $table->foreign('expediteur')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('destinataire')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('is_friends')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friends');
    }
};
