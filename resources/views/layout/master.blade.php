
<!--網頁畫面顯示-->
<html> 

<!--標題-->
    <head> 
        
        <meta charset="utf-8"> 
        <script src="/assets/js/jquery-2.2.4.min.js" defer></script> 
        <script src="/assets/js/bootstrap.min.js" defer></script> 
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css"> 
        <!--指定繼承內容標籤 @yeild表呼叫標籤-->  
        <title class="text-pink">@yield('title')</title> 
    </head> 
<!--網頁內容-->
    <body> 
        <header> 

        @if (session()->has('user_id'))
        <a href="/user/auth/signout">登出</a>
        @else

        <a href="#">註冊</a> 
        <a href="#">登入</a> 

        @endif
        
        </header> 
        <div class="container"> 
            @yield('content') 
        </div> 
        <footer> 
            <a href="#">聯絡我們</a> 
        </footer> 
    </body> 
</html> 