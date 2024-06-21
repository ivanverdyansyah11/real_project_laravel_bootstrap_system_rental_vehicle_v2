<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between">
                <h3 class="title">Delete Admin</h3>
                <button type="button" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark" style="font-size: 1rem;"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="caption">Confirm Admin Deletion: Are you sure you want to delete this admin? This action
                    cannot be undone, and the admin will be permanently removed from the system.</p>
            </div>
            <div class="modal-button w-100 p-3">
                <form id="buttonDeleteAdmin" method="POST" class="form w-100 d-flex gap-2 align-items-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button-primary-small w-100">Delete Admin</button>
                    <button type="button" class="button-reverse w-100" data-bs-dismiss="modal">Cancel Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
