<?php

namespace App\Http\Controllers;

use App\Repositories\BookingRepositories;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportBookingController extends Controller
{
    public function __construct(
        protected readonly BookingRepositories $bookingRepositories,
    ) {
    }

    public function index(Request $request): View
    {
        return view('dashboard.report-booking.index', [
            'title' => 'Report Booking Page',
            'page' => 'Dashboard',
            'bookings' => $this->bookingRepositories->findAllActiveWithPaginate($request),
            'search' => $request,
        ]);
    }

    public function show(int $id): View
    {
        return view('dashboard.report-booking.detail', [
            'title' => 'Detail Report Booking Page',
            'page' => 'Dashboard',
            'booking' => $this->bookingRepositories->findById($id),
        ]);
    }
}
