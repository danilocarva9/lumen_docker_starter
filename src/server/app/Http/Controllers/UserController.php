<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{

    /**
     * Create new controller instance
     *
     * @return void
     */
    public function __construct(protected UserService $userService){}

    public function findById(Request $request, int $id)
    {
        $response = $this->userService->find($id);
        if($response['httpCode'] == Response::HTTP_OK){
            return \ApiResponse::httpCode($response['httpCode'])->data($response['data'])->success()->setEncodingOptions(JSON_UNESCAPED_SLASHES);
        }
        return \ApiResponse::httpCode($response['httpCode'])->message($response['message'])->failed();
    }


    public function updateUserProfile(UserUpdateRequest $request)
    {
        try {
            $response = $this->userService->updateUserProfile($request->all());
            return \ApiResponse::httpCode($response['httpCode'])->data($response['data'])->success()->setEncodingOptions(JSON_UNESCAPED_SLASHES);
        } catch(Throwable $exception) {
            return \ApiResponse::failed($exception);
        }

    }


}
