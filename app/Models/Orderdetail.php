<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orderdetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'accessory_id',
        'dress_id',
        'size_id',
        'order_id',
        'employee_id',
        'late_charge',
        'real_pickup_date',
        'real_return_date',
        'type_dress',
        'type_order',
        'amount',
        'price',
        'deposit',
        'note',
        'damage_insurance',
        'total_damage_insurance',
        'cause_for_insurance',
        'cloth',
        'status_detail',
        'status_payment',
        'late_fee',
        'total_cost',
        'total_decoration_price',
        'total_fitting_price',
        'pickup_date' , 
        'return_date' ,
    ];

    //ตารางorderdetail เป็น M - 1 ของตาราง order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    //ตาราง orderdetail เป็น 1 - M ของตาราง decoration
    public function decorations()
    {
        return $this->hasMany(Decoration::class, 'order_detail_id');
    }


    //ตาราง orderdetail เป็น 1 - M ของตาราง cost
    public function costs()
    {
        return $this->hasMany(Cost::class, 'order_detail_id');
    }

    //ตาราง orderdetail เป็น 1 - M ของตาราง date
    public function dates()
    {
        return $this->hasMany(Date::class, 'order_detail_id');
    }


    //ตาราง orderdetail เป็น 1 - M ของตาราง payment
    public function paymentstatuses()
    {
        return $this->hasMany(Paymentstatus::class, 'order_detail_id');
    }

    //ตาราง orderdetail เป็น 1 - M ของตาราง orderdetailstatuses
    public function orderdetailstatuses()
    {
        return $this->hasMany(Orderdetailstatus::class, 'order_detail_id');
    }

    //ตาราง orderdetail เป็น 1 - M ของตาราง imagerent
    public function imagerent()
    {
        return $this->hasMany(imagerent::class, 'order_detail_id');
    }


    //ตาราง orderdetail เป็น 1 - M ของตาราง fitting
    public function fitting()
    {
        return $this->hasMany(Fitting::class, 'order_detail_id');
    }
}
