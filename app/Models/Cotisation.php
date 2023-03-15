<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cotisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'rubrique_id',
        'user_id',
        'meeting_id',
        'amount',
        'creation'
    ];

    protected $with = [
        'user',
        'rubrique'
    ];
    
    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rubrique():BelongsTo{
        return $this->belongsTo(Rubrique::class, 'rubrique_id');
    }
}
