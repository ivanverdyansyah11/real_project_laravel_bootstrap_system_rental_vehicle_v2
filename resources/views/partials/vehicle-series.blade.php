<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('vehicle-series.store') }}" method="POST" class="form w-100">
                @csrf
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <h3 class="title">Create Series</h3>
                    <button type="button" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark" style="font-size: 1rem;"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="input-group d-flex flex-column">
                                <label for="vehicle_brands_id">Brand Name</label>
                                <select class="input w-100 @error('vehicle_brands_id') input-invalid @enderror"
                                    name="vehicle_brands_id" id="vehicle_brands_id" required>
                                    <option value="">Choose brand name</option>
                                    @foreach ($vehicleBrand as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle_brands_id')
                                    <p class="text-invalid">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group d-flex flex-column">
                                <label for="serial_number">Serial Number</label>
                                <input type="text"
                                    class="input w-100 @error('serial_number') input-invalid @enderror"
                                    name="serial_number" id="serial_number" required autocomplete="off">
                                @error('serial_number')
                                    <p class="text-invalid">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-button w-100 p-3 d-flex gap-2">
                    <button type="submit" class="button-primary-small w-100">Add New Series</button>
                    <button type="button" class="button-reverse w-100" data-bs-dismiss="modal">Cancel Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="form w-100">
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <h3 class="title">Detail Series</h3>
                    <button type="button" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark" style="font-size: 1rem;"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="input-group d-flex flex-column">
                                <label for="vehicle_brands_id">Brand Name</label>
                                <input type="text" class="input w-100" name="vehicle_brands_id"
                                    id="vehicle_brands_id" autocomplete="off" readonly data-value="vehicle_brands_id">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="input-group d-flex flex-column">
                                <label for="serial_number">Serial Number</label>
                                <input type="text" class="input w-100" name="serial_number" id="serial_number"
                                    autocomplete="off" readonly data-value="serial_number">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-button w-100 p-3 d-flex gap-2">
                    <button type="button" class="button-reverse w-100" data-bs-dismiss="modal">Close Modal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="buttonUpdateSeries" method="POST" class="form w-100">
                @csrf
                @method('PUT')
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <h3 class="title">Edit Series</h3>
                    <button type="button" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark" style="font-size: 1rem;"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="input-group d-flex flex-column">
                                <label for="vehicle_brands_id">Brand Name</label>
                                <select class="input w-100 @error('vehicle_brands_id') input-invalid @enderror"
                                    name="vehicle_brands_id" id="vehicle_brands_id" required
                                    data-value="vehicle_brands_id">
                                </select>
                                @error('vehicle_brands_id')
                                    <p class="text-invalid">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group d-flex flex-column">
                                <label for="serial_number">Serial Number</label>
                                <input type="text"
                                    class="input w-100 @error('serial_number') input-invalid @enderror"
                                    name="serial_number" id="serial_number" required autocomplete="off"
                                    data-value="serial_number">
                                @error('serial_number')
                                    <p class="text-invalid">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-button w-100 p-3 d-flex gap-2">
                    <button type="submit" class="button-primary-small w-100">Save Changes</button>
                    <button type="button" class="button-reverse w-100" data-bs-dismiss="modal">Cancel Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between">
                <h3 class="title">Delete Series</h3>
                <button type="button" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark" style="font-size: 1rem;"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="caption">Confirm Series Deletion: Are you sure you want to delete this series? This action
                    cannot be undone, and the series will be permanently removed from the system.</p>
            </div>
            <div class="modal-button w-100 p-3">
                <form id="buttonDeleteSeries" method="POST" class="form w-100 d-flex gap-2 align-items-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button-primary-small w-100">Delete Series</button>
                    <button type="button" class="button-reverse w-100" data-bs-dismiss="modal">Cancel
                        Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
