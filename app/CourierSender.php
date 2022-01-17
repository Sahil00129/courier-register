<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierSender extends Model
{
    use HasFactory;

    protected $table = 'new_courier_sender';
    protected $fillable = [
        'name_company','location','docket_no','docket_date','document_details','telephone_no','courier_name','department','catagories','checked_by','given_to'
    ];
}
