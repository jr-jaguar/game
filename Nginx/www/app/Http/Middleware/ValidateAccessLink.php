<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Services\LinkService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

readonly class ValidateAccessLink
{
    public function __construct(
        private LinkService $linkService
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->route('token');
        $link = $this->linkService->findByToken($token);

        if (!$link || !$this->linkService->isValidLink($link)) {
            return redirect()
                ->route('register')
                ->with('error', 'Invalid or expired access link');
        }

        $request->attributes->set('player_id', $link->player_id);

        return $next($request);
    }
}
