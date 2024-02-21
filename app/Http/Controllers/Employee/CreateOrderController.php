<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Dress;
use App\Models\Order;
use App\Models\Orderdetail;
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

    //ดึงราคา
    public function getprice($selecttype, $selectcode, $selectsize)
    {
        $dressID = Dress::where('dress_type', $selecttype)
            ->where('dress_code', $selectcode)
            ->pluck('id');
        $sizeID = Size::where('id', $dressID)
            ->pluck('id');

        $getprice = Size::where('id', $sizeID)
            ->pluck('price');
        return response()->json($getprice);
    }

    //ดึงราคามัดจำ
    public function getdeposit($selecttype, $selectcode, $selectsize)
    {
        $dressID = Dress::where('dress_type', $selecttype)
            ->where('dress_code', $selectcode)
            ->pluck('id');
        $sizeID = Size::where('id', $dressID)
            ->pluck('id');

        $getprice = Size::where('id', $sizeID)
            ->pluck('deposit');
        return response()->json($getprice);
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

        $order = new Order ;
        $order->user_id = Auth::user()->id ;
        $order->customer_id = $customer->id;
        $order->total_price = $request->input('price');
        $order->total_deposit = $request->input('deposit');
        $order->save();


        $orderdetail = new Orderdetail();
        $orderdetail->accessory_id = $request->input('accessory_id');
        $orderdetail->dress_id = $request->input('dress_id');
        $orderdetail->size_id = $request->input('size_id');
        $orderdetail->order_id = $order->id;
        $orderdetail->employee_id = Auth::user()->id;
        $orderdetail->late_charge = $request->input('late_charge');
        // $orderdetail->real_pickup_date = $request->input('real_pickup_date');
        // $orderdetail->real_return_date = $request->input('real_return_date');
        // $orderdetail->type_dress = $request->input('type_dress');
        $orderdetail->type_order = 2; //หมายถึงเช่าชุด
        $orderdetail->amount = $request->input('amount');
        $orderdetail->price = $request->input('price');
        $orderdetail->deposit = $request->input('deposit');
        $orderdetail->note = $request->input('note');
        $orderdetail->damage_insurance = $request->input('damage_insurance');
        $orderdetail->total_damage_insurance = 0;
        $orderdetail->status_detail = "จองชุด";
        $orderdetail->status_payment = $request->input('status_payment');
        $orderdetail->late_fee = 0;
        $orderdetail->total_cost = 0;
        // $orderdetail->total_decoration_price = $request->input('total_decoration_price');
        // $orderdetail->total_fitting_price = $request->input('total_fitting_price');
        
        $orderdetail->save();
        






        return redirect()->back()->with('success', 'บันทึกข้อมูลลูกค้าและคำสั่งสำเร็จ');
    }




}
