<?php
Route::get('/', function () {
    return view('welcome');
});

//Route::controller('login', 'Auth\AuthController');

Route::get('auth/login', 'Auth\AuthController@getIndex');
Route::post('auth/login', 'Auth\AuthController@postIndex');

Route::group(
    ['namespace' => 'Api', 'prefix' => 'api', 'middleware' => 'cors'],
    function () {

        /**
         * Authentication
         */
        Route::post('api-token-auth', 'AuthenticationController@authorize');
        Route::post('api-token-refresh', [
            'middleware' => 'jwt.refresh', 
            'uses' => 'AuthenticationController@refreshToken'
        ]);

        Route::get('api-token-validate', [
            'middleware' => 'jwt.validate', 
            'uses' => 'AuthenticationController@validateToken'
        ]);


        /**
         * Authenticated API Resources
         */
        Route::group(['middleware' => ['resource', 'jwt.auth']], function () {
            Route::resource('users', 'UsersController');
        });
    }
);
