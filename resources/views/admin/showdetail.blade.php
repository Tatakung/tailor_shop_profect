@extends('layouts.admin')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.showdresstotal') }}">จัดการชุด</a></li>
        <li class="breadcrumb-item active" aria-current="page">รายละเอียด</li>
    </ol>


    <div class="container d-flex justify-content-start">
        <div class="table-responsive text-start" style="width: 100%;">



            <h2 class="text text-start pt-5 ">รายละเอียดชุด</h2>
            <div class=”grid-container”>
                <div class="card mb-3 border-2" style="max-width: 1080px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $dress->dress_image) }}" class="img-fluid rounded-start"
                                alt="" width="120" height="90"> <!--ค่อยปรับตามรูปที่ต้องการ -->
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text">
                                    <span style="font-weight: bold;">ประเภทชุด : </span> {{ $dress->dress_type }}
                                </p>
                                <p class="card-text">
                                    <span style="font-weight: bold;">แบบชุดที่ : </span> {{ $dress->dress_code }}
                                </p>
                                <p class="card-text">
                                    <span style="font-weight: bold;">คำอธิบายชุด : </span> {{ $dress->dress_description }}
                                </p>


                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#showeditdresstable">แก้ไข</button>

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

                            </div>
                        </div>
                    </div>
                </div>

                <!-- modalของแก้ไขตาราง dress -->
                <div class="modal fade" id="showeditdresstable" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header alert alert-warning" role="alert" style="font-weight: bold;">
                                คุณต้องการจะแก้ไขหรือไม่?
                            </div>
                            <form action="{{ route('admin.updatedress') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <label for="description">แก้ไขคำอธิบายชุด : </label>
                                    <input type="text" name="description" id="description"
                                        value="{{ $dress->dress_description }}">
                                    <br>
                                    <label for="update_image">แก้ไขรูปภาพ : </label>
                                    <input type="file" name="update_image" id="update_image">
                                    <input type="hidden" name="dress_id" id="dress_id" value="{{ $dress->id }}">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-success">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: start;" class="py-2">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#showaddsize">+
                        เพิ่มไซส์</button>
                </div>
                <!-- modalสำหรับเพิ่มไซส์ -->
                <div class="modal fade" id="showaddsize" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header alert alert-success" role="alert" style="font-weight: bold;">
                                คุณต้องการเพิ่มชุดที่มีอยู่แล้วหรือไม่?
                            </div>
                            <form action="{{ route('admin.savesize') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <label for="add_size_name"> ขนาดไซส์ : </label>
                                    <input type="text" name="add_size_name" id="add_size_name" required>
                                    <br>
                                    <label for="add_price"> ราคา : </label>
                                    <input type="number" name="add_price" id="add_price" required min="1">
                                    <br>
                                    <label for="add_deposit"> ราคามัดจำ : </label>
                                    <input type="number" name="add_deposit" id="add_deposit" required min="1">
                                    <br>
                                    <label for="add_amount"> จำนวนชุด : </label>
                                    <input type="number" name="add_amount" id="add_amount" required min="1">

                                    <input type="hidden" name="dress_id" id="dress_id" value="{{ $dress->id }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-success">ยันยัน</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
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
                                <td>{{ $size->size_name }}</td>
                                <td>{{ $size->price }}</td>
                                <td>{{ $size->deposit }}</td>
                                <td>{{ $size->amount }}</td>
                                <td>
                                    <button type="button" data-toggle="modal"
                                        data-target="#showedit{{ $size->id }}">
                                        <img src="{{ asset('images/edit.png') }}" alt="" width="20"
                                            height="25">
                                    </button>

      

                                    <button type="button" data-toggle="modal"
                                        data-target="#showhistorysize{{ $size->id }}">
                                        <img src="{{ asset('images/history.png') }}" width="20" height="25">
                                    </button>
    

                                    <!--modal ประวัติการแก้ไข-->
                                    <div class="modal fade" id="showhistorysize{{ $size->id }}" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header alert alert-primary">
                                                    ประวัติการแก้ไข
                                                </div>
                                                <div class="modal-body" style="font-weight: bold;">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>วันที่แก้ไข</th>
                                                                <th>action</th>
                                                                <th>ค่าเดิม</th>
                                                                <th>ค่าใหม่</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach (\App\Models\Dresssizehistory::where('size_id', $size->id)->get() as $showhis)
                                                                <tr>
                                                                    <td>{{ $showhis->created_at }}</td>
                                                                    <td>{{ $showhis->action }}</td>
                                                                    <td>{{ $showhis->old_amount }}</td>
                                                                    <td>{{ $showhis->new_amount }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">กลับ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- modalแสดงแก้ไข -->
                                    <div class="modal fade" id="showedit{{ $size->id }}" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header alert alert-warning" role="alert" style="font-weight: bold;">
                                                    คุณต้องการจะแก้ไขใช่หรือไม่ ?
                                                </div>
                                                <form action="{{ route('admin.updatepricegroup') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="update_price">แก้ไขราคาชุด :</label>
                                                            <input type="number" class="form-control" name="update_price" id="update_price" value="{{ $size->price }}">
                                                        </div>
                                    
                                                        <div class="form-group">
                                                            <label for="update_deposit">แก้ไขราคามัดจำ :</label>
                                                            <input type="number" class="form-control" name="update_deposit" id="update_deposit" value="{{ $size->deposit }}">
                                                        </div>
                                    
                                                        <div class="form-group">
                                                            <label for="action_type">เพิ่ม/ลบจำนวนชุด :</label>
                                                            <select class="form-control" name="action_type" id="action_type">
                                                                <option value="" selected>เลือก</option>
                                                                <option value="add">เพิ่มจำนวน</option>
                                                                <option value="remove">ลบจำนวน</option>
                                                            </select>
                                                        </div>
                                    
                                                        <div class="form-group">
                                                            <label for="quantity">จำนวนที่ต้องการ :</label>
                                                            <input type="number" class="form-control" name="quantity" id="quantity">
                                                        </div>
                                    
                                                        <input type="hidden" name="size_id" id="size_id" value="{{ $size->id }}">
                                                    </div>
                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                                        <button type="submit" class="btn btn-success">บันทึก</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    



                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
