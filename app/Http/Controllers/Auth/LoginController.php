<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['logout', 'refreshToken']);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (! $token = auth()->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => 'E-posta veya şifrenizi yanlış girdiniz.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], Response::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     */
    public function refreshToken(): JsonResponse
    {
        $token = auth()->refresh();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json([], Response::HTTP_OK);
    }
}
