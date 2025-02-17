

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

<form action="/user/auth/signin" method="post">

    <!-- {{ csrf_field() }}表自動隱藏欄位內容-->
    {{ csrf_field() }}

    商品名稱 <input type="text" name="name"
        placeholder="商品名稱" value="{{ old('name', $merchandise->name) }}"><br>
    <br>
    英文名稱 <input type="text" name="name_en"
        placeholder="英文名稱" value="{{ old('name_en', $merchandise->name_en) }}"><br>
    <br>
    商品介紹 <textarea name="introduction">
    {{ old('introduction', $merchandise->introduction) }}
    </textarea>
    <br>
    
</form>

@endsection



