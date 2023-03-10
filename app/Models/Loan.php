<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'loaned',
        'textloaned',
        'partloanamount'
    ];
}
