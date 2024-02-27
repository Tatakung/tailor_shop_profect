@extends('layouts.employee') <!-- หรือเลือก layout ตามที่คุณได้กำหนด -->

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
                        <p class="users-details">สถานะการจ่ายเงิน: {{ $rentdetail->status_payment }}</p>
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
                @foreach ($finttings as $fitting)
                    <p>นัดลองชุด : {{ $fitting->fitting_date }}  สถานะ : {{ $fitting->fitting_status }}
                        โน๊ต:{{ $fitting->fitting_note }} ราคา: {{ $fitting->fitting_price }}บาท
                    </p>
                @endforeach
                <button type="button" class="btn btn-success" id="addfitting">+เพิ่มวันนัดลองชุด</button>
                <button type="button" class="btn btn-success" id="adddecoration">+ปัก</button>

            </div>
        </div>
    </div>

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
            @foreach ($decorations as $decoration)
                <p> {{ $decoration->created_at }} เพิ่ม: {{ $decoration->decoration_type }} รายละเอียด :
                    {{ $decoration->decoration_type_description }} ราคา : {{ $decoration->decoration_price }}</p>
            @endforeach
            {{-- <button type="button" class="btn btn-success" id="adddecoration">+ปักดอกไม้เพิ่ม</button> --}}
        </div>
    </div>



    <div class="row">
        <div class="col-md-6 bg-light border border-gray-500">
            {{-- <h1>กรอบซ้าย</h1> --}}
            <h3>รูปภาพชุดก่อนเช่า</h3>
            @foreach ($imagerents as $imagerent)
                <img src="{{ asset('storage/' . $imagerent->image) }}" alt="123" style="width:90px; height: 90px;">
            @endforeach
        </div>
        <div class="col-md-6 bg-light border border-gray-500">
            {{-- <h1>กรอบขวา</h1> --}}
            <h3>เพิ่มเติม</h3>
        </div>
    </div>




    {{-- กล่องยืนยัน (Confirmation Modal) --}}
    <form action="{{ route('addfitting', ['orderdetailid' => $rentdetail->id]) }}" method="POST">
        @csrf
        <div class="modal fade" id="confirmModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    {{-- ส่วนหัว --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">เพิ่มวันนัดลองชุด</h5>
                    </div>

                    {{-- ส่วนเนื้อหานะ --}}
                    <div class="modal-body" id="areafitting">
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

                        {{-- ส่วนท้าย --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-danger">ยืนยัน</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>






    <div class="modal fade" id="confirmModal2">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                {{-- ส่วนหัว --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel2">+ปักดอกไม้เพิ่ม</h5>
                </div>

                {{-- ส่วนเนื้อหานะ --}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="decorationtype">ประเภทดอกไม้:</label>
                        <select name="decorationtype" id="decorationtype">
                            <option value="">-- เลือกประเภทดอกไม้ --</option>
                            <option value="ดอกกุหลาบ">ดอกกุหลาบ</option>
                            <option value="ดอกกล้วยไม้">ดอกกล้วยไม้</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="decorationprice">ราคา:</label>
                        <input type="number" name="decorationprice" id="decorationprice">
                    </div>
                </div>

                {{-- ส่วนท้าย --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button id="confirmBtn2" type="button" class="btn btn-danger">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        // คลิกปุ่มและแสดงกล่องยืนยัน
        document.getElementById('addfitting').addEventListener('click', function() {
            $('#confirmModal').modal('show');
        });


        document.getElementById('adddecoration').addEventListener('click', function() {
            $('#confirmModal2').modal('show');
        });
    </script>
@endsection
