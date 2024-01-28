<style>
    .accessory-details {
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
        <h2 class="text text-start py-4">รายละเอียด</h2>

        <div class="d-flex align-items-start">
            <div id="image-container">
                <img src="{{ asset('storage/' . $showdetail->accessory_image) }}" alt="{{ $showdetail->accessory_name }}" style="width: 300px; height: 300px;">
            </div>

            <div>
                {{-- <a href="{{ route('accessory.edit', ['id' => $accessory->id]) }}" class="btn btn-custom border rounded p-2 inline-block" id="b">แก้ไข</a> --}}
                {{-- <a href="{{ route('accessory.editCount', ['id' => $accessory->id]) }}" class="btn btn-custom border rounded p-2 inline-block " id="b1" >เพิ่ม/ลบจำนวนเครื่องประดับ</a> --}}
                
                <a href="{{route('admin.editAccessory',['id' => $showdetail->id])}}" class="btn btn-custom border rounded p-2 inline-block" id="b" >แก้ไข</a>

                <p class="accessory-details" >รหัสเครื่องประดับ: <strong>{{ $showdetail->accessory_code_new }}</strong></p>
                <p class="accessory-details" >ประเภท :<strong> {{ $showdetail->accessory_name }}</strong></p>
                <p class="accessory-details" >รายละเอียด :<strong> {{ $showdetail->accessory_description }} </strong></p>
                <p class="accessory-details" >จำนวน: <strong>{{ $showdetail->accessory_count }} ชิ้น</strong></p>
                <p class="accessory-details" >ราคา: <strong>{{ $showdetail->accessory_price }} บาท</strong></p>
            </div>
        </div>
    </div>
</div>
@endsection