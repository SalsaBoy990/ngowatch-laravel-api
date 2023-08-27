<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\Helpers\ApiResponseTrait;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    use ApiResponseTrait;


    /**
     * Send a reset link to the given user.
     *
     * @param  Request  $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function sendResetLinkEmail(Request $request): JsonResponse
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->sendResetLinkCredentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }


    /**
     * Get the response for a successful password reset.
     *
     * @param  Request  $request
     * @param  string  $response
     * @return JsonResponse
     */
    protected function sendResetResponse(Request $request, string $response): JsonResponse
    {
        return $this->respondSuccess(trans($response));
    }


    /**
     * Get the response for a failed password reset.
     *
     * @param  Request  $request
     * @param  string  $response
     * @return JsonResponse
     * @throws ValidationException
     */
    protected function sendResetFailedResponse(Request $request, string $response): JsonResponse
    {
        throw ValidationException::withMessages([
            'email' => [trans($response)],
        ]);
    }


    /**
     * Get the response for a successful password reset link.
     *
     * @param  Request  $request
     * @param  string  $response
     * @return JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, string $response): JsonResponse
    {
        return $this->respondSuccess(trans($response));

    }


    /**
     * Get the response for a failed password reset link.
     *
     * @param  Request  $request
     * @param  string  $response
     *
     * @throws ValidationException
     */
    protected function sendResetLinkFailedResponse(Request $request, string $response)
    {
        throw ValidationException::withMessages([
            'email' => [trans($response)],
        ]);

    }


    /**
     * Get the needed authentication credentials from the request.
     *
     * @param  Request  $request
     * @return array
     */
    protected function sendResetLinkCredentials(Request $request): array
    {
        return $request->only('email');
    }


    /**
     * Get the needed authentication credentials from the request.
     *
     * @param  Request  $request
     * @return array
     */
    protected function sendPasswordResetCredentials(Request $request): array
    {
        return $request->only(['email', 'password', 'token']);
    }


}
