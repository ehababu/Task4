<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentService extends Model
{
    use HasFactory;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'order_id';

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function booking()
    {
        return $this->hasOne(Booking::class, 'rentservice_id', 'order_id');
    }
    public function bankups()
    {
        return $this->hasMany(BankUp::class, 'rentservice_id', 'order_id');
    }

    public function getTotalPaidAttribute()
    {         //total_paid

        $total = 0;
        foreach ($this->bankups as $bankup) {
            $total += $bankup->amount_collected;
        }
        return $total;
    }

    public function getCostPriceAttribute()           //cost_price
    {
        $cost = 0;
        $startDate = new DateTime($this->start_date);
        $endDate = new DateTime($this->expiry_date);
        $interval = date_diff($startDate, $endDate);
        switch ($this->service->cost_type) {
            case 'سنوي':
                $year = $interval->days / 365;
                $cost =  $year * $this->service->cost_amount;
                break;

            case 'شهري':
                $months = $interval->days / 30;
                $cost = $months * $this->service->cost_amount;
                break;

            case 'يومي':
                $cost = $interval->days * $this->service->cost_amount;
                break;
        }
        return round($cost, 2)
        ;
    }
}