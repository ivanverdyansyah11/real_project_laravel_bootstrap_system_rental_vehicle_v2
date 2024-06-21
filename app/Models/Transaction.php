<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'bookings_id')->withTrashed();
    }
}
