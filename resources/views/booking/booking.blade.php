<!-- 指定繼承 layout.master 母模板 --> 
<!-- @extends('layout.master')  -->
<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content') 
@include('component.errors')

<h1>{{$title}}</h1>


<form action="/booking/booking" method="post" class="container">

    <label>姓名：</label>
    <input type="text" name="name"  value="{{old('name')}}">

    <label>郵件：</label>
    <input type="text" name="email"value="{{old('email')}}"><br>

    <label>電話：</label>
    <input type="text" name="phone" value="{{old('phone')}}">

    <label>人數：</label>
    <input type="number" name="num_people" value="{{old('num_people')}}"><br>

    <label>預約時間：</label>
    <input type="datetime-local" name="booking_time" value="{{old('booking_time')}}"><br>

    <button type="submit">送出預約</button>
</form>

@endsection
