<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Utils\UploadFile;

class VehicleRepositories
{
    public function __construct(
        protected readonly Vehicle $vehicle,
        protected readonly UploadFile $uploadFile,
    ) {
    }

    public function findAllWithPaginate($request)
    {
        if ($request != null) {
            return $this->vehicle->where('name', 'like', "%$request%")
                ->orWhere('stnk_name', 'like', "%$request%")
                ->orWhere('license_plate_number', 'like', "%$request%")
                ->orWhere('kilometer', 'like', "%$request%")
                ->orWhere('capacity', 'like', "%$request%")
                ->orWhere('price', 'like', "%$request%")
                ->orWhere('year_of_creation', 'like', "%$request%")
                ->orWhere('date_purchased', 'like', "%$request%")
                ->orWhere('color', 'like', "%$request%")
                ->orWhere('frame_number', 'like', "%$request%")
                ->orWhere('machine_number', 'like', "%$request%")->paginate(6);
        } else {
            return $this->vehicle->latest()->paginate(6);
        }
    }

    public function findAll()
    {
        return $this->vehicle->latest()->get();
    }

    public function findAllWithStatus()
    {
        return $this->vehicle->where('status', 1)->latest()->get();
    }

    public function findAllWithBookingStatus($id)
    {
        return $this->vehicle->where('status', 1)->whereNotIn('id', $id)->latest()->get();
    }

    public function findById(int $id)
    {
        return $this->vehicle->with('vehicle_series')->where('id', $id)->first();
    }

    public function store($request)
    {
        $request['price'] = str_replace('Rp. ', '', $request['price']);
        $request['price'] = (int) str_replace('.', '', $request['price']);
        $request['vehicle_image'] = $this->uploadFile->uploadSingleFile($request['vehicle_image'], "assets/image/vehicle");
        return $this->vehicle->create($request);
    }

    public function update($request, $id)
    {
        $vehicle = $this->findById($id);
        $request['price'] = str_replace('Rp. ', '', $request['price']);
        $request['price'] = (int) str_replace('.', '', $request['price']);
        if (isset($request["vehicle_image"])) {
            $this->uploadFile->deleteExistFile("assets/image/vehicle/" . $vehicle->vehicle_image);
            $request['vehicle_image'] = $this->uploadFile->uploadSingleFile($request['vehicle_image'], 'assets/image/vehicle');
        } else {
            $request['vehicle_image'] = $vehicle->vehicle_image;
        }
        return $vehicle->update($request);
    }

    public function delete($id)
    {
        $vehicle = $this->findById($id);
        $this->uploadFile->deleteExistFile("assets/image/vehicle/" . $vehicle->vehicle_image);
        return $vehicle->delete();
    }
}
