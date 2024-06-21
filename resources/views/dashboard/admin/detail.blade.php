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
                                    <label for="profile_image">
                                        Profile Image
                                        <div class="wrapper d-flex align-items-end gap-2 " style="margin-top: 8px;">
                                            <img src="{{ file_exists('assets/image/profile/' . $user->admin->profile_image) && $user->admin->profile_image ? asset('assets/image/profile/' . $user->admin->profile_image) : asset('assets/image/profile/profile-not-found.svg') }}"
                                                alt="Not Found" width="100" class="img-preview">
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="name">Name</label>
                                    <input type="text" class="input w-100" name="name" id="name"
                                        autocomplete="off" readonly value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" class="input w-100" name="fullname" id="fullname"
                                        autocomplete="off" readonly value="{{ $user->admin->fullname }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="email">Email</label>
                                    <input type="email" class="input w-100" name="email" id="email"
                                        autocomplete="off" readonly value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group d-flex flex-column">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="input w-100" name="phone_number" id="phone_number"
                                        autocomplete="off" readonly value="{{ $user->admin->phone_number }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="input w-100" name="nik" id="nik"
                                        autocomplete="off" readonly value="{{ $user->admin->nik }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group d-flex flex-column">
                                    <label for="address">Address</label>
                                    <textarea class="input w-100" name="address" id="address" autocomplete="off" rows="4" readonly>{{ $user->admin->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-group d-flex gap-2">
                                    <a href="{{ route('admin.index') }}" class="button-reverse">Back to Admin Page</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
