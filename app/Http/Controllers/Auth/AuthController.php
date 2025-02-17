<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\HttpResponseHelper;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ForgotCodeRequest;
use App\Http\Requests\ForgotPasswordUpdate;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /* login */
    public function login(Request $request)
    {
        $data = AuthService::login($request);
        return $data;
        // return HttpResponseHelper::successResponse("Loigin successfully complete", $data, 200);
    }

    /* register credintial */
    public function register(RegistrationRequest $request)
    {
        $data = AuthService::register($request);
        return HttpResponseHelper::successResponse("Registrtion successfully complete.", $data, 201);
    }

    /** forgot */
    public function forgot(ForgotRequest $request)
    {
        $data = AuthService::forgot($request);
        return HttpResponseHelper::successResponse("Mail sent successfully.", $data, 200);
    }

    /** forgot_code_check */
    public function forgot_code_check(ForgotCodeRequest $request)
    {
        $data = AuthService::EmailForgotCodeCheck($request);
        return HttpResponseHelper::successResponse("User information.", $data, 200);
    }
    
    /** forgot_password_update */
    public function forgot_password_update(ForgotPasswordUpdate $request)
    {
        $data = AuthService::ForgotPasswordUpdate($request);
        return HttpResponseHelper::successResponse("Password Updated.", $data, 200);
    }

    /** password reset */
    public function password_reset(PasswordResetRequest $request)
    {
        $data = AuthService::PasswordReset($request);
        return HttpResponseHelper::successResponse("Password reset successfully.", $data, 200);
    }

    /** profile */
    public function profile()
    {
        $data = AuthService::profile();
        return HttpResponseHelper::successResponse("User Profile.", $data, 200);
    }

    /** update_profile */
    public function update_profile(UpdateProfileRequest $request)
    {
        $data = AuthService::update_profile($request);
        return HttpResponseHelper::successResponse("User Profile updated.", $data, 200);
    }

    
}