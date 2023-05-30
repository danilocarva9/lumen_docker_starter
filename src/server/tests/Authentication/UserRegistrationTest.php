<?php

namespace Tests;

use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserRegistrationTest extends TestCase
{
    /**
     * @dataProvider userRegistrationDataProvider
     */
    public function testIsRegistrationValid($inputValue, $expectedStatus, $expectedData = null)
    {
        $this->post('register', $inputValue, ['Accept' => 'application/json']);
        $this->seeStatusCode($expectedStatus);
        if(isset($expectedData)){
             $this->seeJson($expectedData);
        }
    }

    public function userRegistrationDataProvider()
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
                        "name is required.",
                        "email is required.",
                        "password is required."
                    ]
                ]
            ],

            "userInfoShouldBeValid" =>
            [
                "inputValue" => [
                    "name" => "John Kennedy",
                    "email" => "johnkennedy_".rand()."@gmail.com",
                    "password" => "123456",
                    "password_confirmation" => "123456"
                ],
                "expectedStatus" => Response::HTTP_CREATED,
                "expectedData" => [
                    "status" => "success",
                    "http_code" => Response::HTTP_CREATED,
                    "message" => "Created.",
                ]
            ],

            "userEmailIsAlreadyTaken" =>
            [
                "inputValue" => [
                    "name" => "John Kennedy",
                    "email" => "jorgesmith@gmail.com",
                    "password" => "123456",
                    "password_confirmation" => "123456"
                ],
                "expectedStatus" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "expectedData" => [
                    "status" => "error",
                    "http_code" => Response::HTTP_UNPROCESSABLE_ENTITY,
                    "message" => [
                        "email must be unique."
                    ]
                ]
            ],

            "userPasswordDoesNotMatch" =>
            [
                "inputValue" => [
                    "name" => "John Kennedy",
                    "email" => "johnkennedy_".rand()."@gmail.com",
                    "password" => "123456",
                    "password_confirmation" => "1234566"
                ],
                "expectedStatus" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "expectedData" => [
                    "status" => "error",
                    "http_code" => Response::HTTP_UNPROCESSABLE_ENTITY,
                    "message" => [
                        "The password confirmation does not match."
                    ]
                ]
            ]

        ];
    }
}
