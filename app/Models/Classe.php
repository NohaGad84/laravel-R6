<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classe extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'classname',
        'capacity',
        'is_fulled',
        'price',
        'time_from',
        'time_to',


    ];
}
