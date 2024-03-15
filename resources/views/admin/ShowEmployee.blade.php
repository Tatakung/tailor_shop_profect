{{-- @extends('layouts.admin')
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


                <ul class="pagination justify-content-end">
                    <li class="page-item {{ ($employee->currentPage() == 1) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $employee->url(1) }}" tabindex="-1" aria-disabled="true">ย้อนกลับ</a>
                    </li>
                    @for ($i = 1; $i <= $employee->lastPage(); $i++)
                        <li class="page-item {{ ($employee->currentPage() == $i) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $employee->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ ($employee->currentPage() == $employee->lastPage()) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $employee->url($employee->currentPage() + 1) }}">ถัดไป</a>
                    </li>
                </ul>


        </div>
    </div>
</div>

@endsection --}}



@extends('layouts.admin')
@section('content')

<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-center py-4 ">พนักงานทั้งหมด</h2>
        <div class=”grid-container”>
        <div style="display: flex; justify-content: end;">
            <a href="{{ route('register') }}" class="btn btn-success">เพิ่มพนักงาน</a>
        </div>
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



                <ul class="pagination justify-content-end">
                    <li class="page-item {{ ($employee->currentPage() == 1) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $employee->url(1) }}" tabindex="-1" aria-disabled="true">ย้อนกลับ</a>
                    </li>
                    @for ($i = 1; $i <= $employee->lastPage(); $i++)
                        <li class="page-item {{ ($employee->currentPage() == $i) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $employee->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ ($employee->currentPage() == $employee->lastPage()) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $employee->url($employee->currentPage() + 1) }}">ถัดไป</a>
                    </li>
                </ul>


        </div>
    </div>
</div>

@endsection