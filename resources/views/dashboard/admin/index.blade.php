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
                            <input type="search" class="input w-100" id="search" placeholder="Search admin.."
                                autocomplete="off" name="search" value="{{ $search != null ? $search : '' }}">
                        </form>
                        <a href="{{ route('admin.create') }}" class="button-primary-small d-none d-md-inline-block">Add
                            New
                            Admin</a>
                    </div>
                    <div class="wrapper-table mt-4">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Fullname</th>
                                    <th>NIK</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th style="width: 200px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($admins->count() == 0)
                                    <td colspan="5">Data admin not found!</td>
                                @else
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->fullname }}</td>
                                            <td>{{ $admin->nik }}</td>
                                            <td>{{ $admin->phone_number }}</td>
                                            <td>{{ Str::limit($admin->address, '40') }}</td>
                                            <td class="d-flex justify-content-end gap-1 table-mobile" style="width: 200px;">
                                                <a href="{{ route('admin.show', $admin->id) }}"
                                                    class="wrapper-icon icon-detail d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-eye" style="font-size: 0.85rem;"></i>
                                                </a>
                                                <a href="{{ route('admin.edit', $admin->id) }}"
                                                    class="wrapper-icon icon-edit d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-pen-to-square" style="font-size: 0.85rem;"></i>
                                                </a>
                                                <button type="button"
                                                    class="wrapper-icon icon-delete d-flex align-items-center justify-content-center"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $admin->id }}">
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
                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.admin')
@endsection

@push('child-script')
    <script>
        $(document).on('click', '[data-bs-target="#deleteModal"]', function() {
            let id = $(this).data('id');
            $('#buttonDeleteAdmin').attr('action', '/admin/' + id);
        });
    </script>
@endpush
