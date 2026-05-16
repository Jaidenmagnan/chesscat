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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('chess_com_url')->unique();
            $table->string('username')->index();
            $table->string('white_username')->index();
            $table->string('black_username')->index();
            $table->longText('pgn');
            $table->string('fen')->nullable();
            $table->string('time_class')->index();
            $table->string('time_control');
            $table->timestamp('played_at')->nullable()->index();
            $table->string('analysis_status')->default('pending')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
