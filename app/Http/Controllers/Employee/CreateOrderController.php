<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Date;
use App\Models\Decoration;
use App\Models\Dress;
use App\Models\imagerent;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Orderdetailstatus;
use App\Models\Paymentstatus;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateOrderController extends Controller
{
    //
    public function formcreate()
    {
        $get_dresstype = Dress::distinct()->pluck('dress_type');
        return view('employee.createorder', compact('get_dresstype'));
    }


    //ดึงรหัสชุด
    public function getDressCodes($dressType)
    {
        $dressCode = Dress::where('dress_type', $dressType)->pluck('dress_code');
        return response()->json($dressCode); //ส่งค่ากลับแบบ json array
    }


    // ดึงไซส์ของชุดนะ 
    public function getsizename($selecttype, $selectcode)
    {
        $dressID = Dress::where('dress_type', $selecttype)
            ->where('dress_code', $selectcode)
            ->pluck('id');
        $sizename = Size::where('dress_id', $dressID)
            ->pluck('size_name');
        return response()->json($sizename);
    }

    //ดึงรูปชุด
    public function getimage($selecttype, $selectcode)
    {
        $getimage = Dress::where('dress_type', $selecttype)
            ->where('dress_code', $selectcode)
            ->pluck('dress_image');
        return response()->json(['getimage' => $getimage]);
    }

    //ดึงจำนวนชุดหลังจากที่มีการเลือกไซส์
    public function getamount($selecttype, $selectcode, $selectsize)
    {
        $dressID = Dress::where('dress_type', $selecttype)
            ->where('dress_code', $selectcode)
            ->value('id');
        $sizeID = Size::where('dress_id', $dressID)
            ->value('id');
        $getamount = Size::where('id', $sizeID)
            ->pluck('amount');
        return response()->json($getamount);
    }

    //ดึงราคา/มัดจำ
    // public function getprice($selecttype, $selectcode, $selectsize)
    // {
    //     $dressID = Dress::where('dress_type', $selecttype)
    //         ->where('dress_code', $selectcode)
    //         ->pluck('id');
    //     $sizeID = Size::where('dress_id', $dressID)
    //         ->where('size_name', $selectsize)
    //         ->pluck('id');
    //     $getprice = Size::where('id', $sizeID)
    //         ->select('price', 'id', 'dress_id', 'deposit')
    //         ->first();
    //     return response()->json($dressID);
    // }


    //ดึงราคา/มัดจำ
    public function getprice($selecttype, $selectcode, $selectsize)
    {
        $dressID = Dress::where('dress_type', $selecttype)
            ->where('dress_code', $selectcode)
            ->value('id');   //16
        $sizeID = Size::where('dress_id', $dressID)
            ->pluck('id');

        $getprice = Size::where('id', $dressID)
            ->select('price', 'id', 'dress_id', 'deposit')
            ->first();
        return response()->json(['price' => $getprice->price, 'id' => $getprice->id, 'dress_id' => $getprice->dress_id, 'deposit' => $getprice->deposit]);
    }


    // public function getprice($selecttype, $selectcode, $selectsize)
    // {
    //     $dressID = Dress::where('dress_type', $selecttype)
    //         ->where('dress_code', $selectcode)
    //         ->value('id');   //16
    //     $sizeID = Size::where('dress_id', $dressID)
    //         ->where('size_name',$selectsize)
    //         ->pluck('id');

    //     $getprice = Size::where('id', $sizeID)
    //         ->select('price', 'id', 'dress_id', 'deposit')
    //         ->first();
    //     return response()->json(['price' => $getprice->price, 'id' => $getprice->id, 'dress_id' => $getprice->dress_id, 'deposit' => $getprice->deposit]);
    // }







    public function store(Request $request)
    {
        $request->validate([
            'customer_fname' => 'required|string',
            'customer_lname' => 'required|string',
            'customer_phone' => 'required|string',
            'id_line' => 'nullable|string',
            'deposit' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        $customer = Customer::updateOrCreate(
            [
                'customer_fname' => $request->input('customer_fname'),
                'customer_lname' => $request->input('customer_lname'),
            ],
            [
                'customer_phone' => $request->input('customer_phone'),
                'id_line' => $request->input('id_line'),
            ]
        );

        //ออเดอรใหญ่/บิลล
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->customer_id = $customer->id;
        $order->total_price = $request->input('price');
        $order->total_deposit = $request->input('deposit');
        $order->save();

        //รายละเอียดออเดอร์
        $orderdetail = new Orderdetail;
        $orderdetail->dress_id = $request->input('dress_ID');
        $orderdetail->size_id = $request->input('id_of_size');
        $orderdetail->order_id = $order->id;
        $orderdetail->employee_id = Auth::user()->id;
        $orderdetail->late_charge = $request->input('late_charge');
        $orderdetail->type_dress = $request->input('dress_type');
        $orderdetail->type_order = $request->input('type_order');
        $orderdetail->amount = $request->input('amount');
        $orderdetail->price = $request->input('price');
        $orderdetail->deposit = $request->input('deposit');
        $orderdetail->note = $request->input('note');
        $orderdetail->damage_insurance = $request->input('damage_insurance');
        $orderdetail->total_damage_insurance = 0;
        $orderdetail->status_detail = "จองชุด"; //สถานะเริ่มแรก
        $orderdetail->status_payment = $request->input('status_payment');
        $orderdetail->late_fee = 0;
        $orderdetail->total_cost = 0;
        // $orderdetail->total_decoration_price = $request->input('total_decoration_price');
        // $orderdetail->total_fitting_price = $request->input('total_fitting_price');
        $orderdetail->save();


        //วันที่
        $date = new Date;
        $date->order_detail_id = $orderdetail->id;
        $date->pickup_date = $request->input('pickup_date');
        $date->return_date = $request->input('return_date');
        $date->save();

        //สถานะการชำระเงิน
        $paymentstatus = new Paymentstatus;
        $paymentstatus->order_detail_id = $orderdetail->id;
        $paymentstatus->payment_status = $request->input('status_payment');
        $paymentstatus->save();

        //สถานะของออเดอร์ดีเทล
        $orderdetailstatus = new Orderdetailstatus;
        $orderdetailstatus->order_detail_id = $orderdetail->id;
        $orderdetailstatus->status = "จองชุด";  //สถานะเริ่มแรก
        $orderdetailstatus->save();



        //เครื่องประดับ
        // //ตรวจสอบว่า ถ้ามีค่าที่ส่งมา
        if ($request->has('decoration_type_') && $request->has('decoration_type_description_') && $request->has('decoration_price_')) {
            $dec_type = $request->input('decoration_type_');
            $dec_description = $request->input('decoration_type_description_');
            $dec_price = $request->input('decoration_price_');
            foreach ($dec_type as $index => $dec_type) {
                $decoration = new Decoration;
                $decoration->order_detail_id = $orderdetail->id;
                $decoration->decoration_type = $dec_type;
                $decoration->decoration_type_description = $dec_description[$index];
                $decoration->decoration_price = $dec_price[$index];
                $decoration->save();
            }
        }

        if ($request->hasFile('imagerent_')) {
            $imgrent = $request->input('imagerent_');
            dd($imgrent); // เพิ่ม dd() เพื่อดูค่า $imgrent
            foreach ($imgrent as $index => $img) {
                $imagerent = new imagerent;
                $imagerent->order_detail_id = $orderdetail->id;
                $imagerent->image = $img->store('imagerent_images', 'public');
                $imagerent->save();
            }
        }


        // ตรวจสอบว่ามีรูปภาพ (เพิ่มเติม) ส่งมา
        // dd($request->hasFile('imagerent_')) ; 
        // if ($request->hasFile('imagerent_')) {

        //     // ดึงข้อมูลรูปภาพ (เพิ่มเติม)
        //     $images = $request->file('imagerent_');

        //     // วนลูปเพื่อบันทึกข้อมูลรูปภาพแต่ละรายการ
        //     foreach ($images as $index => $image) {
        //         $additionalImage = new imagerent;
        //         $additionalImage->order_detail_id = $orderdetail->id; // กำหนด ID ของรายละเอียดการสั่งซื้อ
        //         $additionalImage->image = $image->store('imagerent_images', 'public'); // บันทึกไฟล์รูปภาพและเก็บชื่อไฟล์
        //         $additionalImage->save(); // บันทึกข้อมูลลงฐานข้อมูล
        //     }
        // }






        return redirect()->back()->with('success', 'บันทึกข้อมูลลูกค้าและคำสั่งสำเร็จ');
    }










    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'customer_fname' => 'required|string',
    //         'customer_lname' => 'required|string',
    //         'customer_phone' => 'required|string',
    //         'id_line' => 'nullable|string',
    //         'deposit' => 'required|numeric',
    //         'price' => 'required|numeric',
    //     ]);

    //     $customerData = [
    //         'customer_fname' => $request->input('customer_fname'),
    //         'customer_lname' => $request->input('customer_lname'),
    //         'customer_phone' => $request->input('customer_phone'),
    //         'id_line' => $request->input('id_line'),
    //     ];

    //     // บันทึกข้อมูลในตาราง customer 
    //     $customer = Customer::create($customerData);

    //     //ตรวจสอบถ้าไม่่ซเำจะให้บันทึกใหม่ 
    //     $customer = Customer::updateOrCreate(
    //         [
    //             'customer_fname' => $customerData['customer_fname'],
    //             'customer_lname' => $customerData['customer_lname'],
    //         ],
    //         $customerData
    //     );

    //     $orderData = [
    //         'user_id' => Auth::user()->id, //ไอดีที่กำลังเข้าสู่ระบบ
    //         'total_deposit' => $request->input('deposit'),
    //         'total_price' => $request->input('price'),
    //     ];

    //     // ผูกคำสั่ง order กับลูกค้า
    //     $customer->orders()->create($orderData);

    //     // ส่งกลับไปยังหน้าที่แล้วพร้อมกับข้อความสำเร็จ
    //     return redirect()->back()->with('success', 'บันทึกข้อมูลลูกค้าและคำสั่งสำเร็จ');
    // }





    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'customer_fname' => 'required|string',
    //         'customer_lname' => 'required|string',
    //         'customer_phone' => 'required|string',
    //         'id_line' => 'nullable|string',
    //         'deposit' => 'required|numeric',
    //         'price' => 'required|numeric',
    //     ]);

    //     // บันทึกข้อมูลในตาราง customer 
    //     $customer = new Customer;
    //     $customer->customer_fname = $request->input('customer_fname');
    //     $customer->customer_lname = $request->input('customer_lname');
    //     $customer->customer_phone = $request->input('customer_phone');
    //     $customer->id_line = $request->input('id_line');
    //     $customer->save(); // บันทึกข้อมูลลูกค้าลงในฐานข้อมูล


    //     $order = new Order;
    //     $order->user_id = Auth::user()->id;
    //     $order->customer_id = $customer->id;
    //     $order->total_deposit = $request->input('deposit');
    //     $order->total_price = $request->input('price');
    //     $order->save();


    //     // ผูกคำสั่ง order กับลูกค้า

    //     // ส่งกลับไปยังหน้าที่แล้วพร้อมกับข้อความสำเร็จ
    //     return redirect()->back()->with('success', 'บันทึกข้อมูลลูกค้าและคำสั่งสำเร็จ');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'customer_fname' => 'required|string',
    //         'customer_lname' => 'required|string',
    //         'customer_phone' => 'required|string',
    //         'id_line' => 'nullable|string',
    //         'deposit' => 'required|numeric',
    //         'price' => 'required|numeric',
    //     ]);

    //     $customerData = [
    //         'customer_fname' => $request->input('customer_fname'),
    //         'customer_lname' => $request->input('customer_lname'),
    //         'customer_phone' => $request->input('customer_phone'),
    //         'id_line' => $request->input('id_line'),
    //     ];

    //     // บันทึกข้อมูลในตาราง customer 
    //     $customer = Customer::create($customerData);

    //     //ตรวจสอบถ้าไม่่ซเำจะให้บันทึกใหม่ 
    //     $customer = Customer::updateOrCreate(
    //         [
    //             'customer_fname' => $customerData['customer_fname'],
    //             'customer_lname' => $customerData['customer_lname'],
    //         ],
    //         $customerData
    //     );

    //     $orderData = [
    //         'user_id' => Auth::user()->id, //ไอดีที่กำลังเข้าสู่ระบบ
    //         'total_deposit' => $request->input('deposit'),
    //         'total_price' => $request->input('price'),
    //     ];

    //     // ผูกคำสั่ง order กับลูกค้า
    //     $customer->orders()->create($orderData);

    //     // ส่งกลับไปยังหน้าที่แล้วพร้อมกับข้อความสำเร็จ
    //     return redirect()->back()->with('success', 'บันทึกข้อมูลลูกค้าและคำสั่งสำเร็จ');
    // }





    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'customer_fname' => 'required|string',
    //         'customer_lname' => 'required|string',
    //         'customer_phone' => 'required|string',
    //         'id_line' => 'nullable|string',
    //         'deposit' => 'required|numeric',
    //         'price' => 'required|numeric',
    //     ]);

    //     // บันทึกข้อมูลในตาราง customer 
    //     $customer = new Customer;
    //     $customer->customer_fname = $request->input('customer_fname');
    //     $customer->customer_lname = $request->input('customer_lname');
    //     $customer->customer_phone = $request->input('customer_phone');
    //     $customer->id_line = $request->input('id_line');
    //     $customer->save(); // บันทึกข้อมูลลูกค้าลงในฐานข้อมูล


    //     $order = new Order;
    //     $order->user_id = Auth::user()->id;
    //     $order->customer_id = $customer->id;
    //     $order->total_deposit = $request->input('deposit');
    //     $order->total_price = $request->input('price');
    //     $order->save();


    //     // ผูกคำสั่ง order กับลูกค้า

    //     // ส่งกลับไปยังหน้าที่แล้วพร้อมกับข้อความสำเร็จ
    //     return redirect()->back()->with('success', 'บันทึกข้อมูลลูกค้าและคำสั่งสำเร็จ');
    // }

}
