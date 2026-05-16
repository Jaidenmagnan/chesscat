<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'chess_com_url',
    'username',
    'white_username',
    'black_username',
    'pgn',
    'fen',
    'time_class',
    'time_control',
    'played_at',
    'analysis_status',
])]
class Game extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'played_at' => 'datetime',
        ];
    }
}
