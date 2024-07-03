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
                    <form action="{{ route('vehicle.update', $vehicle->id) }}" method="POST"
                        class="form d-flex flex-column gap-3 w-100" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="vehicle_image">
                                        Vehicle Image
                                        <div class="wrapper d-flex align-items-end gap-2 " style="margin-top: 8px;">
                                            <img src="{{ file_exists('assets/image/vehicle/' . $vehicle->vehicle_image) && $vehicle->vehicle_image ? asset('assets/image/vehicle/' . $vehicle->vehicle_image) : asset('assets/image/profile/profile-not-found.svg') }}"
                                                alt="Not Found" width="100" class="img-preview">
                                            <input type="file" class="input-hide input-file" id="vehicle_image"
                                                name="vehicle_image">
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
                                        @foreach ($vehicleSeries as $series)
                                            <option value="{{ $series->id }}"
                                                {{ $vehicle->vehicle_series->id == $series->id ? 'selected' : '' }}>
                                                {{ $series->serial_number }}</option>
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
                                        name="name" id="name" autocomplete="off" required
                                        value="{{ $vehicle->name }}">
                                    @error('name')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="stnk_name">Stnk Name</label>
                                    <input type="text" class="input w-100 @error('stnk_name') input-invalid @enderror"
                                        name="stnk_name" id="stnk_name" autocomplete="off" required
                                        value="{{ $vehicle->stnk_name }}">
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
                                        name="license_plate_number" id="license_plate_number" autocomplete="off" required
                                        value="{{ $vehicle->license_plate_number }}">
                                    @error('license_plate_number')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="kilometer">Kilometer (Km)</label>
                                    <input type="number" class="input w-100 @error('kilometer') input-invalid @enderror"
                                        name="kilometer" id="kilometer" autocomplete="off" required
                                        value="{{ $vehicle->kilometer }}">
                                    @error('kilometer')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="capacity">Capacity (Person)</label>
                                    <input type="number" class="input w-100 @error('capacity') input-invalid @enderror"
                                        name="capacity" id="capacity" autocomplete="off" required
                                        value="{{ $vehicle->capacity }}">
                                    @error('capacity')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="price">Price</label>
                                    <input type="text" class="input w-100 @error('price') input-invalid @enderror"
                                        name="price" id="price" autocomplete="off" required
                                        value="{{ $vehicle->price }}">
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
                                        name="year_of_creation" id="year_of_creation" autocomplete="off" required
                                        maxlength="4" value="{{ $vehicle->year_of_creation }}">
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
                                        name="date_purchased" id="date_purchased" autocomplete="off" required
                                        value="{{ $vehicle->date_purchased }}">
                                    @error('date_purchased')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="color">Color</label>
                                    <input type="text" class="input w-100 @error('color') input-invalid @enderror"
                                        name="color" id="color" autocomplete="off" required
                                        value="{{ $vehicle->color }}">
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
                                        name="frame_number" id="frame_number" autocomplete="off" required
                                        value="{{ $vehicle->frame_number }}">
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
                                        name="machine_number" id="machine_number" autocomplete="off" required
                                        value="{{ $vehicle->machine_number }}">
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
                                        <option value="1" {{ $vehicle->status == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ $vehicle->status == 0 ? 'selected' : '' }}>Unactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-group d-flex gap-2">
                                    <button type="submit" class="button-primary-small">Save Changes</button>
                                    <a href="{{ route('vehicle.index') }}" class="button-reverse">Cancel Edit</a>
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

        let price = document.getElementById('price')
        price.value = formatRupiah(price.value, 'Rp. ');
        price.addEventListener('keyup', function(e) {
            price.value = formatRupiah(this.value, 'Rp. ');
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
