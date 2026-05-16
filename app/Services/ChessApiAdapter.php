<?php

namespace App\Services;

use App\Enums\GameType;
use Carbon\CarbonInterface;
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

    /**
     * Fetches the current and previous month games, based on the gameType.
     * @return array An array of games, filtered by the specified game type if provided.
     */
    public function getGameArchives(string $username, ?GameType $gameType = null): array
    {
        $currentMonth = now();
        $previousMonth = now()->subMonthNoOverflow();

        $games = collect([
            ...$this->getGamesForMonth($username, $previousMonth),
            ...$this->getGamesForMonth($username, $currentMonth),
        ])->values()->all();

        if ($gameType) {
            $games = array_filter($games, fn($game) => $game['time_class'] === $gameType->value);
        }

        return $games;
    }

    private function getGamesForMonth(string $username, CarbonInterface $month): array
    {
        return Http::timeout(10)
            ->retry(3, 200)
            ->get(sprintf(
                'https://api.chess.com/pub/player/%s/games/%d/%02d',
                $username,
                $month->year,
                $month->month,
            ))
            ->throw()
            ->json('games') ?? [];
    }
}
