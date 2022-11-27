<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    //user login
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);  //filter only email & password
            if (!$token = auth()->attempt($credentials)) {       //check credentials are correct
                return $this->apiResponse(false, 'Unauthorized', API_RES_STATUS_UNAUTHORIZED);
            }
            $newToken = $this->createNewToken($token);
            return $this->apiResponse(true, $newToken, API_RES_STATUS_SUCCESS, 'success');

        }catch (\Exception $exception){
            return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
        }

    }

    //user registration
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

    //get login user details
    public function getLoginUserData()
    {
        try {
            $userData = auth()->user();
            return $this->apiResponse(true, $userData, API_RES_STATUS_SUCCESS, 'Successfully');
        }catch (\Exception $exception){
            return $this->apiResponse(false, 'Internal server error', API_RES_STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    // user logout
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
