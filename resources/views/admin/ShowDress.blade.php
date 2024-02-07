@extends('layouts.admin')
@section('content')

<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-start py-4">ชุดทั้งหมด</h2>

        <div class=”grid-container”>
            <div class="col py-1"></div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-start">
                    <thead class="table-dark">
                        <tr class="text text-center">
                            <th>ไอดี</th>
                            <th>รหัสชุด</th>
                            <th>ประเภทชุด</th>
                            <th>ชื่อไซส์</th>
                            <th>ราคา</th>
                            <th>ราคามัดจำ</th>
                            <th>จำนวน</th>
                              </tr>
                    </thead>

                    @foreach ($dresses as $dress)
                        @foreach ($dress->sizes as $size)
                            <tr>
                                <td>{{ $dress->id }}</td>
                                <td>{{ $dress->dress_code }}</td>
                                <td>{{ $dress->dress_type }}</td>
                                <td>{{ $size->size_name }}</td>
                                <td>{{ $size->price }}</td>
                                <td>{{ $size->deposit }}</td>
                                <td>{{ $size->amount }}</td>

                            </tr>
                        @endforeach
                    @endforeach
        

                </table>
        </div>
    </div>
</div>

@endsection
