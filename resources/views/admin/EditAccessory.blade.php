
@extends('layouts.admin')

@section('content')
<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-start py-4">แก้ไข</h2>

        <div class="d-flex align-items-start">
            <div id="image-container">
                <img src="{{ asset('storage/' . $editaccessory->accessory_image) }}" alt="{{ $editaccessory->accessory_name }}" style="width: 300px; height: 300px;">
            </div>

            <div>
                {{-- <a href="{{ route('accessory.edit', ['id' => $accessory->id]) }}" class="btn btn-custom border rounded p-2 inline-block" id="b">แก้ไข</a> --}}
                {{-- <a href="{{ route('accessory.editCount', ['id' => $accessory->id]) }}" class="btn btn-custom border rounded p-2 inline-block " id="b1" >เพิ่ม/ลบจำนวนเครื่องประดับ</a> --}}
                


                <p class="accessory-details" >รหัสเครื่องประดับ: <strong>{{ $editaccessory->accessory_name }}</strong></p>


                <form action="" method="" enctype="multipart/form-data">
                    @csrf

                    <label for=""></label>
                    
                
                
                
                
                
                
                
                </form>







            </div>
        </div>
    </div>
</div>
@endsection