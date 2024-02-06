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


            <!-- เพิ่มส่วนของดรอปดาวเลือกประเภทชุด -->
<div class="mb-3">
    <label for="dress_type" class="form-label">เลือกชุด</label>
    <select class="form-control" id="dress_type" name="dress_type">
        <option value="" selected disabled>กรุณาเลือกประเภทชุด</option>
        @foreach($get_dresstype as $dress_type)
            <option value="{{ $dress_type }}">{{ $dress_type }}</option>
        @endforeach
        <option value="other_type">อื่นๆ</option>
    </select>
</div>


        @if(session('checkothertypenew'))
        <div class="alert alert-success">
            {{ session('checkothertypenew') }}
        </div>
    @endif




<!-- ส่วนที่จะแสดงเมื่อเลือกประเภท "อื่นๆ" -->
<div id="other123" style="display: none;">
    <label for="other_type_new" class="form-label">ประเภทชุด (อื่นๆ)</label>
    <input type="text" class="form-control" id="other_type_new" name="other_type_new"  >
</div>

<!-- เพิ่มส่วนของดรอปดาวเลือกรหัสชุด -->
<div class="mb-3">
    <label for="dress_code" class="form-label">รหัสชุด</label>
    <select class="form-control" id="dress_code" name="dress_code">
    </select>
</div>

<!-- ส่วนที่จะแสดงเมื่อเลือกรหัสชุด "อื่นๆ" -->
<div id="other_code123" style="display: none;">
    <label for="other_code_new" class="form-label">รหัสชุด(อื่นๆ)</label>
    <input type="text" class="form-control" id="other_code_new" name="other_code_new" value=""  readonly>
</div>




<!--ดึงข้อมูล dress_code(รหัสชุด)จากAPI -->
<script>
var dressType = document.getElementById('dress_type');
dressType.addEventListener('change',function(){
    fetch('/admin/dresscodes/' + dressType.value)
            .then(response => response.json())
            .then(data => {
                var dressCodeSelect = document.getElementById('dress_code'); //เลือกปกติ      

                dressCodeSelect.innerHTML = '<option value="" selected disabled>กรุณาเลือกรหัสชุด</option>';
                data.forEach(dressCode => {
                    dressCodeSelect.innerHTML += '<option value="' + dressCode + '">' + dressCode + '</option>';
                });
                dressCodeSelect.innerHTML += '<option value="other_code">อื่นๆ</option>';
            });
});
</script>

<!--กรณีเลือกรหัสชุดอื่นๆจะให้มีเด้งช่องกรอกขึ้นมา-->
            <script>
                document.getElementById('dress_code').addEventListener('change',function(){
                var dresscodeseletenormal = document.getElementById('dress_code');
                var dresscodeother = document.getElementById('other_code123');
                if(dresscodeseletenormal.value === "other_code"){
                    dresscodeother.style.display = 'block';
                }
                else{
                    dresscodeother.style.display = 'none';
                }
            });
            </script>

<!--กำหนดรหัสชุดโดย+1-->         
<script>
    document.getElementById('dress_code').addEventListener('change',function(){
        var a = document.getElementById('dress_code');  //ดรอปดาว
        var b = document.getElementById('other_code_new') //ช่องสำหรับกรอกข้อความอัตโนมัิต
        if(a.value === 'other_code'){
            var selectdresstype = document.getElementById('dress_type')
            fetch('/admin/numbercodes/' + selectdresstype.value )
            .then(response => response.json())
            .then(data => {
                if(data.maxCode !== null){
                    b.value = data.maxCode + 1;
                }
                else{
                    b.value = 1 ;
                }
            });
        }
    });
</script>

<!-- ส่วนที่จะแสดงข้อมูล size  -->
<p id="size_name_label" style="display: none;"></p>


@if(session('repeatsize'))
<div class="alert alert-success">
    {{ session('repeatsize') }}
</div>
@endif

            <div class="mb-3">
                <label for="size_name" class="form-label">ไซส์ชุด</label>
                <input type="text" class="form-control" id="size_name" name="size_name" >
            </div>

            <div class="mb-3">
                <label for="dress_description" class="form-label">รายละเอียดชุด</label>
                <textarea class="form-control" id="dress_description" name="dress_description" ></textarea>
            </div>


            <div class="mb-3">
                <label for="dress_image" class="form-label">รูปภาพชุด</label>
                <input type="file" class="form-control" id="dress_image" name="dress_image">
            </div>

<!--block/none ประเภทชุดอื่นๆ-->
            <script>
                    var selectnomal = document.getElementById('dress_type'); //เลือกปกติ
                    var selectother = document.getElementById('other123');
                    selectnomal.addEventListener('change',function(){
                        if(selectnomal.value === "other_type"){
                            selectother.style.display = 'block';
                        }
                        else{
                            selectother.style.display = 'none';
                        }
                    });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded',function(){

                });
            </script>


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

<!--ดึงไซส์-->
<script>
document.getElementById('dress_code').addEventListener('change',function(){
    var selectedType = document.getElementById('dress_type');  //เลือกประเภทชุด
    var selectedCode = document.getElementById('dress_code');  //เลือกรหัสชุด
    var showsize = document.getElementById('size_name_label'); //ไซส์ชุด:

    //block/none ไซส์
    if(selectedCode.value !== ''){
        showsize.style.display = 'block';
    }
    else{
        showsize.style.display = 'none';
    }

        // ดึงข้อมูล size_name จาก API โดยส่ง dress_type และ dress_code
        fetch('/admin/sizes/' + selectedType.value + '/' + selectedCode.value)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                showsize.textContent = 'ไซส์ชุดที่มีในร้าน: ไม่มีไซส์';
            } else {
                showsize.textContent = 'ไซส์ชุดที่มีในร้าน: ' + data.join(', '); 
            }       
        });
});
</script>

<p><img src="" alt="" id="imageshow" style="width:50px; height: 50px;  display: none;  "  ></p>

<!--ดึงรูปภาพ-->
<script>
    document.getElementById('dress_code').addEventListener('change',function(){
        var selectedType = document.getElementById('dress_type');  //เลือกประเภทชุด
        var selectedCode = document.getElementById('dress_code');  //เลือกรหัสชุด
        var imageshow = document.getElementById('imageshow'); //รูปภาพนะ
    
        // block/none รูปภาพ
        if(selectedCode.value !== ''){
            imageshow.style.display = 'block';
        }
        else{
            imageshow.style.display = 'none';
        }
            fetch('/admin/image/' + selectedType.value + '/' + selectedCode.value)
            .then(response => response.json())
            .then(data => {  
                if(data.getimage !== null){
                    imageshow.src = "{{ asset('storage/') }}" + '/' + data.getimage ;
                    imageshow.alt = "รูปภาพไม่แสดง";
                }
                else{
                    imageshow.src ="";
                    imageshow.alt = "ยังไม่มีรูปภาพ";
                }

            });
    });
    </script>


<!--ดึงdescription-->
<script>
    document.getElementById('dress_code').addEventListener('change',function(){
        var a = document.getElementById('dress_type');  //เลือกประเภทชุด
        var b = document.getElementById('dress_code');  //เลือกรหัสชุด
        var c =document.getElementById('dress_description') //รายละเอียดชุด

        fetch('/admin/getdes/' + a.value + '/' + b.value)
            .then(response => response.json())
            .then(data => {
                if(data.getdes !== null){
                    c.value = data.getdes ;
                }
                else{
                    c.value = '';
                }
            });
    });
    </script>


            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>

    </div>
</div>

@endsection 