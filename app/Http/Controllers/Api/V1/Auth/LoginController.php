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
        $data = $request->validated();

        try {
            if (auth()->attempt($data)) {
                $data['message'] = "You have successfully logged in!";
                $data['token'] = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            }
        } catch (\Exception $err) {
            \Log::error("Error: Login user details. " . $err->getMessage());
            $data['message'] = 'Oopps Something went wrong!';
        }

        return response()->json([
            'message' => $data['message'] ?? null,
            'token' => $data['token'] ?? null,
        ]);
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
