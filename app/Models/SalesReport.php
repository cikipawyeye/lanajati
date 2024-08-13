<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReport extends Model
{
   // use HasFactory;

    protected $fillable = [
        //
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
