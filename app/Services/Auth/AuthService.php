<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService
{

    public static function login($request) {
        $credentials = $request->only('email', 'password');
        $existCredintial = User::where('email', $request->email)->first();
        $token = auth()->claims([
            'id' => $existCredintial->id,
            'name' => $existCredintial->name,
            'role' => $existCredintial->role,
        ])->attempt($credentials);

        AuthService::createNewToken($token);

        // Return user data an token
        return [
            'token' => $token,
            'user' => $existCredintial
        ];
    }
    /** image upload */
    public static function ImageUpload(UploadedFile $file) {}
    /* store resoruce documents */
    public static function storeDocument($request)
    {
        return array(
            "name" => $request->name,
            'email' => $request->email,
        );
    }
    /**register */
    public static function register($request)
    {
        $userData = self::storeDocument($request);
        $user =  User::create($userData);
        return $user;
    }
    /** fogot password */
    public static function forgot($request) {}
    /** forgot code check */
    public static function EmailForgotCodeCheck($request) {}
    /** forgot password update */
    public static function ForgotPasswordUpdate($request) {}
    /** password reset */
    public static function PasswordReset($request) {}
    /* profile */
    public static function profile() {
        return Auth::user();
    }
    /* update_profile */
    public static function update_profile($request) {
        $update = User::find(Auth::id());
        $update->name = $request->name;
        $update->email = $request->email; 
        $update->role = $request->role;
        return $update->save();
    }
    /* create token generate exp date */
 /* create token generate exp date */
 public static function createNewToken($token)
 {
     $response_data = [
         'token' => $token,
         'token_type' => 'bearer',
         'expires_in' => auth()->factory()->getTTL() * 3660,
     ];
     return $response_data;
 }
}
