<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForCompany extends Model
{
    use HasFactory;

    protected $table = 'for_companies';
    protected $fillable = [
        'for_company'
    ];
}
