<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table ="transactions";

    public function orders()
    {
      return $this->belongsTo(Order::class);

    }
}
