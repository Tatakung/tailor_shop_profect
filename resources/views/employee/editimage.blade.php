@extends('layouts.employee')
@section('content')
    {{-- <p>ประเภทค่าใช้จ่าย : {{ $editcost->cost_type }}</p>
    <p>ต้นทุน(ราคา) : {{ $editcost->cost_value }}</p> --}}


    <table class="table">
        <thead>
            <tr>
                <th>รูปภาพ</th>
                <th>วันที่เพิ่มรูปภาพ</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            {{-- <img src="{{ asset('storage/' . $imagerent->image) }}" alt="123" style="width:90px; height: 90px;">

            <img src="{{asset('storage/' .$showimage->image)}}" alt=""> --}}
            @foreach($manageimage as $showimage)
            <tr>
                <td>
                    <img src="{{asset('storage/' .$showimage->image)}}" alt="รูปภาพนะ" style="width:90px; height: 90px;">
                </td>
                <td>{{$showimage->created_at}}</td>
                <td>
                    <a href="" class="btn btn-danger">ลบ</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>



@endsection
