<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\Helpers\ApiResponseTrait;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Interface\AuthInterface;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class ResetPasswordController extends Controller implements AuthInterface
{
    use ResetsPasswords;
    use ApiResponseTrait;


    /**
     * Reset the given user's password.
     *
     * @param  Request  $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function reset(Request $request): JsonResponse
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise, we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }


    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function showResetForm(Request $request): RedirectResponse
    {
//        $token = $request->route()->parameter('token');
        $token = $request->query('token');
//        $email = $request->route()->parameter('email');
        $email = $request->query('email');

        return Redirect::to(self::RESET_PASSWORD_URL.'?token='.$token.'&email='.$email);
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
     * Reset the given user's password.
     *
     * @param  CanResetPassword|Authenticatable|User  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password): void
    {
        $user->password = $password; // mutator hashes it
        $user->setRememberToken(Str::random(60));
        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }


}
