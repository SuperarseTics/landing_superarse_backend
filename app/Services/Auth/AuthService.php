<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthService
{
    /**
     * Authenticates a user based on the provided credentials.
     *
     * This method attempts to authenticate a user using the credentials
     * provided in the AuthenticateRequest. If authentication fails, it
     * returns a JSON response with an error message. Upon successful
     * authentication, a new token is generated for the user with a specified
     * expiration time.
     *
     * @param AuthenticateRequest $request The request containing user credentials.
     *
     * @return JsonResponse A JSON response containing the authentication result.
     */
    public function authenticate(AuthenticateRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->validated())) {
            return GeneralHelper::response(
                __('messages.authenticate_failed'),
                [],
                401
            );
        }

        $user = Auth::user();
        $userToken = $user->createToken('authToken', ['*'], now()->addMinutes(config('sanctum.expiration')))->plainTextToken;

        return GeneralHelper::response(
            __('messages.authenticate_success'),
            [
                'token' => $userToken,
                'user' => $user
            ],
            200
        );
    }

    /**
     * Logs out the authenticated user by deleting their current access token.
     *
     * This method retrieves the currently authenticated user and deletes
     * their active access token, effectively logging them out of the system.
     * A successful logout will return a JSON response with a success message.
     *
     * @param Request $request The incoming request containing user authentication details.
     *
     * @return JsonResponse A JSON response indicating the logout result
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return GeneralHelper::response(
            __('messages.logout_success'),
            [],
            200
        );
    }

    /**
     * Create user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(RegisterRequest $request): JsonResponse
    {
        if (User::where('email', $request->email)->count()) {
            return GeneralHelper::response(
                __('messages.create_user'),
                [],
                401
            );
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!Auth::attempt($request->validated())) {
            return GeneralHelper::response(
                __('messages.authenticate_failed'),
                [],
                401
            );
        }

        $user = Auth::user();
        $userToken = $user->createToken('authToken', ['*'], now()->addMinutes(config('sanctum.expiration')))->plainTextToken;

        return GeneralHelper::response(
            __('messages.authenticate_success'),
            [
                'token' => $userToken,
                'user' => $user
            ],
            200
        );
    }

}