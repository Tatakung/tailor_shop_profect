
@extends('layouts.admin')
@section('content')

<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-start py-4">แบบฟอร์มเพิ่มเครื่องประดับ</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">
            
            @csrf

            <div class="mb-3">
                <label for="accessory_name" class="form-label">ชื่อเครื่องประดับ</label>
                <select class="form-select" name="accessory_name" id="accessory_name" required>
                    <option value="" selected disabled>เลือกชื่อเครื่องประดับ</option>
                    @foreach($accessoryName as $name)
                    <option value="{{$name}}">{{$name}}</option>
                    @endforeach
                    <option value="other">อื่นๆ</option>
                </select>
                
                {{-- กรอกอื่นๆ --}}
                <div id="other123"  style="display: none;">
                    <label for="other" class="form-label">ชื่อเครื่องประดับ(อื่นๆ)</label>
                    <input type="text" class="form-control" id="other" name="other">
                </div>

            </div>



            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var accessorySelect = document.getElementById('accessory_name');  //เลือกปกติ
                    var selectother = document.getElementById('other123'); //เลือกอื่นๆ
                    
                    accessorySelect.addEventListener('change', function() {
                        if (accessorySelect.value === 'other') {
                            selectother.style.display = 'block';
                        }                        
                        else {
                            selectother.style.display = 'none';
                        }
                    });
                });
            </script>
  

            <div class="mb-3">
                <label for="accessory_code" class="form-label">รหัสเครื่องประดับ</label>
                <input type="text" class="form-control" id="accessory_code" name="accessory_code" required readonly>
            </div>

            <div class="mb-3">
                <label for="accessory_count" class="form-label">จำนวนเครื่องประดับ</label>
                <input type="number" class="form-control" id="accessory_count" name="accessory_count" required>
            </div>

            <div class="mb-3">
                <label for="accessory_price" class="form-label">ราคาเครื่องประดับ</label>
                <input type="number" class="form-control" id="accessory_price" name="accessory_price" required>
            </div>

            <div class="mb-3">
                <label for="accessory_description" class="form-label">รายละเอียดเครื่องประดับ</label>
                <textarea class="form-control" id="accessory_description" name="accessory_description"></textarea>
            </div>

            <div class="mb-3">
                <label for="accessory_image" class="form-label">รูปภาพเครื่องประดับ</label>
                <input type="file" class="form-control" id="accessory_image" name="accessory_image">
            </div>

            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>

    </div>
</div>

@endsection
