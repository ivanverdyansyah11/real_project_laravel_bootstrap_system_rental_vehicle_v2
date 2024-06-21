<nav class="sidebar d-flex flex-column align-items-center">
    <a href="{{ route('dashboard.index') }}">
        <img src="{{ asset('assets/image/brand/brand-logo.svg') }}" alt="Brand Logo" class="brand-logo">
    </a>
    <div class="sidebar-menu d-flex flex-column w-100">
        <a href="{{ route('dashboard.index') }}"
            class="menu-link d-flex align-items-center gap-2 {{ Route::is('dashboard*') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge"></i>
            Dashboard
        </a>
        @if (auth()->user()->admin || auth()->user()->customer)
            @if (auth()->user()->admin)
                <button type="button"
                    class="menu-link d-flex flex-column parent-menu {{ Route::is('admin*') || Route::is('driver*') || Route::is('customer*') ? 'active' : '' }}">
                    <div class="wrapper d-flex align-items-center gap-2">
                        <i class="fa-solid fa-database"></i>
                        User
                    </div>
                    <div class="child-menu flex-column gap-1">
                        <a href="{{ route('admin.index') }}" class="{{ Route::is('admin*') ? 'active' : '' }}">Admin</a>
                        <a href="{{ route('driver.index') }}"
                            class="{{ Route::is('driver*') ? 'active' : '' }}">Driver</a>
                        <a href="{{ route('customer.index') }}"
                            class="{{ Route::is('customer*') ? 'active' : '' }}">Customer</a>
                    </div>
                </button>
            @endif
            <button type="button"
                class="menu-link d-flex flex-column parent-menu {{ Route::is('vehicle.index') || Route::is('vehicle.show') || Route::is('vehicle.create') || Route::is('vehicle.edit') || Route::is('vehicle-brand*') || Route::is('vehicle-series*') ? 'active' : '' }}">
                <div class="wrapper d-flex align-items-center gap-2">
                    <i class="fa-solid fa-car-rear"></i>
                    Vehicle
                </div>
                <div class="child-menu flex-column gap-1">
                    <a href="{{ route('vehicle.index') }}"
                        class="{{ Route::is('vehicle.index') || Route::is('vehicle.show') || Route::is('vehicle.create') || Route::is('vehicle.edit') ? 'active' : '' }}">Vehicle</a>
                    @if (auth()->user()->admin)
                        <a href="{{ route('vehicle-brand.index') }}"
                            class="{{ Route::is('vehicle-brand*') ? 'active' : '' }}">Vehicle Brand</a>
                        <a href="{{ route('vehicle-series.index') }}"
                            class="{{ Route::is('vehicle-series*') ? 'active' : '' }}">Vehicle Series</a>
                    @endif
                </div>
            </button>
            <a href="{{ route('booking.index') }}"
                class="menu-link d-flex align-items-center gap-2 {{ Route::is('booking*') ? 'active' : '' }}">
                <i class="fa-solid fa-cart-arrow-down"></i>
                Booking
            </a>
            @if (auth()->user()->admin)
                <a href="{{ route('return-transaction.index') }}"
                    class="menu-link d-flex align-items-center gap-2 {{ Route::is('return-transaction*') ? 'active' : '' }}">
                    <i class="fa-solid fa-truck-ramp-box"></i>
                    Return Transaction
                </a>
            @endif
        @endif
        <a href="{{ route('profile.index') }}"
            class="menu-link d-flex d-lg-none align-items-center gap-2 {{ Route::is('profile*') ? 'active' : '' }}">
            <i class="fa-solid fa-circle-user"></i>
            Profile
        </a>
        <button type="button"
            class="menu-link d-flex flex-column parent-menu {{ Route::is('report-booking*') || Route::is('report-transaction*') || Route::is('report-return-transaction*') ? 'active' : '' }}">
            <div class="wrapper d-flex align-items-center gap-2">
                <i class="fa-solid fa-file-lines"></i>
                Report
            </div>
            <div class="child-menu flex-column gap-1">
                <a href="{{ route('report-booking.index') }}"
                    class="{{ Route::is('report-booking*') ? 'active' : '' }}">Report Booking</a>
                <a href="{{ route('report-transaction.index') }}"
                    class="{{ Route::is('report-transaction*') ? 'active' : '' }}">Report Transaction</a>
                <a href="{{ route('report-return-transaction.index') }}"
                    class="{{ Route::is('report-return-transaction*') ? 'active' : '' }}">Report Return Transaction</a>
            </div>
        </button>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="menu-link d-flex d-lg-none gap-2 align-items-center">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>
</nav>

@push('child-script')
    <script>
        const buttonParent = document.querySelectorAll('.parent-menu')
        buttonParent.forEach(button => {
            button.addEventListener('click', function() {
                button.classList.toggle('active')
            })
        });
    </script>
@endpush
