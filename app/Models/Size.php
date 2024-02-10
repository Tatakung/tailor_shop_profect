<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'dress_id',
        'size_name',
        'price',
        'deposit',
        'amount',
    ];
    //sizeเป็น M - 1 ของตาราง dress
    public function dress(){
        return $this->belongsTo(Dress::class, 'dress_id');
    }


    // size 1 - M ของตาราง dressizehistory
    public function dresssizehistories(){
        return $this->hasMany(Dresssizehistory::class,'size_id');
    }
    


}
