<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // define fillable fields
    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    // No need to set $connection — Stancl switches DB automatically per tenant
}