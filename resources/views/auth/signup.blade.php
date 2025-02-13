

<!-- 指定繼承 layout.master 母模板 --> 
@extends('layout.master') 

<!-- 傳送資料到母模板，並指定變數為 title --> 
@section('title', $title) 

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content') 

<!--以下為content中的內容,只要寫到上述標籤就會繼承內容-->

<h1>{{ $title }}</h1> 

<!-- 載入元件模板 components.socialButtons --> 

@include('component.social')

Email： <input type="text" name="email" placeholder="Email" > <br>
密碼： <input type="password" name="password" placeholder="密碼" > <br>
暱稱： <input type="text" name="nickname" placeholder="暱稱" > <br>

@endsection


