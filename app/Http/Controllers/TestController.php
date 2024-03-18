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

    public function testdresstotal(){

        $dress = Dress::all() ; 
        $dressTypes = Dress::pluck('dress_type')->unique();

       return view('test',compact('dress','dressTypes')) ;  
    } 

    public function testdetail($id){
        $datasize = Size::where('dress_id',$id)->get() ;
        $datadress = Dress::find($id) ;  
        return view('testdetail',compact('datasize','datadress')) ; 
    }




}
