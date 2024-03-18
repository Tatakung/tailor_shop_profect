@extends('layouts.admin')
@section('content')


ประเภทชุด<p>{{$datadress->dress_type}}</p>
แบบชุด {{$datadress->dress_code}}
<img src="{{asset('storage/' .$datadress->dress_image)}}" alt="" width="250px" height="250px">
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>dress_id</th>
                <th>size_name</th>
                <th>price</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datasize as $datasize)
            <tr>
                <td>{{$datasize->id}}</td>
                <td>{{$datasize->dress_id}}</td>
                <td>{{$datasize->size_name}}</td>
                <td>{{$datasize->price}}</td>
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#showmodal{{$datasize->id}}">แก้ไข</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#showhis{{$datasize->id}}">แสดงประวัติ</button>
                </td>

                {{-- modalประวัติ --}}
                <div class="modal fade" id="showhis{{$datasize->id}}" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                ดูประวัติ
                            </div>
                        
                        <div class="modal-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>size_id</th>
                                        <th>วันที่แก้ไข</th>
                                        <th>action</th>
                                        <th>ค่าเดิม</th>
                                        <th>ค่าใหม่</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( \App\Models\Dresssizehistory::where('size_id',$datasize->id)->get() as $showhis )
                                        <tr>
                                            <td>{{ $showhis->id }}</td>
                                            <td>{{ $showhis->size_id }}</td>
                                            <td>{{ $showhis->created_at }}</td>
                                            <td>{{ $showhis->action }}</td>
                                            <td>{{ $showhis->old_amount }}</td>
                                            <td>{{ $showhis->new_amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismmiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-success">บันทึก</button>
                        </div>
                    </div>
                    </div>
                </div>



                {{-- <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>size_id</th>
                            <th>วันที่แก้ไข</th>
                            <th>action</th>
                            <th>ค่าเดิม</th>
                            <th>ค่าใหม่</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\Models\Dresssizehistory::where('size_id', $size->id)->get() as $showhis)
                        
                            <tr>
                                <td>{{ $showhis->id }}</td>
                                <td>{{ $showhis->size_id }}</td>
                                <td>{{ $showhis->created_at }}</td>
                                <td>{{ $showhis->action }}</td>
                                <td>{{ $showhis->old_amount }}</td>
                                <td>{{ $showhis->new_amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}

                

                {{-- @foreach( \App\Models\Dresssizehistory::where('size_id',$datasize->id)->get() as $showhis ) --}}











                {{-- modalแก้ไข --}}
                <div class="modal fade" id="showmodal{{$datasize->id}}" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                แก้ไข
                            </div>
                        
                        <div class="modal-body">
                            จะลบไอดีที่ {{$datasize->id}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismmiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-success">บันทึก</button>
                        </div>
                    </div>
                    </div>
                </div>






            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
