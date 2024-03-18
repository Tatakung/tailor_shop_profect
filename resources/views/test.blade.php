@extends('layouts.employee')
@section('content')
    <label for="type">ประเภทชุด</label>
    <select name="seletetype" id="seletetype">
        <option value="" selected disabled>เลือกประเภทชุด</option>
        @foreach ($gettype as $gettype)
            <option value="{{ $gettype }}">{{ $gettype }}</option>
        @endforeach
    </select>


    <div>
        <label for="code">แบบชุด</label>
        <select name="seletecode" id="seletecode"></select>
    </div>

    </select>


    {{-- ดึงแบบชุด --}}
    <script>
        var seleteType = document.getElementById('seletetype'); //เลือกประเภทชุด
        var showcode = document.getElementById('seletecode'); //แสดงแบบชุด
        seleteType.addEventListener('change', function() {
            fetch('getcode/' + seleteType.value)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    showcode.innerHTML = '<option value="">เลือกแบบชุด</option>';
                    data.forEach(getcode => {
                        showcode.innerHTML += '<option value="' + getcode + '">' + 'แบบที่ ' + getcode +
                            '</option>';
                    });
                });
        });
    </script>

    <label for="size">เลือกไซส์</label>
    <select name="selectsize" id="selectsize"></select>

    {{-- ดึงไซส์ --}}
    <script>
        var seleteType = document.getElementById('seletetype'); //เลือกประเภทชุด
        var selecycode = document.getElementById('seletecode'); //เลือกแบบชุด
        var showsize = document.getElementById('selectsize'); //แสดงไซา์ นะ 
        selecycode.addEventListener('change', function() {
            fetch('/getsize/' + seleteType.value + '/' + selecycode.value)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    showsize.innerHTML = '<option value="" selected disabled>กรุณาเลือกไซส์</option>';
                    data.forEach(getsize => {
                        showsize.innerHTML += '<option value=" ' + getsize + ' "> ' + getsize +
                            ' </option>'
                    });
                });
        });
    </script>
    <br>
    <label for="price">ราคาต่อชุด</label>
    <input type="number" name="price" id="price" readonly>

    <label for="deposit">ราคามัดจำ</label>
    <input type="number" name="deposit" id="deposit" readonly>


    <input type="number" name="id_for_size" id="id_for_size" >
    <input type="number" name="dress_id" id="dress_id">

    <p  id="amount_for_dress">จำนวนชุดที่มีในร้าน</p>



    <script>
        var seleteType = document.getElementById('seletetype'); //เลือกประเภทชุด
        var selecyCode = document.getElementById('seletecode'); //เลือกแบบชุด
        var selectSize = document.getElementById('selectsize'); //เลือกไซส์ 
        var showprice = document.getElementById('price') ; 
        var showdeposit = document.getElementById('deposit') ; 
        var id_for_size = document.getElementById('id_for_size') ; 
        var dress_id = document.getElementById('dress_id') ; 
        var amount_for_dress = document.getElementById('amount_for_dress') ; 
        selectsize.addEventListener('change',function(){
            fetch('/typeprice' + '/' + seleteType.value + '/' + selecyCode.value + '/' + selectSize.value)
            .then(response => response.json())
            .then(data => {
                console.log(data) ; 
                showprice.value = data.price ; 
                showdeposit.value = data.deposit ; 
                id_for_size.value = data.id ; 
                dress_id.value = data.dress_id ; 
                amount_for_dress.textContent = "จำนวนชุดที่มีในร้าน" + data.amount ; 
            }) ; 
        }) ; 

    </script>



<label for="pickupdate">วันที่นัดรับชุด</label>          
<input type="date" name="pickupdate" id="pickupdate" min="<?= date('Y-m-d')?>">

<label for="returndate">วันที่นัดคืนชุด</label>
<input type="date" name="returndate" id="returndate">
















@endsection
