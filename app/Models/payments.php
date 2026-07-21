<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'concept',
        'percentage',
        'amount',
        'date',
        'status',
        'forma_pago',
        'no_cuenta',
        'hora_recibido',
        'condiciones',
    ];
}
