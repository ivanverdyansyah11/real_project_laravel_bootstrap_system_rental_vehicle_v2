<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('vehicle-brand.store') }}" method="POST" class="form w-100">
                @csrf
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <h3 class="title">Create Brand</h3>
                    <button type="button" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark" style="font-size: 1rem;"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group d-flex flex-column">
                                <label for="name">Name</label>
                                <input type="text" class="input w-100 @error('name') input-invalid @enderror"
                                    name="name" id="name" placeholder="Enter your name.." autocomplete="off"
                                    required>
                                @error('name')
                                    <p class="text-invalid">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-button w-100 p-3 d-flex gap-2">
                    <button type="submit" class="button-primary-small w-100">Add New Brand</button>
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
                    <h3 class="title">Detail Brand</h3>
                    <button type="button" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark" style="font-size: 1rem;"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group d-flex flex-column">
                                <label for="name">Name</label>
                                <input type="text" class="input w-100" name="name" id="name"
                                    autocomplete="off" readonly data-value="name">
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
            <form id="buttonUpdateBrand" method="POST" class="form w-100">
                @csrf
                @method('PUT')
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <h3 class="title">Edit Brand</h3>
                    <button type="button" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark" style="font-size: 1rem;"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group d-flex flex-column">
                                <label for="name">Name</label>
                                <input type="text" class="input w-100 @error('name') input-invalid @enderror"
                                    name="name" id="name" autocomplete="off" required data-value="name">
                                @error('name')
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
                <h3 class="title">Delete Brand</h3>
                <button type="button" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark" style="font-size: 1rem;"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="caption">Confirm Brand Deletion: Are you sure you want to delete this brand? This action
                    cannot be undone, and the brand will be permanently removed from the system.</p>
            </div>
            <div class="modal-button w-100 p-3">
                <form id="buttonDeleteBrand" method="POST" class="form w-100 d-flex gap-2 align-items-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button-primary-small w-100">Delete Brand</button>
                    <button type="button" class="button-reverse w-100" data-bs-dismiss="modal">Cancel
                        Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
