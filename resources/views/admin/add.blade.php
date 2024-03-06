@extends('layouts.admin')
@section('content')
    {{-- {{$gettype}} --}}
    <div class="container d-flex justify-content-start">
        <div class="table-responsive text-start" style="width: 100%;">
            <h2 class="text text-start py-4">แบบฟอร์มเพิ่มเครื่องประดับ</h2>

            @if(session('fail'))
                <div class="alert alert-danger">
                    {{session('fail')}}
                </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif

            <form action="{{ route('new.saveadddress') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="dresstype" class="form-label">เลือกประเภทชุด</label>
                    <select class="form-select" name="dresstype" id="dresstype">
                        <option value="" selected disabled>กรุณาเลือกประเภทชุด</option>
                        @foreach ($gettype as $gettype)
                            <option value="{{ $gettype }}">{{ $gettype }}</option>
                        @endforeach
                        <option value="other_type">เพิ่มประเภทชุดใหม่</option>
                    </select>
                </div>

                <div style="display: none" id="showinputother">
                    <label class="form-label" for="inputother">เพิ่มใหม่</label>
                    <input type="text" name="inputother" id="inputother">
                </div>

                {{-- script สำหรับ แสดงช่อง input --}}
                <script>
                    var selectdresstype = document.getElementById('dresstype'); //เลือกประเภทชุด
                    var showshowinputother = document.getElementById('showinputother'); //แสดงกล่องสำหรับinput เพิ่ทใหม่ 
                    selectdresstype.addEventListener('click', function() {

                        if (selectdresstype.value == "other_type") {
                            showshowinputother.style.display = "block";
                        } else {
                            showshowinputother.style.display = "none";
                            value = '' ; 
                        }
                    });
                </script>

                <div class="mb-3">
                    <label class="form-label" for="dresscode">แบบชุด</label>
                    <input type="number" name="dresscode" id="dresscode" value="" readonly>
                </div>

                <script>
                    var selectdresstype = document.getElementById('dresstype'); //เลือกประเภทชุด
                    var showdresscode = document.getElementById('dresscode'); //แสดงแบบชุดอันโตมัติ  + 1 
                    selectdresstype.addEventListener('click', function() {
                        fetch('/getmaxcode/' + selectdresstype.value)
                            .then(response => response.json())
                            .then(data => {
                                if (data.max === null) {
                                    showdresscode.value = 1;
                                } else {
                                    showdresscode.value = data.max + 1;
                                }
                            });
                    });
                </script>

                <div class="mb-3">
                    <label for="sizename">ไซส์</label>
                    <input type="text" name="sizename" id="sizename" required>
                </div>

                <div class="mb-3">
                    <label for="description">รายละเอียด</label>
                    <textarea name="description" id="description" cols="20" rows="2"></textarea>
                </div>

                <div class="mb-3">
                    <label class="mb-3" for="price">ราคาชุด / วัน</label>
                    <input type="number" name="price" id="price" required> ดอลล่า
                </div>


                <div class="mb-3">
                    <label for="deposit">ราคามัดจำ</label>
                    <input type="number" name="deposit" id="deposit" required>
                </div>

                <div class="mb-3">
                    <label for="amount">จำนวนชุด</label>
                    <input type="number" name="amount" id="amount" required>
                </div>


                <div class="mb-3">
                    <label for="imagedress">เพิ่มรูปภาพสำหรับชุด</label>
                    <input type="file" name="imagedress" id="imagedress">
                </div>

                <button class="btn btn-danger" type="submit">ยืนยันการเพิ่มชุด</button>

            </form>

        </div>
    </div>
@endsection
