<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Repositories\BookingRepositories;
use App\Repositories\TransactionRepositories;
use App\Repositories\CustomerRepositories;
use App\Repositories\DriverRepositories;
use App\Repositories\VehicleRepositories;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function __construct(
        protected readonly BookingRepositories $bookingRepositories,
        protected readonly TransactionRepositories $transactionRepositories,
        protected readonly DriverRepositories $driverRepositories,
        protected readonly CustomerRepositories $customerRepositories,
        protected readonly VehicleRepositories $vehicleRepositories,
    ) {
    }

    public function index(Request $request): View
    {
        return view('dashboard.booking.index', [
            'title' => 'Booking Page',
            'page' => 'Dashboard',
            'bookings' => $this->bookingRepositories->findAllActiveWithPaginate($request),
            'booking_transactions' => $this->transactionRepositories->findAll(),
            'search' => $request,
        ]);
    }

    public function show(int $id): View
    {
        return view('dashboard.booking.detail', [
            'title' => 'Detail Booking Page',
            'page' => 'Dashboard',
            'booking' => $this->bookingRepositories->findById($id),
        ]);
    }

    public function showDriverVehicle(string $pickup_date, string $return_date): JsonResponse
    {
        try {
            $bookingSelected = $this->bookingRepositories->findAllWithPickupReturnDate($pickup_date, $return_date);
            $driverAvailable = $this->driverRepositories->findAllWithBookingStatus($bookingSelected[0]);
            $vehicleAvailable = $this->vehicleRepositories->findAllWithBookingStatus($bookingSelected[1]);
            return response()->json([
                'status_code' => 200,
                'drivers' => $driverAvailable,
                'vehicles' => $vehicleAvailable,
            ]);
        } catch (\Exception $e) {
            logger($e->getMessage());
            return response()->json([
                'status_code' => 404,
            ]);
        }
    }

    public function create(): View
    {
        return view('dashboard.booking.create', [
            'title' => 'Create Booking Page',
            'page' => 'Dashboard',
            'customers' => $this->customerRepositories->findAll(),
        ]);
    }

    public function store(BookingStoreRequest $request): RedirectResponse
    {
        try {
            $this->bookingRepositories->store($request->validated());
            return redirect(route('booking.index'))->with('success', 'Successfully to add new booking!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('booking.create'))->with('failed', 'Failed to add new booking!');
        }
    }

    public function edit(int $id): View
    {
        $booking = $this->bookingRepositories->findById($id);
        $startDate = Carbon::create($booking->pickup_date);
        $endDate = Carbon::create($booking->return_date);
        $totalDays = $startDate->diffInDays($endDate);
        return view('dashboard.booking.edit', [
            'title' => 'Edit Booking Page',
            'page' => 'Dashboard',
            'booking' => $booking,
            'total_days' => $totalDays,
        ]);
    }

    public function update(BookingUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->bookingRepositories->update($request->validated(), $id);
            return redirect(route('booking.index'))->with('success', 'Successfully to add order!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Failed to add order!');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->bookingRepositories->delete($id);
            return redirect(route('booking.index'))->with('success', 'Successfully to delete booking!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('booking.index'))->with('failed', 'Failed to delete booking!');
        }
    }
}
