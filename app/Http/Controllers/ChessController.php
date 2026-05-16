<?php

namespace App\Http\Controllers;

use App\Services\ChessApiAdapter;

class ChessController extends Controller
{
    protected ChessApiAdapter $chessApi;

    public function __construct(ChessApiAdapter $chessApi)
    {
        $this->chessApi = $chessApi;
    }

    public function index()
    {
        $response = $this->chessApi->getGameArchives('jaiden0');
        dd($response);

        return view('chess.index');
    }
}
