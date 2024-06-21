<div class="topbar d-flex justify-content-between align-items-center container">
    <h3 class="title">{{ $title }}</h3>
    <div class="wrapper-position position-relative d-none d-lg-inline-block">
        <div class="topbar-profile d-flex align-items-center position-relative gap-3">
            <div class="wrapper d-flex align-items-center gap-3">
                @if (auth()->user()->admins_id != null)
                    <div class="wrapper d-flex flex-column align-items-end">
                        <h6>{{ auth()->user()->admin->fullname }}</h6>
                        <p>Admin Management</p>
                    </div>
                    <img src="{{ file_exists('assets/image/profile/' . auth()->user()->admin->profile_image) && auth()->user()->admin->profile_image ? asset('assets/image/profile/' . auth()->user()->admin->profile_image) : asset('assets/image/profile/profile-not-found.svg') }}"
                        class="img-fluid profile-image" alt="Profile Profile" draggable="false">
                @elseif(auth()->user()->drivers_id != null)
                    <div class="wrapper d-flex flex-column align-items-end">
                        <h6>{{ auth()->user()->driver->fullname }}</h6>
                        <p>Driver Rental</p>
                    </div>
                    <img src="{{ file_exists('assets/image/profile/' . auth()->user()->driver->profile_image) && auth()->user()->driver->profile_image ? asset('assets/image/profile/' . auth()->user()->driver->profile_image) : asset('assets/image/profile/profile-not-found.svg') }}"
                        class="img-fluid profile-image" alt="Profile Profile" draggable="false">
                @elseif(auth()->user()->customers_id != null)
                    <div class="wrapper d-flex flex-column align-items-end">
                        <h6>{{ auth()->user()->customer->fullname }}</h6>
                        <p>Customer</p>
                    </div>
                    <img src="{{ file_exists('assets/image/profile/' . auth()->user()->customer->profile_image) && auth()->user()->customer->profile_image ? asset('assets/image/profile/' . auth()->user()->customer->profile_image) : asset('assets/image/profile/profile-not-found.svg') }}"
                        class="img-fluid profile-image" alt="Profile Profile" draggable="false">
                @endif
            </div>
            <div class="arrow-border d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-chevron-down" style="font-size: 0.65rem;"></i>
            </div>
        </div>
        <div class="popup-topbar position-absolute d-flex flex-column">
            <div class="modal-topbar">
                <a href="{{ route('profile.index') }}"
                    class="wrapper d-flex align-items-center gap-2 mb-1 {{ Request::is('profile*') ? 'active' : '' }}">
                    <i class="fa-solid fa-circle-user"></i>
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="wrapper d-flex align-items-center gap-2">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="topbar-hamburger d-lg-none d-flex align-items-center justify-content-center">
        <i class="fa-solid fa-bars-staggered"></i>
    </div>
</div>

<script>
    const topbarProfile = document.querySelector('.topbar-profile');
    const popupTopbar = document.querySelector('.popup-topbar');
    const hamburger = document.querySelector('.topbar-hamburger');
    const sidebar = document.querySelector('.sidebar');

    topbarProfile.addEventListener('click', function() {
        topbarProfile.classList.toggle('active');
        popupTopbar.classList.toggle('active');
    });

    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        sidebar.classList.toggle('active');
    });
</script>
