@extends('template.main')

@section('content-dashboard')
    <div class="content container mt-4">
        <div class="row">
            <div class="col-12">
                @if (session()->has('failed'))
                    <div class="alert alert-danger w-100 mb-3" role="alert">
                        {{ session('failed') }}
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
                                        value="{{ $transaction->booking->customer->fullname }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="pickup_date">Pickup Date</label>
                                    <input type="text" class="input w-100" name="pickup_date" id="pickup_date" readonly
                                        value="{{ $transaction->booking->pickup_date }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="return_date">Return Date</label>
                                    <input type="text" class="input w-100" name="return_date" id="return_date" readonly
                                        value="{{ $transaction->booking->return_date }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="drivers_id">Driver</label>
                                    <input type="text" class="input w-100" name="drivers_id" id="drivers_id" readonly
                                        value="{{ $transaction->booking->driver != null ? $transaction->booking->driver->fullname : '-' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="vehicles_id">Vehicle</label>
                                    <input type="text" class="input w-100" name="vehicles_id" id="vehicles_id" readonly
                                        value="{{ $transaction->booking->vehicle->name . ' - ' . $transaction->booking->vehicle->license_plate_number . ' - ' . $transaction->booking->vehicle->capacity . ' person' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="total_price">Total Price</label>
                                    <input type="text" class="input w-100" name="total_price" id="total_price" readonly
                                        value="{{ formatRupiah($transaction->total_price) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="total_paid">Total Paid</label>
                                    <input type="text" class="input w-100" name="total_paid" id="total_paid" readonly
                                        value="{{ formatRupiah($transaction->total_paid) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="total_change">Total Change</label>
                                    <input type="text" class="input w-100" name="total_change" id="total_change" readonly
                                        value="{{ formatRupiah($transaction->total_change) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="payment_method">Payment Method</label>
                                    <input type="text" class="input w-100 text-capitalize" name="payment_method"
                                        id="payment_method" readonly value="{{ $transaction->payment_method }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="send_address">Send Address</label>
                                    <textarea class="input w-100" name="send_address" id="send_address" readonly rows="4">{{ $transaction->booking->send_address }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-group d-flex gap-2">
                                    <a href="{{ route('return-transaction.index') }}" class="button-reverse">Back to Return
                                        Transaction Page</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
