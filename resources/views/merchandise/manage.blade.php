

<!-- 指定繼承 layout.master 母模板 --> 
@extends('layout.master') 

<!-- 傳送資料到母模板，並指定變數為 title --> 
@section('title', $title) 

<!-- 傳送資料到母模板，並指定變數為 content -->
<!--以下為content中的內容,只要寫到上述標籤就會繼承內容-->
@section('content') 

<!-- @include('component.social') -->

<!--商品管理頁面-->
@include('component.errors')
<ul>
    @foreach($merchandises as $merchandise)
    <li>
        <h4>{{ $merchandise->name }}</h4>
        <img src="/{{ $merchandise->photo}}" />
        <p>{{ $merchandise->price }}</p>
        <a href="/merchandise/{{ $merchandise->id }}/edit">編輯</a>
        <form action="/merchandise/{{ $merchandise->id }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <a href="/merchandise/{{ $merchandise->id }}/edit">
            <button type="submit">刪除</button></a>
        </form>
    </li>
    @endforeach
</ul>
@endsection



