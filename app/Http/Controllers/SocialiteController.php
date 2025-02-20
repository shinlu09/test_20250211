<?php

//使用繼承的方式(複製另存成額外的controller.php)載入外部

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Socialite;
use Hash;
use App\Shop\Entity\User;

//使用郵件驗證
use Illuminate\Support\Facades\Mail;


//第三方驗證google接收控制器

class SocialiteController extends Controller
{


    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();

        
    }

    //回傳驗證
    public function handleProviderCallback()
    {
    $user = Socialite::driver('google')->stateless()->user();
    dd($user);
    }
    

}

//可用http://laravelclasstest.com:8088/google/auth 確認是否可使用google驗證
