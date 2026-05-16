<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'game_id',
    'fen',
    'user_color',
    'best_move',
    'played_move',
    'move_number',
    'stockfish_depth',
    'eval_loss',
    'classification',
])]
class Puzzle extends Model
{
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
