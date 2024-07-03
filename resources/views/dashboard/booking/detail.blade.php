@extends('template.main')

@section('content-dashboard')
    <div class="content container mt-4">
        <div class="row">
            <div class="col-12">
                @if ($booking->status == 2)
                    <div class="alert alert-danger w-100 mb-3" role="alert">
                        This vehicle is already booked for that date!
                    </div>
                @endif
            </div>
            <div class="col-12">
                <div class="card-default">
                    <form class="form d-flex flex-column gap-3 w-100">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="customers_id">Customer</label>
                                    <input type="text" class="input w-100" name="customers_id" id="customers_id" readonly
                                        value="{{ $booking->customer->fullname }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="pickup_date">Pickup Date</label>
                                    <input type="text" class="input w-100" name="pickup_date" id="pickup_date" readonly
                                        value="{{ $booking->pickup_date }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="return_date">Return Date</label>
                                    <input type="text" class="input w-100" name="return_date" id="return_date" readonly
                                        value="{{ $booking->return_date }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="drivers_id">Driver</label>
                                    <input type="text" class="input w-100" name="drivers_id" id="drivers_id" readonly
                                        value="{{ $booking->driver != null ? $booking->driver->fullname : '-' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="vehicles_id">Vehicle</label>
                                    <input type="text" class="input w-100" name="vehicles_id" id="vehicles_id" readonly
                                        value="{{ $booking->vehicle->name . ' - ' . $booking->vehicle->license_plate_number . ' - ' . $booking->vehicle->capacity . ' person' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="send_address">Send Address</label>
                                    <textarea class="input w-100" name="send_address" id="send_address" readonly rows="4">{{ $booking->send_address }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-group d-flex gap-2">
                                    <a href="{{ route('booking.index') }}" class="button-reverse">Back to Booking Page</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
