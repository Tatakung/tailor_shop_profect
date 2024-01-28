@extends('layouts.admin')
@section('content')

<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-start py-4">เครื่องประดับทั้งหมด</h2>

        <div class=”grid-container”>
            <a href="{{route('admin.formaccessory')}}" class="btn btn-success">เพิ่มเครืองประดับ</a>
            <div class="col py-1"></div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-start">
                    <thead class="table-dark">
                        <tr class="text text-center">
                            <th scope="col" class="col-1">ไอดี</th>
                            <th scope="col" class="col-1">รูปภาพ</th>
                            <th scope="col" class="col-1">ชื่อ</th>
                            <th scope="col" class="col-3">แบบ</th>
                            <th scope="col" class="col-2">ราคา</th>
                            <th scope="col" class="col-2">จำนวน</th>
                            <th scope="col" class="col-2">รายละเอียด</th>
                              </tr>
                    </thead>

                    @foreach ($accessorytotal as $show )
                        <tr>
                            <td>{{$show->id}}</td>
                            <td>
                                <img src="{{ asset('storage/' . $show->accessory_image)}} " style="width:50px; height: 50px;">
                            </td>
                            <td>{{$show->accessory_name}}</td>
                            <td>{{$show->accessory_code_new}}</td>
                            <td>{{$show->accessory_price}}</td>
                            <td>{{$show->accessory_count}}</td>
                            <td>
                                <a href="{{route('admin.detailAccessory',['id' => $show->id])}}">ดูรายละเอียด</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
        </div>
    </div>
</div>

@endsection
