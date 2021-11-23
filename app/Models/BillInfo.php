<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillInfo extends BaseModel
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'tele_bill_info';
}
