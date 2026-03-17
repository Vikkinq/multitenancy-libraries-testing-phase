<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'amount'
    ];

    public $timestamps = true;

    public function getRouteKeyName(){
        return 'slug';
    }
}
