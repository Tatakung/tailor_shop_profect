@extends('layouts.employee')
@section('content')
    <div class="container d-flex justify-content-start">
        <div class="table-responsive text-start" style="width: 100%;">
            <h2 class="text text-start pt-5 ">รายละเอียดชุด</h2>
            <div class=”grid-container”>
                <div class="card mb-3 border-2" style="max-width: 1080px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $detaildress->dress_image) }}" class="img-fluid rounded-start"
                                alt="" width="120" height="90">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{-- {{$access}} --}}</h5>
                                <p class="card-text">
                                    <span style="font-weight: bold;">ประเภทชุด : </span> {{ $detaildress->dress_type }}
                                </p>
                                <p class="card-text">
                                    <span style="font-weight: bold;">แบบชุดที่ : </span> {{ $detaildress->dress_code }}
                                </p>
                                <p class="card-text">
                                    <span style="font-weight: bold;">คำอธิบายชุด : </span>
                                    {{ $detaildress->dress_description }}
                                </p>



                                


                            </div>
                        </div>
                    </div>
                </div>




                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>dress_id</th>
                            <th>ไซส์</th>
                            <th>ราคาชุด</th>
                            <th>ราคามัดจำ</th>
                            <th>จำนวนชุด</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailsize as $size)
                            <tr>
                                <td>{{ $size->id }}</td>
                                <td>{{ $size->dress_id }}</td>
                                <td>{{ $size->size_name }}</td>
                                <td>{{ $size->price }}</td>
                                <td>{{ $size->deposit }}</td>
                                <td>{{ $size->amount }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
