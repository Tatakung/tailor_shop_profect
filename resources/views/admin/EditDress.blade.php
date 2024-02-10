<style>
    .accessory-details {
        margin-bottom: 20px;
        font-size: 15px;
        margin-left: 30px;
    }

    #image-container {
        flex-shrink: 0;
        margin-right: 20px;
        margin-top: 20px;
    }

    #form-container {
        display: flex;
        flex-direction: column; /* จัดวางแนวตั้ง */
        max-width: 400px; /* ปรับขนาดเพื่อให้ไม่ขยับไปทางขวาเกินไป */
    }

    #form-container label {
        margin-bottom: 10px;
    }

    #form-container input,
    #form-container textarea,
    #form-container button {
        margin-bottom: 15px;
    }

    #price{
        margin-left: 30px;
        font-size: 15px;
        width: 100 px; /* ปรับความกว้างของ input ตามที่ต้องการ */

    }

    #image{
        margin-left: 30px;
        font-size: 15px;
    }
    #tt{
        margin-left: 30px;
        font-size: 15px;
    }
    #description{
        margin-left: 30px;
        font-size: 15px;
    }
    #size{
        margin-left: 30px;
        font-size: 15px;
    }
    #accessory_description {
    margin-left: 30px;
    font-size: 15px;
    width: 300px; /* ปรับความกว้างของ textarea ตามที่ต้องการ */
    height: 100px; /* ปรับความยาวของ textarea ตามที่ต้องการ */

}
    #sm {
        margin-left: 30px;
        margin-top: px;
    }
    #price_input {
        width: 80px; /* ปรับความกว้างของ textarea ตามที่ต้องการ */
        height: 25px; /* ปรับความยาวของ textarea ตามที่ต้องการ */
    }
    #size_input {
        width: 80px; /* ปรับความกว้างของ textarea ตามที่ต้องการ */
        height: 25px; /* ปรับความยาวของ textarea ตามที่ต้องการ */
    }

    #description_input {
        margin-left: 30px;
        font-size: 15px;
        width: 300px; /* ปรับความกว้างของ textarea ตามที่ต้องการ */
        height: 100px; /* ปรับความยาวของ textarea ตามที่ต้องการ */

    }
    #status {
        margin-left: 30px;
        width: 80px; /* ปรับความกว้างของ textarea ตามที่ต้องการ */
        height: 25px; /* ปรับความยาวของ textarea ตามที่ต้องการ */
    }
    #status_input
    {
        font-size: 15px;
    }
</style>

@extends('layouts.admin')

@section('content')
<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-center py-4">แก้ไขชุด</h2>

        <div class="d-flex align-items-start">
            <div id="image-container">
                <img src="{{ asset('storage/' . $getdata->dress->dress_image) }}" alt="Dress Image" style="width: 300px; height: 300px;">
            </div>
            <div class="mt-4" id="form-container">

                
                @if(session('sizeupdate'))
                <div class="alert alert-success">
                    {{session('sizeupdate')}}
                </div>
                @endif




                <p class="accessory-details">รหัสชุด: <strong>{{ $getdata->dress->dress_code }}</strong></p>
                <p class="accessory-details">ประเภทชุด:<strong>{{ $getdata->dress->dress_type }}</strong></p>
                <p class="accessory-details">ไซส์:<strong>{{ $getdata->size_name }}</strong></p>
                <p class="accessory-details">จำนวน:<strong>{{ $getdata->amount }} ชุด</strong></p>

                <form action="{{ route('admin.updateDress', ['id' => $getdata->id])}}" method="post" enctype="multipart/form-data">
                    @csrf


                    <label for="accessory_price" id="price">ราคาต่อชุด:</label>
                    <input type="number" name="price" value="{{ $getdata->price }}" id="price_input" required>



                    <br>

                    @if(session('Overdeposit'))
                <div class="alert alert-success">
                    {{session('Overdeposit')}}
                </div>
                @endif

                    <label for="accessory_deposit" id="price">ราคามัดจำ:</label>
                    <input type="number" name="deposit" value="{{ $getdata->deposit }}" id="deposit_input" required>
 
                    

<br>

                    <label for="accessory_price" id="description">คำอธิบาย:</label>
                    <textarea name="description" id="description_input">{{ $getdata->dress->dress_description }}</textarea>
                    <br>

                    <label for="accessory_image" id="image">รูปภาพ:</label>
                    <input type="file" name="image" id="tt">


                                        <!--เพิ่ม/ลบจำนวนชุด-->
                    <div>
                    <label for="amount" id="amount">เพิ่ม/ลบจำนวนชุด</label>
                    <select name="action_type" id="action_type">
                        <option value="" selected>เลือก</option>
                        <option value="add">เพิ่มจำนวน</option>
                        <option value="remove">ลบจำนวน</option>
                    </select>
                </div>

                @if(session('amountover'))
                <div class="alert alert-success">
                    {{session('amountover')}}
                </div>
                @endif
                
                
                    <label for="quantity">จำนวนที่ต้องการ</label>
                    <input type="number" name="quantity" id="quantity" disabled>
                    


                    <script>
                        selecttype = document.getElementById('action_type');  //เลือกปกติ
                        quantityinput = document.getElementById('quantity'); //ช่องกรอกข้อมูลนะ
                        selecttype.addEventListener('change',function(){
                            if(selecttype.value === "add" || selecttype.value === "remove"  ){
                                quantityinput.removeAttribute('disabled');
                            }
                            else{
                                quantityinput.setAttribute('disabled','disabled');
                            }

                        });
                    </script>
                    
                    <button type="submit" class="btn btn-primary "id="sm">บันทึก</button>
                </form>
            </div>
        </div>
    </div>
</div>


<h2>ประวัติการแก้ไข</h2>
<table class="table">
    <thead>
        <tr>
            <th>size_id</th>
            <th>วันที่แก้ไข</th>
            <th>รายการแก้ไข</th>
            <th>ค่าใหม่</th>
            <th>ค่าเดิม</th>
                                 

              </tr>
    </thead>

    @foreach ($dreshowhistory as $dsh)
    @if($getdata->id == $dsh->size_id)
        <tr>
            <td>{{ $dsh->size_id }}</td>
            <td>{{ $dsh->created_at }}</td>
            <td>{{ $dsh->action }}</td>
            <td>{{$dsh->new_amount}}</td>
            <td>{{$dsh->old_amount}}</td>
        </tr>
    @endif
@endforeach
            </table>






@endsection