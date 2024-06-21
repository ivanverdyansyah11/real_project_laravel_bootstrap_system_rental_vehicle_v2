<?php

namespace App\Repositories;

use App\Models\ReturnTransaction;
use App\Models\Transaction;
use Carbon\Carbon;

class ReturnTransactionRepositories
{
    public function __construct(
        protected readonly Transaction $transaction,
        protected readonly ReturnTransaction $returnTransaction,
    ) {
    }

    public function findAllWithPaginate($request)
    {
        if ($request->filled('pickup_date') && $request->filled('return_date')) {
            $pickupDate = Carbon::parse($request->pickup_date)->startOfDay();
            $returnDate = Carbon::parse($request->return_date)->endOfDay();

            if (auth()->user()->admin) {
                return $this->transaction->whereHas('booking', function ($query) use ($pickupDate, $returnDate) {
                    $query->where('status', 1)
                        ->where(function ($query) use ($pickupDate, $returnDate) {
                            $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                                ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                                ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                                    $query->where('pickup_date', '<=', $pickupDate)
                                        ->where('return_date', '>=', $returnDate);
                                });
                        });
                })->paginate(6);
            } elseif (auth()->user()->driver) {
                return $this->transaction->whereHas('booking', function ($query) use ($pickupDate, $returnDate) {
                    $query->where('drivers_id', auth()->user()->driver->id)
                        ->where('status', 1)
                        ->where(function ($query) use ($pickupDate, $returnDate) {
                            $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                                ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                                ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                                    $query->where('pickup_date', '<=', $pickupDate)
                                        ->where('return_date', '>=', $returnDate);
                                });
                        });
                })->paginate(6);
            } elseif (auth()->user()->customer) {
                return $this->transaction->whereHas('booking', function ($query) use ($pickupDate, $returnDate) {
                    $query->where('customers_id', auth()->user()->customer->id)
                        ->where('status', 1)
                        ->where(function ($query) use ($pickupDate, $returnDate) {
                            $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                                ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                                ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                                    $query->where('pickup_date', '<=', $pickupDate)
                                        ->where('return_date', '>=', $returnDate);
                                });
                        });
                })->paginate(6);
            }
        } else {
            if (auth()->user()->admin) {
                return $this->transaction->with('booking')->where('status', 1)->latest()->paginate(6);
            } elseif (auth()->user()->driver) {
                return $this->transaction->whereHas('booking', function ($query) {
                    $query->where('drivers_id', auth()->user()->driver->id);
                })->where('status', 1)->latest()->paginate(6);
            } elseif (auth()->user()->customer) {
                return $this->transaction->whereHas('booking', function ($query) {
                    $query->where('customers_id', auth()->user()->customer->id);
                })->where('status', 1)->latest()->paginate(6);
            }
        }
    }

    public function findReturnAllWithPaginate($request)
    {
        if ($request->filled('pickup_date') && $request->filled('return_date')) {
            $pickupDate = Carbon::parse($request->pickup_date)->startOfDay();
            $returnDate = Carbon::parse($request->return_date)->endOfDay();

            if (auth()->user()->admin) {
                return $this->returnTransaction->whereHas('transaction.booking', function ($query) use ($pickupDate, $returnDate) {
                    $query->where(function ($query) use ($pickupDate, $returnDate) {
                        $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                            ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                            ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                                $query->where('pickup_date', '<=', $pickupDate)
                                    ->where('return_date', '>=', $returnDate);
                            });
                    });
                })->paginate(6);
            } elseif (auth()->user()->driver) {
                return $this->returnTransaction->whereHas('transaction.booking', function ($query) use ($pickupDate, $returnDate) {
                    $query->where(function ($query) use ($pickupDate, $returnDate) {
                        $query->where('drivers_id', auth()->user()->driver->id)
                            ->whereBetween('pickup_date', [$pickupDate, $returnDate])
                            ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                            ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                                $query->where('pickup_date', '<=', $pickupDate)
                                    ->where('return_date', '>=', $returnDate);
                            });
                    });
                })->paginate(6);
            } elseif (auth()->user()->customer) {
                return $this->returnTransaction->whereHas('transaction.booking', function ($query) use ($pickupDate, $returnDate) {
                    $query->where(function ($query) use ($pickupDate, $returnDate) {
                        $query->where('customers_id', auth()->user()->customer->id)
                            ->whereBetween('pickup_date', [$pickupDate, $returnDate])
                            ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                            ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                                $query->where('pickup_date', '<=', $pickupDate)
                                    ->where('return_date', '>=', $returnDate);
                            });
                    });
                })->paginate(6);
            }
        } else {
            if (auth()->user()->admin) {
                return $this->returnTransaction->whereHas('transaction.booking')->latest()->paginate(6);
            } elseif (auth()->user()->driver) {
                return $this->returnTransaction->whereHas('transaction.booking', function ($query) {
                    $query->where(function ($query) {
                        $query->where('drivers_id', auth()->user()->driver->id);
                    });
                })->latest()->paginate(6);
            } elseif (auth()->user()->customer) {
                return $this->returnTransaction->whereHas('transaction.booking', function ($query) {
                    $query->where(function ($query) {
                        $query->where('customers_id', auth()->user()->customer->id);
                    });
                })->latest()->paginate(6);
            }
        }
    }

    public function findAll()
    {
        if (auth()->user()->admin) {
            return $this->transaction->with('booking')->latest()->get();
        } elseif (auth()->user()->driver) {
            return $this->transaction->whereHas('booking', function ($query) {
                $query->where('drivers_id', auth()->user()->driver->id);
            })->latest()->get();
        } elseif (auth()->user()->customer) {
            return $this->transaction->whereHas('booking', function ($query) {
                $query->where('customers_id', auth()->user()->customer->id);
            })->latest()->get();
        }
    }

    public function findById(int $id)
    {
        return $this->transaction->with('booking')->where('id', $id)->first();
    }

    public function findReturnById(int $id)
    {
        return $this->returnTransaction->with('transaction')->where('id', $id)->first();
    }

    public function store($request)
    {
        $transaction = $this->findById($request['transactions_id']);
        $transaction->update(['status' => 0]);
        $transaction->booking->vehicle->update(['kilometer' => $request['return_kilometer']]);
        return $this->returnTransaction->create($request);
    }
}
