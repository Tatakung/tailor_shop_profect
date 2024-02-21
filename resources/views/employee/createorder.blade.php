@extends('layouts.admin') <!-- หรือเลือก layout ตามที่คุณได้กำหนด -->

@section('content')
    <div class="container">
        <h2>เพิ่มออเดอร์เช่าชุด</h2>
        <form method="post" action="{{ route('order.store') }}">
            @csrf


            <div class="form-group">
                <label for="customer_fname">ชื่อจริงลูกค้า</label>
                <input type="text"id="customer_fname" name="customer_fname">

                <label for="customer_lname">นามสกุลลูกค้า</label>
                <input type="text"id="customer_lname" name="customer_lname">

            </div>

            <div class="form-group">
                <label for="customer_phone">เบอร์ติดต่อ</label>
                <input type="text"id="customer_phone" name="customer_phone" >

                <label for="id_line">ID Line</label>
                <input type="text"id="id_line" name="id_line" >

            </div>


            <div class="form-group">
                <label for="type_dress">ประเภทชุด:</label>
                <select name="dress_type" id="dress_type" class="form-control">
                    <option value="">เลือกประเภทชุด</option>
                    @foreach ($get_dresstype as $get_dresstype)
                        <option value="{{ $get_dresstype }}">{{ $get_dresstype }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="dress_code" class="form-label">รหัสชุด</label>
                <select class="form-control" id="dress_code" name="dress_code">
                </select>
            </div>

            <div class="mb-3">
                <label for="dress_size" class="form-label">ไซส์</label>
                <select class="form-control" id="dress_size" name="dress_size">

                </select>
            </div>

            <!--ดึงรหัสชุด -->
            <script>
                var dressType = document.getElementById('dress_type'); //เลือกประเภทชุดเสด
                dressType.addEventListener('change', function() {
                    fetch('/getdresscode/' + dressType.value)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // ดูค่าที่ API คืนมาทั้งหมดใน console
                            var showcode = document.getElementById('dress_code'); //แสดงดรอปดาวรหัสชุด    

                            showcode.innerHTML = '<option value="" selected disabled>เลือกรหัสชุด</option>';
                            data.forEach(dressCode => {
                                showcode.innerHTML += '<option value="' + dressCode + '">' + dressCode +
                                    '</option>';
                            });
                        });
                });
            </script>

            <!--ดึงไซส์-->
            <script>
                var selecttype = document.getElementById('dress_type') //เลือกประเภทชุด
                var selectcode = document.getElementById('dress_code') //เลือกประเภทชุด 
                selectcode.addEventListener('change', function() {
                    fetch('/get/sizename/' + selecttype.value + '/' + selectcode.value)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // ดูค่าที่ API คืนมาทั้งหมดใน console

                            var showsizename = document.getElementById('dress_size'); //แสดงดรอปดาวไซส์นะ
                            showsizename.innerHTML = '<option value=""> เลือกไซส์ </option>';

                            data.forEach(sizename => {
                                showsizename.innerHTML += '<option value=" ' + sizename + ' "> ' + sizename +
                                    ' </option>';
                            });
                        });
                });
            </script>


            <!--ดึงจำนวนชุด-->
            <script>
                var selecttype = document.getElementById('dress_type'); //เลือกประเภทชุด
                var selectcode = document.getElementById('dress_code'); //เลือกรหัสชุด
                var selectsize = document.getElementById('dress_size'); //เลือกไซส์

                selectsize.addEventListener('change', function() {
                    fetch('/get/amount/' + selecttype.value + '/' + selectcode.value + '/' + selectsize.value)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // ดูค่าที่ API คืนมาทั้งหมดใน console
                            var showamount = document.getElementById('amountMessage'); //แสดงจำนวนชุดในร้าน
                            // showamount.textContent = 'จำนวนชุดที่มีในร้าน: ' + parseInt(data[0]);
                            showamount.textContent = 'จำนวนชุดที่มีในร้าน: ' + data[0] + ' ชุด';
                        });
                });
            </script>

            <p id="amountMessage" style="color: rgb(0, 76, 255)">จำนวนชุดที่มีในร้าน: (กรุณาเลือกชุด)</p>


            <div class="form-group">
                <label for="amount">จำนวนชุดที่ลูกค้าต้องการเช่า</label>
                <input type="number" name="amount" class="form-control"
                    placeholder="จำนวนชุดที่เช่าต้องไม่เกินจำนวนชุดในร้าน">
            </div>

            <p><img src="" alt="" id="imageshow" style="width:100px; height: 100px;"></p>

            <!--ส่วนแสดงรูปชุด-->
            <script>
                var selecttype = document.getElementById('dress_type')
                var selectcode = document.getElementById('dress_code')
                var selectsize = document.getElementById('dress_size')
                selectsize.addEventListener('change', function() {
                    fetch('/get/image/' + selecttype.value + '/' + selectcode.value)
                        .then(response => response.json())
                        .then(data => {
                            var imageshow = document.getElementById('imageshow');
                            imageshow.src = "{{ asset('storage/') }}" + '/' + data.getimage;
                        });
                });
            </script>

            <div class="form-group">
                <label for="price">ราคาต่อชุด</label>
                <input type="number"id="price" name="price" class="form-control" value="" readonly>
            </div>


            <div class="form-group">
                <label for="deposit">ราคามัดจำ</label>
                <input type="number" id="deposit" name="deposit" class="form-control" value="" readonly>
                **หมายเหตุ -ลูกค้าจะต้องจ่ายมัดจำหรือจ่ายเต็มจำนวนเท่านั้นพนักงานจึงจะสามารถบันทึกการเช่าให้ได้
            </div>


            <!--ดึงราคาทั้้งหมด/ราคามัดจำ-->
            <script>
                var selecttype = document.getElementById('dress_type') //เลือกประเภทชุด
                var selectcode = document.getElementById('dress_code') //เลือกรหัสชุด
                var selectsize = document.getElementById('dress_size') //เเลือกไซส์
                var showprice = document.getElementById('price') //แสดงราคาชุด
                var showdeposit = document.getElementById('deposit') //แสดงราคามัดจำ
                selectsize.addEventListener('change', function() {
                    fetch('/get/price/' + selecttype.value + '/' + selectcode.value + '/' + selectsize.value)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // ดูค่าที่ API คืนมาทั้งหมดใน console
                            showprice.value = data[0];
                        });
                });
                selectsize.addEventListener('change', function() {
                    fetch('/get/deposit/' + selecttype.value + '/' + selectcode.value + '/' + selectsize.value)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // ดูค่าที่ API คืนมาทั้งหมดใน console
                            showdeposit.value = data[0];
                        });
                });
            </script>

            <div class="form-group">
                <label for="damage_insurance">ประกันค่าเสียหาย</label>
                <input type="text" name="damage_insurance" class="form-control">
                **หมายเหตุ -ประกันค่าเสียหายจะคืนให้ลูกค้าหลังจากที่ลูกค้านำชุดมาคืน
            </div>
            <div class="form-group">


                <label for="transactionDate">วันที่ทำรายการ</label>
                <input type="text" id="transactionDate" readonly>

                <script>
                    // สร้างวัตถุ Date สำหรับดึงข้อมูลวันที่ปัจจุบัน
                    const currentDate = new Date();

                    // รับข้อมูลวันที่, เดือน, ปี
                    const day = currentDate.getDate();
                    const month = currentDate.getMonth() + 1; // เดือนเริ่มจาก 0 (มกราคม = 0)
                    const year = currentDate.getFullYear();

                    // กำหนดรูปแบบของวันที่ (dd/mm/yyyy)
                    const formattedDate = `${day}/${month}/${year}`;

                    // นำรูปแบบวันที่ไปแสดงใน input
                    document.getElementById('transactionDate').value = formattedDate;
                </script>




                <label for="real_pickup_date">วันที่นัดรับชุด:</label>
                <input type="date" name="pickup_date" id="pickup_date" required min="<?= date('Y-m-d') ?>"
                    max="<?= date('Y-m-d', strtotime('+30 days')) ?>">

                <label for="real_return_date">วันที่นัดคืนชุด:</label>
                <input type="date" name="return_date" id="return_date" required min="<?= date('Y-m-d') ?>">
            </div>

            <div class="form-group">
                <label for="late_charge">Late Charge หรือ ค่าบริการขยายเวลาเช่าชุด :</label>
                <input type="text" id="late_charge" name="late_charge" class="form-control" readonly>
                **หมายเหตุ กรณีเช่าชุด วันที่นัดรับชุด - วันที่นัดคืนชุด ทางร้านอนุญาตให้เช่าชุดสูงสุด 5 วัน
                หากเกินกำหนดจะคิดค่าบริการขยายเวลาเช่าชุด 100 / วัน
            </div>

            <script>
                var pickupDateInput = document.getElementById('pickup_date'); //นัดรับชุด
                var returnDateInput = document.getElementById('return_date'); //นัดคืนชุด
                var lateChargeInput = document.getElementById('late_charge'); //late_charge

                function updateLateCharge() {
                    var pickupDate = new Date(pickupDateInput.value);
                    var returnDate = new Date(returnDateInput.value);

                    // ตรวจสอบว่าวันที่นัดคืนชุดน้อยกว่าหรือเท่ากับวันที่นัดรับชุดหรือไม่
                    if (returnDate < pickupDate) {
                        alert('กรุณาเลือกวันที่นัดคืนชุดให้มากกว่าวันที่นัดรับชุด');
                        returnDateInput.value = ''; // ล้างค่าใน input วันที่นัดคืนชุด
                        return; // ไม่ทำขั้นตอนถัดไป
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


            <div class="form-group">
                <label>ประเภท:</label><br>
                <input type="radio" name="type_order" value="1" disabled> ตัดชุด
                <input type="radio" name="type_order" value="2" checked disabled> เช่าชุด
                <input type="radio" name="type_order" value="3" disabled> เช่าเครื่องประดับ
                <input type="radio" name="type_order" value="4" disabled> เช่าตัด
            </div>

            <div class="form-group">
                <label>ชำระเงิน:</label><br>
                <input type="radio" name="status_payment" value="1" checked> จ่ายมัดจำ
                <input type="radio" name="status_payment" value="2"> จ่ายเต็มจำนวน
            </div>

            <div class="form-group">
                <label>โน๊ต/หมายเหตุ:</label><br>
                <textarea class="form-control" id="note" name="note"></textarea>

            </div>


            <!-- เพิ่มปุ่ม "เพิ่มปักดอกไม้" -->
            <button type="button" id="addDecorationButton" class="btn btn-success">+เพิ่มปักดอกไม้</button>

            <!-- ส่วนที่จะเพิ่มช่องกรอกข้อมูลปักดอกไม้ -->
            <div id="additionalDecorations">
                <!-- ช่องกรอกข้อมูลปักดอกไม้จะถูกเพิ่มที่นี่ -->
            </div>


            <script>
                var add = document.getElementById('addDecorationButton'); //กดเพื่อปักดอกไม้เพิ่ม
                var ariashow = document.getElementById('additionalDecorations'); //พื้นที่สำหรับแสดงตอที่กด
                var counter = 0;

                add.addEventListener('click', function() {
                    counter++;
                    var creatediv = document.createElement('div'); //สร้างdiv มาขึ้นมาใหม่
                    creatediv.id = 'decoration' + counter;  // กำหนด id ให้มัน
                    var inputs = 
                    '<div class="form-group">' +
                        ' <label for="decoration_type ' + counter + '">ประเภทปักดอกไม้</label> ' +
                        ' <input type="text" name="decoration_type [' + counter + '] " id="decoration_type ' + counter + ' "> ' +
                    '</div>' +

                    ' <div class="form-group"> ' +
                        ' <label for="decoration_type_description ' + counter + ' ">รายละเอียดปักดอกไม้</label> ' +
                        ' <input type="text" name="decoration_type_description [' + counter + '] " id="decoration_type_description ' + counter + ' ">' +
                    '</div>' + 
// 
                    '<div class="form-group">' + 
                        ' <label for="decoration_price ' + counter + ' ">ราคาปักดอกไม้</label> ' +
                        ' <input type="number" name="decoration_price [' + counter + '] " id="decoration_price ' + counter + ' "> ' +
                    '</div>' +

                    '<button type="button" class="btn btn-danger" onclick="removeDecoration(' + counter +' )">ลบปักดอกไม้</button> '  
                    ;

                    creatediv.innerHTML = inputs ; // เอา ก้อนinputs ไปต่อในdiv ของ creatediv
                    ariashow.appendChild(creatediv); //เอาก้อนcreatediv ไปแทรกข้างในdiv ที่สร้างไว้ <!-- ช่องกรอกข้อมูลปักดอกไม้จะถูกเพิ่มที่นี่ -->
                });

                function removeDecoration(index){
                    var deletetodiv = document.getElementById('decoration' + index); //ลบตาม เลข div id 
                    deletetodiv.remove();
                }

            </script>

            <br>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
