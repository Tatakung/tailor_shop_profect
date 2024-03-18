<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Dress;
use App\Models\Dresssizehistory;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class TestController extends Controller
{

    // public function testdresstotal(){

    //     $dress = Dress::all() ; 
    //     $dressTypes = Dress::pluck('dress_type')->unique();

    //    return view('test',compact('dress','dressTypes')) ;  
    // } 

    // public function testdetail($id){
    //     $datasize = Size::where('dress_id',$id)->get() ;
    //     $datadress = Dress::find($id) ;  
    //     return view('testdetail',compact('datasize','datadress')) ; 
    // }
    public function form()
    {
        $gettype = Dress::distinct()->pluck('dress_type');
        return view('test', compact('gettype'));
    }

    public function getcode($seleteType)
    {
        $getcode = Dress::where('dress_type', $seleteType)
            ->pluck('dress_code');
        return response()->json($getcode);
    }

    public function getsize($seleteType , $seletecode){
        $getID = Dress::where('dress_type',$seleteType)
                    ->where('dress_code',$seletecode)
                    ->value('id'); 
        $getsize = Size::where('dress_id',$getID)
                    ->pluck('size_name') ; 
        return response()->json($getsize) ; 
    }

    public function typeprice($seleteType,$seleteCode,$seleteSize){
        $seleteSize = trim($seleteSize) ; 
        $getID = Dress::where('dress_type',$seleteType)
                    ->where('dress_code',$seleteCode)
                    ->value('id') ; 
        $get = Size::where('dress_id',$getID)
                ->where('size_name',$seleteSize)
                ->select('price','deposit','amount','id','dress_id') 
                ->first(); 
        return response()->json(['price'=> $get->price , 'deposit'=> $get->deposit , 'amount'=>$get->amount , 'id'=>$get->id , 'dress_id'=>$get->dress_id]) ; 
    }






}
