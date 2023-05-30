<?php

namespace Tests;

use Illuminate\Http\Response;

class UserRecoveryPasswordTest extends TestCase
{
    /**
     * @dataProvider userRecoveryPasswordDataProvider
     */
    public function testIsRecoveryPasswordValid($inputValue, $expectedStatus, $expectedData = null)
    {
        $this->post('recovery-password', $inputValue, ['Accept' => 'application/json']);
        $this->seeStatusCode($expectedStatus);
        if(isset($expectedData)){
             $this->seeJson($expectedData);
        }
    }

    public function userRecoveryPasswordDataProvider()
    {
        return [
            "userInfoAreRequired" =>
            [
                "inputValue" => [],
                "expectedStatus" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "expectedData" => [
                    "status" => "error",
                    "http_code" => Response::HTTP_UNPROCESSABLE_ENTITY,
                    "message" => [
                        "password is required.",
                        "recovery hash is required."
                    ]
                ]
            ],

            "PasswordConfirmationDoesNotMatch" =>
            [
                "inputValue" => [
                    "password" => "123456",
                    "password_confirmation" => "1234567",
                    "recoveryHash" => "JDJ5JDEwJHQubk40aGU3c3pHNWxRbjByRC9UYU9iQWxaZGJSaExGUGJDaUpPanpyTUtBY2FlRi9QdmQy"
                ],
                "expectedStatus" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "expectedData" => [
                    "status" => "error",
                    "http_code" => Response::HTTP_UNPROCESSABLE_ENTITY,
                    "message" => [
                        "The password confirmation does not match."
                    ]
                ]
            ],

            "UserSuccessfullyChangedPassword" =>
            [
                "inputValue" => [
                    "password" => "123456",
                    "password_confirmation" => "123456",
                    "recoveryHash" => "JDJ5JDEwJHQubk40aGU3c3pHNWxRbjByRC9UYU9iQWxaZGJSaExGUGJDaUpPanpyTUtBY2FlRi9QdmQy"
                ],
                "expectedStatus" => Response::HTTP_OK,
                "expectedData" => [
                    "status" => "success",
                    "http_code" => Response::HTTP_OK,
                    "message" => "Your password has been successfully changed.",
                ]
            ]

//            "userInfoSuccessEmailSent" =>
//            [
//                "inputValue" => [
//                    "email" => "jorgesmith@gmail.com",
//                ],
//                "expectedStatus" => Response::HTTP_OK,
//                "expectedData" => [
//                    "status" => "success",
//                    "http_code" => Response::HTTP_OK,
//                    "message" => "We've sent an email with instructions to recovery your password."
//                ]
//            ]
        ];
    }
}
