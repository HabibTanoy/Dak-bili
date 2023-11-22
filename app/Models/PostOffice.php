<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostOffice extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function image(){
        return $this->hasMany(PostOfficeImage::class,'post_office_id');
    }
}
