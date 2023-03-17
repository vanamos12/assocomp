<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    Const ACTIF_STATUS = 'actif';
    Const REMBOURSE_STATUS = 'rembourse';
    Const PARTIAL_REMBOURSE_STATUS = 'partialrembourse';

    protected $fillable = [
        'user_id',
        'meeting_id',
        'company_id',
        'amount',
        'status',
        'creation',
        'nextpaymentlimit',
        'total'
    ];

    protected $with = [
        'user',
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
}
