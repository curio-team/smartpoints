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
        Schema::create('studiepunten_excels', function (Blueprint $table) {
            $table->id();
            $table->string('studentennummer');
            $table->string('klascode');
            $table->json('studiepunten');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studiepunten_excels');
    }
};
