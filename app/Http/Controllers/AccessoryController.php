<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
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

    





    
}
