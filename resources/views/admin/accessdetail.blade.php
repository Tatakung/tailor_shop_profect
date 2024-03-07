@extends('layouts.admin')
@section('content')
    {{-- {{$access}} --}}
    <h4>ประเภทเครื่องประดับ {{ $access->accessory_name }}</h4>
    <h4>จำนวนเครื่องประดับ {{ $access->accessory_count }}</h4>
    <h4>ราคา {{ $access->accessory_price }}</h4>
    <h4>ราคามัดจำ {{ $access->accessory_deposit }}</h4>
    <h4>รายละเอียด {{ $access->accessory_description }}</h4>
    <img src="{{ asset('storage/' . $access->accessory_image) }}" alt="" width="120" height="90">


    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modaleditaccess">แก้ไข</button>
    <button type="button" data-toggle="modal" data-target="#history">ประวัติการแก้ไข</button>
    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    @if(session('fail'))
    <div class="alert alert-danger">
        {{session('fail')}}
    </div>
    @endif
    {{-- ส่วน modalแก้ไข --}}
    <div class="modal fade" id="modaleditaccess" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    จะแก้ไขไหมนะ
                </div>
                <form action="{{route('admin.updateaccessdetail')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label for="update_price">ราคา</label>
                        <input type="number" name="update_price" id="update_price" value="{{ $access->accessory_price }}" required>
                        <br>

                        <label for="update_deposit">ราคามัดจำ</label>
                        <input type="number" name="update_deposit" id="update_deposit" value="{{ $access->accessory_deposit }}" required>

                        <br>

                        <label for="update_des">แก้ไขคำบรรยาย</label>
                        <textarea name="update_des" id="update_des" cols="20" rows="2">{{ $access->accessory_description }}</textarea>

                        <br>

                        <label for="update_amount">เพิ่มลบจำนวนเครื่องประดับ</label>
                        <select name="update_amount" id="update_amount">
                            <option value="">เลือก</option>
                            <option value="add">เพิ่ม</option>
                            <option value="remove">ลบ</option>
                        </select>
                        <input type="number" name="quantity" id="quantity">

                        <br>
                        <label for="update_image">แก้ไขรูปภาพ</label>
                        <input type="file" name="update_image" id="update_image">
                        
                        <input type="hidden" name="id" id="id" value="{{$access->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-secondary">บันทึก</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



    {{-- modalแสดงประวัติ --}}

    <div class="modal fade" id="history" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    ประวัติการแก้ไข
                </div>
                <div class="modal-body">
                    แสดงตาราง
                    <table class="table">
                        <thead>
                            <tr>
                                <th>accessory_id</th>
                                <th>วันที่แก้ไข</th>
                                <th>action</th>
                                <th>ค่าเก่า</th>
                                <th>ค่าใหม่</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Accessoryhistory::where('accessory_id',$access->id)->get() as $history)
                            <tr>
                                <td>{{$history->id}}</td>
                                <td>{{$history->created_at}}</td>
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
                    
                </div>
            </div>
        </div>
    </div>





@endsection
