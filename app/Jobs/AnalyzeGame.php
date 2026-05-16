<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

use App\Models\Game;

class AnalyzeGame implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $chessUrl)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $game = Game::where('chess_com_url', $this->chessUrl)->first();
        Log::info('PROCESSED', ['chess_url' => $this->chessUrl]);

        $game->update([
            'analysis_status' => 'processed',
        ]);
    }
}
