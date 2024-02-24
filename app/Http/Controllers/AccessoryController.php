<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Accessoryhistory;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccessoryController extends Controller
{
    //
    public function formaccessory(){
        $accessoryName = Accessory::distinct()->pluck('accessory_name');
        return view('admin.AddAccessory',compact('accessoryName'));

        
    }

    //บันทึกข้อมูล
    public function store(Request $request){
        $request->validate([
            'accessory_name' => 'required|string',
            'accessory_code' => 'required|string',
            'accessory_count' => 'required|integer|min:0',
            'accessory_price' => 'required|numeric|min:1',
            'accessory_deposit' => 'required|numeric|min:1',
            'accessory_description' => 'nullable|string',
            'accessory_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);



        //เช็ครูปภาพ
        if ($request->hasFile('accessory_image')){
            $imagePath = $request->file('accessory_image')->store('accessory_images','public');
        }
        else{
            $imagePath = null;
        }


        if($request->input('accessory_name') !== "other"){
                Accessory::create([
                    'accessory_name' => $request->input('accessory_name'),
                    'accessory_code_new' => $request->input('accessory_code'),
                    'accessory_count' => $request->input('accessory_count'),
                    'accessory_price' => $request->input('accessory_price'),
                    'accessory_deposit' => $request->input('accessory_deposit'),
                    'accessory_description' => $request->input('accessory_description'),
                    'accessory_image' => $imagePath
                ]);
            }
        else{
            if($request->input('other_new')){
                $checkother = Accessory::where('accessory_name', $request->input('other_new'))->first();  
                if(!$checkother){
                    Accessory::create([
                        'accessory_name' => $request->input('other_new'),
                        'accessory_code_new' => $request->input('accessory_code'),
                        'accessory_count' => $request->input('accessory_count'),
                        'accessory_price' => $request->input('accessory_price'),
                        'accessory_deposit' => $request->input('accessory_deposit'),
                        'accessory_description' => $request->input('accessory_description'),
                        'accessory_image' => $imagePath
                    ]);
                }
                return redirect()->back()->with('duplicate',"ซ้ำกับฐานข้อมูล");
            }
        }
        
        return redirect()->back()->with('success','บันทึกสำเร็จ');

    }

    
    public function getMaxAccessoryCode($accessory_name)
    {    
        $maxAccessoryCode = Accessory::where('accessory_name', $accessory_name)->max('accessory_code_new'); //ได้ค่าสูงสุดแล้วนะ
        return response()->json(['maxCode' => $maxAccessoryCode]); 
    }


    // แสดงเครื่องประดับ
    // public function showAccessory(){
    //     $accessorytotal = Accessory::all();
    //     return view('admin.ShowAccessory',compact('accessorytotal'));
    // }


    public function showAccessory(Request $request){
        $SelectType = Accessory::distinct()->pluck('accessory_name')->toArray();
        $inputfilter = $request->input('typeFilter');

        //ถ้ามีการกรอง
        if($inputfilter){
            $accessorytotal = Accessory::where('accessory_name',$inputfilter)->paginate(10);
        }
        else{ //ถ้าไม่มีการกรอกหรือเป็นค่า ""
            $accessorytotal = Accessory::paginate(10);
        }
        return view('admin.ShowAccessory',compact('SelectType','accessorytotal','request'));
    }



    //แสดงรายละเอียดเครื่องประดับ
    public function detailAccessory($id){
        $showdetail = Accessory::findOrFail($id);
        return view('admin.DetailAccessory',compact('showdetail'));
    }
    //แสดงหน้าแก้ไขเครื่องประดับ
    public function editAccessory($id){
        $editaccessory = Accessory::find($id);
        $accshowhistory = Accessoryhistory::all();
        return view('admin.EditAccessory',compact('editaccessory','accshowhistory'));
    }

    
    


    public function updateAccessory(Request $request, $id){
        $request->validate([
            'accessory_price' => 'required|numeric|min:1',
            'accessory_deposit' => 'required|numeric|min:1',
            'accessory_description' => 'nullable|string',
            'accessory_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'action_type' => 'nullable|in:add,remove',
            'quantity' => 'nullable|integer|min:1'
        ]);
        $AccessoryUpdate = Accessory::find($id);
    
          //เช็ครูปภาพ
          if ($request->hasFile('accessory_image')) {
            $AccessoryUpdate->accessory_image = $request->file('accessory_image')->store('accessory_images','public');
        }

    //ตรวจสอบการแก้ไขราคานะ
    if($AccessoryUpdate->accessory_price != $request->input('accessory_price')){
        if($AccessoryUpdate->accessory_price < $request->input('accessory_price')){
            $text = "ปรับราคาขึ้น";
        }
        elseif($AccessoryUpdate->accessory_price > $request->input('accessory_price')){
            $text = "ปรับราคาลง";
        }
        Accessoryhistory::create([
            'accessory_id' => $AccessoryUpdate->id,
            'action' => $text,
            'old_amount' => $AccessoryUpdate->accessory_price,
            'new_amount' => $request->input('accessory_price'),
        ]);
    }

    //ตรวจสอบการแก้ไขราคามัดจำนะ
    if($AccessoryUpdate->accessory_deposit != $request->input('accessory_deposit')){
        if($request->input('accessory_deposit') > $AccessoryUpdate->accessory_price){  // ราคามัดจำห้ามเกินราคาเต็มเครืาองปรัดัล
            return redirect()->back()->with('overdeposit',"ราคามัดจำต้องไม่เกินราคาเต็มของเครื่องประดับนะ");
        }
        elseif($request->input('accessory_deposit') <= $AccessoryUpdate->accessory_price){
            if($AccessoryUpdate->accessory_deposit < $request->input('accessory_deposit')){
                $text_deposit = "ปรับราคามัดจำขึ้น";
            }
            elseif($AccessoryUpdate->accessory_deposit > $request->input('accessory_deposit')){
                $text_deposit = "ปรับราคามัดจำลง";
            }
            Accessoryhistory::create([
                'accessory_id' => $AccessoryUpdate->id,
                'action' => $text_deposit,
                'old_amount' => $AccessoryUpdate->accessory_deposit,
                'new_amount' => $request->input('accessory_deposit'),
            ]);
        }
   
    }

    //ตรวจสอบการแก้ไขเพิ่ม/ลบจำนวน   (ประวัติ)
    if($request->input('action_type') == "add"){
        Accessoryhistory::create([
            'accessory_id' => $AccessoryUpdate->id,
            'action' => "เพิ่มจำนวนเครื่องประดับ",
            'old_amount' => $AccessoryUpdate->accessory_count,   // 15 
            'new_amount' => $request->input('quantity') + $AccessoryUpdate->accessory_count ,   
        ]);                                
    }
    elseif($request->input('action_type') == "remove"){
        if($request->input('quantity') < $AccessoryUpdate->accessory_count){
            Accessoryhistory::create([
                'accessory_id' => $AccessoryUpdate->id,
                'action' => "ลบจำนวนเครื่องประดับ",
                'old_amount' => $AccessoryUpdate->accessory_count,
                'new_amount' => $AccessoryUpdate->accessory_count - $request->input('quantity'),
            ]);
        }
    }
    

    //บันทึกลงในฐานนข้อมูล
    if ($request->input('action_type') == "add"){
        $AccessoryUpdate->accessory_count += $request->input('quantity');
    }
    elseif($request->input('action_type') == "remove"){
        if($request->input('quantity') >  $AccessoryUpdate->accessory_count){
            return redirect()->back()->with('T','ไม่สามารถลบเครื่องประดับมากกว่าจำนวนที่มีได้');
        }
        $AccessoryUpdate->accessory_count -= $request->input('quantity');
    }


        // //เช็ครูปภาพ
        // if ($request->hasFile('accessory_image')) {
        //     $AccessoryUpdate->accessory_image = $request->file('accessory_image')->store('accessory_images','public');
        // }

   
        //บันทึกลงในฐานข้อมูล
        $AccessoryUpdate->update([
        'accessory_price' => $request->input('accessory_price'),
        'accessory_deposit' => $request->input('accessory_deposit'),
        'accessory_description' => $request->input('accessory_description'),
    ]);

    
        return redirect()->back()->with('success','อัพเดตเสร็จสิ้น');
    }









}
