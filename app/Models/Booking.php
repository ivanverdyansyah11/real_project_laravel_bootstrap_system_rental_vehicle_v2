<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'drivers_id')->withTrashed();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id')->withTrashed();
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicles_id')->withTrashed();
    }
}
