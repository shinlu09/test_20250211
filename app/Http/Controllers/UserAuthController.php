<?php

//使用繼承的方式(複製另存成額外的controller.php)載入外部

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hash;

//
use App\Shop\Entity\User;

//使用郵件驗證
use Illuminate\Support\Facades\Mail;

//建立路由控制器,注意下方檔名(UserAuthController)與(UserAuthController.php)要完全一致
class UserAuthController extends Controller
{


    //指定到views中的auth資料夾中的signup.blade.php檔
    public function SignUpPage()
    {
        $binding=[
            'title' =>'註冊',
            'note' =>'使用者註冊頁面'
        ];

        
        
        return view('auth.signup',$binding);

        
    }

    //public function處理表單函數

    public function  SignUpProcess()
    {
        //$input接收輸入資料,並回傳結果

        $input = request()->all();
        print_r($input);

        //假設暱稱欄位為空
        if($input['nickname']==''){
            print('暱稱不得為空');
            return redirect('/user/auth/signup')
                ->withErrors(['暱稱不得為空', '請重新輸入'])
                //withInput();設置如帳戶輸入錯誤,人可記憶原先輸入的資料
                ->withInput();

        

        //假設密碼欄位為空       
        } else if ($input['password'] == '') {
            print('密碼不得為空');
            return redirect('/user/auth/signup')
                ->withErrors(['密碼不得為空', '請重新輸入'])
                //設置如帳戶輸入錯誤,人可記憶原先輸入的資料
                ->withInput();

        //假設郵件欄位為已註冊過資料 
        } else if (User::where('email',$input['email'])->count() >0) {
            return redirect('/user/auth/signup')
                ->withErrors(['帳號已被註冊', '請重新輸入'])
                //設置如帳戶輸入錯誤,人可記憶原先輸入的資料
                ->withInput();

        }else {
            
            //Hash表加密密碼
            $input['password']= Hash::make($input['password']);
            User::create($input);
        }

        //設置郵件驗證,需先至終端機安裝套件composer require guzzlehttp/guzzl

        Mail::send('email.signUp',

        //送給郵件參數
        ['nickname' => $input['nickname']],
        function($message) use ($input) {
            $message->to($input['email'], $input['nickname'])
            
            //發送郵件端,需跟.env中MAIL_USERNAME=相同
            ->from('g0970980831@gmail.com')
            ->subject('恭喜您註冊成功');
        });



    }
    

    //設置登入路由
    public function SignInPage()
    {
        $binding = [
            'title' => '登入',
            'note' => '使用者登入頁面'
        ];
        return view('auth.signin', $binding);
    }
    public function SignInProcess()
    {

        $input = request()->all();
        print_r($input);

        //  將登入邏輯寫進去
        // 1. 判斷資料庫裏面有沒有該帳號
        // 2. 若有該帳號則判斷密碼加密後是否一致

        //先判定有無此帳號

        $tmpuser = User::where('email',$input['email'])->first();
        //dd($tmpuser);
        //如果找不到輸入的帳號,則顯示下列
        if(is_null($tmpuser)){
            return redirect('/user/auth/signin')
            ->withErrors(['查無此帳號', '請重新輸入'])
            ->withInput();
       
        //如帳號密碼輸入正確,則顯示下列
        }else 
        {
            if (Hash::check($input['password'], $tmpuser['password'])) {

                //登入成功將記住登入帳號
                session()->put('user_id', $tmpuser['id']);

                return redirect('/user/auth/signin')
                    ->withErrors(['登入成功'])
                    ->withInput();
            } else {
                return redirect('/user/auth/signin')
                    ->withErrors(['密碼錯誤', '請重新輸入'])
                    ->withInput();
            }

        }
      
    }

    //登出路由設置
    public function SignOut()
    {
        //登出後將忘記登入資訊
        session()->forget('user_id');
        return redirect('/user/auth/signin');
    }

    

}
