<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Interface\AuthInterface;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VerificationController extends Controller implements AuthInterface
{
    use ApiResponseTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  Request  $request
     * @return RedirectResponse
     *
     * @throws AuthorizationException
     */
    public function verify(Request $request): RedirectResponse
    {
        if (!$request->hasValidSignature()) {
            throw new AuthorizationException;
        }

        $user = User::findOrFail($request->route('id'));

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return Redirect::to(self::LOGIN_URL);
   }


    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function resend(Request $request): JsonResponse
   {
       if ($request->user()->hasVerifiedEmail()) {
           return $this->apiResponse(['success' => true], 204);
       }

       $request->user()->sendEmailVerificationNotification();

       return $this->apiResponse(['success' => true, 'message' => 'Re-sent email verification link.'], 202);
   }

}
