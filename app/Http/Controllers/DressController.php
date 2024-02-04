<?php

namespace App\Http\Controllers;

use App\Models\Dress;
use App\Models\Size;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class DressController extends Controller
{
    //
    public function formdress(){
        $get_dresstype = Dress::distinct()->pluck('dress_type');
        return view('admin.AddDress',compact('get_dresstype'));
    }


    public function storeDress(Request $request){
        $request->validate([
            'dress_code' => 'required|string',
            'dress_type' => 'required|string',
            'dress_description' => 'nullable|string',
            'dress_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size_name' => 'required|string',
            'price' => 'required|numeric',
            'deposit' => 'required|numeric',
            'amount' => 'required|integer',
        ]);
    
        // ตรวจสอบว่า dress_type และ dress_code มีอยู่แล้วหรือไม่
        $dress = Dress::where('dress_type', $request->input('dress_type'))
                      ->where('dress_code', $request->input('dress_code'))
                      ->first();
    
        // ถ้ามี dress_type และ dress_code อยู่แล้ว
        if ($dress) {
            $dress_id = $dress->id; // ให้ใช้ id ที่มีอยู่แล้ว
        } else {             // ถ้าไม่มี dress_type และ dress_code ให้สร้างใหม่

            $newDress = new Dress();

            if($request->input('dress_type') == 'other_type'){
                $newDress->dress_type = $request->input('other_type_new');
            }
            else{
                $newDress->dress_type = $request->input('dress_type');
            }
                
            $newDress->dress_code = $request->input('dress_code');
            $newDress->dress_description = $request->input('dress_description');
    
            if($request->hasFile('dress_image')){
                $imagePath = $request->file('dress_image')->store('dress_images','public');
                $newDress->dress_image = $imagePath;
            }
    
            $newDress->save();
            $dress_id = $newDress->id; // ให้ใช้ id ใหม่ที่สร้างขึ้น
        }
    
        // สร้าง size ใหม่
        $size = new Size();
        $size->dress_id = $dress_id; // ใช้ dress_id ที่ได้จากข้างบน
        $size->size_name = $request->input('size_name');
        $size->price = $request->input('price');
        $size->deposit = $request->input('deposit');
        $size->amount = $request->input('amount');
        $size->save();
    
        return redirect()->back()->with('success','บันทึกข้อมูลสำเร็จแล้ว');
    }
    
    
    public function getDressCodes($dressType){
        $dressCode = Dress::where('dress_type', $dressType)->pluck('dress_code');
        return response()->json($dressCode); //ส่งค่ากลับแบบ json array
    }
















        
}

