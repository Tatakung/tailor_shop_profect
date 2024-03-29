<?php

namespace App\Http\Controllers;

use App\Models\Dress;
use App\Models\Size;
use App\Models\Dresssizehistory;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class DressController extends Controller
{
    //
    // public function formdress(){
    //     $get_dresstype = Dress::distinct()->pluck('dress_type');
    //     return view('admin.AddDress',compact('get_dresstype'));
    // }

    // public function storeDress(Request $request){
    //     $request->validate([
    //         'dress_code' => 'required|string',
    //         'dress_type' => 'required|string',
    //         'dress_description' => 'nullable|string',
    //         'dress_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'size_name' => 'required|string',
    //         'price' => 'required|numeric',
    //         'deposit' => 'required|numeric',
    //         'amount' => 'required|integer',
    //     ]);

    //     // ตรวจสอบว่า dress_type และ dress_code มีอยู่แล้วหรือไม่
    //     $dress = Dress::where('dress_type', $request->input('dress_type'))
    //                   ->where('dress_code', $request->input('dress_code'))
    //                   ->first();

    //     //ตรวจสอบว่าถ้ามันซ้ำ
    //     if ($dress) {
    //         $dress_id = $dress->id; 
    //     } 
    //     //ตรวจสอบว่าถ้ามันไม่ซ้ำ
    //     else {        
    //         $newDress = new Dress();

    //         if($request->input('dress_type') == 'other_type'){
    //             $checkothertypenew = Dress::where('dress_type',$request->input('other_type_new'))->first();  //ตรวจสอบประเภทชุดซ้ำไหม
    //             if(!$checkothertypenew){
    //                 $newDress->dress_type = $request->input('other_type_new'); 
    //             }
    //             else{
    //                 return redirect()->back()->with('checkothertypenew','ซ้ำกับประเภทชุดที่มี');
    //             }
    //             // $newDress->dress_type = $request->input('other_type_new');
    //         }
    //         else{
    //             $newDress->dress_type = $request->input('dress_type');
    //         }

    //         // รหัสชุด
    //         if($request->input('dress_code') == "other_code"){
    //             $newDress->dress_code = $request->input('other_code_new');
    //         }
    //         else{
    //             $newDress->dress_code = $request('dress_code');
    //         }

    //         $newDress->dress_description = $request->input('dress_description');

    //         if($request->hasFile('dress_image')){
    //             $imagePath = $request->file('dress_image')->store('dress_images','public');
    //             $newDress->dress_image = $imagePath;
    //         }

    //         $newDress->save();
    //         $dress_id = $newDress->id; // ให้ใช้ id ใหม่ที่สร้างขึ้น 6
    //     }

    //     // สร้าง size ใหม่
    //     $size = new Size();
    //     $size->dress_id = $dress_id; // ใช้ dress_id ที่ได้จากข้างบน


    //     //ตรวจหาไซส์ว่ามันซ้ำไหม
    //     $validatedress = Dress::where('dress_type', $request->input('dress_type'))
    //                         ->where('dress_code',$request->input('dress_code'))
    //                         ->value('id');   //null  
    //                     if($validatedress != null){
    //                         $validatesize = Size::where('dress_id',$validatedress)
    //                                             ->pluck('size_name');
    //                     }
    //                     else{
    //                         $validatesize = collect(); //กำหนดเป็ฯค่าว่าง
    //                     }

    //     if(!$validatesize->contains($request->input('size_name'))){ //ไซส์ที่กรอก มันอยยู่ในข้อมูลไหม
    //         $size->size_name = $request->input('size_name');
    //     }
    //     else{
    //         return redirect()->back()->with('repeatsize','ไซส์มีอยู่แล้วในฐานข้อมูล');
    //     }

    //     $size->price = $request->input('price');
    //     $size->deposit = $request->input('deposit');
    //     $size->amount = $request->input('amount');
    //     $size->save();


    //     //อัปเดตรายละเอียดชุด + รูปภาพ ถ้ามีการแก้ไข
    //     if($validatedress != null){
    //         $updatenew = Dress::find($validatedress);

    //         //รายละเอียด
    //         if($updatenew->dress_description != $request->input('dress_description')){
    //             $updatenew->update([
    //                 'dress_description' => $request->input('dress_description'),
    //             ]);
    //         }

    //         //รูปภาพ
    //         if($request->hasFile('dress_image')){
    //             $imagepath_new = $request->file('dress_image')->store('dress_images','public');
    //             $updatenew->update([
    //                 'dress_image' => $imagepath_new,
    //             ]);
    //         }
    //     }

    //     return redirect()->back()->with('success','บันทึกข้อมูลสำเร็จแล้ว');
    // }


    // //ดึงรหัสชุด
    // public function getDressCodes($dressType){
    //     $dressCode = Dress::where('dress_type', $dressType)->pluck('dress_code');
    //     return response()->json($dressCode); //ส่งค่ากลับแบบ json array
    // }


    // //กำหนดค่ากรณ๊เลือกหมายเลขชุดอื่นๆ
    // public function NumberCodes($numbertypecode){
    //     $increasecode = Dress::where('dress_type', $numbertypecode)->max('dress_code'); //ได้ค่าสูงสุดแล้วนะ **ถ้าไม่มีจะถูกส่งกลับเป็ฯค่า nullนะ
    //     return response()->json(['maxCode' => $increasecode]); 
    // }

    // // ดึงไซส์ในร้าน
    // public function getSizeNames($dressType,$dressCode){
    //     $dressid = Dress::where('dress_type',$dressType)
    //                     ->where('dress_code',$dressCode)
    //                     ->value('id');
    //         if($dressid == null){
    //             return response()->json([]);
    //         }
    //         else{
    //             $sizeNames = Size::where('dress_id',$dressid)
    //                         ->pluck('size_name')
    //                         ->toArray();
    //             return response()->json($sizeNames);
    //         }
    // }

    // // ดึงdiscription
    // public function getDescription($dressType, $dressCode){
    //     $getdes = Dress::where('dress_type', $dressType)
    //                     ->where('dress_code', $dressCode)
    //                     ->value('dress_description');
    //         return response()->json(['getdes' => $getdes]);
    // }

    // // ดึงimage
    // public function getimage($dressType, $dressCode){
    //     $getimage = Dress::where('dress_type', $dressType)
    //                         ->where('dress_code', $dressCode)
    //                         ->value('dress_image');
    //                         return response()->json(['getimage' => $getimage]);
    // }
    //คอมเม้นอันเก่าไว้ก่อนนะ


    //แบบฟอร์มเพิ่มชุดใหม่
    public function getdresstype()
    {
        $gettype = Dress::distinct()->pluck('dress_type');
        return view('admin.add', compact('gettype'));
    }
    //ดึงค่ามากที่สุด+1
    public function getmaxcode($dresstype)
    {
        $max = Dress::where('dress_type', $dresstype)
            ->max('dress_code');
        return response()->json(['max' => $max]);
    }

    //บันทึกการเพิ่มชุดใหม่
    public function saveadddress(Request $request)
    {
        $request->validate([
            'dresscode' => 'required|string',
            'dresscode' => 'required|numeric',
            'sizename' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'deposit' => 'required|numeric',
            'amount' => 'required|numeric',
            'imagedress' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $dress = new Dress;
        $dress->dress_code = $request->input('dresscode');


        if ($request->input('dresstype')  ===  'other_type') {
            if ($request->input('inputother') != null) {
                $dress->dress_type = $request->input('inputother');
            } else {
                return redirect()->back()->with('fail', "กรุณาใส่ค่าในช่องinput");
            }
        } else {
            $dress->dress_type = $request->input('dresstype');
        }

        $dress->dress_description = $request->input('description');
        if ($request->hasFile('imagedress')) {
            $dress->dress_image = $request->file('imagedress')->store('dress_images', 'public');
        }
        $dress->save();


        $size = new Size;
        $size->dress_id = $dress->id;
        $size->size_name = $request->input('sizename');
        $size->price = $request->input('price');
        $size->deposit = $request->input('deposit');
        $size->amount = $request->input('amount');
        $size->save();
        return redirect()->back()->with('success', "บันทึกข้อมูลสำเร็จแล้ว");
    }

    //แสดงชุดทั้งหมดในร้าน
    public function show()
    {
        $dress = Dress::all();
        $dressTypes = $dress->pluck('dress_type')->unique();
        return view('admin.show', compact('dress', 'dressTypes'));
    }

    //แสดงรายละเอียดชุด
    public function showdetail($id)
    {
        $size = Size::where('dress_id', $id)
            ->get();
        $dress = Dress::find($id);

        return view('admin.showdetail', compact('size', 'dress'));
    }

    //บันทึกเพิ่มไซส์ 
    public function savesize(Request $request)
    {
        $request->validate([
            'add_size_name' => 'required|string',
            'add_price' => 'required|numeric',
            'add_deposit' => 'required|numeric',
            'add_amount' => 'required|numeric',
        ]);

        $again = Size::where('dress_id', $request->input('dress_id'))
            ->pluck('size_name');


        $savesize = new Size;
        $savesize->dress_id  = $request->input('dress_id');

        if ($again->contains($request->input('add_size_name'))) {
            return redirect()->back()->with('fail', "ไซส์ที่เพิ่มมันมีอยู่แล้ว");
        } else {
            $savesize->size_name = $request->input('add_size_name');
        }
        $savesize->price = $request->input('add_price');


        if($request->input('add_deposit') > $request->input('add_price')){
            return redirect()->back()->with('fail', "ราคามัดจำต้องไม่เกินราคาชุด");
        }
        else{
            $savesize->deposit = $request->input('add_deposit');
        }

        $savesize->amount = $request->input('add_amount');
        $savesize->save();
        return redirect()->back()->with('success', "เพิ่มไซส์สำเร็จ");
    }

    //บันทึกข้อมูลอัพเดตในตาราง dress
    public function updatefordress(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string',
            'update_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $update = Dress::find($request->input('dress_id'));
        $update->dress_description = $request->input('description');

        if ($request->hasFile('update_image')) {
            $update->dress_image = $request->file('update_image')->store('dress_images', 'public');
        }
        $update->save();
        return redirect()->back()->with('success', "อัพเดตข้อมูลสำเร็จ");
    }

    //อัปเดตพวก ราคา ราคามัดจำ จำนวนเครื่องประดับ
    public function updatepricegroup(Request $request)
    {
        $request->validate([]);
        $update = Size::find($request->input('size_id'));


        // //บันทึกประวัติการปรับราคา
        if ($request->input('update_price') != $update->price) {
            if ($request->input('update_price') > $update->price) {
                $textprice = "ปรับเพิ่มราคาขึ้น";
            } elseif ($request->input('update_price') < $update->price) {
                $textprice = "ปรับราคาลง";
            }
            Dresssizehistory::create([
                'size_id' => $update->id,
                'action' => $textprice,
                'old_amount' =>  $update->price,
                'new_amount' => $request->input('update_price'),
            ]);
            $update->price = $request->input('update_price');
            // $update->save();
            // return redirect()->back()->with('success', $textprice);
        }

        // //เพิ่มประวัติแก้ไขราคามัดจำ 


        if ($request->input('update_deposit') <= $update->price) {
            if ($request->input('update_deposit') != $update->deposit) {
                if ($request->input('update_deposit') > $update->deposit) {
                    $textdeposit = "ปรับเพิ่มราคามัดจำ";
                } elseif ($request->input('update_deposit') < $update->deposit) {
                    $textdeposit = "ปรับราคามัดจำลง";
                }
                Dresssizehistory::create([
                    'size_id' => $update->id,
                    'action' => $textdeposit,
                    'old_amount' => $update->deposit,
                    'new_amount' => $request->input('update_deposit'),
                ]);
                $update->deposit = $request->input('update_deposit');
            } else {
                $update->deposit = $request->input('update_deposit');
                $textdeposit = "มันเท่ากันไม่มีอะไร";
            }
        } else {
            return redirect()->back()->with('fail', "ไม่สามารถแก้ไขราคามัดจำที่มากกว่าราคาเช่าต่อชุดได้");
        }



        if ($request->input('action_type') == "add") {
            Dresssizehistory::create([
                'size_id' => $update->id , 
                'action' => "เพิ่มจำนวน",
                'old_amount' => $update->amount , 
                'new_amount' => $request->input('quantity') + $update->amount , 
            ]) ; 
            $update->amount = $request->input('quantity') + $update->amount;
        } 
        elseif ($request->input('action_type') == "remove") {
            if ($request->input('quantity') <= $update->amount) {
                Dresssizehistory::create([
                    'size_id' => $update->id , 
                    'action' => "ลดจำนวน",
                    'old_amount' => $update->amount , 
                    'new_amount' => $update->amount - $request->input('quantity') , 
                ]) ; 
                $update->amount = $update->amount - $request->input('quantity');
            } 
            else {
                return redirect()->back()->with('faildeleteamount', 'ไม่สามารถลบจำนวนชุดที่มากกว่าจำนวนที่มีในร้านได้');
            }
        }
        elseif($request->input('action_type') == "" && $request->input('quantity') != ""){
            return redirect()->back()->with('addselect', 'กรุณาเลือกเพิ่ม/ลบจำนวนชุดที่ต้องการ'); 
        }


        $update->save();
        return redirect()->back()->with('success', 'แก้ไขสำเร็จ');


    }

















    public function showDress(Request $request)
    {
        $selectType = Dress::distinct()->pluck('dress_type')->toArray();
        $inputfilter = $request->input('typeFilter');

        if ($inputfilter) {
            $dresses = Dress::where('dress_type', $inputfilter)->with('sizes')->get();
        } else {
            $dresses = Dress::with('sizes')->get();
        }
        return view('admin.ShowDress', compact('selectType', 'dresses', 'request'));
    }




    // แสดงรายละเอียดชุด
    public function detailDress($id)
    {
        $getsize = Size::find($id);
        return view('admin.DetailDress', compact('getsize'));
    }


    public function editDress($id)
    {
        $getdata = Size::find($id);
        $dreshowhistory = Dresssizehistory::all(); //ส่งค่าประวัติไปแสดง
        return view('admin.EditDress', compact('getdata', 'dreshowhistory'));
    }


    //อัปเดตข้อมูลการแก้ไขชุดนะ 
    public function updateDress(Request $request, $id)
    {
        // ตรวจสอบข้อมูลที่ได้รับจากฟอร์ม
        $request->validate([
            'price' => 'required|numeric|min:1',
            'deposit' => 'required|numeric|min:1',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'numeric|min:1'
        ]);


        $size = Size::find($id);  // idที่ 3 จากตารางsize   มี dress_id ที่ 2 กำกับอยู่
        $dress = $size->dress; //ดึงข้อมูล dress ที่เกี่ยวข้องกัล size  



        //ตารางdressนะ
        if ($request->hasFile('image')) {
            $imagepathupdate = $request->file('image')->store('dress_images', 'public');
            $dress->dress_image = $imagepathupdate;
        }
        $dress->dress_description = $request->input('description');
        $dress->save();
        //รูปภาพ



        //บันทึกประวัติ(ราคา)
        if ($request->input('price') != $size->price) {
            if ($request->input('price') > $size->price) {
                $text_edit_price = "ปรับราคาขึ้น";
            } elseif ($request->input('price') < $size->price) {
                $text_edit_price = "ปรับราคาลง";
            }
            Dresssizehistory::create([
                'size_id' => $size->id,
                'action' => $text_edit_price,
                'old_amount' => $size->price,
                'new_amount' => $request->input('price'),
            ]);
        }

        $size->price = $request->input('price'); //ให้มันเพิ่มลงในประวัติก่อนค่อยบันทึกการอก้ไขในตาราง size 

        //บันทึกประวัติ(มัดจำ)
        if ($request->input('deposit') <= $size->price) {    //เช็คว่า ราคามัดจำที่แก้ไขมันมีค่าต้องน้อยกว่า ราคาเต็ม
            if ($request->input('deposit') != $size->deposit) {
                if ($request->input('deposit') > $size->deposit) {
                    $text_edit_deposit = "ปรับราคามัดจำขึ้น";
                } elseif ($request->input('deposit') < $size->deposit) {
                    $text_edit_deposit = "ปรับราคามัดจำลง";
                }
                Dresssizehistory::create([
                    'size_id' => $size->id,
                    'action' => $text_edit_deposit,
                    'old_amount' => $size->deposit,
                    'new_amount' => $request->input('deposit'),
                ]);
            }
            $size->deposit = $request->input('deposit'); //ให้มันเพิ่มลงในประวัติก่อนค่อยบันทึกการอก้ไขในตาราง size
        } else {
            return redirect()->back()->with('Overdeposit', 'ราคามัดจำต้องไม่เกินราคาเต็มของชุด');
        }




        if ($request->input('action_type') == "add") {
            //บันทึกประวัติ
            Dresssizehistory::create([
                'size_id' => $size->id,
                'action' => "เพิ่มจำนวนชุด",
                'old_amount' => $size->amount,
                'new_amount' => $request->input('quantity') + $size->amount,
            ]);
            $size->amount += $request->input('quantity');
        } elseif ($request->input('action_type') == "remove") {
            if ($request->input('quantity') > $size->amount) {
                return redirect()->back()->with('amountover', 'ไม่สามารถลบเกินจำนวนที่มีได้');
            } else {
                Dresssizehistory::create([
                    'size_id' => $size->id,
                    'action' => "ลบจำนวนชุด",
                    'old_amount' => $size->amount,
                    'new_amount' => $size->amount - $request->input('quantity'),
                ]);
                $size->amount -= $request->input('quantity');
            }
        }
        $size->save(); //เซฟด้วยสุดท้าย
        return redirect()->back()->with('sizeupdate', 'แก้ไขสำเร็จแล้วนะ');
    }
}
