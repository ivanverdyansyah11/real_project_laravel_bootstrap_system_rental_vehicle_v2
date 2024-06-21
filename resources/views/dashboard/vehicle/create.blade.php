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
                    <form action="{{ route('vehicle.store') }}" method="POST" class="form d-flex flex-column gap-3 w-100"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="vehicle_image">
                                        Vehicle Image
                                        <div class="wrapper d-flex align-items-end gap-2 " style="margin-top: 8px;">
                                            <img src="{{ asset('assets/image/profile/profile-not-found.svg') }}"
                                                alt="Not Found" width="100" class="img-preview">
                                            <input type="file" class="input-hide input-file" id="vehicle_image"
                                                name="vehicle_image" required>
                                            <div class="button-file">Choose Image</div>
                                        </div>
                                    </label>
                                    @error('vehicle_image')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="vehicle_series_id">Vehicle Series</label>
                                    <select class="input w-100 @error('vehicle_series_id') input-invalid @enderror"
                                        name="vehicle_series_id" id="vehicle_series_id" required>
                                        <option value="">Choose vehicle series</option>
                                        @foreach ($vehicleSeries as $series)
                                            <option value="{{ $series->id }}">{{ $series->serial_number }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_series_id')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="name">Name</label>
                                    <input type="text" class="input w-100 @error('name') input-invalid @enderror"
                                        name="name" id="name" placeholder="Enter your name.." autocomplete="off"
                                        required>
                                    @error('name')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="stnk_name">Stnk Name</label>
                                    <input type="text" class="input w-100 @error('stnk_name') input-invalid @enderror"
                                        name="stnk_name" id="stnk_name" placeholder="Enter your stnk name.."
                                        autocomplete="off" required>
                                    @error('stnk_name')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="license_plate_number">License Plate Number</label>
                                    <input type="text"
                                        class="input w-100 @error('license_plate_number') input-invalid @enderror"
                                        name="license_plate_number" id="license_plate_number"
                                        placeholder="Enter your license plate number.." autocomplete="off" required>
                                    @error('license_plate_number')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="kilometer">Kilometer (Km)</label>
                                    <input type="number" class="input w-100 @error('kilometer') input-invalid @enderror"
                                        name="kilometer" id="kilometer" placeholder="Enter your kilometer.."
                                        autocomplete="off" required>
                                    @error('kilometer')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="capacity">Capacity (Person)</label>
                                    <input type="number" class="input w-100 @error('capacity') input-invalid @enderror"
                                        name="capacity" id="capacity" placeholder="Enter your capacity.."
                                        autocomplete="off" required>
                                    @error('capacity')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="price">Price</label>
                                    <input type="number" class="input w-100 @error('price') input-invalid @enderror"
                                        name="price" id="price" placeholder="Enter your price.." autocomplete="off"
                                        required>
                                    @error('price')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="year_of_creation">Year of Creation</label>
                                    <input type="number"
                                        class="input w-100 @error('year_of_creation') input-invalid @enderror"
                                        name="year_of_creation" id="year_of_creation"
                                        placeholder="Enter your year of creation.." autocomplete="off" required
                                        maxlength="4">
                                    @error('year_of_creation')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="date_purchased">Date Purchased</label>
                                    <input type="date"
                                        class="input w-100 @error('date_purchased') input-invalid @enderror"
                                        name="date_purchased" id="date_purchased"
                                        placeholder="Enter your date purchased.." autocomplete="off" required>
                                    @error('date_purchased')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="color">Color</label>
                                    <input type="text" class="input w-100 @error('color') input-invalid @enderror"
                                        name="color" id="color" placeholder="Enter your color.."
                                        autocomplete="off" required>
                                    @error('color')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="frame_number">Frame Number</label>
                                    <input type="text"
                                        class="input w-100 @error('frame_number') input-invalid @enderror"
                                        name="frame_number" id="frame_number" placeholder="Enter your frame number.."
                                        autocomplete="off" required>
                                    @error('frame_number')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="machine_number">Machine Number</label>
                                    <input type="text"
                                        class="input w-100 @error('machine_number') input-invalid @enderror"
                                        name="machine_number" id="machine_number"
                                        placeholder="Enter your machine number.." autocomplete="off" required>
                                    @error('machine_number')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="status">Status</label>
                                    <select class="input w-100 @error('status') input-invalid @enderror" name="status"
                                        id="status" required>
                                        <option value="">Choose status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Unactive</option>
                                    </select>
                                    @error('status')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-group d-flex gap-2">
                                    <button type="submit" class="button-primary-small">Add New Vehicle</button>
                                    <a href="{{ route('vehicle.index') }}" class="button-reverse">Cancel Add</a>
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
        const tagImage = document.querySelector('.img-preview');
        const inputImage = document.querySelector('.input-file');

        inputImage.addEventListener('change', function() {
            tagImage.src = URL.createObjectURL(inputImage.files[0]);
        });
    </script>
@endpush
