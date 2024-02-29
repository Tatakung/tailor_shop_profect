@extends('layouts.employee')
@section('content')


<p>ประเภท : {{$decoration->decoration_type}}</p>
<p>รายละเอียด : {{$decoration->decoration_type_description}}</p>
<p>ราคา : {{$decoration->decoration_price}}</p>


<form action="{{route('updatedecoration', ['id' => $decoration->id])}}" method="POST" >
    @csrf
    <label for="decoration_type">แก้ไขประเภท</label>
    <input type="text" name="decoration_type" id="decoration_type" value="{{$decoration->decoration_type}}">
    <br>

    <label for="decoration_type_description">แก้ไขรายละเอียด</label>
    <textarea name="decoration_type_description" id="decoration_type_description" cols="10" rows="2">{{$decoration->decoration_type_description}}</textarea>
    <br>

    <label for="decoration_price">แก้ไขราคา</label>
    <input type="number" name="decoration_price" id="decoration_price" value="{{$decoration->decoration_price}}">
    <br>
    <button type="submit" class="btn btn-danger">อัพเดต</button>
</form>

@endsection
