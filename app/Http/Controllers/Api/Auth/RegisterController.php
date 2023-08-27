<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegistrationRequest;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
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
}
