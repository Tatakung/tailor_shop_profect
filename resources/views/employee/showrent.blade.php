@extends('layouts.employee') <!-- หรือเลือก layout ตามที่คุณได้กำหนด -->

@section('content')

<!-- resources/views/your-view.blade.php -->

<div class="table-responsive text-start" style="width: 100%;">
    
    {{-- <h1>ออเดอร์เช่าชุด</h1>
    <div class=”grid-container”>
        <div class="col py-1"></div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-start">
                <thead class="table-dark">
                    <tr class="text text-center">
                        <th>ชื่อ-สกุล</th>
                        <th>วันที่ทำรายการ</th>
                        <th>วันที่นัดคืนชุด</th>
                        <th>ประเภทชุด</th>
                        <th>ราคาเต็ม</th>
                        <th>จำนวนชุดที่เช่า</th>
                        <th>ดูรายละเอียด</th>
                          </tr>
                </thead>
                
                @foreach($data as $customer)
                    @foreach($customer->orders as $order)
                        @foreach($order->orderdetails as $detail)
                            @foreach($detail->dates as $date)
                            
                    <tr>
                        <td>{{$customer->customer_fname . ' ' . $customer->customer_lname}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$date->latest()->first()->return_date}}</td>
                        <td>{{$detail->type_dress}}</td>
                        <td>{{$detail->price}}</td>
                        <td>{{$detail->amount}} ชุด</td>
                        <td>
                            <a href="{{route('rentdetail', ['id' => $detail->id])}}">รายละเอียด</a>
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                @endforeach
                @endforeach
            </table> --}}




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
                                    <th scope="col">ชื่อ-สกุล</th>
                                    <th scope="col">วันที่ทำรายการ</th>
                                    <th scope="col">วันที่นัดคืนชุด</th>
                                    <th scope="col">ประเภทชุด</th>
                                    <th scope="col">ราคาเต็ม</th>
                                    <th scope="col">จำนวนชุดที่เช่า</th>
                                    <th scope="col">ดูรายละเอียด</th>
        
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $customer)
                                @foreach($customer->orders as $order)
                                    @foreach($order->orderdetails as $detail)
                                        @foreach($detail->dates as $date)
                                        
                                <tr>
                                    <td>{{$customer->customer_fname . ' ' . $customer->customer_lname}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$date->latest()->first()->return_date}}</td>
                                    <td>{{$detail->type_dress}}</td>
                                    <td>{{$detail->price}}</td>
                                    <td>{{$detail->amount}} ชุด</td>
                                    <td>
                                        <a href="{{route('rentdetail', ['id' => $detail->id])}}">รายละเอียด</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                            @endforeach
                            @endforeach
                                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        







@endsection
