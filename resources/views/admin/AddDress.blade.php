@extends('layouts.admin')
@section('content')

<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-start py-4">แบบฟอร์มเพิ่มชุด</h2>


        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{route('admin.sotre')}}" method="post" enctype="multipart/form-data">
            
            @csrf

            <div class="mb-3">
                <label for="dress_type" class="form-label">ประเภทชุด</label>
                <input type="text" class="form-control" id="dress_type" name="dress_type">
            </div>
            
            {{-- <div class="mb-3">
                <label for="dress_id" class="form-label">เลือกชุด</label>
                <select class="form-control" id="dress_id" name="dress_id">
                    <option value="" selected disabled>กรุณาเลือกประเภทชุด</option>
                    @foreach($get_dresstype as $get_dresstype)
                        <option value="{{$get_dresstype}}">{{$get_dresstype}}</option>
                    @endforeach
                    <option value="other_type">อื่นๆ</option>
                </select>
            </div> --}}

            {{-- กรณีเลือกประเภทชุดอื่นๆ --}}
            {{-- <div id="other123"  style="display: none;">
                <label for="other_type_new" class="form-label">ประเภทชุด(อื่นๆ)</label>
                <input type="text" class="form-control" id="other_type_new" name="other_type_new">
            </div> --}}

            {{-- ถ้าเลือกประเภทชุดอื่นๆจะเด้งขึ้นมา --}}
            {{-- <script>
                document.addEventListener('DOMContentLoaded',function(){
                    var selectnomal = document.getElementById('dress_id'); //เลือกปกติ
                    var selectother = document.getElementById('other123');
                    selectnomal.addEventListener('change',function(){
                        if(selectnomal.value === "other_type"){
                            selectother.style.display = 'block';
                        }
                        else{
                            selectother.style.display = 'none';
                        }
                    });
                });
            </script> --}}





            <div class="mb-3">
                <label for="dress_code" class="form-label">รหัสชุด</label>
                <input type="nu" class="form-control" id="dress_code" name="dress_code">
            </div>


            <div class="mb-3">
                <label for="size_name" class="form-label">ไซส์ชุด</label>
                <input type="text" class="form-control" id="size_name" name="size_name">
            </div>




            <div class="mb-3">
                <label for="dress_description" class="form-label">รายละเอียดชุด</label>
                <textarea class="form-control" id="dress_description" name="dress_description"></textarea>
            </div>

            <div class="mb-3">
                <label for="dress_image" class="form-label">รูปภาพชุด</label>
                <input type="file" class="form-control" id="dress_image" name="dress_image">
            </div>

            <!-- เพิ่มส่วนของ size -->


            <div class="mb-3">
                <label for="price" class="form-label">ราคาต่อชุด</label>
                <input type="number" class="form-control" id="price" name="price">
            </div>

            <div class="mb-3">
                <label for="deposit" class="form-label">ราคามัดจำชุดต่อชุด</label>
                <input type="number" class="form-control" id="deposit" name="deposit">
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">จำนวนชุด</label>
                <input type="number" class="form-control" id="amount" name="amount">
            </div>

            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>

    </div>
</div>


@endsection
