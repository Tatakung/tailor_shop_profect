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
    <a href="{{route('rentdetail' , ['id'=>$decoration->order_detail_id ])}}" class="btn btn-danger">ยกเลิก</a>
</form>

    <button class="btn btn-danger" data-toggle="modal" data-target="#showmodal">ลบ</button>

    <div class="modal fade" id="showmodal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    แน่ใจว่าจะจริงจริงหรอ ?
                </div>

                <div class="modal-body">
                    ถึงจะลบ แต่ก็ไม่สามารถลบเขาออกจากหัวใจได้หรอก 555555 ว้ายยยย
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-danger" id="confirm">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>

    <script>                               
        document.getElementById('confirm').addEventListener('click',function(){
            window.location.href = "{{route('deletedecoration', ['id' => $decoration->id])}}" ; 
        });
    </script>


@endsection
