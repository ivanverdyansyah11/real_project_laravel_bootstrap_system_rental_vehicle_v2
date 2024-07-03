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
                    <form action="{{ route('return-transaction.store') }}" method="POST"
                        class="form d-flex flex-column gap-3 w-100" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="transactions_id" value="{{ $transaction->id }}">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="customers_id">Customer</label>
                                    <input type="text" class="input w-100" id="customers_id" readonly
                                        value="{{ $transaction->booking->customer->fullname }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="drivers_id">Driver</label>
                                    <input type="text" class="input w-100" id="drivers_id" readonly
                                        value="{{ $transaction->booking->driver != null ? $transaction->booking->driver->fullname : '-' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="vehicles_id">Vehicle</label>
                                    <input type="text" class="input w-100" id="vehicles_id" readonly
                                        value="{{ $transaction->booking->vehicle->name . ' - ' . $transaction->booking->vehicle->license_plate_number . ' - ' . $transaction->booking->vehicle->capacity . ' person' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="total_price">Total Price</label>
                                    <input type="text" class="input w-100" id="total_price" readonly
                                        value="{{ formatRupiah($transaction->total_price) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="total_paid">Total Paid</label>
                                    <input type="text" class="input w-100" id="total_paid" readonly
                                        value="{{ formatRupiah($transaction->total_paid) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="total_change">Total Change</label>
                                    <input type="text" class="input w-100" id="total_change" readonly
                                        value="{{ formatRupiah($transaction->total_change) }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="return_date">Return Date</label>
                                    <input type="date" class="input w-100" name="return_date" id="return_date" required>
                                    @error('return_date')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="return_kilometer">Return Kilometer (Km)</label>
                                    <input type="number" class="input w-100" name="return_kilometer" id="return_kilometer"
                                        required placeholder="Enter your return kilometer..">
                                    @error('return_kilometer')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="late_returning">Late Returning</label>
                                    <select class="input w-100" name="late_returning" id="late_returning" required>
                                        <option value="">Choose condition returning</option>
                                        <option value="1">Late</option>
                                        <option value="0">Not Late</option>
                                    </select>
                                    @error('late_returning')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="description">Description</label>
                                    <textarea class="input w-100 @error('description') input-invalid @enderror" name="description" id="description"
                                        placeholder="Enter your description.." autocomplete="off" rows="4"></textarea>
                                    @error('description')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-group d-flex gap-2">
                                    <button type="submit" class="button-primary-small">Return Transaction</button>
                                    <a href="{{ route('return-transaction.index') }}" class="button-reverse">Cancel
                                        Return</a>
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
        const totalPrice = document.querySelector('#total_price');
        const totalPaid = document.querySelector('#total_paid');
        const totalChange = document.querySelector('#total_change');

        totalPaid.addEventListener('keyup', function() {
            if (parseInt(totalPaid.value) < parseInt(totalPrice.value)) {
                totalChange.value = '0'
            } else {
                totalChange.value = totalPaid.value - totalPrice.value
            }
        })

        const tagImage = document.querySelector('.img-preview');
        const inputImage = document.querySelector('.input-file');

        inputImage.addEventListener('change', function() {
            tagImage.src = URL.createObjectURL(inputImage.files[0]);
        });
    </script>
@endpush
