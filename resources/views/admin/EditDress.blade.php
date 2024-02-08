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

                <p class="accessory-details">รหัสชุด: <strong>{{ $getdata->dress->dress_code }}</strong></p>
                <p class="accessory-details">ประเภทชุด:<strong>{{ $getdata->dress->dress_type }}</strong></p>


                <form action="{{ route('admin.updateDress', ['id' => $getdata->id])}}" method="post" enctype="multipart/form-data">
                    @csrf


                    <label for="accessory_price" id="price">ราคาต่อชุด:</label>
                    <input type="number" name="price" value="{{ $getdata->price }}" id="price_input" required>


                    <label for="accessory_deposit" id="price">ราคามักจำต่อชุด:</label>
                    <input type="number" name="deposit" value="{{ $getdata->deposit }}" id="deposit_input" required>


                    <br>
                    <label for="accessory_size" id="size">ไซส์:</label>
                    <input type="text" name="size_name" value="{{ $getdata->size_name }}" id="size_input"  required>
<br>

                    <label for="accessory_price" id="description">คำอธิบาย:</label>
                    <textarea name="description" id="description_input">{{ $getdata->dress->dress_description }}</textarea>
                    <br>

                    <label for="accessory_image" id="image">รูปภาพ:</label>
                    <input type="file" name="image" id="tt">


                    <button type="submit" class="btn btn-primary "id="sm">บันทึก</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection