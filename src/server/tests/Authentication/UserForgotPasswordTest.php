<?php

namespace Tests;

use Illuminate\Http\Response;

class UserForgotPasswordTest extends TestCase
{
    /**
     * @dataProvider userForgotPasswordDataProvider
     */
    public function testIsForgotPasswordValid($inputValue, $expectedStatus, $expectedData = null)
    {
        $this->post('forgot-password', $inputValue, ['Accept' => 'application/json']);
        $this->seeStatusCode($expectedStatus);
        if(isset($expectedData)){
             $this->seeJson($expectedData);
        }
    }

    public function userForgotPasswordDataProvider()
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
                        "email is required."
                    ]
                ]
            ],

            "userInfoShouldExists" =>
            [
                "inputValue" => [
                    "email" => "johnkennedy_".rand()."@gmail.com"
                ],
                "expectedStatus" => Response::HTTP_NOT_FOUND,
                "expectedData" => [
                    "status" => "error",
                    "http_code" => Response::HTTP_NOT_FOUND,
                    "message" => "User not found.",
                ]
            ],

            "userInfoSuccessEmailSent" =>
            [
                "inputValue" => [
                    "email" => "jorgesmith@gmail.com",
                ],
                "expectedStatus" => Response::HTTP_OK,
                "expectedData" => [
                    "status" => "success",
                    "http_code" => Response::HTTP_OK,
                    "message" => "We've sent an email with instructions to recovery your password."
                ]
            ]

        ];
    }
}
