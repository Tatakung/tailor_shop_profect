
    {{-- <style>
        .accessory-details {
            margin-bottom: 20px;
            font-size: 15px;
            margin-left: 25px;
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
            margin-left: 28px;
            font-size: 15px;
            width: 40px; /* ปรับความกว้างของ input ตามที่ต้องการ */

        }

        #image{
            margin-left: 28px;
            font-size: 15px;
        }
        #tt{
            margin-left: 28px;
            font-size: 15px;
        }
        #des{
            margin-left: 28px;
            font-size: 15px;
        }
        #accessory_description {
        margin-left: 28px;
        font-size: 15px;
        width: 300px; /* ปรับความกว้างของ textarea ตามที่ต้องการ */
        height: 100px; /* ปรับความยาวของ textarea ตามที่ต้องการ */
    }
        #sm {
            margin-left: 30px;
        margin-top: -10px;
        }
        #price_input {
            width: 80px; /* ปรับความกว้างของ textarea ตามที่ต้องการ */
            height: 25px; /* ปรับความยาวของ textarea ตามที่ต้องการ */
        }

    </style> --}}
    
    @extends('layouts.admin')
    
    @section('content')
    <div class="container d-flex justify-content-start">
        <div class="table-responsive text-start" style="width: 100%;">
            <h2 class="text text-center py-4">แก้ไขเครื่องประดับ</h2>
    
            <div class="d-flex align-items-start">
                <div id="image-container">
                    <img src="{{asset('storage/' . $editaccessory->accessory_image)}}" alt="" style="width: 300px; height: 300px;">
                </div>
                <div class="mt-4" id="form-container">
                    <p class="accessory-details">รหัสเครื่องประดับ: <strong>{{ $editaccessory->accessory_code_new }}</strong> </p>
                    <p class="accessory-details">ประเภท:<strong>{{ $editaccessory->accessory_name }}</strong> </p>
                    <p class="accessory-details">จำนวน: <strong>{{ $editaccessory->accessory_count }}</strong> อัน </p>
    
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                    <form action="{{route('admin.updateAccessory',['id' => $editaccessory->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')


                        <label for="accessory_price" id="price">ราคา:</label>
                        <input type="number" name="accessory_price" value="{{ $editaccessory->accessory_price }}"id="price_input" required>
                        <br>
    
                        <label for="accessory_description" id="des">รายละเอียด:</label>
                        <textarea name="accessory_description" id="accessory_description" rows="4">{{ $editaccessory->accessory_description }}</textarea>

                        <br>
                        <label for="accessory_image" id="image">เพิ่มรูปภาพ:</label>
                        <input type="file" name="accessory_image" id="tt">


                        <br>

                        <label for="action_type">กรุณาเลือก:</label>
                        <select name="action_type" id="action_type">
                            <option value=""  selected>เลือก</option>
                            <option value="add">เพิ่มจำนวน</option>
                            <option value="remove">ลบจำนวน</option>
                        </select>
                        <br>

                        <label for="quantity">จำนวน:</label>
                        <input type="number" name="quantity" id="quantity">
                        <br>

                        <button type="submit" class="btn btn-primary "id="sm">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection