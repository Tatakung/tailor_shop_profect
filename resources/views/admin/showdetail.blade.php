@extends('layouts.admin')
@section('content')
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#showeditdresstable">แก้ไข</button>
    <h4>ประเภทชุด {{ $dress->dress_type }}</h4>
    <h4>แบบชุดที่ {{ $dress->dress_code }}</h4>
    <h4>ลายระเอียด {{ $dress->dress_description }}</h4>
    <div>
        <img src="{{ asset('storage/' . $dress->dress_image) }}" alt="" width="120" height="90">
    </div>

    

    @if (session('fail'))
        <div class="alert alert-danger">
            {{ session('fail') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('faildeleteamount'))
        <div class="alert alert-danger">
            {{ session('faildeleteamount') }}
        </div>
    @endif


    @if (session('addselect'))
        <div class="alert alert-danger">
            {{ session('addselect') }}
        </div>
    @endif



    {{-- modalของแก้ไขตาราง dress --}}
    <div class="modal fade" id="showeditdresstable" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    แก้ไขชุด
                </div>
                <form action="{{ route('admin.updatedress') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label for="description">แก้ไขลายละเอียด</label>
                        <input type="text" name="description" id="description" value="{{ $dress->dress_description }}">
                        <br>
                        <label for="update_image">แก้ไขรูปภาพ</label>
                        <input type="file" name="update_image" id="update_image">
                        <input type="hidden" name="dress_id" id="dress_id" value="{{ $dress->id }}">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-secondary">บันทึก</button>
                    </div>
                </form>
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
                <form action="{{ route('admin.savesize') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        {{ $dress->id }}
                        <br>
                        <label for="add_size_name">ชื่อไซส์</label>
                        <input type="text" name="add_size_name" id="add_size_name" required>
                        <br>
                        <label for="add_price">ราคา</label>
                        <input type="number" name="add_price" id="add_price" required>
                        <br>
                        <label for="add_deposit">ราคามัดจำ</label>
                        <input type="number" name="add_deposit" id="add_deposit" required>
                        <br>
                        <label for="add_amount">จำนวนชุด</label>
                        <input type="number" name="add_amount" id="add_amount" required>

                        <input type="hidden" name="dress_id" id="dress_id" value="{{ $dress->id }}">
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
                        {{-- ปุ่มแก้ไข --}}
                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                            data-target="#showedit{{ $size->id }}">แก้ไข</button>
                        {{-- ปุ่มลบ --}}

                        <button type="button" data-toggle="modal" data-target="#showconfirmdeletesize{{ $size->id }}">
                            <img src="{{ asset('images/icondelete.jpg') }}" alt="" width="20" height="20">
                        </button>

                        <button type="button" data-toggle="modal"
                        data-target="#showhistory{{ $size->id }}">ดูประวัติ</button>


                        {{-- modalลบsize --}}
                        <div class="modal fade" id="showconfirmdeletesize{{ $size->id }}" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        จะลบจริงหรอ
                                    </div>
                                    <div class="modal-body">
                                        จะลบจริงๆใช้ไหม
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-secondary">ยืนยัน</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- momdalแสดงประวัติ --}}
                        <div class="modal fade" id="showhistory{{ $size->id }}" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        ประวัติการแก้ไข
                                    </div>
                                    <div class="modal-body">
                                        {{$size->id}}
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>size_id</th>
                                                    <th>วันที่ทำรายการ</th>
                                                    <th>action</th>
                                                    <th>ค่าเดิม</th>
                                                    <th>ค่าใหม่</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(   \App\Models\Dresssizehistory::where('size_id',$size->id)->get() as $history  )
                                                <tr>
                                                    <td>{{$history->size_id}}</td>
                                                    <td>{{$history->created_at->format('Y-m-d')}}</td>
                                                    <td>{{$history->action}}</td>
                                                    <td>{{$history->old_amount}}</td>
                                                    <td>{{$history->new_amount}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-secondary">ยืนยัน</button>
                                    </div>
                                </div>
                            </div>
                        </div>




                        {{-- modalแสดงแก้ไข --}}
                        <div class="modal fade" id="showedit{{ $size->id }}" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        จะแก้ไข
                                    </div>
                                    <form action="{{ route('admin.updatepricegroup') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <label for="update_price">แก้ไขราคาชุด</label>
                                            <input type="number" name="update_price" id="update_price"
                                                value="{{ $size->price }}">
                                            <br>

                                            <label for="update_deposit">แก้ไขราคามัดจำ</label>
                                            <input type="number" name="update_deposit" id="update_deposit"
                                                value="{{ $size->deposit }}">

                                            <br>

                                            <label for="amount" id="amount">เพิ่ม/ลบจำนวนชุด</label>
                                            <select name="action_type" id="action_type_{{ $size->id }}">
                                                <option value="" selected>เลือก</option>
                                                <option value="add">เพิ่มจำนวน</option>
                                                <option value="remove">ลบจำนวน</option>
                                            </select>

                                            <label for="quantity">จำนวนที่ต้องการ</label>
                                            <input type="number" name="quantity" id="quantity_{{ $size->id }}">


                                            <input type="hidden" name="size_id" id="size_id"
                                                value="{{ $size->id }}">


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">ยกเลิก</button>
                                                <button type="submit" class="btn btn-secondary">บันทึก</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>





                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <script>
        selecttype = document.getElementById('action_type_{{ $size->id }}'); //เลือกปกติ
        quantityinput = document.getElementById('quantityy_{{ $size->id }}'); //ช่องกรอกข้อมูลนะ
        var isQuantityDisabled = true;
        selecttype.addEventListener('change', function() {
            if (selecttype.value === "add" || selecttype.value === "remove") {
                quantityinput.value = '';
                quantityinput.disabled = false;
                isQuantityDisabled = false;

            } else {
                quantityinput.value = '';
                quantityinput.disabled = true;
                isQuantityDisabled = true;
            }

        });
    </script> --}}

    {{-- modalแสดงประวัติแก้ไข --}}
    <div class="modal fade" id="history{{ $size->id }}" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    จะแสดงประวัติ
                </div>
                <div class="modal-body">

                    กกหหกกห
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-secondary">บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
