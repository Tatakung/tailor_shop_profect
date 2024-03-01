@extends('layouts.employee')
@section('content')
    <p>ประเภทค่าใช้จ่าย : {{ $editcost->cost_type }}</p>
    <p>ต้นทุน(ราคา) : {{ $editcost->cost_value }}</p>


    <form action="{{route('updatecost', ['id' =>$editcost->id])}}" method="POST">
        @csrf
        <label for="cost_type">แก้ไขประเภท</label>
        <input type="text" name="cost_type" id="cost_type" value="{{ $editcost->cost_type }}">

        @error('cost_type')
            <div class="text-danger">{{$message}}</div>
        @enderror



        <label for="cost_value">แก้ไขราคา</label>
        <input type="number" name="cost_value" id="cost_value" value="{{ $editcost->cost_value }}">
        <br>
        @error('cost_value')
            <div class="text-danger">{{$message}}</div>
        @enderror

        <button type="submit" class="btn btn-secondary">อัพเดต</button>
        <a href="{{route('rentdetail', ['id' => $editcost->order_detail_id])}}" class="btn btn-danger">ยกเลิก</a>
    </form>



    <button id="deleteclick"     class="btn btn-danger" data-toggle="modal" data-target="#showmodal">ลบ</button>
    <div class="modal fade" id="showmodal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>คุณแน่ใจหรือไม่ที่ต้องการลบรายการนี้?</h5>
                </div>

                <div class="modal-body">
                    sddsds
                </div>

                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="confirm" class="btn btn-danger">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('confirm').addEventListener('click',function(){
            window.location.href = "{{route('deletecost', ['id' => $editcost->id])}}" ; 
        });
    </script>



@endsection
