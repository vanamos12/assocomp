<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'creation',
        'nextpaymentlimit',
        'total'
    ];

    Const ACTIF_STATUS = 'actif';
    Const REMBOURSE_STATUS = 'rembourse';
}
