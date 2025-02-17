

<!-- 指定繼承 layout.master 母模板 --> 
@extends('layout.master') 

<!-- 傳送資料到母模板，並指定變數為 title --> 
@section('title', $title) 

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content') 

<!--以下為content中的內容,只要寫到上述標籤就會繼承內容-->

<h1>{{ $title }}</h1> 

<!-- 載入元件模板 components.socialButtons --> 


@include('component.errors')

<!--登入頁面顯示-->   

<form action="/user/auth/signin" method="post" class="container">

    <!-- {{ csrf_field() }}表自動隱藏欄位內容-->
    {{ csrf_field() }}

    Email： <input type="text" name="email" 
            placeholder="Email" value="{{old('email')}}"><br>
    密碼： <input type="password" name="password" 
            placeholder="密碼" value="{{old('password')}}"><br>
    使用者類型：
    <input type="radio" name="type" value="G"
        @if (old("type")=="user" )
        checked
        @endif> 一般使用者
    <input type="radio" name="type" value='A'
        @if (old("type")=="admin" )
        checked
        @endif> 管理員<br>
    <input type="submit" value="登入">
    
</form>

@endsection



