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
        Schema::create('chapdiffusion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('histoire_id')->constrained('histoire')->onDelete('cascade');
            $table->integer('numerochapitre');
            $table->string('titre_chapitre');
            $table->string('url_chapitre');
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapdiffusion');
    }
};
