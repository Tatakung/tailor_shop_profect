@extends('layouts.employee')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>รูปภาพ</th>
                <th>วันที่เพิ่มรูปภาพ</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($manageimage as $showimage)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $showimage->image) }}" alt="รูปภาพนะ"
                            style="width:90px; height: 90px;">
                    </td>
                    <td>{{ $showimage->created_at }}</td>
                    <td>
                        <form action="{{route('deleteimage',['id'=>$showimage->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#showmodal{{$showimage->id}}">ลบ</button>

                            <div class="modal fade" id="showmodal{{$showimage->id}}" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            จะลบ
                                        </div>
                                        <div class="modal-body">
                                            แน่ใจติ
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-secondary">ยืนยัน</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>



                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
