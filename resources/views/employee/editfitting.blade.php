@extends('layouts.employee')
@section('content')


<p>วันที่นัดลองชุด : {{$fit->fitting_date}}</p>
<p>วันที่มาลองจริง : {{$fit->fitting_real_date}}</p>
<p>บันทึก : {{$fit->fitting_note}}</p>
<p>สถานะ : {{$fit->fitting_status}}</p>
<p>ราคา : {{$fit->fitting_price}}</p>


<form action="{{route('updatefitting', ['id' => $fit->id])}}" method="POST" >
    @csrf
    <label for="fitting_price">อัพเดตราคา</label>
    <input type="number" name="fitting_price" id="fitting_price" value="{{$fit->fitting_price}}">

    <br>

    <label for="fitting_note">อัพเดตบันทึก</label>
    <textarea name="fitting_note" id="fitting_note" cols="10" rows="2">{{$fit->fitting_note}}</textarea>


    <br>

    <label for="fitting_status">อัพเดตสถานะ</label>
    <select name="fitting_status" id="fitting_status">
        <option value="ยังไม่ลองชุด" selected>ยังไม่ลองชุด</option>
        <option value="มาลองชุดแล้ว">มาลองชุดแล้ว</option>
    </select>

    <br>
    <button type="submit" class="btn btn-danger">อัพเดต</button>
</form>

@endsection
