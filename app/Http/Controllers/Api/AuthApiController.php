<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use App\Services\UserService;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthUserResource;
use App\Http\Requests\RegistrationRequest;

class AuthApiController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegistrationRequest $request): AuthUserResource
    {

        $user = $this->userService->createUser($request->validated());

        return new AuthUserResource($user);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::guard('web')->attempt($request->validated())) {
            return response()->json(
                [
                    'message' => __('Unauthenticated.'),
                ],
                401
            );
        }

        $user = Auth::guard('web')->user();

        return new AuthUserResource($user);
    }

    public function logout(): Response
    {
        Auth::user()->tokens()->delete();

        return response()->noContent();
    }
}
