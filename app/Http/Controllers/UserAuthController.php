<?php

//使用繼承的方式(複製另存成額外的controller.php)載入外部

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

//建立路由控制器,注意下方檔名(UserAuthController)與(UserAuthController.php)要完全一致

class UserAuthController extends Controller
{
    public function Login()
    {
        return 123;
    }

    // public function Search($user_id)
    // {
    //     return "你輸入的值:$user_id";
    // }

    
    public function SignUp()
    {
        $binding=[
            'title' =>'註冊',
            'note' =>'使用者註冊頁面'
        ];

        //指定到views中的auth資料夾中的signup.blade.php檔
        return view('auth.signup',$binding);
    }

}
