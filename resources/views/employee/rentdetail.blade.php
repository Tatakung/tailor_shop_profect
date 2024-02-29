@extends('layouts.employee')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 bg-light border border-gray-500">
                <h1>กรอบบน</h1>
                <div class="row">
                    <div class="col-md-6">
                        <p class="users-details">Dress ID: {{ $rentdetail->dress_id }}</p>
                        @foreach ($dates as $date)
                            <p>วันที่นัดรับชุด : {{ $date->pickup_date }}</p>
                            <p>วันที่นัดคืนชุด : {{ $date->return_date }} </p>
                        @endforeach

                        <p> ประเภทชุด :{{ $dress->dress_type }}</p>
                        <p>แบบชุดที่ {{ $dress->dress_code }}</p>
                        <p>ไซส์ :{{ $size->size_name }}</p>
                        <p class="users-details">Order ID: {{ $rentdetail->order_id }}</p>
                        <p> พนักงานที่เพิ่มออเดอร์นี้ คุณ : {{ $employee->name . ' ' . $employee->lname }}</p>
                        @foreach ($orderdetailstatuses as $detailstatus)
                            <p> สถานะ : {{ $detailstatus->latest()->first()->status }} (ล่าสุด)</p>
                        @endforeach
                        <p class="users-details">เลขชาท: {{ $rentdetail->late_charge }} บาท</p>
                        <p class="users-details">ประเภทชุด: {{ $rentdetail->type_dress }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="users-details">Type Order: {{ $rentdetail->type_order }}</p>
                        <p class="users-details">จำนวนที่เช่า: {{ $rentdetail->amount }} ชุด</p>
                        <p class="users-details">ราคา: {{ $rentdetail->price }} บาท</p>
                        <p class="users-details">ราคามัดจำ: {{ $rentdetail->deposit }} บาท</p>
                        <p class="users-details">โน๊ต: {{ $rentdetail->note }}</p>
                        <p class="users-details">ประกันค่าเสียหาย: {{ $rentdetail->damage_insurance }} บาท</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="users-details">สถานะออเดอร์: {{ $rentdetail->status_detail }}</p>
                        <p class="users-details">สถานะการจ่ายเงิน:
                            @if ($rentdetail->status_payment == 1)
                                จ่ายมัดจำแล้ว
                            @elseif($rentdetail->status_payment == 2)
                                จ่ายเต็มจำนวนแล้ว
                            @else
                                สถานะการจ่ายเงินไม่ถูกต้อง
                            @endif
                        </p>
                        <p class="users-details">Late Fee: {{ $rentdetail->late_fee }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 bg-light border border-gray-500">
                {{-- <h1>กรอบซ้าย</h1> --}}
                <h3>วันที่</h3>
                @foreach ($dates as $date)
                    <p>วันที่นัดรับชุด : {{ $date->pickup_date }} || วันที่นัดคืนชุด : {{ $date->return_date }}</p>
                @endforeach
            </div>
            <div class="col-md-6 bg-light border border-gray-500">
                {{-- <h1>กรอบขวา</h1> --}}
                <h3>นัดลองชุด</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal">เพิ่มวันนัดลองชุด </button>

                <table class="table">
                    <thead>
                        <tr>
                            <th>วันที่นัด</th>
                            <th>สถานะ</th>
                            <th>โน๊ต</th>
                            <th>ราคา</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finttings as $fitting)
                            <tr>
                                <td>{{ $fitting->fitting_date }}</td>
                                <td>{{ $fitting->fitting_status }}</td>
                                <td>{{ $fitting->fitting_note }}</td>
                                <td>{{ $fitting->fitting_price }}</td>
                                <td>
                                    <a href="{{ route('editfitting', ['id' => $fitting->id]) }}">
                                        <img src="{{ asset('images/edit.png') }}" alt="" width="20"
                                            height="20"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- <label for="cost_type">ประเภทค่าใช้จ่าย</label>
    <input type="text" name="cost_type" id="cost_type">
    <label for="cost_value">ราคา</label>
    <input type="number" name="cost_value" id="cost_value"> --}}


    <div class="row">
        <div class="col-md-6 bg-light border border-gray-500">
            {{-- <h1>กรอบซ้าย</h1> --}}
            <h3>สถานะของออเดอร์123</h3>
            @foreach ($orderdetailstatuses as $detailstatus)
                <p>วันที่ : {{ $detailstatus->created_at }} สถานะ : {{ $detailstatus->status }}</p>
            @endforeach
        </div>
        <div class="col-md-6 bg-light border border-gray-500">
            {{-- <h1>กรอบขวา</h1> --}}
            <h3>เพิ่มเติมกรณีปักดอกไม้เพิ่ม</h3>
            <button type="button" class="btn btn-primary" data-toggle="modal"
                data-target="#adddecoration">+ปักเพิ่ม</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>วันที่เพิ่มรายการ</th>
                        <th>ประเภท</th>
                        <th>รายละเอียด</th>
                        <th>ราคา</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($decorations as $decoration)
                        <tr>
                            <td>{{ $decoration->created_at }}</td>
                            <td>{{ $decoration->decoration_type }}</td>
                            <td>{{ $decoration->decoration_type_description }}</td>
                            <td>{{ $decoration->decoration_price }}</td>
                            <td>
                                <a href="{{ route('editdecoration', ['id' => $decoration->id]) }}">
                                    <img src="{{ asset('images/edit.png') }}" alt="" width="20"
                                        height="20"></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 bg-light border border-gray-500">
            <h3>รูปภาพชุดก่อนเช่า</h3>
            {{-- @foreach ($imagerents as $imagerent)
                <img src="{{ asset('storage/' . $imagerent->image) }}" alt="123" style="width:90px; height: 90px;">
            @endforeach --}}
        </div>
        <div class="col-md-6 bg-light border border-gray-500">
            <h3>ค่าใช้จ่าย</h3>
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addcost"
                id="clickaddcost">บันทึกค่าใช้จ่าย</button>

            <table class="table">
                <thead>
                    <tr>
                        <th>วันที่เพิ่ม</th>
                        <th>ประเภทค่าใช้จ่าย</th>
                        <th>ต้นทุน</th>
                        <th>action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($costs as $cost)
                    <tr>
                        <td>{{$cost->created_at}}</td>
                        <td>{{$cost->cost_type}}</td>
                        <td>{{$cost->cost_value}}</td>
                        <td>
                            <a href="{{route('editcost', ['id' => $cost->id])}}">
                                <img src="{{ asset('images/edit.png') }}" alt="" width="20"
                                    height="20"></a>
                        </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('addfitting', ['orderdetailid' => $rentdetail->id]) }}" method="POST">
        @csrf
        <div class="modal fade" id="exampleModal" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">เพิ่มวันนัดลองชุด</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fittingdate">วันนัดลองชุด:</label>
                            <input type="date" name="fittingdate" id="fittingdate">

                        </div>

                        <div class="form-group">
                            <label for="fittingnote">บันทึก:</label><br>
                            <textarea class="form-control" name="fittingnote" id="fittingnote"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="fittingprice">ราคา:</label>
                            <input type="number" name="fittingprice" id="fittingprice">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">ยืนยัน</button>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <form action="{{ route('adddecoration', ['orderdetailid' => $rentdetail->id]) }}" method="POST">
        @csrf
        <div class="modal fade" id="adddecoration" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>ปักเพิ่มเติม</h5>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="decoration_type">ประเภทปัก:</label>
                            <input type="text" name="decoration_type" id="decoration_type">
                        </div>

                        <div class="form-group">
                            <label for="decoration_type_description">รายละเอียด</label><br>
                            <input type="text" name="decoration_type_description" id="decoration_type_description">
                        </div>

                        <div class="form-group">
                            <label for="decoration_price">ราคา:</label>
                            <input type="number" name="decoration_price" id="decoration_price">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-danger">ยืนยัน</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- modalเพิ่มค่าใช้จ่าย --}}
    <form action="{{ route('addcost') }}" method="POST">
        @csrf
        <div class="modal fade" id="addcost" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        บันทึกค่าใช้จ่าย
                    </div>

                    <div class="modal-body">
                        <div id="ariacost">

                            {{-- </div> --}}
                            {{-- แสดงช่องinputสำหรับเพิ่มค่าใช้จ่าย --}}
                            <button type="button" class="btn btn-secondary" id="add_for_cost">+เพิ่มค่าใช้จ่าย</button>

                            <div class="form-group">
                                <label for="cost_type1">ประเภทค่าใช้จ่าย</label>
                                <input type="text" name="cost_type_[1]" id="cost_type1">
                            </div>

                            <div class="form-group">
                                <label for="cost_value1">ราคา</label>
                                <input type="number" name="cost_value_[1]" id="cost_value1">
                            </div>

                            <input type="hidden" name="id_of_detail" id="id_of_detail" value="{{ $rentdetail->id }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-secondary">บันทึก</button>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <script>
        var addcost = document.getElementById('add_for_cost') //เพิ่มบันทึกค่าใช้จ่าย
        var ariashow = document.getElementById('ariacost') // พื้นที่แสดงช่องinput
        var count = 1;

        addcost.addEventListener('click', function() {
            count++;

            var creatediv = document.createElement('div'); //สร้างdiv 
            creatediv.id = 'cost' + count;

            input =

                '<div class="form-group">' +
                ' <label for="cost_type' + count + '">ประเภทค่าใช้จ่าย</label>' +
                ' <input type="text" name="cost_type_[' + count + ']" id="cost_type' + count + '">' +
                '</div>' +

                '<div class="form-group">' +
                '<label for="cost_value' + count + '">ราคา</label>' +
                '<input type="number" name="cost_value_[' + count + ']" id="cost_value' + count + '">' +
                '</div>' +


                '<button type="button" class="btn btn-danger" onclick="removefitting(' + count + ')">ลบ</button>';

            creatediv.innerHTML = input;
            ariashow.appendChild(creatediv);
        });

        function removefitting(index) {
            var deleteID = document.getElementById('cost' + index)
            deleteID.remove();
        }
    </script>















    {{-- <form action="" method="POST">
        @csrf
        <div class="modal fade" id="confirmModaltwo">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">ปักเพิ่ม</h5>
                    </div>

                    <div class="modal-body" id="areafitting">
                        <div class="form-group">
                            <label for="decoration_type">ประเภทปัก:</label>
                            <input type="string" name="decoration_type" id="decoration_type">
                        </div>

                        <div class="form-group">
                            <label for="decoration_description">รายละเอียด</label><br>
                            <textarea class="form-control" name="decoration_description" id="decoration_description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="decoration_price">ราคา:</label>
                            <input type="number" name="decoration_price" id="decoration_price">
                        </div>
                        <div class="modal-footer">                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>

                            <button type="submit" class="btn btn-danger">ยืนยัน</button>
                        </div>
                    </div>
                </div>
            </div>
    </form> --}}
@endsection
