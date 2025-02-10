<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\PlayerDTO;
use App\Http\Requests\RegisterRequest;
use App\Services\RegistrationService;
use Illuminate\Contracts\View\View;

class RegisterController extends Controller
{
    public function __construct(
        private readonly RegistrationService $registrationService
    ) {}

    public function showForm(): View
    {
        return view('register');
    }

    public function register(RegisterRequest $request): View
    {
        $playerDTO = PlayerDTO::fromRequest($request->validated());
        $result = $this->registrationService->register($playerDTO);

        return view('register_success', $result->toArray());
    }
}
