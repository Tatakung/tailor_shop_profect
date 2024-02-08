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
        <h2 class="text text-start py-4">แสดงรายละเอียดชุด</h2>



        <div class="d-flex align-items-start">
            <div id="image-container">
                <img src="{{asset('storage/' .$getsize->dress->dress_image)}}" alt="{{$getsize->dress->dress_description}}" style="width: 300px; height: 300px;">
            </div>
            <div>

                <a href="{{route('admin.editDress',['id' => $getsize->id])}}" class="btn btn-custom border rounded p-2 inline-block" id="b">แก้ไขชุด</a>


                <p class="accessory-details">ประเภทชุด: {{$getsize->dress->dress_type}}</p>
                <p class="accessory-details">แบบชุดที่: {{$getsize->dress->dress_code}} </p>
                <p class="accessory-details">ไซส์: {{$getsize->size_name}} </p>
                <p class="accessory-details">ราคาต่อชุด: {{$getsize->price}}  บาท</p>
                <p class="accessory-details">ราคามัดจำต่อชุด: {{$getsize->deposit}}  บาท</p> 
                <p class="accessory-details">จำนวนชุด: {{$getsize->amount}} ชุด </p>
                <p class="accessory-details">รายละเอียด: {{$getsize->dress->dress_description}}  </p>
            </div>
        </div>





    </div>
</div>
@endsection
