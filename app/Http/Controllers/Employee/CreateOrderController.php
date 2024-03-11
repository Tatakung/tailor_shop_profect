<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Cost;
use App\Models\Customer;
use App\Models\Date;
use App\Models\Decoration;
use App\Models\Dress;
use App\Models\Fitting;
use App\Models\imagerent;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Orderdetailstatus;
use App\Models\Paymentstatus;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            ->where('amount', '>=', 1)
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


    public function getprice($selecttype, $selectcode, $selectsize)
    {
        $selectsize = trim($selectsize);
        $dressID = Dress::where('dress_type', $selecttype)
            ->where('dress_code', $selectcode)
            ->pluck('id');
        $get = Size::where('dress_id', $dressID)
            ->where('size_name', $selectsize)
            ->select('id', 'dress_id', 'price', 'deposit', 'amount')
            ->first();
        return response()->json(['price' => $get->price, 'deposit' => $get->deposit, 'dress_id' => $get->dress_id, 'id' => $get->id, 'amount' => $get->amount]);
    }



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

        try {
            // เริ่มการทำงานของ transaction
            DB::beginTransaction();

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
            $order->total_quantity = "1";
            $order->save();

            //รายละเอียดออเดอร์
            $orderdetail = new Orderdetail;
            $orderdetail->dress_id = $request->input('dress_ID');
            $orderdetail->size_id = $request->input('id_of_size'); //id 30
            $orderdetail->order_id = $order->id;
            $orderdetail->employee_id = Auth::user()->id;
            $orderdetail->pickup_date = $request->input('pickup_date');
            $orderdetail->return_date = $request->input('return_date');
            $orderdetail->late_charge = $request->input('late_charge');
            $orderdetail->type_dress = $request->input('dress_type');
            $orderdetail->type_order = "2";

            // ลดจำนวนสินค้าในตาราง size
            $reduce = Size::find($request->input('id_of_size'));
            if ($request->input('amount') <= $reduce->amount) {
                $reduce->amount = $reduce->amount - $request->input('amount');
                $reduce->save();
            } else {
                DB::rollBack(); // ถ้ามีปัญหา ทำการยกเลิกธุรกรรม
                return redirect()->back()->with('Overamount', "ไม่สามารถเช่าชุดเกินจำนวนที่มี");
            }
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


            //เพิ่มเติมลวดลายชุด
            // //ตรวจสอบว่า ถ้ามีค่าที่ส่งมา
            if ($request->has('decoration_type_description_') && $request->has('decoration_price_')) {
                // $dec_type = $request->input('decoration_type_');
                $dec_description = $request->input('decoration_type_description_');
                $dec_price = $request->input('decoration_price_');
                foreach ($dec_description as $index => $dec_dec) {
                    $decoration = new Decoration;
                    $decoration->order_detail_id = $orderdetail->id;
                    // $decoration->decoration_type = $dec_type;
                    $decoration->decoration_type_description = $dec_dec;
                    $decoration->decoration_price = $dec_price[$index];
                    $decoration->save();
                }
            }

            //รูปภาพ
            if ($request->hasFile('imagerent_')) {
                $images = $request->file('imagerent_');
                foreach ($images as $index => $image) {
                    // ตรวจสอบว่าไฟล์ถูกส่งมา
                    $additionalImage = new imagerent;
                    $additionalImage->order_detail_id = $orderdetail->id;
                    $additionalImage->image = $image->store('imagerent_images', 'public');
                    $additionalImage->save();
                }
            }


            //นัดลองชุด
            if ($request->has('fitting_date_')) {
                $fittingdate = $request->input('fitting_date_');
                $fittingNote = $request->input('fitting_note_');
                // $fittingPrice = $request->input('fitting_price_');
                foreach ($fittingdate as $index => $fittingdate) {
                    $request->validate([
                        'imagerent_' . $index => 'file|mimes:jpeg,png,jpg|max:2048',
                    ], [
                        'imagerent_' . $index . '.file' => "รูปภาพต้องเป็ฯไฟล์",
                        'imagerent_' . $index . 'mimes' => "รูปภาพต้องเป็นไฟล์ประเภท jpeg, png, jpg'",
                        'imagerent_' . $index . 'max' => "ขนาดไฟล์รูปภาพต้องไม่เกิน 2 MB",
                    ]);
                    $fitting = new Fitting;
                    $fitting->order_detail_id = $orderdetail->id;
                    $fitting->fitting_date = $fittingdate;
                    $fitting->fitting_note = $fittingNote[$index];
                    // $fitting->fitting_price = $fittingPrice[$index];
                    $fitting->fitting_status = "ยังไม่ลองชุด";
                    $fitting->save();
                }
            }

            DB::commit();
            // return redirect()->back()->with('successpasstry', "บันทึกข้อมูลสำเร็จ");
            return redirect()->route('showorderbill',['id'=>$order->id])->with('success' , "สำเร็จนะ") ; 
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errortotal', "เกิดข้อผิดพลาด");
        }

        // return redirect()->back()->with('success', 'บันทึกข้อมูลลูกค้าและคำสั่งสำเร็จ');
        // return redirect()->route('showorderbill',['id'=>$order->id])->with('success' , "สำเร็จนะ") ; 
    }


    // public function showTable()
    // {

    //     //ตารางหลัก (customers) มีความสัมพันธ์กับตารางลูก (orders) และตารางลูก (orders) 
    //     //ก็มีความสัมพันธ์กับตารางลูกอีกตารางหนึ่ง (orderdetails) โดยที่มันต่อเนื่องกัน.
    //     $data = Customer::with([
    //         'orders:id,customer_id,created_at',
    //         'orders.orderdetails:id,type_dress,price,amount,order_id',
    //         'orders.orderdetails.dates:id,order_detail_id,return_date'
    //     ])
    //         ->select('id', 'customer_fname', 'customer_lname')
    //         ->orderBy('orders.created_at', 'desc') // เรียงลำดับตาม created_at จากมากไปน้อย
    //         ->get();
    //     return view('employee.showrent', compact('data'));
    // }

    public function showTable()
    {
        $data = DB::table('customers')
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->join('orderdetails', 'orders.id', '=', 'orderdetails.order_id')
            // ->join('dates', 'orderdetails.id', '=', 'dates.order_detail_id')
            ->select(
                'customers.id as customer_id',
                'customers.customer_fname',
                'customers.customer_lname',
                'orders.created_at as order_created_at',
                'orders.id as order_id',
                'orderdetails.return_date',
                'orderdetails.type_dress',
                'orderdetails.status_detail',
                'orderdetails.amount',
                'orderdetails.id as detail_id'
            )

            ->orderBy('order_created_at', 'desc') // เรียงลำดับตาม created_at จากมากไปน้อย
            ->get();

        return view('employee.showrent', compact('data'));
    }

    //ทำใหม้ 

    //แสดงตารางบิลรวม
    public function showorder()
    {
        $showorder = Customer::with('orders')->orderBy('created_at', 'desc')->get();
        return view('employee.showorder', compact('showorder'));
    }
    // Query
    // public function showorder() {
    //     $showorder = DB::table('customers')
    //                     ->join('orders', 'customers.id', '=', 'orders.customer_id')
    //                     ->select('customers.*', 'orders.id as order_id', 'orders.created_at as order_created_at')
    //                     ->get();

    //     return view('employee.showorder', compact('showorder'));
    // }

    //แสดงตาราง orderbill
    public function showorderbill($id)
    {
        $bill = Orderdetail::where('order_id', $id)->get();

        return view('employee.showorderbill', compact('bill'));
    }
















    public function rentdetail($id)
    {
        $rentdetail = Orderdetail::find($id);

        $employee = User::find($rentdetail->employee_id);
        $size = Size::find($rentdetail->size_id);
        $dress = Dress::find($rentdetail->dress_id);


        $dates = Date::where('order_detail_id', $id)
            ->select('id', 'pickup_date', 'return_date')
            ->get();

        $finttings = Fitting::where('order_detail_id', $id)
            ->select('fitting_date', 'fitting_note', 'fitting_status', 'fitting_price', 'id')
            ->get();

        $orderdetailstatuses = Orderdetailstatus::where('order_detail_id', $id)
            ->select('order_detail_id', 'status', 'created_at')
            ->get();

        $decorations = Decoration::where('order_detail_id', $id)
            ->select('decoration_type', 'decoration_type_description', 'decoration_price', 'created_at', 'id')
            ->get();

        $imagerents = imagerent::where('order_detail_id', $id)
            ->select('image')
            ->get();

        $costs = Cost::where('order_detail_id', $id)
            ->select('id', 'cost_type', 'cost_value', 'created_at', 'order_detail_id')
            ->get();

        //ส่งค่าสถานะ เพื่อไปตรวจสอบในการ บล้อคช่องปุ่มกดต่างๆ 
        $valuestatus = Orderdetailstatus::where('order_detail_id', $id)
            ->latest('created_at')
            ->value('status');

        $valuepickupdate = Date::where('order_detail_id', $id)
            ->latest('created_at')
            ->value('pickup_date');
        $valuereturndate = Date::where('order_detail_id', $id)
            ->latest('created_at')
            ->value('return_date');



        return view('employee.rentdetail', compact('rentdetail', 'dates', 'finttings', 'orderdetailstatuses', 'employee', 'size', 'dress', 'decorations', 'imagerents', 'costs', 'valuestatus', 'valuepickupdate', 'valuereturndate'));
    }


    public function addfitting(Request $request, $orderdetailid)
    {
        $request->validate([
            'fitting_note' => 'nullable|string',
            'fittingprice' => 'required|numeric'
        ]);

        //ส่วนของเพิ่มวันที่นัดลองชุด
        $fitting = new Fitting;
        $fitting->order_detail_id = $orderdetailid;
        $fitting->fitting_date = $request->input('fittingdate');
        $fitting->fitting_note = $request->input('fittingnote');
        $fitting->fitting_price = $request->input('fittingprice');
        $fitting->fitting_status = "ยังไม่ลองชุด";
        $fitting->save();
        return redirect()->back()->with('success', 'บันทึกข้อมูลลูกค้าและคำสั่งสำเร็จ');
    }
    public function adddecoration(Request $request, $orderdetailid)
    {
        $request->validate([
            'decoration_type' => 'required|string',
            'decoration_type_description' => 'nullable|string',
            'decoration_price' => 'required|numeric',
        ]);
        $decoration = new Decoration;
        $decoration->order_detail_id = $orderdetailid;
        $decoration->decoration_type = $request->input('decoration_type');
        $decoration->decoration_type_description = $request->input('decoration_type_description');
        $decoration->decoration_price = $request->input('decoration_price');
        $decoration->save();
        return redirect()->back()->with('success', 'บันทึกข้อมูลลูกค้าและคำสั่งสำเร็จ');
    }

    //เพิ่ม cost
    public function addcost(Request $request)
    {
        $request->validate([
            'cost_type_*.*' => 'required|string',
            'cost_value_*.*' => 'required|numeric',
        ]);
        $cost_type = $request->input('cost_type_');
        $cost_value = $request->input('cost_value_');
        foreach ($cost_type as $index => $type) {
            $addcost = new Cost;
            $addcost->order_detail_id = $request->input('id_of_detail');
            $addcost->cost_type = $type;
            $addcost->cost_value = $cost_value[$index];
            $addcost->save();
        }
        return redirect()->back()->with('success', "เพิ่มค่าใช้จ่ายสำเร็จแล้วนะ");
    }

    public function addimage(Request $request)
    {
        $request->validate([
            'addimage' => 'file|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('addimage')) {
            $addimage = new imagerent;
            $addimage->order_detail_id = $request->input('orderdetail_id');
            $addimage->image = $request->file('addimage')->store('imagerent_images', 'public');
            $addimage->save();
        } else {
            return redirect()->back()->with('noaddimage', 'อัพโหลดไม่ได้');
        }

        return redirect()->back()->with('success', 'บันทึกสำเร็จ');
    }

    //จัดการรูปภาพ

    public function manageimage($id)
    {
        $manageimage = imagerent::where('order_detail_id', $id)
            ->select('id', 'image', 'created_at')
            ->get();
        return view('employee.editimage', compact('manageimage'));
    }

    //ลบimagerent
    public function deleteimage($id)
    {
        $deleteimage = imagerent::find($id);
        $deleteimage->delete();
        return redirect()->back()->with('success', 'ลบสำเร็จ');
    }



    //อัพเดต cost 
    public function updatecost(Request $request, $id)
    {

        $updatecost = Cost::find($id);
        $request->validate([
            'cost_type' => 'required|string',
            'cost_value' => 'required|numeric',
        ], [
            'required' => 'กรุณากรอก :attribute',
            'string' => 'กรุณากรอก :attribute  เป็นข้อวคาม',
            'numeric' => 'กรุณากรอก :attribute เป็นตัวเลข',
        ]);

        $updatecost->cost_type = $request->input('cost_type');
        $updatecost->cost_value = $request->input('cost_value');
        $updatecost->save();
        return redirect()->route('rentdetail', ['id' => $updatecost->order_detail_id])->with('success', 'อัพเดตสำเร็จ');
    }

    //ลบcost
    public function deletecost($id)
    {
        $delete = Cost::find($id);
        $delete->delete();
        return redirect()->route('rentdetail', ['id' => $delete->order_detail_id])->with('success', "ลบสำเร็จแล้ว");
    }



    //อัพเดต decoration
    public function updatedecoration(Request $request, $id)
    {
        $request->validate([
            'decoration_type' => 'required|string',
            'decoration_type_description' => 'required|string',
            'decoration_price' => 'required|numeric',
        ]);
        $updatedecoration = Decoration::find($id);
        $updatedecoration->decoration_type = $request->input('decoration_type');
        $updatedecoration->decoration_type_description = $request->input('decoration_type_description');
        $updatedecoration->decoration_price = $request->input('decoration_price');
        $updatedecoration->save();
        return redirect()->route('rentdetail', ['id' => $updatedecoration->order_detail_id])->with('success', "แก้ไขข้อมูลสำเร็จแล้ว");
    }
    // ลบdecoration
    public function deletedecoration($id)
    {
        $deletedecoration = Decoration::find($id);
        $deletedecoration->delete();
        return redirect()->route('rentdetail', ['id' => $deletedecoration->order_detail_id])->with('success', "แก้ไขข้อมูลสำเร็จแล้ว");
    }

    //แก้ไจ fitting
    public function updatefitting(Request $request, $id)
    {
        $request->validate([
            'fitting_price' => 'required|numeric',
            'fitting_note' => 'nullable|string',
            'fitting_status' => 'required|string',
        ]);

        $updatefit = Fitting::find($id);
        $updatefit->fitting_price = $request->input('fitting_price');
        $updatefit->fitting_note = $request->input('fitting_note');

        if ($request->input('fitting_status') == "มาลองชุดแล้ว") {
            $updatefit->fitting_real_date = date('Y-m-d');
            $updatefit->fitting_status = $request->input('fitting_status');
        } else {
            $updatefit->fitting_status = $request->input('fitting_status');
        }
        $updatefit->save();
        return redirect()->route('rentdetail', ['id' => $updatefit->order_detail_id])->with('success', 'อัพเดตข้อมูลสำเร็จ');
    }

    public function deletefitting($id)
    {
        $delete = Fitting::find($id);

        if ($delete->fitting_status == "ยังไม่ลองชุด") {
            $delete->delete();
            return redirect()->back()->with('success', "ลบแล้ว");
        } else {
            return redirect()->back()->with('notdelete', "ไม่สามารถลบได้เนื่องจาก เขามาลองชุดแล้วจร้า");
        }
    }

    public function adddate(Request $request)
    {
        $adddate = new Date;
        $adddate->order_detail_id = $request->input('order_id_id');
        $adddate->pickup_date = $request->input('pickup_date');
        $adddate->return_date = $request->input('return_date');
        $adddate->save();
        return redirect()->back()->with('success', 'แก้ไขสำเร็จแล้ว');
    }

    //อัพเดตสภานะจาก จองชุดเป็นกำลังเช่า 
    public function updateorderstatus(Request $request)
    {
        //ดึงสถนะของออเดอร์ดีเทล
        $valuestatus  = Orderdetailstatus::where('order_detail_id', $request->input('order_detail_id'))
            ->latest('created_at')
            ->value('status');

        //ดึงสถานะของจ่ายเงิน
        $valuepayment = Paymentstatus::where('order_detail_id', $request->input('order_detail_id'))
            ->latest('created_at')
            ->value('payment_status');


        //อัพเดตในสถานะในตารางorderdetail ด้วยนะ 
        $statusdetail = Orderdetail::find($request->input('order_detail_id'));
        if ($statusdetail->status_detail == "จองชุด") {
            $statusdetail->status_detail = "กำลังเช่า";
        }
        //อัพเดตสถานะการเงินในตาราง orderdetai lดว้ยนะ 
        if ($statusdetail->status_payment == "1") {
            $statusdetail->status_payment = "2";
        }
        $statusdetail->save();


        //อัพเดตสถานะออเดอร์detail 
        $addstatus = new Orderdetailstatus;
        if ($valuestatus === "จองชุด") {
            $addstatus->order_detail_id = $request->input('order_detail_id');
            $addstatus->status = "กำลังเช่า";
            $addstatus->save();
        }


        //อัพเดตสถานะเงิน
        if ($valuepayment === "1") {
            $addpayment = new Paymentstatus;
            $addpayment->order_detail_id = $request->input('order_detail_id');
            $addpayment->payment_status = "2";
            $addpayment->save();
        }


        return redirect()->back()->with('success', "อัพเดตสถานะสำเร็จแล้ว");
    }
    public function updateorderreturn(Request $request)
    {
        $request->validate([
            'damage_insurance' => 'required|numeric',
            'why' => 'nullable|string',
        ]);

        $confirm = Orderdetail::find($request->input('order_detail_id'));
        $confirm->total_damage_insurance = $request->input('damage_insurance');
        if ($request->input('why') == "") {
            $confirm->cause_for_insurance = "ชุดไม่มีการเสียหาย";
        } else {
            $confirm->cause_for_insurance = $request->input('why');
        }
        $confirm->status_detail = "คืนชุดแล้ว";
        $confirm->save();


        $orderdetailstatus = new Orderdetailstatus;
        $orderdetailstatus->order_detail_id = $request->input('order_detail_id');
        $orderdetailstatus->status = "คืนชุดแล้ว";
        $orderdetailstatus->save();
        return redirect()->back()->with('success', "ยืนยันการคืนชุดสำเร็จ");
    }



}
