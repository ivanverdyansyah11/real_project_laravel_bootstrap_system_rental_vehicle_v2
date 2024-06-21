<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Utils\UploadFile;

class CustomerRepositories
{
    public function __construct(
        protected readonly Customer $customer,
        protected readonly UploadFile $uploadFile,
    ) {
    }

    public function findAllWithPaginate($request)
    {
        if ($request != null) {
            return $this->customer->where('fullname', 'like', "%$request%")
                ->orWhere('nik', 'like', "%$request%")
                ->orWhere('phone_number', 'like', "%$request%")
                ->orWhere('identity_card_number', 'like', "%$request%")
                ->orWhere('family_card_number', 'like', "%$request%")
                ->orWhere('address', 'like', "%$request%")->paginate(6);
        } else {
            return $this->customer->latest()->paginate(6);
        }
    }

    public function findAll()
    {
        return $this->customer->latest()->get();
    }

    public function findById(int $id)
    {
        return $this->customer->where('id', $id)->first();
    }

    public function store($request)
    {
        $request['profile_image'] = $this->uploadFile->uploadSingleFile($request['profile_image'], "assets/image/profile");
        return $this->customer->create($request);
    }

    public function update($request, $id)
    {
        $customer = $this->findById($id);
        if (isset($request["profile_image"])) {
            $this->uploadFile->deleteExistFile("assets/image/profile/" . $customer->profile_image);
            $request['profile_image'] = $this->uploadFile->uploadSingleFile($request['profile_image'], 'assets/image/profile');
        } else {
            $request['profile_image'] = $customer->profile_image;
        }
        return $customer->update($request);
    }

    public function delete($id)
    {
        $customer = $this->findById($id);
        $this->uploadFile->deleteExistFile("assets/image/profile/" . $customer->profile_image);
        return $customer->delete();
    }
}
