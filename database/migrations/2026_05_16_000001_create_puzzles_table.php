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
        Schema::create('puzzles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('fen');
            $table->string('user_color')->index();
            $table->string('best_move');
            $table->string('played_move')->nullable();
            $table->integer('move_number')->nullable();
            $table->integer('stockfish_depth')->default(3);
            $table->integer('eval_loss')->nullable();
            $table->string('classification')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puzzles');
    }
};
