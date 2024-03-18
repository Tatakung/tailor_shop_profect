{{-- @extends('layouts.admin')
@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif

<form action="{{route('adddata')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">

        <select name="seletetype" id="seletetype" class="form-select">
            <option value="" selected disabled>กรุณาเลือกเครื่องประดับ</option>
            @foreach ($gettype as $gettype)
                <option value="{{ $gettype }}">{{ $gettype }}</option>
            @endforeach
            <option value="other">เครื่องประดับใหม่</option>
        </select>
    </div>

    <div id="showforinput" style="display: none">
        <label class="form-label" for="othertype">กรอกสำหรับเครื่องประดับใหม่</label>
        <input class="form-control" type="text" name="othertype" id="othertype">
    </div>

    <div>
        <label for="code">แบบที่</label>
        <input type="number" name="code" id="code" value="" readonly> 
    </div>


    <script>
        var seleteType = document.getElementById('seletetype'); //เลือกประเภทเครื่องประดับ
        var showinput = document.getElementById('showforinput'); //ช่องกรอกสำหรับinput 
        seleteType.addEventListener('change', function() {
            if (seleteType.value == "other") {
                showinput.style.display = "block";
            } else {
                showinput.style.display = "none";
            }
        });
    </script>


    <script>
        var seleteType = document.getElementById('seletetype'); //เลือกประเภทเครื่องประดับ
        var calculatecode = document.getElementById('code') ;  //สำหรับช่องโชว์การ คำนวณ
        seleteType.addEventListener('change',function(){
            fetch('caculatemax/' +  seleteType.value)
            .then(response => response.json())
            .then(data => {

                if(seleteType.value == "other"){
                    calculatecode.value = 1 ; 
                }
                else{
                    calculatecode.value = data.findmaxcode + 1 ; 
                }


            }) ; 
        }) ;  
    </script>


<label for="amount">จำนวนเครื่องประดับ</label>
<input type="number" name="amount" id="amount">


<label for="price">ราคาเครื่องประดับ</label>
<input type="number" name="price" id="price">


<label for="deposit">ราคามัดจำเครื่องประดับ</label>
<input type="number" name="deposit" id="deposit">

<br>

<label for="des">ลายละเอียดเครื่องประดับ</label>
<textarea name="des" id="des" cols="3" rows="3"></textarea>

<label for="imagee">สำหรับเพิ่มรูปภาพ</label>
<input type="file" name="imagee" id="imagee">


<button type="submit" class="btn btn-success">บันทึก</button>
</form>
@endsection --}}




{{-- @extends('layouts.admin')
@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif
@if (session('fail'))
<div class="alert alert-success">
    {{session('fail')}}
</div>
@endif
    <form action="{{route('save')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div mb-3>
            <select name="seletetype" id="seletetype">
                <option value="" selected disabled>กรุณาเลือกประเภทชุด</option>
                @foreach ($type as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
                <option value="other">กรอกประเภทใหม่</option>
            </select>
        </div>

        <div class="mb-3" id="showinput" style="display: none">
            <label for="typenew" class="form-label">กรอกประเภทชุดใหม่</label>
            <input class="form-control" type="text" name="typenew" id="typenew">
        </div>


        <script>
            var selectType = document.getElementById('seletetype'); //เลือกประเภทชุด
            var show = document.getElementById('showinput'); //แสดงช่งอสำหรับกรอกinput
            selectType.addEventListener('change', function() {
                if (selectType.value == "other") {
                    show.style.display = "block";
                } else {
                    show.style.display = "none";
                }
            });
        </script>

        <div class="mb-3">
            <label class="form-label" for="code">แบบชุด</label>
            <input class="form-control" type="number" name="code" id="code" value="" readonly>
        </div>


        <script>
            var selectType = document.getElementById('seletetype'); //เลือกประเภทชุด
            var calculatecode = document.getElementById('code'); //แบบชุด
            selectType.addEventListener('change', function() {
                fetch('getcodemax/' + selectType.value)
                    .then(response => response.json())
                    .then(data => {
                        if (selectType.value == "other") {
                            calculatecode.value = 1;
                        } else {
                            calculatecode.value = data.max + 1;
                        }
                    });
            });
        </script>




        <div class="mb-3">
            <label for="size" class="form-label">ไซส์</label>
            <input type="text" name="size" id="size" class="form-control">
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">จำนวนชุด</label>
            <input type="text" name="amount" id="amount" class="form-control">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">ราคาชุด</label>
            <input type="text" name="price" id="price" class="form-control">
        </div>

        <div class="mb-3">
            <label for="deposit" class="form-label">ราคามัดจำ</label>
            <input type="text" name="deposit" id="deposit" class="form-control">
        </div>

        <div class="mb-3">
            <label for="des">รายละเอยีด</label>
            <textarea name="des" id="des" cols="5" rows="5"></textarea>
        </div>

        <div>
            <label for="images">เพิ่มรูปภาพ</label>
            <input type="file" name="images" id="images">
        </div>



        <button type="submit" class="btn btn-secondary">บันทึก</button>


    </form> --}}




@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($dress as $dress)
                <div class="col-md-3 md-3">
                    <a href="{{route('testdetail',['id'=>$dress->id])}}">
                        <img src="{{ asset('storage/' . $dress->dress_image) }}" alt="" width="100px" height="100px">
                        {{ $dress->dress_type }}
                        แบบที่ {{ $dress->dress_code }}
                    </a>

                </div>
            @endforeach
        </div>
    </div>
@endsection
