<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;

    Const LOANED = 'loaned';
    Const NOT_LOANED = 'not_loaned';
    Const PARTIAL_LOANED = 'partial_loaned';

    protected $fillable = [
        'user_id',
        'amount',
        'creation',
        'meeting_id',
        'company_id',
        'loaned',
        'textloaned',
        'partloanamount'
    ];

    protected $with = [
        'user',
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
}
