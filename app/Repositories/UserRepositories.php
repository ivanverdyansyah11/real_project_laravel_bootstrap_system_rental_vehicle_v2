<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\User;
use App\Utils\UploadFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserRepositories
{
    public function __construct(
        protected readonly User $user,
        protected readonly Admin $admin,
        protected readonly Driver $driver,
        protected readonly Customer $customer,
        protected readonly UploadFile $uploadFile,
    ) {
    }

    public function findAllWithPaginate($request)
    {
        if ($request != null) {
            return $this->user->where('name', 'like', "%$request%")
                ->orWhere('email', 'like', "%$request%")->paginate(6);
        } else {
            return $this->user->latest()->paginate(6);
        }
    }

    public function findAll()
    {
        return $this->user->latest()->get();
    }

    public function findById(int $id)
    {
        return $this->user->where('id', $id)->first();
    }

    public function findByAdminId(int $id)
    {
        return $this->user->with('admin')->where('admins_id', $id)->first();
    }

    public function findByDriverId(int $id)
    {
        return $this->user->with('driver')->where('drivers_id', $id)->first();
    }

    public function findByCustomerId(int $id)
    {
        return $this->user->with('customer')->where('customers_id', $id)->first();
    }

    public function store($request)
    {
        $request['password'] = bcrypt($request['password']);
        return $this->user->create($request);
    }

    public function update($request, $id)
    {
        $user = $this->findById($id);
        if ($user->admin) {
            if (isset($request["profile_image"])) {
                $this->uploadFile->deleteExistFile("assets/image/profile/" . $user->admin->profile_image);
                $request['profile_image'] = $this->uploadFile->uploadSingleFile($request['profile_image'], 'assets/image/profile');
            } else {
                $request['profile_image'] = $user->admin->profile_image;
            }
            $user->admin->update(Arr::except($request, ['name', 'email', 'old_password', 'password']));
        } else if ($user->driver) {
            if (isset($request["profile_image"])) {
                $this->uploadFile->deleteExistFile("assets/image/profile/" . $user->driver->profile_image);
                $request['profile_image'] = $this->uploadFile->uploadSingleFile($request['profile_image'], 'assets/image/profile');
            } else {
                $request['profile_image'] = $user->driver->profile_image;
            }
            $user->driver->update(Arr::except($request, ['name', 'email', 'old_password', 'password']));
        } else if ($user->customer) {
            if (isset($request["profile_image"])) {
                $this->uploadFile->deleteExistFile("assets/image/profile/" . $user->customer->profile_image);
                $request['profile_image'] = $this->uploadFile->uploadSingleFile($request['profile_image'], 'assets/image/profile');
            } else {
                $request['profile_image'] = $user->customer->profile_image;
            }
            $user->customer->update(Arr::except($request, ['name', 'email', 'old_password', 'password']));
        }

        if ($request["old_password"] != null && $request["password"] != null) {
            if (!Hash::check($request["old_password"], $user->password)) {
                return redirect()->back()->with('failed', 'Password not match!');
            }
            $request['password'] = bcrypt($request['password']);
            return $user->update(Arr::only($request, ['name', 'email', 'password']));
        }
        return $user->update(Arr::only($request, ['name', 'email']));
    }

    public function updateAdmin($request, $id)
    {
        $user = $this->findByAdminId($id);
        return $user->update($request);
    }

    public function updateDriver($request, $id)
    {
        $user = $this->findByDriverId($id);
        return $user->update($request);
    }

    public function updateCustomer($request, $id)
    {
        $user = $this->findByCustomerId($id);
        return $user->update($request);
    }

    public function deleteAdmin($id)
    {
        $user = $this->findByAdminId($id);
        return $user->delete();
    }

    public function deleteDriver($id)
    {
        $user = $this->findByDriverId($id);
        return $user->delete();
    }

    public function deleteCustomer($id)
    {
        $user = $this->findByCustomerId($id);
        return $user->delete();
    }
}
