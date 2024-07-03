<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepositories
{
    public function __construct(
        protected readonly Transaction $transaction,
    ) {
    }

    public function findAll()
    {
        return $this->transaction->whereHas('booking', function ($query) {
            $query->where('status', 0);
        })->where('status', 1)->latest()->pluck('bookings_id')->toArray();
    }
}
