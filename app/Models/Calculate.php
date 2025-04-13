<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calculate extends Model
{
    protected $fillable = [
        'item',
        'unitprice',
        'quantity',
        'total',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}


  
}
