<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Utils\UploadFile;

class AdminRepositories
{
    public function __construct(
        protected readonly Admin $admin,
        protected readonly UploadFile $uploadFile,
    ) {
    }

    public function findAllWithPaginate($request)
    {
        if ($request != null) {
            return $this->admin->where('fullname', 'like', "%$request%")
                ->orWhere('nik', 'like', "%$request%")
                ->orWhere('phone_number', 'like', "%$request%")
                ->orWhere('address', 'like', "%$request%")->paginate(6);
        } else {
            return $this->admin->latest()->paginate(6);
        }
    }

    public function findAll()
    {
        return $this->admin->latest()->get();
    }

    public function findById(int $id)
    {
        return $this->admin->where('id', $id)->first();
    }

    public function store($request)
    {
        $request['profile_image'] = $this->uploadFile->uploadSingleFile($request['profile_image'], "assets/image/profile");
        return $this->admin->create($request);
    }

    public function update($request, $id)
    {
        $admin = $this->findById($id);
        if (isset($request["profile_image"])) {
            $this->uploadFile->deleteExistFile("assets/image/profile/" . $admin->profile_image);
            $request['profile_image'] = $this->uploadFile->uploadSingleFile($request['profile_image'], 'assets/image/profile');
        } else {
            $request['profile_image'] = $admin->profile_image;
        }
        return $admin->update($request);
    }

    public function delete($id)
    {
        $admin = $this->findById($id);
        $this->uploadFile->deleteExistFile("assets/image/profile/" . $admin->profile_image);
        return $admin->delete();
    }
}
