@extends('layouts.admin')
@section('content')

<div class="container d-flex justify-content-start">



    <form id="filterForm" action="{{ route('admin.showDress') }}" method="get" class="mb-0">
        <label for="typeFilter" class="me-2">ประเภทชุด</label>
        <select name="typeFilter" id="typeFilter" class="form-select" onchange="this.form.submit()">
            <option value="">ทั้งหมด</option>
            @foreach($selectType as $type)
                <option value="{{$type}}" @if($type === $request->input('typeFilter')) selected @endif >{{$type}}</option>
            @endforeach
        </select>
    </form>




    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-start py-4">ชุดทั้งหมด</h2>

        <div class=”grid-container”>
            <a href="{{route('admin.formdress')}}" class="btn btn-success">เพิ่มชุด</a>
            <div class="col py-1"></div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-start">
                    <thead class="table-dark">
                        <tr class="text text-center">
                            <th>ประเภทชุด</th>
                            <th>แบบชุด</th>
                            <th>ไซส์</th>
                            <th>ราคา</th>
                            <th>จำนวนชุด</th>
                            <td>ดูรายละเอียด</td>
                              </tr>
                    </thead>
                    @foreach($dresses as $dress)
                        @foreach($dress->sizes as $size)
                        <tr>
                            <td>{{$dress->dress_type}}</td>
                            <td>แบบที่ {{$dress->dress_code}}</td>
                            <td>{{$size->size_name}}</td>
                            <td>{{$size->price}}</td>
                            <td>{{$size->amount}} ชุด</td> 
                            <td>
                                <a href="{{route('admin.detailDress',['id' => $size->id])}}">รายละเอียด</a>
                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                </table>

                
                                
                

        </div>
    </div>
</div>

@endsection
