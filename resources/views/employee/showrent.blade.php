@extends('layouts.employee') <!-- หรือเลือก layout ตามที่คุณได้กำหนด -->

@section('content')
    <div class="table-responsive text-start" style="width: 100%;">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Recent Salse</h6>
                    <a href="">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th>order_idบิล</th>
                                <th scope="col">ชื่อ-สกุล</th>
                                <th scope="col">วันที่ทำรายการ</th>
                                <th scope="col">วันที่นัดคืนชุด</th>
                                <th scope="col">ประเภทชุด</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">จำนวนชุดที่เช่า</th>
                                <th scope="col">ดูรายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{$item->order_id}}</td>
                                    <td>{{ $item->customer_fname . ' ' . $item->customer_lname }}</td>
                                    <td>{{ $item->order_created_at }}</td>
                                    <td>{{ $item->return_date }}</td>
                                    <td>{{$item->type_dress}}</td>
                                    <td>{{ $item->status_detail }}</td>
                                    <td>{{ $item->amount }} ชุด</td>
                                    <td>
                                        <a href="{{ route('rentdetail', ['id' => $item->detail_id]) }}">รายละเอียด</a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
