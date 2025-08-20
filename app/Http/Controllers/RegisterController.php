<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\RegistrationService;

class RegisterController extends Controller
{
    public function __construct(private readonly RegistrationService $service) {}

    public function __invoke(Request $request):  JsonResponse
    {
        $data = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $user = $this->service->register($data);

        return response()->json(['message' => 'User registered successfully']);
    }
}