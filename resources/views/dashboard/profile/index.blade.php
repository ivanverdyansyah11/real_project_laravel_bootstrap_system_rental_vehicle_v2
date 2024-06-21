@extends('template.main')

@section('content-dashboard')
    <div class="content container mt-4">
        <div class="row">
            <div class="col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success w-100 mb-3" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif (session()->has('failed'))
                    <div class="alert alert-danger w-100 mb-3" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif
            </div>
            <div class="col-12">
                <div class="card-default">
                    <form action="{{ route('profile.update', $user->id) }}" method="POST"
                        class="form d-flex flex-column gap-3 w-100" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="input-group d-flex flex-column w-100 pe-xl-4">
                                    <label for="profile_image w-100">
                                        Profile Image
                                        <div class="wrapper d-flex flex-column align-items-end gap-2 w-100"
                                            style="margin-top: 8px;">
                                            <img src="{{ file_exists('assets/image/profile/' . $user_role->profile_image) && $user_role->profile_image ? asset('assets/image/profile/' . $user_role->profile_image) : asset('assets/image/profile/profile-not-found.svg') }}"
                                                alt="Not Found" class="img-preview"
                                                style="width: 100%; height: 100%; aspect-ratio: 1/1;">
                                            <input type="file" class="input-hide input-file" id="profile_image"
                                                name="profile_image">
                                            <label class="button-file w-100 text-center" for="profile_image">Choose
                                                Image</label>
                                        </div>
                                    </label>
                                    @error('profile_image')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="input-group d-flex flex-column">
                                            <label for="name">Name</label>
                                            <input type="text" class="input w-100 @error('name') input-invalid @enderror"
                                                name="name" id="name" value="{{ $user->name }}" autocomplete="off"
                                                required>
                                            @error('name')
                                                <p class="text-invalid">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group d-flex flex-column">
                                            <label for="fullname">Fullname</label>
                                            <input type="text"
                                                class="input w-100 @error('fullname') input-invalid @enderror"
                                                name="fullname" id="fullname" value="{{ $user_role->fullname }}"
                                                autocomplete="off" required>
                                            @error('fullname')
                                                <p class="text-invalid">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group d-flex flex-column">
                                            <label for="email">Email</label>
                                            <input type="email"
                                                class="input w-100 @error('email') input-invalid @enderror" name="email"
                                                id="email" value="{{ $user->email }}" autocomplete="off" required>
                                            @error('email')
                                                <p class="text-invalid">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group d-flex flex-column">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text"
                                                class="input w-100 @error('phone_number') input-invalid @enderror"
                                                name="phone_number" id="phone_number"
                                                value="{{ $user_role->phone_number }}" autocomplete="off" required>
                                            @error('phone_number')
                                                <p class="text-invalid">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group d-flex flex-column">
                                            <label for="old_password">Old Password</label>
                                            <input type="password"
                                                class="input w-100 @error('old_password') input-invalid @enderror"
                                                name="old_password" id="old_password" autocomplete="off"
                                                placeholder="Enter your old password..">
                                            @error('old_password')
                                                <p class="text-invalid">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group d-flex flex-column">
                                            <label for="password">New Password</label>
                                            <input type="password"
                                                class="input w-100 @error('password') input-invalid @enderror"
                                                name="password" id="password" autocomplete="off"
                                                placeholder="Enter your new password..">
                                            @error('password')
                                                <p class="text-invalid">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group d-flex flex-column">
                                            <label for="nik">NIK</label>
                                            <input type="text" class="input w-100 @error('nik') input-invalid @enderror"
                                                name="nik" id="nik" value="{{ $user_role->nik }}"
                                                autocomplete="off" required>
                                            @error('nik')
                                                <p class="text-invalid">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    @if (auth()->user()->driver || auth()->user()->customer)
                                        <div class="col-md-6">
                                            <div class="input-group d-flex flex-column">
                                                <label for="identity_card_number">Identity Card Number</label>
                                                <input type="text"
                                                    class="input w-100 @error('identity_card_number') input-invalid @enderror"
                                                    name="identity_card_number" id="identity_card_number"
                                                    value="{{ $user_role->identity_card_number }}" autocomplete="off"
                                                    required>
                                                @error('identity_card_number')
                                                    <p class="text-invalid">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        @if (auth()->user()->driver)
                                            <div class="col-md-6">
                                                <div class="input-group d-flex flex-column">
                                                    <label for="drivers_license_number">Drivers License Number</label>
                                                    <input type="text"
                                                        class="input w-100 @error('drivers_license_number') input-invalid @enderror"
                                                        name="drivers_license_number" id="drivers_license_number"
                                                        value="{{ $user_role->drivers_license_number }}"
                                                        autocomplete="off" required>
                                                    @error('drivers_license_number')
                                                        <p class="text-invalid">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group d-flex flex-column">
                                                    <label for="status">Status Driver</label>
                                                    <select class="input w-100 @error('status') input-invalid @enderror"
                                                        name="status" id="status" required>
                                                        <option value="1"
                                                            {{ $user_role->status == 1 ? 'selected' : '' }}>Active
                                                        </option>
                                                        <option value="0"
                                                            {{ $user_role->status == 0 ? 'selected' : '' }}>Unactive
                                                        </option>
                                                    </select>
                                                    @error('status')
                                                        <p class="text-invalid">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        @elseif (auth()->user()->customer)
                                            <div class="col-md-6">
                                                <div class="input-group d-flex flex-column">
                                                    <label for="family_card_number">Family Card Number</label>
                                                    <input type="text"
                                                        class="input w-100 @error('family_card_number') input-invalid @enderror"
                                                        name="family_card_number" id="family_card_number"
                                                        value="{{ $user_role->family_card_number }}" autocomplete="off"
                                                        required>
                                                    @error('family_card_number')
                                                        <p class="text-invalid">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="col-12">
                                        <div class="input-group d-flex flex-column">
                                            <label for="address">Address</label>
                                            <textarea class="input w-100 @error('address') input-invalid @enderror" name="address" id="address"
                                                autocomplete="off" rows="4" required>{{ $user_role->address }}</textarea>
                                            @error('address')
                                                <p class="text-invalid">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="button-group d-flex gap-2">
                                            <button type="submit" class="button-primary-small">Save Changes</button>
                                        </div>
                                    </div>
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
