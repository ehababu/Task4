<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankUp extends Model
{
    use HasFactory;
    public function rentservice()
    {
        return $this->belongsTo(RentService::class,'rentservice_id','order_id');
    }
}
