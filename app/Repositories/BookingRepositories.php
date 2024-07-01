<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Transaction;
use App\Utils\UploadFile;
use Carbon\Carbon;

class BookingRepositories
{
    public function __construct(
        protected readonly Booking $booking,
        protected readonly Transaction $transaction,
        protected readonly UploadFile $uploadFile,
    ) {
    }

    public function findAllActiveWithPaginate($request)
    {
        if ($request->filled('pickup_date') && $request->filled('return_date')) {
            $pickupDate = Carbon::parse($request->pickup_date)->startOfDay();
            $returnDate = Carbon::parse($request->return_date)->endOfDay();

            if (auth()->user()->admin) {
                return $this->booking
                    ->where('status', 1)
                    ->where(function ($query) use ($pickupDate, $returnDate) {
                        $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                            ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                            ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                                $query->where('pickup_date', '<=', $pickupDate)
                                    ->where('return_date', '>=', $returnDate);
                            });
                    })
                    ->paginate(6);
            } elseif (auth()->user()->driver) {
                return $this->booking
                    ->where('status', 1)
                    ->where('drivers_id', auth()->user()->driver->id)
                    ->where(function ($query) use ($pickupDate, $returnDate) {
                        $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                            ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                            ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                                $query->where('pickup_date', '<=', $pickupDate)
                                    ->where('return_date', '>=', $returnDate);
                            });
                    })
                    ->paginate(6);
            } elseif (auth()->user()->customer) {
                return $this->booking
                    ->where('status', 1)
                    ->where('customers_id', auth()->user()->customer->id)
                    ->where(function ($query) use ($pickupDate, $returnDate) {
                        $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                            ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                            ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                                $query->where('pickup_date', '<=', $pickupDate)
                                    ->where('return_date', '>=', $returnDate);
                            });
                    })
                    ->paginate(6);
            }
        } else {
            if (auth()->user()->admin) {
                return $this->booking->where('status', 1)->latest()->paginate(6);
            } elseif (auth()->user()->driver) {
                return $this->booking->where('status', 1)->where('drivers_id', auth()->user()->driver->id)->latest()->paginate(6);
            } elseif (auth()->user()->customer) {
                return $this->booking->where('status', 1)->where('customers_id', auth()->user()->customer->id)->latest()->paginate(6);
            }
        }
    }

    public function findAllUnactiveWithPaginate($request)
    {
        if ($request->filled('pickup_date') && $request->filled('return_date')) {
            $pickupDate = Carbon::parse($request->pickup_date)->startOfDay();
            $returnDate = Carbon::parse($request->return_date)->endOfDay();

            return $this->booking
                ->where('status', 0)
                ->where(function ($query) use ($pickupDate, $returnDate) {
                    $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                        ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                        ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                            $query->where('pickup_date', '<=', $pickupDate)
                                ->where('return_date', '>=', $returnDate);
                        });
                })
                ->paginate(6);
        } else {
            return $this->booking->where('status', 0)->latest()->paginate(6);
        }
    }

    public function findAllWithPickupReturnDate(string $pickup_date, string $return_date)
    {
        $pickupDate = Carbon::parse($pickup_date)->startOfDay();
        $returnDate = Carbon::parse($return_date)->endOfDay();

        $bookings = $this->booking
            ->where('status', 1)
            ->where(function ($query) use ($pickupDate, $returnDate) {
                $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                    ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                    ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                        $query->where('pickup_date', '<=', $pickupDate)
                            ->where('return_date', '>=', $returnDate);
                    });
            })
            ->get(['drivers_id', 'vehicles_id']);

        $transactions = $this->transaction
            ->where('status', 1)
            ->whereHas('booking', function ($query) use ($pickupDate, $returnDate) {
                $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                    ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                    ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                        $query->where('pickup_date', '<=', $pickupDate)
                            ->where('return_date', '>=', $returnDate);
                    });
            })
            ->get();

        $driversIdsFromBookings = $bookings->pluck('drivers_id')->toArray();
        $vehiclesIdsFromBookings = $bookings->pluck('vehicles_id')->toArray();
        $driversIdsFromTransactions = $transactions->pluck('booking.drivers_id')->toArray();
        $vehiclesIdsFromTransactions = $transactions->pluck('booking.vehicles_id')->toArray();
        $driversIds = array_merge($driversIdsFromBookings, $driversIdsFromTransactions);
        $vehiclesIds = array_merge($vehiclesIdsFromBookings, $vehiclesIdsFromTransactions);
        $driversIds = array_unique($driversIds);
        $vehiclesIds = array_unique($vehiclesIds);
        return [$driversIds, $vehiclesIds];
    }

    public function findAll()
    {
        return $this->booking->with(['driver', 'customer', 'vehicle'])->latest()->get();
    }

    public function findById(int $id)
    {
        return $this->booking->with(['driver', 'customer', 'vehicle'])->where('id', $id)->first();
    }

    public function store($request)
    {
        return $this->booking->create($request);
    }

    public function update($request, $id)
    {
        $booking = $this->findById($id);
        $request['paid_image'] = $this->uploadFile->uploadSingleFile($request['paid_image'], "assets/image/paid");
        $booking->update(['status' => 0]);
        return $this->transaction->create($request);
    }

    public function delete($id)
    {
        $booking = $this->findById($id);
        return $booking->delete();
    }
}
