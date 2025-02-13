<?php

use Illuminate\Support\Facades\Route;

//路由參數設置


// Route::get('/user/auth/login', 
//         'App\Http\Controllers\UserAuthControl@Login');

// Route::get('/user/auth/search/{user_id}', 
//         'App\Http\Controllers\UserAuthControl@Search');


//路由群組設置,可將上方參數合併成一個群組

Route::group(['prefix' => 'user'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::get(
            'login',
            'App\Http\Controllers\UserAuthController@Login'
        );
        Route::get(
            'signup',
            'App\Http\Controllers\UserAuthController@SignUpPage'
        );
        Route::post(
            'signup',
            'App\Http\Controllers\UserAuthController@SignUpProcess'
        );
    });
});
    
    




        
