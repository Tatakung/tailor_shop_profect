<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dresssizehistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'size_id',
        'action',
        'old_amount',
        'new_amount',
    ];


    //ตารางsize เชื่อมแบบ M - 1 กับ ตารางsize
    public function sizes(){
        return $this->belongsTo(Size::class,'size_id');
    }

}
