@extends('layouts.employee')
@section('content')
    <h4>รายละเอียดบิลที่ {{ $bill->first()->order_id }}</h4><br>
    <table class="table">
        <thead>
            <tr>
                <th>order_detail_id</th>
                <th>ประเภทออเดอร์</th>
                <th>นัดรับชุด</th>
                <th>นัดคืนชุด</th>
                <th>ประเภทชุดที่เช่า</th>
                <th>สถานะ</th>
                <th>จำนวนที่เช่า</th>
                <th>รายละเอียดบิล</th>
                {{-- {{$bill->type_order}} --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($bill as $bill)
                <tr>
                    <td>{{ $bill->id }}</td>
                    {{-- <td>{{ $bill->type_order }}</td> --}}
                    <td>
                        @if ($bill->type_order == '1')
                            ตัดชุด
                        @elseif($bill->type_order == '2')
                            เช่าชุด
                        @elseif($bill->type_order == '3')
                            เช่าเครื่องประดับ
                        @elseif($bill->type_order == '4')
                            เช่าตัด
                        @endif
                    </td>


                    <td>{{ $bill->pickup_date }}</td>
                    <td>{{ $bill->return_date }}</td>
                    <td>{{ $bill->type_dress }}</td>
                    <td>{{ $bill->status_detail }}</td>
                    <td>{{ $bill->amount }} ชุด</td>
                    <td>
                        <a href="{{ route('rentdetail', ['id' => $bill->id]) }}">รายละเอียด</a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
