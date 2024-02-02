<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dress extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'dress_code',
        'dress_type',
        'dress_image',
        'dress_description',
    ];
    //dressเป็น 1 - M ของตาราง size
    public function sizes(){
        return $this->hasMany(Size::class, 'dress_id');
    }
}
