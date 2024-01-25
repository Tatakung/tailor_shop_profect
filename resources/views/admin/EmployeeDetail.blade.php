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
                <p class="users-details">สถานะ: @if($employeefind->status == 1)เป็นพนักงาน @elseif($employeefind->status == 0) ไม่ได้เป็นพนักงาน @endif
                     </p>
                <p class="users-details">เบอร์ติดต่อ: {{ $employeefind->phone }}</p>
                <p class="users-details">วันที่เริ่มทำงาน: {{ $employeefind->start_date }}</p>
                <p class="users-details">วันเกิด: {{ $employeefind->birthday }}</p>
                <p class="users-details">ที่อยู่: {{ $employeefind->address }}</p>
                <button id="changeStatusBtn" class="btn btn-danger" >เปลี่ยนสถานะ</button>
            </div>
        </div>
    </div>
</div>




{{-- กล่องยืนยัน (Confirmation Modal) --}}
<div class="modal fade" id="confirmModal" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            {{-- ส่วนหัว --}}
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">ยืนยันการเปลี่ยนสถานะ</h5>
            </div>

            {{-- ส่วนเนื้อหานะ --}}
            <div class="modal-body">
                คุณต้องการเปลี่ยนสถานะของ {{$employeefind->name}} หรือไม่?
                
            </div>

            {{-- ส่วนท้าย --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button id="confirmBtn" type="button" class="btn btn-danger">ยืนยัน</button>
            </div>
        </div>
    </div>
</div>

<script>
    // คลิกปุ่มและแสดงกล่องยืนยัน
    document.getElementById('changeStatusBtn').addEventListener('click', function() {
        $('#confirmModal').modal('show');
    });

    //หลังจากกดยืนยันแล้ว
    document.getElementById('confirmBtn').addEventListener('click',function() {
        window.location.href = "{{ route('admin.changestatus', ['id' => $employeefind->id]) }}";
    });
</script>

@endsection
