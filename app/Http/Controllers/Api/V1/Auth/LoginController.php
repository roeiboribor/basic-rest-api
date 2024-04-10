<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Login User
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(LoginUserRequest $request): JsonResponse
    {
        // Passed Validation / Validated
        $credentials = $request->validated();

        try {
            if (auth()->attempt($credentials)) {
                $accessToken = auth()->user()->createToken('LaravelAuthApp')->accessToken;
                return response()->json(['user' => auth()->user(), 'access_token' => $accessToken]);
            }
        } catch (\Exception $err) {
            \Log::error("Error: Login user details. " . $err->getMessage());
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Logout User
     *
     * @return JsonResponse
     */
    public function destroy(): JsonResponse
    {
        try {
            auth()->user()->token()->revoke();
        } catch (\Exception $err) {
            \Log::error("Error: Logout user. " . $err->getMessage());
        }

        return response()->json([
            'message' => $data['message'] ?? null,
            'token' => $data['token'] ?? null,
        ]);
    }
}
