<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiary_name',
        'relationship',
        'email',
        'password',
        'primary_user_id',
    ];
}
