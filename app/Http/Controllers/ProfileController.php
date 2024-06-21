<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\AdminRepositories;
use App\Repositories\CustomerRepositories;
use App\Repositories\DriverRepositories;
use App\Repositories\UserRepositories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        protected readonly AdminRepositories $adminRepositories,
        protected readonly DriverRepositories $driverRepositories,
        protected readonly CustomerRepositories $customerRepositories,
        protected readonly UserRepositories $userRepositories,
    ) {
    }

    public function index(): View
    {
        if (auth()->user()->admins_id != null) {
            $user = auth()->user();
            $userRole = auth()->user()->admin;
        } elseif (auth()->user()->drivers_id != null) {
            $user = auth()->user();
            $userRole = auth()->user()->driver;
        } elseif (auth()->user()->customers_id != null) {
            $user = auth()->user();
            $userRole = auth()->user()->customer;
        }
        return view('dashboard.profile.index', [
            'title' => 'Profile Page',
            'page' => 'Dashboard',
            'user' => $user,
            'user_role' => $userRole,
        ]);
    }

    public function update(ProfileUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->userRepositories->update($request->validated(), $id);
            return redirect(route('profile.index'))->with('success', 'Successfully to edit profile!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Failed to edit profile!');
        }
    }
}
