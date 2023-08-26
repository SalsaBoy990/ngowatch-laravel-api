<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegistrationRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponseTrait;


    /**
     * Handle a registration request for the application.
     *
     * @param  RegistrationRequest  $request
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request)
    {
        User::create($request->getAttributes())->sendEmailVerificationNotification();

        return $this->apiResponse(['success' => true, 'message' => 'User successfully created.'], 201);
    }

    /**
     * Logs in user (creates sanctum bearer token)
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->respondUnauthorized('Invalid email or password');
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token');

        return $this->apiResponse([
            'success' => true,
            'message' => 'Successful login',
            'result' => [
                'access_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
                'expires_in' => $token->accessToken['expires_at'],
            ],

        ]);
    }


    /**
     * Get logged-in user data
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function user(Request $request): JsonResponse
    {
        return $this->respondWithResource(new UserResource($request->user()));

    }


    /**
     * Signs out users by removing tokens
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return $this->respondSuccess('Token revoked. User successfully logged out.');
    }


}
