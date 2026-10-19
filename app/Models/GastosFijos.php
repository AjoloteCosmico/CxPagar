<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastosFijos extends Model
{
    use HasFactory;

    protected $table = 'gastos_fijos';

    protected $fillable = [
        'description',
        'amount',
        'coin_id',
        'periodicity',
        'type',
    ];

    public function coin()
    {
        return $this->belongsTo(Coin::class, 'coin_id');
    }
}
