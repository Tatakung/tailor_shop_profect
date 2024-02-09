<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accessory extends Model
{
    use HasFactory;
    use SoftDeletes;

    
    protected $fillable = [
        'accessory_name',
        'accessory_code_new',
        'accessory_count',
        'accessory_price',
        'accessory_image',
        'accessory_description',
    ];
    //1-M
    public function accessoryhistories(){
        return $this->hasMany(Accessoryhistory::class,'accessory_id');
    }
    



}
