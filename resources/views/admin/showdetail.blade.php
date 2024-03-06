@extends('layouts.admin')
@section('content')
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#showeditdresstable">แก้ไข</button>
    <h4>ประเภทชุด {{ $dress->dress_type }}</h4>
    <h4>แบบชุดที่ {{ $dress->dress_code }}</h4>
    <h4>ลายระเอียด {{ $dress->dress_description }}</h4>
    <div>
        <img src="{{ asset('storage/' . $dress->dress_image) }}" alt="" width="120" height="90">
    </div>


    {{-- modalของแก้ไขตาราง dress --}}
    <div class="modal fade" id="showeditdresstable" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    แก้ไขชุด
                </div>
                <div class="modal-body">
                    <label for="description">แก้ไขลายละเอียด</label>
                    <input type="text" name="description" id="description" value="{{ $dress->dress_description }}">
                    <br>
                    <label for="">แก้ไขรูปภาพ</label>
                    <input type="file" name="" id="">


                    <input type="hidden" name="" id="" value="{{ $dress->id }}">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-secondary">บันทึก</button>
                </div>
            </div>
        </div>
    </div>













    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#showaddsize">+เพิ่มไซส์</button>
    {{-- modalสำหรับเพิ่มไซส์ --}}
    <div class="modal fade" id="showaddsize" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    เพิ่ม ไซส์
                </div>
                <form action="{{route('admin.savesize')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        {{ $dress->id }}
                        <br>
                        <label for="add_size_name">ชื่อไซส์</label>
                        <input type="text" name="add_size_name" id="add_size_name">
                        <br>
                        <label for="add_price">ราคา</label>
                        <input type="number" name="add_price" id="add_price">
                        <br>
                        <label for="add_deposit">ราคามัดจำ</label>
                        <input type="number" name="add_deposit" id="add_deposit">
                        <br>
                        <label for="add_amount">จำนวนชุด</label>
                        <input type="number" name="add_amount" id="add_amount">

                        <input type="hidden" name="dress_id" id="dress_id" value="{{$dress->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-secondary">ยันยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
















    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>dress_id</th>
                <th>ไซส์</th>
                <th>ราคาชุด</th>
                <th>ราคามัดจำ</th>
                <th>จำนวนชุด</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($size as $size)
                <tr>
                    <td>{{ $size->id }}</td>
                    <td>{{ $size->dress_id }}</td>
                    <td>{{ $size->size_name }}</td>
                    <td>{{ $size->price }}</td>
                    <td>{{ $size->deposit }}</td>
                    <td>{{ $size->amount }}</td>
                    <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#showedit{{ $size->id }}">แก้ไข</button>
                        {{-- modalแสดงแก้ไข --}}
                        <div class="modal fade" id="showedit{{ $size->id }}" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        จะแก้ไข
                                    </div>
                                    <div class="modal-body">
                                        <label for="update_price">แก้ไขราคา</label>
                                        <input type="number" name="update_price" id="update_price"
                                            value="{{ $size->price }}">
                                        <br>

                                        <label for="update_deposit">แก้ไขราคามัดจำ</label>
                                        <input type="number" name="update_deposit" id="update_deposit"
                                            value="{{ $size->deposit }}">

                                        <br>

                                        <label for="amount" id="amount">เพิ่ม/ลบจำนวนชุด</label>
                                        <select name="action_type" id="action_type">
                                            <option value="" selected>เลือก</option>
                                            <option value="add">เพิ่มจำนวน</option>
                                            <option value="remove">ลบจำนวน</option>
                                        </select>

                                        <label for="quantity">จำนวนที่ต้องการ</label>
                                        <input type="number" name="quantity" id="quantity" disabled>



                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-secondary">บันทึก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        selecttype = document.getElementById('action_type'); //เลือกปกติ
        quantityinput = document.getElementById('quantity'); //ช่องกรอกข้อมูลนะ
        selecttype.addEventListener('change', function() {
            if (selecttype.value === "add" || selecttype.value === "remove") {
                quantityinput.value = '';
                quantityinput.disabled = false;
            } else {
                quantityinput.value = '';
                quantityinput.disabled = true;
            }

        });
    </script>
@endsection
