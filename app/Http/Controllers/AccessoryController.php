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
            'accessory_count' => 'required|integer',
            'accessory_price' => 'required|numeric',
            'accessory_description' => 'nullable|string',
            'accessory_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        //
        if ($request->input('accessory_name') === "other"){
            $ac_name = $request->input('other_new');
        }
        else{
            $ac_name = $request->input('accessory_name');
        }



        //เช็ครูปภาพ
        if ($request->hasFile('accessory_image')){
            $imagePath = $request->file('accessory_image')->store('accessory_images','public');
        }
        else{
            $imagePath = null;
        }
        Accessory::create([
            'accessory_name' => $ac_name,
            'accessory_code_new' => $request->input('accessory_code'),
            'accessory_count' => $request->input('accessory_count'),
            'accessory_price' => $request->input('accessory_price'),
            'accessory_description' => $request->input('accessory_description'),
            'accessory_image' => $imagePath
        ]);
        return redirect()->back()->with('success','บันทึกสำเร็จ');
    }


    public function getMaxAccessoryCode($accessory_name)
    {    
        $maxAccessoryCode = Accessory::where('accessory_name', $accessory_name)->max('accessory_code_new'); //ได้ค่าสูงสุดแล้วนะ
        return response()->json(['maxCode' => $maxAccessoryCode]); 
    }


    //แสดงเครื่องประดับ
    public function showAccessory(){
        $accessorytotal = Accessory::all();
        return view('admin.ShowAccessory',compact('accessorytotal'));
    }

    //แสดงรายละเอียดเครื่องประดับ
    public function detailAccessory($id){
        $showdetail = Accessory::findOrFail($id);
        return view('admin.DetailAccessory',compact('showdetail'));
    }
    //แสดงหน้าแก้ไขเครื่องประดับ
    public function editAccessory($id){
        $editaccessory = Accessory::find($id);
        return view('admin.EditAccessory',compact('editaccessory'));
    }













    //////////////////////////////////////////////////////////////////////อัพเดตตตตตตตตต///////////////////////////////
    // public function updateAccessory(Request $request, $id){
    //     $request->validate([
    //         'accessory_price' => 'required|numeric',
    //         'accessory_description' => 'nullable|string',
    //         'accessory_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'action_type' => 'nullable|in:add,remove',
    //         'quantity' => 'nullable|integer|min:1'
    //     ]);
    //     $AccessoryUpdate = Accessory::find($id); //หาก่อนว่าจะบันทึกไว้ในไอดีไหน

    //     //ตรวจสอบว่ามีการแก้ไขราคาไหม
    //     $validateprice = $AccessoryUpdate->accessory_price != $request->input('accessory_price'); //true
    //     $validateaddremove = $AccessoryUpdate->accessory_count != $request->input('quantity'); //true

    //     //เช็ครูปภาพ
    //     if ($request->hasFile('accessory_image')) {
    //         $AccessoryUpdate->accessory_image = $request->file('accessory_image')->store('accessory_images','public');
    //     }



    //     /////////////////////////////////////////ส่วนบันทึกประวัตินะ            
    //     //บันทึกประวัติ(ราคา)
    //     if($validateprice){
    //         $price_history = new Accessoryhistory();
    //         $price_history->accessory_id = $AccessoryUpdate->id;
    //         $price_history->action = "แก้ไขราคา";
    //         $price_history->old_amount = $AccessoryUpdate->accessory_price;
    //         $price_history->new_amount = $request->input('accessory_price');
    //         $price_history->save();
    //     }

    //     //บันทึกประวัติ(เพิ่ม/ลบเครื่องประดับ)
    //     if($validateaddremove){
    //         $Quantity_history = new Accessoryhistory();
    //         $Quantity_history->accessory_id  = $AccessoryUpdate->id ; 
    //         $Quantity_history->action = "เพิ่ม/ลบ";
    //         $Quantity_history->old_amount = $AccessoryUpdate->accessory_count;
    //         $Quantity_history->new_amount = $request->input('quantity');
    //         $Quantity_history->save();
    //     }
        


    //     //เช็คเพิ่มลบ
    //     if ($request->input('action_type') == "add"){
    //         $AccessoryUpdate->accessory_count += $request->input('quantity');
    //     }
    //     elseif($request->input('action_type') == "remove"){
    //         if($request->input('quantity') >  $AccessoryUpdate->accessory_count){
    //             return redirect()->back()->with('T','ไม่สามารถลบเครื่องประดับมากกว่าจำนวนที่มีได้');
    //         }
    //         $AccessoryUpdate->accessory_count -= $request->input('quantity');
    //     }



    //     //อัพเดตลงในฐานข้อมูลนะ
    //     $AccessoryUpdate->update([
    //         'accessory_price' => $request->input('accessory_price'),
    //         'accessory_description' => $request->input('accessory_description'),
    //     ]);

    //     return redirect()->back()->with('success','อัพเดตเสร็จสิ้น');
    // }







    // public function getHistory($id){
    //     $editaccessory = Accessory::find($id);
    //     $history = Accessoryhistory::where('accessory_id', $id)->get();
    //     return view('admin.AccessoryHistory', compact('editaccessory', 'history'));
    // }
    
    


    public function updateAccessory(Request $request, $id){
        $request->validate([
            'accessory_price' => 'required|numeric',
            'accessory_description' => 'nullable|string',
            'accessory_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'action_type' => 'nullable|in:add,remove',
            'quantity' => 'nullable|integer|min:1'
        ]);
        $AccessoryUpdate = Accessory::find($id);
    
        //ตรวจสอบว่ามีการแก้ไขราคาไหม
        $validateprice = $AccessoryUpdate->accessory_price != $request->input('accessory_price'); //true
    

               //เงือนไตรงประวัติ
               if($AccessoryUpdate->accessory_price > $request->input('accessory_price') ){
                $actionName = "แก้ไขราคาลง";
            }
            elseif($AccessoryUpdate->accessory_price < $request->input('accessory_price')){
                $actionName = "เพิ่มราคาขึ้น";
            }




        //เช็ครูปภาพ
        if ($request->hasFile('accessory_image')) {
            $AccessoryUpdate->accessory_image = $request->file('accessory_image')->store('accessory_images','public');
        }
    
        //เช็คเพิ่มลบ
        if ($request->input('action_type') == "add"){
            $AccessoryUpdate->accessory_count += $request->input('quantity');
        }
        elseif($request->input('action_type') == "remove"){
            if($request->input('quantity') >  $AccessoryUpdate->accessory_count){
                return redirect()->back()->with('T','ไม่สามารถลบเครื่องประดับมากกว่าจำนวนที่มีได้');
            }
            $AccessoryUpdate->accessory_count -= $request->input('quantity');
        }
    

    
 
    
        //บันทึกประวัติ
        if($validateprice){
            $price_history = new Accessoryhistory();
            $price_history->accessory_id = $AccessoryUpdate->id;
            $price_history->action = $actionName;
            $price_history->old_amount = $AccessoryUpdate->accessory_price;
            $price_history->new_amount = $request->input('accessory_price');
            $price_history->save();
        }
    




        //บันทึกลงในฐานข้อมูล
        $AccessoryUpdate->update([
        'accessory_price' => $request->input('accessory_price'),
        'accessory_description' => $request->input('accessory_description'),
    ]);


        return redirect()->back()->with('success','อัพเดตเสร็จสิ้น');
    }
    

    



}
