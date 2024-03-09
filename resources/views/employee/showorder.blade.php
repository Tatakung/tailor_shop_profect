@extends('layouts.employee')
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
@endsection
