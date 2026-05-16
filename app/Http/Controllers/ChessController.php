<?php

namespace App\Http\Controllers;

use App\Enums\GameType;
use App\Services\ChessApiAdapter;
use App\Models\Game;
use App\Jobs\AnalyzeGame;

class ChessController extends Controller
{
    public function __construct(private ChessApiAdapter $chessApi) {}

    public function index()
    {
        $username = 'jaiden0';

        $response = $this->chessApi->getGameArchives($username, GameType::Rapid);

        $games = collect($response)->map(function (array $chessComGame) use ($username) {
            return Game::updateOrCreate(
                [
                    'chess_com_url' => $chessComGame['url'],
                ],
                [
                    'username' => $username,
                    'white_username' => $chessComGame['white']['username'],
                    'black_username' => $chessComGame['black']['username'],
                    'pgn' => $chessComGame['pgn'],
                    'fen' => $chessComGame['fen'] ?? null,
                    'time_class' => $chessComGame['time_class'],
                    'time_control' => $chessComGame['time_control'],
                    'played_at' => now()->setTimestamp($chessComGame['end_time'] ?? time()),
                    'analysis_status' => 'pending',
                ]
            );
        });

        foreach ($games as $game) {
            if ($game->analysis_status === 'pending') {
                AnalyzeGame::dispatch($game->chess_com_url);
            }
        }

        dd(@$games);

        return view('chess.index');
    }
}
