<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    use HasFactory;
    protected $table = 'sender_details';
    protected $fillable = [
        'name','type','address','city','distt','pin_code','telephone_no'
    ];
}
