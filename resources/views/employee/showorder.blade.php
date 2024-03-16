{{-- @extends('layouts.employee')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>เลขบิล</th>
                <th>ชื่อ-นามสกุลลูกค้า</th>
                <th>วันที่ทำรายการ</th>
                <th>รายการทั้งหมด</th>
                <th>ดูรายละเอียด</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($showorder as $customer)
                @foreach ($customer->orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $customer->customer_fname . ' ' . $customer->customer_lname }}</td>
                        <td>{{ $order->created_at->format('Y-m-d')}}</td>
                        <td>{{$order->total_quantity}} รายการ</td>
                        <td>
                            <a href="{{route('showorderbill' , ['id' => $order->id])}}">รายละเอียดเกี่ยวกับบิล</a>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@endsection --}}
@extends('layouts.employee')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>เลขบิล</th>
                <th>ชื่อ-นามสกุลลูกค้า</th>
                <th>วันที่ทำรายการ</th>
                <th>รายการทั้งหมด</th>
                <th>ทดสอบ</th>
                <th>ดูรายละเอียด</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($showorder as $customer)
                @foreach ($customer->orders as $order)
                    {{-- @foreach ($order->orderdetails as $orderdetail) --}}
                        <tr>
                            {{-- @if($orderdetail->status_detail  == "กำลังเช่า" || $orderdetail->status_detail == 'จองชุด') --}}
                            <td>{{ $order->id }}</td>
                            <td>{{ $customer->customer_fname . ' ' . $customer->customer_lname }}</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            <td>{{ $order->total_quantity }} รายการ</td>
                            <td>
                                <a href="{{ route('showorderbill', ['id' => $order->id]) }}">รายละเอียดเกี่ยวกับบิล</a>
                            </td>
                            {{-- @endif --}}
                        </tr>
                    @endforeach
                @endforeach
            {{-- @endforeach --}}
        </tbody>
    </table>
@endsection
