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
                    <form action="{{ route('booking.store') }}" method="POST" class="form d-flex flex-column gap-3 w-100"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="status" value="1">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="customers_id">Customer</label>
                                    <select class="input w-100 @error('customers_id') input-invalid @enderror"
                                        name="customers_id" id="customers_id" required>
                                        @if (auth()->user()->customer)
                                            <option value="{{ auth()->user()->customer->id }}">
                                                {{ auth()->user()->customer->fullname }}</option>
                                        @else
                                            <option value="">Choose customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->fullname }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('customers_id')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="pickup_date">Pickup Date</label>
                                    <input type="date" class="input w-100 @error('pickup_date') input-invalid @enderror"
                                        name="pickup_date" id="pickup_date" autocomplete="off" required
                                        data-enter="pickup_date">
                                    @error('pickup_date')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="return_date">Return Date</label>
                                    <input type="date" class="input w-100 @error('return_date') input-invalid @enderror"
                                        name="return_date" id="return_date" autocomplete="off" required
                                        data-enter="return_date" disabled>
                                    @error('return_date')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="drivers_id">Driver</label>
                                    <select class="input w-100 @error('drivers_id') input-invalid @enderror"
                                        name="drivers_id" id="drivers_id" data-value="drivers_id">
                                        <option value="">Enter pickup and return date first</option>
                                    </select>
                                    @error('drivers_id')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="vehicles_id">Vehicle</label>
                                    <select class="input w-100 @error('vehicles_id') input-invalid @enderror"
                                        name="vehicles_id" id="vehicles_id" data-value="vehicles_id">
                                        <option value="">Enter pickup and return date first</option>
                                    </select>
                                    @error('vehicles_id')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="send_address">Send Address</label>
                                    <textarea class="input w-100 @error('send_address') input-invalid @enderror" name="send_address" id="send_address"
                                        placeholder="Enter your send address.." autocomplete="off" required rows="4" required></textarea>
                                    @error('send_address')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-group d-flex gap-2">
                                    <button type="submit" class="button-primary-small">Add New Booking</button>
                                    <a href="{{ route('booking.index') }}" class="button-reverse">Cancel Add</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('child-script')
    <script>
        $(document).on('change', '[data-enter="pickup_date"]', function() {
            $('[data-enter="return_date"]').attr('disabled', false);
        });

        $(document).on('change', '[data-enter="return_date"]', function() {
            let pickupDate = $('[data-enter="pickup_date"]').val();
            let returnDate = $('[data-enter="return_date"]').val();
            $('[data-value="drivers_id"] option').remove();
            $('[data-value="vehicles_id"] option').remove();
            $.ajax({
                type: 'get',
                url: '/booking/show-driver-vehicle/' + pickupDate + '/' + returnDate,
                success: function(data) {
                    if (data.status_code == 200) {
                        if (data.drivers.length == 0) {
                            $('[data-value="drivers_id"]').append(
                                `<option value="">No drivers available</option>`
                            )
                        } else {
                            $('[data-value="drivers_id"]').append(
                                `<option value="">Choose driver</option>`
                            )

                            data.drivers.forEach(driver => {
                                $('[data-value="drivers_id"]').append(
                                    `<option value="${ driver.id }">${ driver.fullname }</option>`
                                );
                            });
                        }

                        if (data.vehicles.length == 0) {
                            $('[data-value="vehicles_id"]').append(
                                `<option value="">No vehicles available</option>`
                            )
                        } else {
                            $('[data-value="vehicles_id"]').append(
                                `<option value="">Choose vehicle</option>`
                            )

                            data.vehicles.forEach(vehicle => {
                                $('[data-value="vehicles_id"]').append(
                                    `<option value="${ vehicle.id }">${ vehicle.name } - ${ vehicle.license_plate_number } - ${ vehicle.capacity } person</option>`
                                );
                            });
                        }
                    } else {
                        console.log('Failed to fetch data driver & vehicle!');
                    }
                }
            });
        });
    </script>
@endpush
