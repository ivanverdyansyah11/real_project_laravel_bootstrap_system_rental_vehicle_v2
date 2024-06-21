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
                                    <label for="vehicle_image">
                                        Vehicle Image
                                        <div class="wrapper d-flex align-items-end gap-2 " style="margin-top: 8px;">
                                            <img src="{{ file_exists('assets/image/vehicle/' . $vehicle->vehicle_image) && $vehicle->vehicle_image ? asset('assets/image/vehicle/' . $vehicle->vehicle_image) : asset('assets/image/profile/profile-not-found.svg') }}"
                                                alt="Not Found" width="100" class="img-preview">
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="vehicle_series_id">Vehicle Series</label>
                                    <input type="text" class="input w-100" name="name" id="name" readonly
                                        value="{{ $vehicle->vehicle_series->serial_number }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="name">Name</label>
                                    <input type="text" class="input w-100" name="name" id="name" readonly
                                        value="{{ $vehicle->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="stnk_name">Stnk Name</label>
                                    <input type="text" class="input w-100" name="stnk_name" id="stnk_name" readonly
                                        value="{{ $vehicle->stnk_name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="license_plate_number">License Plate Number</label>
                                    <input type="text" class="input w-100" name="license_plate_number"
                                        id="license_plate_number" readonly value="{{ $vehicle->license_plate_number }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="kilometer">Kilometer (Km)</label>
                                    <input type="number" class="input w-100" name="kilometer" id="kilometer" readonly
                                        value="{{ $vehicle->kilometer }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="capacity">Capacity (Person)</label>
                                    <input type="number" class="input w-100" name="capacity" id="capacity" readonly
                                        value="{{ $vehicle->capacity }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="price">Price</label>
                                    <input type="text" class="input w-100" name="price" id="price" readonly
                                        value="{{ formatRupiah($vehicle->price) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="year_of_creation">Year of Creation</label>
                                    <input type="number" class="input w-100" name="year_of_creation" id="year_of_creation"
                                        readonly value="{{ $vehicle->year_of_creation }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="date_purchased">Date Purchased</label>
                                    <input type="text" class="input w-100" name="date_purchased" id="date_purchased"
                                        readonly value="{{ $vehicle->date_purchased }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="color">Color</label>
                                    <input type="text" class="input w-100" name="color" id="color" readonly
                                        value="{{ $vehicle->color }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="frame_number">Frame Number</label>
                                    <input type="text" class="input w-100" name="frame_number" id="frame_number"
                                        readonly value="{{ $vehicle->frame_number }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="machine_number">Machine Number</label>
                                    <input type="text" class="input w-100" name="machine_number" id="machine_number"
                                        readonly value="{{ $vehicle->machine_number }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="status">Status</label>
                                    <input type="text" class="input w-100" name="status" id="status" readonly
                                        value="{{ $vehicle->status == 1 ? 'Active' : 'Unactive' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-group d-flex gap-2">
                                    <a href="{{ route('vehicle.index') }}" class="button-reverse">Back to Vehicle
                                        Page</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
