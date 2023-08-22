<?php

namespace App\Http\Middleware;

use App\Interface\UserCodeInterface;
use App\Models\UserCode;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Traits\Helpers\ApiResponseTrait;

class Check2FA implements UserCodeInterface
{
    use ApiResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if user did not submit the code, redirect to the 2fa index view
        if (auth()->user()->enable_2fa && ! Session::has('user_2fa')) {

            // In order to use 2FA on api routes
            // Ajax call should return 401 to trigger a redirect to log in route
            // (axios's response interceptor will catch it)
            if ($request->expectsJson()) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'Unauthenticated or Token Expired, Please Login',
                    ],
                    401
                );
            }

            // Only generate code if currently there are no valid ones for the current user!
            $find = UserCode::where('user_id', auth()->id())
                ->where('updated_at', '>=', now()->subMinutes(self::CODE_VALIDITY_EXPIRATION))
                ->first();


            if (is_null($find)) {
                // need to send a new code automatically when 'user_2fa' session variable expires
                auth()->user()->generateCode();
            }

            return redirect()->route('2fa.index');
        }

        return $next($request);
    }
}
