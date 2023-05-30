<?php

namespace Tests;

use Illuminate\Http\Response;

class UserLoginTest extends TestCase
{
    /**
     * @dataProvider userLoginDataProvider
     */
    public function testIsLoginValid($inputValue, $expectedStatus, $expectedData = null)
    {
        $this->post('login', $inputValue, ['Accept' => 'application/json']);
        $this->seeStatusCode($expectedStatus);
        if(isset($expectedData)){
             $this->seeJson($expectedData);
        }
    }

    public function userLoginDataProvider()
    {
        return [
            "userInfoShouldBeRequired" =>
            [
                "inputValue" => [],
                "expectedStatus" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "expectedData" => [
                    "status" => "error",
                    "http_code" => Response::HTTP_UNPROCESSABLE_ENTITY,
                    "message" => [
                        "email is required.",
                        "password is required."
                    ]
                ]
            ],

            "userInfoShouldBeValid" =>
            [
                "inputValue" => [
                    "email" => "jorgesmith@gmail.com",
                    "password" => "123456"
                ],
                "expectedStatus" => Response::HTTP_OK,
                "expectedData" => [
                    "status" => "success",
                    "http_code" => Response::HTTP_OK,
                    "message" => "You have successfully logged in.",
                ]
            ],

            "userInfoShouldNotBeValid" =>
            [
                "inputValue" => [
                    "email" => "jorgesmith@gmail.com",
                    "password" => "123123"
                ],
                "expectedStatus" => Response::HTTP_UNAUTHORIZED,
                "expectedData" => [
                    "status" => "error",
                    "http_code" => Response::HTTP_UNAUTHORIZED,
                    "message" => "You have entered an invalid email or password."
                ]
            ]
        ];
    }
}
