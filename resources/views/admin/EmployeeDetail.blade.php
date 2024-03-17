<style>
    .users-details {
        margin-bottom:22px;
        font-size: 20px; /* เพิ่มส่วนนี้เพื่อกำหนดขนาดตัวหนังสือ */
        margin-left: 20px; /* ระยะห่างทางด้านซ้ายของประเภท */
        margin-top: 15px;
    }

    #image-container {
        flex-shrink: 0;
        margin-right: 30px;
        
    }
    #b {
        background-color: #E36414;
        color: #FFFFFF; /* เพิ่มส่วนนี้เพื่อกำหนดสีตัวหนังสือ */
        margin-left: 20px; /* ระยะห่างทางด้านซ้ายของประเภท */
    }
    #b1 {
        background-color: #994D1C;
        color: #FFFFFF; /* เพิ่มส่วนนี้เพื่อกำหนดสีตัวหนังสือ */
        margin-left: 20px; /* ระยะห่างทางด้านซ้ายของประเภท */

    }

</style>
@extends('layouts.admin')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.showEmployee') }}">จัดการพนักงาน</a></li>
    <li class="breadcrumb-item active" aria-current="page">รายละเอียด</li>
</ol>

@if(session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif
<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-start py-4">รายละเอียดของพนักงาน</h2>

        <div class="d-flex align-items-start">
            <div id="image-container">
                {{-- รูปภาพ --}}
                <img src="{{asset('storage/' .$employeefind->image)}}" alt="รูปภาพ" style="width: 300px; height: 300px;">
            </div>

            <div>
                <p class="users-details">หมายเลข: {{ $employeefind->id }}</p>
                <p class="users-details">ชื่อ-สกุล: {{ $employeefind->name . ' ' . $employeefind->lname }}</p>
                <p class="users-details">อีเมล: {{ $employeefind->email }}</p>
                {{-- <p class="users-details" class="">สถานะ: @if($employeefind->status == 1)เป็นพนักงาน @elseif($employeefind->status == 0) ไม่ได้เป็นพนักงาน @endif
                     </p> --}}


                <p class="users-details">
                    @if ($employeefind->status == 1 )
                                    เป็นพนักงาน
                    @elseif($employeefind->status == 0 )
                            ไม่ได้เป็นพนักงาน
                    @endif
                </p>


                <p class="users-details">เบอร์ติดต่อ: {{ $employeefind->phone }}</p>
                <p class="users-details">วันที่เริ่มทำงาน: {{ $employeefind->start_date }}</p>
                <p class="users-details">วันเกิด: {{ $employeefind->birthday }}</p>
                <p class="users-details">ที่อยู่: {{ $employeefind->address }}</p>
                <button id="changeStatusBtn" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">เปลี่ยนสถานะ</button>
            </div>
        </div>
    </div>
</div>


{{-- modal --}}
<div class="modal fade" id="confirmModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">ยืนยันการเปลี่ยนสถานะ</h5>
            </div>
            <form action="{{ route('admin.changestatus', ['id' => $employeefind->id]) }}" method="POST">
                @csrf
            <div class="modal-body">
                คุณต้องการเปลี่ยนสถานะของคุณ {{$employeefind->name}} {{$employeefind->lname}}หรือไม่? 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-danger">ยืนยัน</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
