@extends('template.main')

@section('content-dashboard')
    <div class="content container mt-4">
        <div class="row">
            <div class="col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success w-100 mb-3" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif(session()->has('failed'))
                    <div class="alert alert-danger w-100 mb-3" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif
            </div>
            <div class="col-12">
                <div class="card-default">
                    <div class="wrapper d-flex align-items-center justify-content-between gap-2">
                        <form class="form w-100" method="GET">
                            <input type="search" class="input w-100" id="search" placeholder="Search vehicle brand.."
                                autocomplete="off" name="search" value="{{ $search != null ? $search : '' }}">
                        </form>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createModal"
                            class="button-primary-small d-none d-md-inline-block">Add
                            New Brand</button>
                    </div>
                    <div class="wrapper-table mt-4">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th style="width: 200px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($vehicleBrands->count() == 0)
                                    <td colspan="2">Data brand not found!</td>
                                @else
                                    @foreach ($vehicleBrands as $brand)
                                        <tr>
                                            <td>{{ $brand->name }}</td>
                                            <td class="d-flex justify-content-end gap-1 table-mobile" style="width: 200px;">
                                                <button type="button"
                                                    class="wrapper-icon icon-detail d-flex align-items-center justify-content-center"
                                                    data-bs-toggle="modal" data-bs-target="#detailModal"
                                                    data-id="{{ $brand->id }}">
                                                    <i class="fa-solid fa-eye" style="font-size: 0.85rem;"></i>
                                                </button>
                                                <button type="button"
                                                    class="wrapper-icon icon-edit d-flex align-items-center justify-content-center"
                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-id="{{ $brand->id }}">
                                                    <i class="fa-solid fa-pen-to-square" style="font-size: 0.85rem;"></i>
                                                </button>
                                                <button type="button"
                                                    class="wrapper-icon icon-delete d-flex align-items-center justify-content-center"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $brand->id }}">
                                                    <i class="fa-solid fa-trash-can" style="font-size: 0.85rem;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="wrapper-paginate">
                        {{ $vehicleBrands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.vehicle-brand')
@endsection

@push('child-script')
    <script>
        $(document).on('click', '[data-bs-target="#detailModal"]', function() {
            let id = $(this).data('id');
            $.ajax({
                type: 'get',
                url: '/vehicle-brand/' + id,
                success: function(data) {
                    if (data.status_code == 200) {
                        $('[data-value="name"]').val(data.brand.name);
                    } else {
                        console.log('Data brand not found!');
                    }
                }
            });
        });

        $(document).on('click', '[data-bs-target="#editModal"]', function() {
            let id = $(this).data('id');
            $('#buttonUpdateBrand').attr('action', '/vehicle-brand/' + id);
            $.ajax({
                type: 'get',
                url: '/vehicle-brand/' + id,
                success: function(data) {
                    if (data.status_code == 200) {
                        $('[data-value="name"]').val(data.brand.name);
                    } else {
                        console.log('Data brand not found!');
                    }
                }
            });
        });

        $(document).on('click', '[data-bs-target="#deleteModal"]', function() {
            let id = $(this).data('id');
            $('#buttonDeleteBrand').attr('action', '/vehicle-brand/' + id);
        });
    </script>
@endpush
