<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Repositories\AdminRepositories;
use App\Repositories\UserRepositories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        protected readonly AdminRepositories $adminRepositories,
        protected readonly UserRepositories $userRepositories,
    ) {
    }

    public function index(Request $request): View
    {
        return view('dashboard.admin.index', [
            'title' => 'Admin Page',
            'page' => 'Dashboard',
            'admins' => $this->adminRepositories->findAllWithPaginate($request->search),
            'search' => $request->search,
        ]);
    }

    public function show(int $id): View
    {
        return view('dashboard.admin.detail', [
            'title' => 'Detail Admin Page',
            'page' => 'Dashboard',
            'user' => $this->userRepositories->findByAdminId($id),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.admin.create', [
            'title' => 'Create Admin Page',
            'page' => 'Dashboard',
        ]);
    }

    public function store(AdminStoreRequest $request): RedirectResponse
    {
        try {
            $admin = $this->adminRepositories->store($request->except('name', 'email', 'password'));
            $request['admins_id'] = $admin->id;
            $this->userRepositories->store($request->only('name', 'email', 'password', 'admins_id'));
            return redirect(route('admin.index'))->with('success', 'Successfully to add new admin!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('admin.create'))->with('failed', 'Failed to add new admin!');
        }
    }

    public function edit(int $id): View
    {
        return view('dashboard.admin.edit', [
            'title' => 'Edit Admin Page',
            'page' => 'Dashboard',
            'user' => $this->userRepositories->findByAdminId($id),
        ]);
    }

    public function update(AdminUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->adminRepositories->update($request->except('name', 'email', 'password'), $id);
            $this->userRepositories->updateAdmin($request->only('name', 'email'), $id);
            return redirect(route('admin.index'))->with('success', 'Successfully to edit admin!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Failed to edit admin!');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->adminRepositories->delete($id);
            $this->userRepositories->deleteAdmin($id);
            return redirect(route('admin.index'))->with('success', 'Successfully to delete admin!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('admin.index'))->with('failed', 'Failed to delete admin!');
        }
    }
}
