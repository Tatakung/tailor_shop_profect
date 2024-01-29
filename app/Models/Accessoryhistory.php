<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accessoryhistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'accessory_id',
        'action',
        'old_amount',
        'new_amount',
    ];
    //M-1
    public function accessory(){
        return $this->belongsTo(Accessory::class,'accessory_id');
    }

}
