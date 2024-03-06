<?php

namespace App\Http\Controllers;

use App\Models\Dress;
use App\Models\Size;
use Illuminate\Http\Request;

class NewdressController extends Controller
{

    // public function getdresstype()
    // {
    //     $gettype = Dress::distinct()->pluck('dress_type');
    //     return view('admin.add', compact('gettype'));
    // }

    // public function getmaxcode($dresstype)
    // {
    //     $max = Dress::where('dress_type', $dresstype)
    //         ->max('dress_code');
    //     return response()->json(['max' => $max]);
    // }



    // public function saveadddress(Request $request)
    // {
    //     $request->validate([
    //         'dresscode' => 'required|string' , 
    //         'dresscode' => 'required|numeric' , 
    //         'sizename' => 'required|string' , 
    //         'description' => 'nullable|string' , 
    //         'price' => 'required|numeric' , 
    //         'deposit' => 'required|numeric' , 
    //         'amount' => 'required|numeric' , 
    //         'imagedress' => 'nullable|image|mimes:jpg,png,jpeg|max:2048' , 
    //     ]);

    //     $dress = new Dress;
    //     $dress->dress_code = $request->input('dresscode');


    //     if ($request->input('dresstype')  ===  'other_type') {
    //         if($request->input('inputother') != null){
    //             $dress->dress_type = $request->input('inputother');
    //         }else{
    //             return redirect()->back()->with('fail',"กรุณาใส่ค่าในช่องinput") ; 
    //         }
    //     } else {
    //         $dress->dress_type = $request->input('dresstype');
    //     }

    //     $dress->dress_description = $request->input('description');
    //     if ($request->hasFile('imagedress')) {
    //         $dress->dress_image = $request->file('imagedress')->store('dress_images', 'public');
    //     }
    //     $dress->save();



    //     $size = new Size;
    //     $size->dress_id = $dress->id ; 
    //     $size->size_name = $request->input('sizename');
    //     $size->price = $request->input('price');
    //     $size->deposit = $request->input('deposit');
    //     $size->amount = $request->input('amount');
    //     $size->save();
    //     return redirect()->back()->with('success' , "บันทึกข้อมูลสำเร็จแล้ว") ; 
    // }

    // public function show(){
    //     $dress = Dress::all();
    //     $dressTypes = $dress->pluck('dress_type')->unique();
    //     return view('admin.show', compact('dress', 'dressTypes'));
    // }


    
    // public function showdetail($id){
    //     $size = Size::where('dress_id',$id)
    //     ->get();

    //     $dress = Dress::find($id) ; 

    
    //     return view('admin.showdetail',compact('size','dress')) ; 
    // }





}
