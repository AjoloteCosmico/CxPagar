<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provider extends Customer
{
    use HasFactory;

    protected $table = 'customers';
}
