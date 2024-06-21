<?php

namespace App\Repositories;

use App\Models\Driver;
use App\Utils\UploadFile;

class DriverRepositories
{
    public function __construct(
        protected readonly Driver $driver,
        protected readonly UploadFile $uploadFile,
    ) {
    }

    public function findAllWithPaginate($request)
    {
        if ($request != null) {
            return $this->driver->where('fullname', 'like', "%$request%")
                ->orWhere('nik', 'like', "%$request%")
                ->orWhere('phone_number', 'like', "%$request%")
                ->orWhere('identity_card_number', 'like', "%$request%")
                ->orWhere('drivers_license_number', 'like', "%$request%")
                ->orWhere('address', 'like', "%$request%")->paginate(6);
        } else {
            return $this->driver->latest()->paginate(6);
        }
    }

    public function findAll()
    {
        return $this->driver->latest()->get();
    }

    public function findAllWithStatus()
    {
        return $this->driver->where('status', 1)->latest()->get();
    }

    public function findAllWithBookingStatus($id)
    {
        return $this->driver->where('status', 1)->whereNotIn('id', $id)->latest()->get();
    }

    public function findById(int $id)
    {
        return $this->driver->where('id', $id)->first();
    }

    public function store($request)
    {
        $request['profile_image'] = $this->uploadFile->uploadSingleFile($request['profile_image'], "assets/image/profile");
        return $this->driver->create($request);
    }

    public function update($request, $id)
    {
        $driver = $this->findById($id);
        if (isset($request["profile_image"])) {
            $this->uploadFile->deleteExistFile("assets/image/profile/" . $driver->profile_image);
            $request['profile_image'] = $this->uploadFile->uploadSingleFile($request['profile_image'], 'assets/image/profile');
        } else {
            $request['profile_image'] = $driver->profile_image;
        }
        return $driver->update($request);
    }

    public function delete($id)
    {
        $driver = $this->findById($id);
        $this->uploadFile->deleteExistFile("assets/image/profile/" . $driver->profile_image);
        return $driver->delete();
    }
}
