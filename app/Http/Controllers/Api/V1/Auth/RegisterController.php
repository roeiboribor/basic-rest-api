<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Register new user
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(RegisterUserRequest $request): JsonResponse
    {
        // Passed Validation / Validated
        $data = $request->validated();

        try {
            $data['password'] = Hash::make('password');
            $user = \App\Models\User::create($data);
            $token = $user->createToken('Authenticated')->accessToken;
            $data['token'] = $token;
            $data['message'] = 'User has been created!';
        } catch (\Exception $err) {
            \Log::error("Error: Register user details. " . $err->getMessage());
            $data['message'] = 'Oopps Something went wrong!';
        }

        return response()->json([
            'message' => $data['message'] ?? null,
            'token' => $data['token'] ?? null,
        ]);
    }
}
