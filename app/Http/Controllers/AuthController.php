<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use function Symfony\Component\Translation\t;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            if (!$token = auth()->attempt($credentials)) {
                return $this->apiResponse(false, 'Unauthorized', API_RES_STATUS_UNAUTHORIZED);
            }
            $newToken = $this->createNewToken($token);
            return $this->apiResponse(true, $newToken, API_RES_STATUS_SUCCESS, 'success');

        }catch (\Exception $exception){
            return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
        }

    }

    public function register(RegistrationRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $response = $user->save();
            return $this->apiResponse(true, $response, API_RES_STATUS_SUCCESS, 'Registration successfully completed');

        }catch (\Exception $exception){
            return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    public function getLoginUserData()
    {
        try {
            $userData = auth()->user();
            return $this->apiResponse(true, $userData, API_RES_STATUS_SUCCESS, 'Successfully');
        }catch (\Exception $exception){
            return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout()
    {
        try {
            auth()->logout();
            return $this->apiResponse(true, true, API_RES_STATUS_SUCCESS, 'User successfully signed out');
        }catch (\Exception $exception){
            return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
        }

    }

    protected function createNewToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
    }

}
