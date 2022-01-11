<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierSender extends Model
{
    use HasFactory;

    protected $table = 'new_courier_sender';
    protected $fillable = [
        'name_company','address','city','distt','pin_code','document','telephone_no','courier_name'
    ];
}
