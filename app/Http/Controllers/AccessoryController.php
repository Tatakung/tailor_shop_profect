<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

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

        
        if ($request->hasFile('accessory_image')){
            $imagePath = $request->file('accessory_image')->store('accessory_images','public');
        }
        else{
            $imagePath = null;
        }
        Accessory::create([
            'accessory_name' => $request->input('accessory_name'),
            'accessory_code' => $request->input('accessory_code'),
            'accessory_count' => $request->input('accessory_count'),
            'accessory_price' => $request->input('accessory_price'),
            'accessory_description' => $request->input('accessory_description'),
            'accessory_image' => $imagePath
        ]);
        return redirect()->back()->with('success','บันทึกสำเร็จ');
    }



}
