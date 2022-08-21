<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function getActiveStatusAttribute()
    {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    public function coin()
    {
        return $this->belongsTo(Coin::class);
    }

    public function rentServices() {
        return $this->hasMany(RentService::class);
    }
}