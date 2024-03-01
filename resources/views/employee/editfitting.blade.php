@extends('layouts.employee')
@section('content')
    <p>วันที่นัดลองชุด : {{ $fit->fitting_date }}</p>
    <p>วันที่มาลองจริง : {{ $fit->fitting_real_date }}</p>
    <p>บันทึก : {{ $fit->fitting_note }}</p>
    <p>สถานะ : {{ $fit->fitting_status }}</p>
    <p>ราคา : {{ $fit->fitting_price }}</p>


    @if(session('notdelete'))
    <div class="alert alert-success">
        {{session('notdelete')}}
    </div>
    @endif

    

    <form action="{{ route('updatefitting', ['id' => $fit->id]) }}" method="POST">
        @csrf
        <label for="fitting_price">อัพเดตราคา</label>
        <input type="number" name="fitting_price" id="fitting_price" value="{{ $fit->fitting_price }}">

        <br>

        <label for="fitting_note">อัพเดตบันทึก</label>
        <textarea name="fitting_note" id="fitting_note" cols="10" rows="2">{{ $fit->fitting_note }}</textarea>


        <br>

        <label for="fitting_status">อัพเดตสถานะ</label>
        <select name="fitting_status" id="fitting_status">
            <option value="ยังไม่ลองชุด" selected>ยังไม่ลองชุด</option>
            <option value="มาลองชุดแล้ว">มาลองชุดแล้ว</option>
        </select>

        <br>
        <button type="submit" class="btn btn-danger">อัพเดต</button>
        <a href="{{route('rentdetail',['id' =>$fit->order_detail_id])}}" class="btn btn-danger">ยกเลิก</a>

    </form>

    <button class="btn btn-danger" data-toggle="modal" data-target="#showmodal">ลบ</button>

    <div class="modal fade" id="showmodal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    หัว
                </div>

                 <div class="modal-body">
                    จะลบจริงหรอ
                 </div>

                 <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-secondary" id="confirm">ยืนยัน</button>
                 </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('confirm').addEventListener('click',function(){
            window.location.href = "{{route('deletefitting',['id'=> $fit->id ])}}" ; 
        });
    </script>
@endsection
