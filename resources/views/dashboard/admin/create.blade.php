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
                    <form action="{{ route('admin.store') }}" method="POST" class="form d-flex flex-column gap-3 w-100"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="profile_image">
                                        Profile Image
                                        <div class="wrapper d-flex align-items-end gap-2 " style="margin-top: 8px;">
                                            <img src="{{ asset('assets/image/profile/profile-not-found.svg') }}"
                                                alt="Not Found" width="100" class="img-preview">
                                            <input type="file" class="input-hide input-file" id="profile_image"
                                                name="profile_image">
                                            <div class="button-file">Choose Image</div>
                                        </div>
                                    </label>
                                    @error('profile_image')
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
                                    <label for="fullname">Fullname</label>
                                    <input type="text" class="input w-100 @error('fullname') input-invalid @enderror"
                                        name="fullname" id="fullname" placeholder="Enter your fullname.."
                                        autocomplete="off" required>
                                    @error('fullname')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="email">Email</label>
                                    <input type="email" class="input w-100 @error('email') input-invalid @enderror"
                                        name="email" id="email" placeholder="Enter your email.." autocomplete="off"
                                        required>
                                    @error('email')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="password">Password</label>
                                    <input type="password" class="input w-100 @error('password') input-invalid @enderror"
                                        name="password" id="password" placeholder="Enter your password.."
                                        autocomplete="off" required>
                                    @error('password')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="input w-100 @error('phone_number') input-invalid @enderror"
                                        name="phone_number" id="phone_number" placeholder="Enter your phone number.."
                                        autocomplete="off" required>
                                    @error('phone_number')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="input w-100 @error('nik') input-invalid @enderror"
                                        name="nik" id="nik" placeholder="Enter your nik.." autocomplete="off"
                                        required>
                                    @error('nik')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="address">Address</label>
                                    <textarea class="input w-100 @error('address') input-invalid @enderror" name="address" id="address"
                                        placeholder="Enter your address.." autocomplete="off" required rows="4" required></textarea>
                                    @error('address')
                                        <p class="text-invalid">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-group d-flex gap-2">
                                    <button type="submit" class="button-primary-small">Add New Admin</button>
                                    <a href="{{ route('admin.index') }}" class="button-reverse">Cancel Add</a>
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
