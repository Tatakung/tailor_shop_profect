@extends('layouts.employee')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 bg-light border border-gray-500">
                <h1>กรอบบน</h1>
                <div class="row">
                    <div class="col-md-6">
                        <p class="users-details">Dress ID: {{ $rentdetail->dress_id }}</p>
                        @php
                            $date = $dates->sortByDesc('id')->first();
                        @endphp
                        <p>วันที่นัดรับชุด : {{ $date->pickup_date }} ล่าสุด</p>
                        <p>วันที่นัดคืนชุด : {{ $date->return_date }} ล่าสุด</p>


                        ทดสอบค่าที่ส่งมา -> : {{ $valuestatus }}
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
                    <p>วันที่นัดรับชุด : {{ $date->pickup_date }} ||||| วันที่นัดคืนชุด : {{ $date->return_date }}</p>
                @endforeach
                {{-- ปุ่มแก้ไขวันที่ --}}
                <div style="display: block">
                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                    data-target="#showeditdate" id="showeditdateid">แก้ไขวันที่</button>
                </div>

                {{-- modal แสดง ตอนที่กดแก้ไขวันที่นัดรับชุดและนัดคืนชุด --}}
                <div class="modal fade" id="showeditdate" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                แก้ไขวันที่ (นัดรับชุด) / (นัดคืนชุด)
                            </div>
                            <form action="{{ route('adddate') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <label for="pickup_date">วันที่นัดรับชุด</label>
                                    <input type="date" name="pickup_date" id="pickup_date"
                                        max="<?= date('Y-m-d', strtotime('+30 days')) ?>"
                                        value="{{ $dates->sortByDesc('id')->first()->pickup_date }}">

                                    <label for="return_date">วันที่นัดคืนชุด</label>
                                    <input type="date" name="return_date" id="return_date"
                                        value="{{ $dates->sortByDesc('id')->first()->return_date }}">

                                    <input type="hidden" name="order_id_id" id="order_id_id"
                                        value="{{ $rentdetail->id }}">

                                    <br>
                                    <label for="late_charge">Late Charge หรือ ค่าบริการขยายเวลาเช่าชุด :</label> <br>
                                    <input type="text" id="late_charge" name="late_charge" readonly>
                                    **หมายเหตุ กรณีเช่าชุด วันที่นัดรับชุด - วันที่นัดคืนชุด ทางร้านอนุญาตให้เช่าชุดสูงสุด 5
                                    วัน
                                    หากเกินกำหนดจะคิดค่าบริการขยายเวลาเช่าชุด 100 / วัน


                                    <script>
                                        var pickupDateInput = document.getElementById('pickup_date'); //นัดรับชุด
                                        var returnDateInput = document.getElementById('return_date'); //นัดคืนชุด
                                        var lateChargeInput = document.getElementById('late_charge'); //late_charge

                                        var originalPickupDateValue = pickupDateInput.value; // เก็บค่า value เดิม

                                        function updateLateCharge() {
                                            var pickupDate = new Date(pickupDateInput.value);
                                            var returnDate = new Date(returnDateInput.value);

                                            if (returnDate < pickupDate) {
                                                pickupDateInput.value = originalPickupDateValue; // รีเซ็ตค่าเป็นค่าเดิม
                                                pickupDateInput.value = '{{ $dates->sortByDesc('id')->first()->pickup_date }}'; // Reset pickup date
                                                returnDateInput.value = ''; // Reset return date
                                                lateChargeInput.value = '';
                                                return;
                                            }

                                            var timeDiff = returnDate.getTime() - pickupDate.getTime();
                                            var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                                            if (daysDiff > 5) {
                                                var lateCharge = (daysDiff - 5) * 100;
                                            } else {
                                                var lateCharge = 0;
                                            }

                                            lateChargeInput.value = lateCharge;
                                        }

                                        returnDateInput.addEventListener('change', updateLateCharge);
                                        pickupDateInput.addEventListener('change', updateLateCharge);
                                    </script>

                                    <script>
                                        document.getElementById('pickup_date').addEventListener('input', function() {
                                            var pickupDate = new Date(this.value);
                                            var returnDateInput = document.getElementById('return_date');
                                            returnDateInput.min = pickupDate.toISOString().split('T')[0];
                                            updateLateCharge(); // เรียกใหม่เมื่อมีการเปลี่ยนแปลงในวันที่นัดรับชุด
                                        });
                                    </script>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-secondary">ยืนยัน</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>














            </div>
            <div class="col-md-6 bg-light border border-gray-500">
                {{-- <h1>กรอบขวา</h1> --}}
                <h3>นัดลองชุด</h3>
                <div style="display: block;">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" id="showfittingid">เพิ่มวันนัดลองชุด</button>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>วันที่นัด</th>
                            <th>สถานะ</th>
                            <th>โน๊ต</th>
                            <th>ราคา(บาท)</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finttings as $fitting)
                            <tr>
                                <td>{{ $fitting->id }}</td>
                                <td>{{ $fitting->fitting_date }}</td>
                                <td>{{ $fitting->fitting_status }}</td>
                                <td>{{ $fitting->fitting_note }}</td>
                                <td>{{ $fitting->fitting_price }}</td>
                                <td>
                                    {{-- ปุ่มแก้ไข --}}
                                    <button data-toggle="modal" data-target="#showeditmodalfitting{{ $fitting->id }}">
                                        <img src="{{ asset('images/edit.png') }}" alt="" width="20"
                                            height="20">
                                    </button>
                                    {{-- ปุ่มลบ --}}
                                    <button type="button" data-toggle="modal"
                                        data-target="#showmodaldeletefitting{{ $fitting->id }}">
                                        <img src="{{ asset('images/icondelete.jpg') }}" alt="" width="20"
                                            height="20">
                                    </button>
                                    @if (session('notdelete'))
                                        <div class="alert alert-success">
                                            {{ session('notdelete') }}
                                        </div>
                                    @endif
                                </td>

                                {{-- modalแก้ไข fitting --}}
                                <div class="modal fade" id="showeditmodalfitting{{ $fitting->id }}" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                จะแก้ไขวันนัดลองชุดหรอ?
                                            </div>
                                            <form action="{{ route('updatefitting', ['id' => $fitting->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <label for="fitting_note">โน๊ตบันทึก</label>
                                                    <textarea name="fitting_note" id="fitting_note" cols="10" rows="2">{{ $fitting->fitting_note }}</textarea>

                                                    <label for="fitting_price">ราคา</label>
                                                    <input type="number" name="fitting_price" id="fitting_price"
                                                        value="{{ $fitting->fitting_price }}">

                                                    <label for="fitting_status">สถานะ</label>
                                                    <select name="fitting_status" id="fitting_status">
                                                        <option value="ยังไม่ลองชุด"> ยังไม่ลองชุด</option>
                                                        <option value="มาลองชุดแล้ว">มาลองชุดแล้ว</option>


                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">ยกเลิก</button>
                                                    <button type="submit" class="btn btn-secondary">อัพเดต</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- modalลบ fitting --}}
                                <div class="modal fade" id="showmodaldeletefitting{{ $fitting->id }}" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                จะลบนัดชุดจริงหรอ
                                            </div>
                                            <form action="{{ route('deletefitting', ['id' => $fitting->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    วันที่นัด :{{ $fitting->fitting_date }} <br>
                                                    สถานะ :{{ $fitting->fitting_status }} <br>
                                                    ราคา :{{ $fitting->fitting_price }} บาท <br>
                                                    โน๊ต : {{ $fitting->fitting_note }} <br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">ยกเลิก</button>
                                                    <button type="submit" class="btn btn-secondary">ยืนยัน</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 bg-light border border-gray-500">
            {{-- <h1>กรอบซ้าย</h1> --}}
            <h3>สถานะของออเดอร์123</h3>
            @foreach ($orderdetailstatuses as $detailstatus)
                <p>วันที่ทำรายการ : {{ $detailstatus->created_at }} สถานะ : {{ $detailstatus->status }}</p>
            @endforeach
            <div style="display: block">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#showpickup"
                id="showpickupid">ยืนยันมารับชุด</button>
            </div>

            <div style="display: block">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#showreturn"
                id="showreturnid">ยืนยันคืนชุด</button>
            </div>

            {{-- modal ยืนยันคืนชุด --}}
            <div class="modal fade" id="showreturn" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            ยืนยันการคืนชุด
                        </div>
                        <div class="modal-body">
                            <label for="">ราคาประกัน</label>
                            <input type="number" name="" id="">
                        
                            <br>
                            <label for="">เหตุผล</label>
                            <input type="text" placeholder="เหตุผลในการหัก">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-secondary">ยืนยัน</button>
                        </div>
                    </div>

                </div>
            </div>









            {{-- modalอัพเดตสถานะ --}}
            <div class="modal fade" id="showpickup" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                        <form action="{{ route('updateorderstatus', ['id' => $rentdetail->id]) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                คุณจะอัพเดตสถานะหรอ
                            </div>
                            <div class="modal-body">
                                จองชุด--->กำลังเช่า--->คืนชุดแล้ว
                                <input type="hidden" name="order_detail_id" id="order_detail_id"
                                    value="{{ $rentdetail->id }}">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                <button type="submit" class="btn btn-secondary">อัพเดต</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        {{-- รอให้หน้าเว็บโหลดเสร็จ --}}
        {{-- ส่วนบล็อคปุ่มต่างๆ ไม่ให้มันกดได้  --}}
        <script>
            document.addEventListener('DOMContentLoaded',function(){
                var Status_orderdetail = "{{$valuestatus}}" ;  //รับค่าล่าสุดมา
                var showpickupid = document.getElementById('showpickupid'); //ปุ่มยืนยันการมารับชุด
                var showreturnid = document.getElementById('showreturnid'); //ปุ่มยืนยันคืนชุด
                var showfittingid = document.getElementById('showfittingid') ; //ปุ่มเพิ่มวันนัดลองชุด
                var showdecorationid = document.getElementById('showdecorationid'); //ปุ่มปักเพิ่ม
                var showaddimageid = document.getElementById('showaddimageid') ; //เพิ่มเพิ่มรูปภาพ
                var showeditdateid = document.getElementById('showeditdateid') ; //แก้ไขวันที่

                if(Status_orderdetail === "จองชุด"){
                    showreturnid.style.display = "none" ; 
                }
                if(Status_orderdetail === "กำลังเช่า"){
                    showpickupid.style.display = "none"
                    showreturnid.style.display = "block";
                    showfittingid.style.display = "none" ; 
                    showdecorationid.style.display = "none";
                    showaddimageid.style.display = "none";
                    showeditdateid.style.display = "none" ; 
                }
            });
        </script>





        <div class="col-md-6 bg-light border border-gray-500">
            {{-- <h1>กรอบขวา</h1> --}}
            <h3>เพิ่มเติมกรณีปักดอกไม้เพิ่ม</h3>
            <div style="display: block">
                <button type="button" class="btn btn-secondary" data-toggle="modal"
                data-target="#adddecoration" id="showdecorationid">+ปักเพิ่ม</button>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>ไอดี</th>
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
                            <td>{{ $decoration->id }}</td>
                            <td>{{ $decoration->created_at }}</td>
                            <td>{{ $decoration->decoration_type }}</td>
                            <td>{{ $decoration->decoration_type_description }}</td>
                            <td>{{ $decoration->decoration_price }}</td>
                            <td>


                                {{-- ปุ่มแก้ไขdecoration --}}
                                <button type="button" data-toggle="modal"
                                    data-target="#showeditmodaldecoration{{ $decoration->id }}">
                                    <img src="{{ asset('images/edit.png') }}" alt="" width="20"
                                        height="20">
                                </button>

                                {{-- ปุ่มลบ --}}
                                <button type="button" data-toggle="modal"
                                    data-target="#showconfirmdeletedecoration{{ $decoration->id }}">
                                    <img src="{{ asset('images/icondelete.jpg') }}" alt="" width="20"
                                        height="20">
                                </button>
                                {{-- modalของลบ --}}
                                <div class="modal fade" id="showconfirmdeletedecoration{{ $decoration->id }}"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                จะลบจริงๆหรอ
                                            </div>
                                            <form action="{{ route('deletedecoration', ['id' => $decoration->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    ยืนยันใช่ไหมว่าจะลบอะ
                                                    {{ $decoration->id }} <br>
                                                    {{ $decoration->decoration_type }} <br>
                                                    {{ $decoration->decoration_price }} <br>
                                                    {{ $decoration->decoration_type_description }} <br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">ยกเลิก</button>
                                                    <button type="submit" class="btn btn-secondary">ยืนยัน</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- modalแก้ไขของ decoration --}}
                                <div class="modal fade" id="showeditmodaldecoration{{ $decoration->id }}" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                แก้ไขdecoration
                                            </div>
                                            <form action="{{ route('updatedecoration', ['id' => $decoration->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <label for="decoration_type">ประเภท</label>
                                                    <input type="text" name="decoration_type" id="decoration_type"
                                                        value="{{ $decoration->decoration_type }}">
                                                    <br>
                                                    <label for="decoration_price">ราคา</label>
                                                    <input type="number" name="decoration_price" id="decoration_price"
                                                        value="{{ $decoration->decoration_price }}">
                                                    <br>
                                                    <label for="decoration_type_description">รายละเอียด</label>
                                                    <textarea name="decoration_type_description" id="decoration_type_description" cols="10" rows="2">{{ $decoration->decoration_type_description }}</textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">ยกเลิก</button>
                                                    <button class="btn btn-secondary" type="submit">อัพเดต</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

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
            <p><a href="{{ route('manageimage', ['id' => $rentdetail->id]) }}">จัดการรูปภาพ</a></p>
            @foreach ($imagerents as $imagerent)
                <img src="{{ asset('storage/' . $imagerent->image) }}" alt="123" style="width:90px; height: 90px;">
            @endforeach
            <div style="display: block">
                <button class="btn btn-secondary" style="width:90px; height: 90px;" data-toggle="modal"
                data-target="#showaddimahe" id="showaddimageid">เพิ่มรูปภาพ</button>

            </div>
        </div>


        {{-- เพิ่มรูปภาพ  --}}
        <form action="{{ route('addimage') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="showaddimahe" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            เพิ่มรูปภาพ
                        </div>
                        <div class="modal-body">
                            <label for="addimage">เพิ่มรูปภาพ</label>
                            <input class="form-control" type="file" id="addimage" name="addimage">
                            <input type="hidden" name="orderdetail_id" id="orderdetail_id"
                                value="{{ $rentdetail->id }}">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-secondary">ยืนยัน</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>



        <div class="col-md-6 bg-light border border-gray-500">
            <h3>ค่าใช้จ่าย</h3>
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addcost"
                id="clickaddcost">บันทึกค่าใช้จ่าย</button>

            <table class="table">
                <thead>
                    <tr>
                        <th>ไอดี</th>
                        <th>วันที่เพิ่ม</th>
                        <th>ประเภทค่าใช้จ่าย</th>
                        <th>ต้นทุน</th>
                        <th>action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($costs as $cost)
                        <tr>
                            <td>{{ $cost->id }}</td>
                            <td>{{ $cost->created_at }}</td>
                            <td>{{ $cost->cost_type }}</td>
                            <td>{{ $cost->cost_value }}</td>
                            <td>
                                {{-- ปุ่มแก้ไข --}}
                                <button type="button" data-toggle="modal" data-target="#costedit{{ $cost->id }}">
                                    <img src="{{ asset('images/edit.png') }}" alt="" width="20"
                                        height="20">
                                </button>

                                {{-- ปุ่มลบ --}}
                                <button type="button" data-toggle="modal"
                                    data-target="#showconfirmdeletecost{{ $cost->id }}">
                                    <img src="{{ asset('images/icondelete.jpg') }}" alt="" width="20"
                                        height="20">
                                </button>


                                <div class="modal fade" id="showconfirmdeletecost{{ $cost->id }}" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                ยืนยันการลบ
                                            </div>
                                            <form action="{{ route('deletecost', ['id' => $cost->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    แน่ใจว่าจะจบ
                                                    {{ $cost->cost_type }}
                                                    <br>
                                                    {{ $cost->cost_value }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">ยกเลิก</button>
                                                    <button type="submit" class="btn btn-secondary">ยืนยัน</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade" id="costedit{{ $cost->id }}" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                แก้ไขค่าใช้จ่ายหรอ
                                            </div>
                                            <form action="{{ route('updatecost', ['id' => $cost->id]) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    ไอดี : {{ $cost->id }}
                                                    <br>
                                                    วันที่เพิ่มรายการ: {{ $cost->created_at }}
                                                    <br>
                                                    {{-- ประเภทค่าใช้จ่าย :{{ $cost->cost_type }} --}}
                                                    <label for="cost_type">แก้ไขประเภทค่าใช้จ่าย</label>
                                                    <input type="text" name="cost_type" id="cost_type"
                                                        value="{{ $cost->cost_type }}">
                                                    <br>
                                                    {{-- ราคาต้นทุน :{{ $cost->cost_value }} --}}
                                                    <label for="cost_value">แก้ไขราคา</label>
                                                    <input type="number" name="cost_value" id="cost_value"
                                                        value="{{ $cost->cost_value }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                                    <button type="submit" class="btn btn-secondary">อัพเดต</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
@endsection
