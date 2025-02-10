<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GameService;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    public function __construct(
        private readonly GameService $gameService
    ) {}

    public function show(string $token): View
    {
        return view('game', [
            'token' => $token
        ]);
    }

    public function play(Request $request, string $token): JsonResponse
    {
        try {
            $playerId = $request->attributes->get('player_id');
            $gameResult = $this->gameService->play($playerId);

            return response()->json([
                'current_game' => $gameResult->toArray(),
            ]);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => __('messages.errors.game_error')],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function history(Request $request, string $token): JsonResponse
    {
        try {
            $playerId = $request->attributes->get('player_id');
            $history = $this->gameService->getLastGames($playerId);

            return response()->json($history->toArray());
        } catch (\Exception $e) {
            return response()->json(
                ['error' => __('messages.errors.history_error')],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
