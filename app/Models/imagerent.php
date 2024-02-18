<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class imagerent extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'order_detail_id',
        'image',
    ];

        //ตารางorderdetailstatus เป็น M - 1 ของตาราง orderdetail
        public function imagerentManytoOneorderdetail(){
            return $this->belongsTo(Orderdetail::class, 'order_detail_id');
        }

}
