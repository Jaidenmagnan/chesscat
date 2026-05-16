<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChessApiAdapter
{
    public function getPlayer(string $username): array
    {
        return Http::timeout(10)
            ->retry(3, 200)
            ->get("https://api.chess.com/pub/player/{$username}")
            ->throw()
            ->json();
    }

    public function getGameArchives(string $username): array
    {
        return Http::timeout(10)
            ->retry(3, 200)
            ->get("https://api.chess.com/pub/player/{$username}/games/archives")
            ->throw()
            ->json();
    }
}
