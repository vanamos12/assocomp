<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubrique extends Model
{
    use HasFactory;

    const COTISATION = 1;
    const EPARGNE = 2;
    const FONDS_ROULEMENT = 3;
    
    protected $fillable = [
        'company_id',
        'name',
        'debut',
        'fin',
    ];
}
