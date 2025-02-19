<?php

use Illuminate\Support\Facades\Route;

//路由參數設置


// Route::get('/user/auth/login', 
//         'App\Http\Controllers\UserAuthControl@Login');

// Route::get('/user/auth/search/{user_id}', 
//         'App\Http\Controllers\UserAuthControl@Search');


//路由群組設置,可將上方參數合併成一個群組

//寫成網址寫法:http://127.0.0.1:8088/user/auth/signup

//下列為註冊登入登出路由設置

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
        Route::get(
            'signin',
            'App\Http\Controllers\UserAuthController@SignInPage'
        );
        Route::post(
            'signin',
            'App\Http\Controllers\UserAuthController@SignInProcess'
        );
        Route::get(
            'signout',
            'App\Http\Controllers\UserAuthController@SignOut'
        );
    });
});

//下列為商品資訊路由設置

Route::group(['prefix' => 'merchandise'], function () {

    //商品建立頁面
    Route::get(
        'create',
        'App\Http\Controllers\MerchandiseController@MerchandiseCreateProcess'
    );

    //商品建編輯頁面

    Route::get(
        '{mechandise_id}/edit',
        'App\Http\Controllers\MerchandiseController@MerchandiseEditPage'
    );
    Route::post(
        '{mechandise_id}/edit',
        'App\Http\Controllers\MerchandiseController@MerchandiseEditProcess'
    );
});


    
    




        
