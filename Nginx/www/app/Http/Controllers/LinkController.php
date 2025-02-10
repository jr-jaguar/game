<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\LinkService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LinkController extends Controller
{
    public function __construct(
        private readonly LinkService $linkService
    ) {}

    public function regenerate(Request $request, string $token): JsonResponse
    {
        try {
            $newLinkDTO = $this->linkService->regenerateLinkByToken($token);

            return response()->json([
                'game_url' => route('game.show', ['token' => $newLinkDTO->token])
            ]);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => __('messages.errors.regenerate_error')],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function deactivate(Request $request, string $token): JsonResponse
    {
        try {
            $this->linkService->deactivateLinkByToken($token);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => __('messages.errors.deactivate_error')],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
