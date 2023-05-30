# Simple Admin Panel Start - Angular + Lumen (PHP)

Simple project using angular 15 and Lumen 9 with php 8.0.


## Requirements

[Lumen]
PHP >= 8.0,
OpenSSL PHP Extension,
PDO PHP Extension,
Mbstring PHP Extension.

[Angular]
Node.js, npm package manager


## Getting Started

### Dependencies

* Describe any prerequisites, libraries, OS version, etc., needed before installing program.
* ex. Windows 10

### Installing

* After cloning, there will be two folders APP (Angular app) and SERVER (Lumen API).

#### Running Angular app
1. To start the app (angular) application, you enter the folder and run `npm install` (to install all the project's node dependencies).
2. After all dependencies are installed, run `npm start`. Your application should run at this address `http://localhost:4200`

#### Running Server API
1. To start the Lumen application, you need to enter the server folder and run `composer install` (to install the project dependencies).
2. After all dependencies are installed, change file `.env.example` to `.env` and configure the default settings. You should also generate an APP_KEY and JWT_SECRET.
3. Inside the server folder, run `php artisan migrate` to migrate and create the tables in the database.
4. You should also run `php artisan db:seed` to create a default user in the database (for testing purposes) - note that some tests can only run one, because of the changes in the user infos.
5. Run the server using `php -S localhost:8000 -t public`.

Notes:
1. To run tests, on command line hit:
`vendor/bin/phpunit` to run all tests
`vendor/bin/phpunit --filter=UserForgotPasswordTest` to run a test class, you can find the classes at `tests` folder in the project`s root folder.

## Authors

Contributors names and contact info

Danilo Carvalho
[dscarvalho.com](https://dscarvalho.com)