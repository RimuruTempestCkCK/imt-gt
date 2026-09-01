<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_type',
        'province',
        'email',
        'password',
        'company_type',
        'company_name',
        'pic_name',
        'phone',
        'status',
    ];

    protected $hidden = [
        'password',
    ];
}
