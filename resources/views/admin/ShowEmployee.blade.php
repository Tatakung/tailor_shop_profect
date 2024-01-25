@extends('layouts.admin')
@section('content')

<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-start py-4">พนักงานทั้งหมด</h2>

        <div class=”grid-container”>
            <a href="{{ route('register') }}" class="btn btn-success">เพิ่มพนักงาน</a>
            <div class="col py-1"></div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-start">
                    <thead class="table-dark">
                        <tr class="text text-center">
                            <th scope="col" class="col-1">หมายเลข</th>
                            <th scope="col" class="col-3">ชื่อ</th>
                            <th scope="col" class="col-2">อีเมล</th>
                            <th scope="col" class="col-2">สถานะ</th>
                            <th scope="col" class="col-2">รายละเอียด</th>
                              </tr>
                    </thead>

                    @foreach ($employee as $user)
                    @if($user->is_admin != 1)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name . ' ' . $user->lname}}</td>
                            <td>{{$user->email}}</td>
                            {{-- <td>{{$user->status}}</td> --}}
                            <td>
                                @if($user->status == 1)
                                    เป็นพนักงาน
                                @elseif($user->status == 0)
                                    ไม่ได้เป็นพนักงาน
                                @endif
                            </td>
                            <td>
                                <a href="{{route('admin.employeedetail',['id' => $user->id])}}">ดูรายละเอียด</a>
                            </td>
                        </tr>
                    @endif
                    @endforeach
                </table>
        </div>
    </div>
</div>

@endsection
