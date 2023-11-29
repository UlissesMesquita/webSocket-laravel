<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomAuth extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'client_id',
        'client_secret',
        'secret_token',
        'access_token',
        'refresh_token'
    ];
}
