<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'clave_alterna',
        'type',
        'product',
        'description',
        'family',
        'inventariable',
        'public_price',
        'coin_id',
        'provider_id',
        'observations',
        'iva',
        'ieps',
        'isr',
        'retention_iva',
        'retention_isr',
        'other_retentions',
    ];

    protected $casts = [
        'inventariable' => 'boolean',
    ];
}
