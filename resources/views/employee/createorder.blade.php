@extends('layouts.employee') <!-- หรือเลือก layout ตามที่คุณได้กำหนด -->

@section('content')
    <div class="container">
        <h2>เพิ่มออเดอม</h2>
        <form method="post" action="{{ route('order.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="customer_fname">ชื่อจริงลูกค้า</label>
                <input type="text"id="customer_fname" name="customer_fname">

                <label for="customer_lname">นามสกุลลูกค้า</label>
                <input type="text"id="customer_lname" name="customer_lname">

            </div>

            <div class="form-group">
                <label for="customer_phone">เบอร์ติดต่อ</label>
                <input type="text"id="customer_phone" name="customer_phone">

                <label for="id_line">ID Line</label>
                <input type="text"id="id_line" name="id_line">

            </div>

            <div class="form-group">
                <button type="button" class="btn btn-secondary">+เพิ่มตัดชุด</button>
                <button type="button" class="btn btn-secondary">+เพิ่มเช่าชุด</button>
                <button type="button" class="btn btn-secondary">+เพิ่มเช่าเครื่องประดับ</button>
                <button type="button" class="btn btn-secondary">+เพิ่มเช่าตัด</button>
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
                <label for="dress_code" class="form-label">แบบชุด</label>
                <select class="form-control" id="dress_code" name="dress_code">
                </select>
            </div>

            <div class="mb-3">
                <label for="dress_size" class="form-label">ไซส์</label>
                <select class="form-control" id="dress_size" name="dress_size">
                </select>
            </div>

            <!--ดึงรหัสชุด(ถูกต้อง) -->
            <script>
                var dressType = document.getElementById('dress_type'); //เลือกประเภทชุดเสด
                dressType.addEventListener('change', function() {
                    fetch('/getdresscode/' + dressType.value)
                        .then(response => response.json())
                        .then(data => {
                            // console.log(data); // ดูค่าที่ API คืนมาทั้งหมดใน console
                            var showcode = document.getElementById('dress_code'); //แสดงดรอปดาวรหัสชุด    

                            showcode.innerHTML = '<option value="" selected disabled>เลือกรหัสชุด</option>';
                            data.forEach(dressCode => {
                                showcode.innerHTML += '<option value="' + dressCode + '">' + dressCode +
                                    '</option>';
                            });
                        });
                });
            </script>

            <!--ดึงไซส์ (ถูกต้อง)-->
            <script>
                var selecttype = document.getElementById('dress_type') //เลือกประเภทชุด
                var selectcode = document.getElementById('dress_code') //เลือกประเภทชุด 
                selectcode.addEventListener('change', function() {
                    fetch('/get/sizename/' + selecttype.value + '/' + selectcode.value)
                        .then(response => response.json())
                        .then(data => {
                            // console.log(data); // ดูค่าที่ API คืนมาทั้งหมดใน console

                            var showsizename = document.getElementById('dress_size'); //แสดงดรอปดาวไซส์นะ
                            showsizename.innerHTML = '<option value=""> เลือกไซส์ </option>';

                            data.forEach(sizename => {
                                showsizename.innerHTML += '<option value=" ' + sizename + ' "> ' + sizename +
                                    ' </option>';
                            });
                        });
                });
            </script>



            <p id="amountMessage" style="color: rgb(0, 76, 255)">จำนวนชุดที่มีในร้าน: (กรุณาเลือกชุด)</p>
            @if (session('Overamount'))
                <div class="alert alert-success">
                    {{ session('Overamount') }}
                </div>
            @endif

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

            {{-- จะเอาไว้ส่งค่า id และ dress_id นะ --}}
            <input type="hidden" name="id_of_size" id="id_of_size" value="">
            <input type="hidden" name="dress_ID" id="dress_ID" value="">


            <script>
                var selecttype = document.getElementById('dress_type'); //เลือกประเภทชุด
                var selectcode = document.getElementById('dress_code'); //เลือกรหัสชุด
                var Size = document.getElementById('dress_size'); //เเลือกไซส์
                var showprice = document.getElementById('price'); //แสดงราคาชุด
                var showdeposit = document.getElementById('deposit') //แสดงราคามัดจำ
                var hiddenidsize = document.getElementById('id_of_size');
                var hiddendressid = document.getElementById('dress_ID');
                var showamount = document.getElementById('amountMessage'); //แสดงจำนวนชุดในร้าน

                Size.addEventListener('change', function() {
                    if (Size.value === '') {
                        return;
                    }
                    console.log('ประเภทชุด:', selecttype.value); // Debug
                    console.log('รหัสชุด', selectcode.value);
                    console.log('ไซส์', Size.value)
                    fetch('/get/pricedeposit/' + selecttype.value + '/' + selectcode.value + '/' + Size.value)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // ดูค่าที่ API คืนมาทั้งหมดใน console
                            // showprice.value = data[0];
                            // showprice.value = data.price;
                            // showdeposit.value = data.deposit;

                            showprice.value = data.price;

                            showdeposit.value = data.deposit;
                            showamount.textContent = 'จำนวนชุดที่มีในร้าน: ' + data.amount + ' ชุด';
                            hiddenidsize.value = data.id;
                            hiddendressid.value = data.dress_id;
                            calculate(data.price);


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







                <label for="pickup_date">วันที่นัดรับชุด:</label>
                <input type="date" name="pickup_date" id="pickup_date" required min="<?= date('Y-m-d') ?>"
                    max="<?= date('Y-m-d', strtotime('+30 days')) ?>">

                <label for="return_date">วันที่นัดคืนชุด:</label>
                <input type="date" name="return_date" id="return_date" required min="<?= date('Y-m-d') ?>">
            </div>

            <div class="form-group">
                <label for="late_charge">Late Charge หรือ ค่าบริการขยายเวลาเช่าชุด :</label>
                <input type="text" id="late_charge" name="late_charge" class="form-control" readonly>
                **หมายเหตุ กรณีเช่าชุด วันที่นัดรับชุด - วันที่นัดคืนชุด ทางร้านอนุญาตให้เช่าชุดสูงสุด 5 วัน
                หากเกินกำหนดจะคิดค่าบริการขยายเวลาเช่าชุด 100 / วัน
            </div>

            <script>
                var pickupinput = document.getElementById('pickup_date') ;
                var returninput = document.getElementById('return_date') ; 
                var showlate_charge = document.getElementById('late_charge') ; 
                // var price = document.getElementById('price').value ; 
                // console.log(price)
                // console.log(price)

                function calculate(price){
                    console.log('ราคาที่ได้จาก API:', data.price);
                    var pickupvalue = new Date(pickupinput.value) ; 
                    var returnvalue = new Date(returninput.value) ; 

                    var time = returnvalue.getTime() - pickupvalue.getTime()  ; 
                    var day = Math.ceil(time / (24*60*60*1000))  ; 

                    if(day > 3 ) {
                        showlate_charge.value = (day-3) * (price*0.25)  ; 
                    }
                    else{
                        showlate_charge.value = 0 ; 
                    }
                }

                pickupinput.addEventListener('change',function(){
                    calculate() ; 
                    returninput.value = '' ; 
                    showlate_charge.value = null ; 
                }) ; 

                returninput.addEventListener('change',function(){
                    calculate() ; 
                }) ; 

                pickupinput.addEventListener('input',function(){
                    var input_of_pickup = new Date(pickupinput.value) ;
                    var returnvalue = document.getElementById('return_date') ; 
                    returnvalue.min = input_of_pickup.toISOString().split('T')[0]  ;

                }) ; 
            </script>



            <div class="form-group">
                <label>ประเภท:</label><br>
                <input type="radio" name="type_order" value="1" disabled> ตัดชุด
                <input type="radio" name="type_order" value="2" checked readonly> เช่าชุด
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

            <button type="button" id="addDecorationButton" class="btn btn-success">+เพิ่มปักดอกไม้</button>

            <button type="button" id="addimagerent" class="btn btn-success">+เพิ่มรูปภาพ</button>

            <button type="button" id="addfitting" class="btn btn-success">+เพิ่มวันนัดลองชุด</button>


            <!-- ส่วนที่จะเพิ่มช่องกรอกข้อมูลปักดอกไม้ -->
            <div id="additionalDecorations">
                <!-- ช่องกรอกข้อมูลปักดอกไม้จะถูกเพิ่มที่นี่ -->
            </div>

            <div id="areaimage">
                {{-- พื้นที่สำหรับแสดงสำหรับเพิ่มรูปชุดนะ --}}
            </div>

            <div id="areafitting">
                {{-- พื้นที่สำหรับเพิ่มวันที่นัดลองชุดนะ --}}
            </div>


            <script>
                var add = document.getElementById('addDecorationButton'); //กดเพื่อปักดอกไม้เพิ่ม
                var ariashow = document.getElementById('additionalDecorations'); //พื้นที่สำหรับแสดงตอที่กด
                var counter = 0;

                add.addEventListener('click', function() {
                    counter++;
                    var creatediv = document.createElement('div'); //สร้างdiv มาขึ้นมาใหม่
                    creatediv.id = 'decoration' + counter; // กำหนด id ให้มัน
                    var inputs =
                        '<div class="form-group">' +
                        counter + ' . ' +
                        ' <label for="decoration_type ' + counter + '">ประเภทปักดอกไม้</label> ' +
                        ' <input type="text" name="decoration_type_[' + counter + '] " id="decoration_type ' + counter +
                        ' "> ' +
                        '</div>' +

                        ' <div class="form-group"> ' +
                        counter + ' . ' +
                        ' <label for="decoration_type_description ' + counter + ' ">รายละเอียดปักดอกไม้</label> ' +
                        ' <input type="text" name="decoration_type_description_[' + counter +
                        '] " id="decoration_type_description ' + counter + ' ">' +
                        '</div>' +
                        // 
                        '<div class="form-group">' +
                        counter + ' . ' +
                        ' <label for="decoration_price ' + counter + ' ">ราคาปักดอกไม้</label> ' +
                        ' <input type="number" name="decoration_price_[' + counter + '] " id="decoration_price ' + counter +
                        ' "> ' +
                        '</div>' +

                        '<button type="button" class="btn btn-danger" onclick="removeDecoration(' + counter +
                        ' )">ลบปักดอกไม้</button> ';

                    creatediv.innerHTML = inputs; // เอา ก้อนinputs ไปต่อในdiv ของ creatediv
                    ariashow.appendChild(
                        creatediv
                    ); //เอาก้อนcreatediv ไปแทรกข้างในdiv ที่สร้างไว้ <!-- ช่องกรอกข้อมูลปักดอกไม้จะถูกเพิ่มที่นี่ -->
                });

                function removeDecoration(index) {
                    var deletetodiv = document.getElementById('decoration' + index); //ลบตาม เลข div id 
                    deletetodiv.remove();
                }
            </script>


            <script>
                var addimage = document.getElementById('addimagerent');

                var areaimage = document.getElementById('areaimage');

                var count = 0;

                addimage.addEventListener('click', function() {
                    count++;
                    var creatediv = document.createElement('div');
                    creatediv.id = 'imagerent' + count;


                    var label = document.createElement('label');
                    label.htmlFor = 'imagerent' + count;
                    label.innerHTML = 'เพิ่มจำนวนรูปชุด'

                    var input = document.createElement('input');
                    input.type = 'file';
                    input.className = 'form-control';
                    input.name = 'imagerent_[' + count + ']';
                    input.id = 'imagerent' + count;

                    var button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'btn btn-danger';
                    button.onclick = function() {
                        removeimage(count);
                    }
                    button.innerHTML = "ลบออก";


                    creatediv.appendChild(label);
                    creatediv.appendChild(input);
                    creatediv.appendChild(button);

                    areaimage.appendChild(creatediv);


                });

                function removeimage(index) {
                    var deleteID = document.getElementById('imagerent' + index);
                    deleteID.remove();
                }
            </script>











            <script>
                var addfitting = document.getElementById('addfitting'); //เพิ่มวันที่นัดลองชุด
                var areafitting = document.getElementById('areafitting') //พื้นที่สำหรับแสดงเพิ่มวันที่นัดชุด
                var count = 0;

                addfitting.addEventListener('click', function() {
                    count++;
                    var creatediv = document.createElement('div')
                    creatediv.id = "fitting" + count;
                    input =

                        '<div class="form-group">' +
                        count + ' . ' +
                        '<label for="fitting_date ' + count + ' " >วันนัดลองชุด:</label>' +
                        '<input type="date" name="fitting_date_[' + count + '] " id="fitting_date ' + count + ' ">' +
                        '</div>' +


                        '<div class="form-group">' +
                        '<label for="fitting_note ' + count + ' ">บันทึก:</label><br>' +
                        '<textarea class="form-control" name="fitting_note_[' + count + '] " id="fitting_note ' + count +
                        ' "></textarea>' +
                        '</div>' +

                        '<div class="form-group">' +
                        '<label for="fitting_price ' + count + ' " >ราคา:</label>' +
                        '<input type="number" name="fitting_price_[' + count + '] " id="fitting_price ' + count + ' ">' +
                        '</div>' +

                        '<button type="button" class="btn btn-danger" onclick="removefitting(' + count +
                        ' )">ลบปักดอกไม้</button> ';
                    creatediv.innerHTML = input;

                    areafitting.appendChild(creatediv);

                });

                function removefitting(index) {
                    var deleteid = document.getElementById('fitting' + index);
                    deleteid.remove();
                }
            </script>












            <br>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
