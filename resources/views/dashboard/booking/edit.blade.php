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
                    <form action="{{ route('booking.update', $booking->id) }}" method="POST"
                        class="form d-flex flex-column gap-3 w-100" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="bookings_id" value="{{ $booking->id }}">
                        <input type="hidden" name="status" value="1">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="customers_id">Customer</label>
                                    <input type="text" class="input w-100" id="customers_id" readonly
                                        value="{{ $booking->customer->fullname }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="drivers_id">Driver</label>
                                    <input type="text" class="input w-100" id="drivers_id" readonly
                                        value="{{ $booking->driver != null ? $booking->driver->fullname : '-' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="vehicles_id">Vehicle</label>
                                    <input type="text" class="input w-100" id="vehicles_id" readonly
                                        value="{{ $booking->vehicle->name . ' - ' . $booking->vehicle->license_plate_number . ' - ' . $booking->vehicle->capacity . ' person' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="vehicle_price">Vehicle Price</label>
                                    <input type="text" class="input w-100" id="vehicle_price" readonly
                                        value="{{ formatRupiah($booking->vehicle->price) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="pickup_date">Pickup Date</label>
                                    <input type="text" class="input w-100" id="pickup_date" readonly
                                        value="{{ $booking->pickup_date }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="return_date">Return Date</label>
                                    <input type="text" class="input w-100" id="return_date" readonly
                                        value="{{ $booking->return_date }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="total_days">Total Days</label>
                                    <input type="text" class="input w-100" id="total_days" readonly
                                        value="{{ $total_days }} days">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="total_price">Total Price</label>
                                    <input type="text" class="input w-100" name="total_price" id="total_price" required
                                        readonly value="{{ $total_days * $booking->vehicle->price }}">
                                    @error('total_price')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="paid_image">
                                        Paid Image
                                        <div class="wrapper d-flex align-items-end gap-2 " style="margin-top: 8px;">
                                            <img src="{{ asset('assets/image/profile/profile-not-found.svg') }}"
                                                alt="Not Found" width="100" class="img-preview">
                                            <input type="file" class="input-hide input-file" id="paid_image"
                                                name="paid_image" required>
                                            <div class="button-file">Choose Image</div>
                                        </div>
                                    </label>
                                    @error('paid_image')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="total_paid">Total Paid</label>
                                    <input type="text" class="input w-100" name="total_paid" id="total_paid" required
                                        placeholder="Enter your total paid..">
                                    @error('total_paid')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="total_change">Total Change</label>
                                    <input type="text" class="input w-100" name="total_change" id="total_change"
                                        required readonly>
                                    @error('total_change')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="payment_method">Payment Method</label>
                                    <select class="input w-100" name="payment_method" id="payment_method" required>
                                        <option value="">Choose payment method</option>
                                        <option value="cash">Cash</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
                                    @error('payment_method')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-group d-flex gap-2">
                                    <button type="submit" class="button-primary-small">Do Transaction</button>
                                    <a href="{{ route('booking.index') }}" class="button-reverse">Cancel Transaction</a>
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
            let totalPriceValue = totalPrice.value.replace('Rp. ', '')
            totalPriceValue = totalPriceValue.replace(/\./g, '')
            let totalPaidValue = totalPaid.value.replace('Rp. ', '')
            totalPaidValue = totalPaidValue.replace(/\./g, '')

            if (parseInt(totalPaidValue) < parseInt(totalPriceValue)) {
                totalChange.value = 'Rp. 0'
            } else {
                totalChange.value = formatRupiah(totalPaidValue - totalPriceValue, 'Rp. ')

                function formatRupiah(angka, prefix) {
                    angka = angka.toString();
                    let number_string = angka.replace(/[^,\d]/g, '').toString(),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }
                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
                }
            }
        })

        const tagImage = document.querySelector('.img-preview');
        const inputImage = document.querySelector('.input-file');

        inputImage.addEventListener('change', function() {
            tagImage.src = URL.createObjectURL(inputImage.files[0]);
        });

        totalPrice.value = formatRupiah(totalPrice.value, 'Rp. ');
        totalPrice.addEventListener('keyup', function(e) {
            totalPrice.value = formatRupiah(this.value, 'Rp. ');
        });

        totalPaid.value = formatRupiah(totalPaid.value, 'Rp. ');
        totalPaid.addEventListener('keyup', function(e) {
            totalPaid.value = formatRupiah(this.value, 'Rp. ');
        });

        function formatRupiah(angka, prefix) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endpush
