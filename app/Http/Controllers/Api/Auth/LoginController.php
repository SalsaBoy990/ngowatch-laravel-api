<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    use ApiResponseTrait;
    use AuthenticatesUsers;

    /**
     * Logs in user (creates sanctum bearer token)
     *
     * @param  Request  $request
     * @return JsonResponse|Response
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse|Response
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);

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
