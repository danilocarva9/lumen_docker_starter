<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\UserService;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\RecoveryPasswordRequest;
use Illuminate\Http\Response;
use Nette\Utils\Json;
use Throwable;

class AuthController extends Controller
{
    /**
     * Create new controller instance
     *
     * @return void
     */
    public function __construct(
        protected UserService $userService,
        protected AuthService $authService
    ) {}

    /**
     * Register new user.
     *
     * @param UserStoreRequest $request
     * @return Json
     */
    public function register(UserStoreRequest $request): Json
    {
        try {
            $response = $this->userService->create($request->all());
            return \ApiResponse::created($response);
        } catch(Throwable $exception) {
            return \ApiResponse::failed($exception);
        }
    }

    /**
     * User login.
     *
     * @param AuthLoginRequest $request
     * @return Json
     */
    public function login(AuthLoginRequest $request): Json
    {
        $response = $this->authService->login($request->get(['email', 'password']));
        if($response['httpCode'] == Response::HTTP_OK){
            return \ApiResponse::httpCode($response['httpCode'])->message($response['message'])->data($response['data'])->success();
        }
        return \ApiResponse::httpCode($response['httpCode'])->message($response['message'])->failed();
    }


    /**
     * User forgot password.
     *
     * @param ForgotPasswordRequest $request
     * @return Json
     */
    public function forgotPassword(ForgotPasswordRequest $request): Json
    {

        $response = $this->authService->forgotPassword($request->get('email'));
        if($response['httpCode'] == Response::HTTP_OK){
            return \ApiResponse::success($response['message']);
        }
        return \ApiResponse::httpCode($response['httpCode'])->message($response['message'])->failed();
    }

     /**
     * User recovery password.
     *
     * @param RecoveryPasswordRequest $request
     * @return Json
     */
    public function recoveryPassword(RecoveryPasswordRequest $request): Json
    {
        try {
            $response = $this->authService->recoveryPassword($request->all());
            if($response['httpCode'] == Response::HTTP_OK){
                return \ApiResponse::success($response['message']);
            }
            return \ApiResponse::httpCode($response['httpCode'])->message($response['message'])->failed();
        } catch(Throwable $exception) {
            return \ApiResponse::failed($exception);
        }
    }


}
