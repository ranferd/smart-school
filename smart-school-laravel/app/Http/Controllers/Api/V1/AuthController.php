<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Services\AuthServices;

class AuthController extends BaseController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthServices $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Register new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signUp(SignUpRequest $request)
    {
        $response = $this->auth->signUp($request->all());

        if ($response['status'] == true) {
            return $this->sendResponse($response['data'], 'School Admin Sign Up Success');
        } else {
            return $this->sendError('School Admin Sign Up Failed', $response['data'], 400);
        }
    }

    /**
     * Login user, return token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $response = $this->auth->login($request->all());

        if ($response['status'] == true) {
            return $this->sendResponse($response['data'], 'Login Success');
        } else {
            return $this->sendError('Login Failed', $response['data'], 400);
        }
    }

    /**
     * logout user, flush session, destroy token.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $response = $this->auth->logout();

        if ($response['status'] == true) {
            return $this->sendResponse($response['data'], 'Logout Success');
        } else {
            return $this->sendError('Logout Failed', $response['data'], 400);
        }
    }
}
