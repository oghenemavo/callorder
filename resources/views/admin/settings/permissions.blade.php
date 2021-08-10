@extends('layouts.app')

@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Permissions</h3>
                <div class="nk-block-des text-soft">
                    <p>Manage permissions.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    <li>
                        <div class="drodown">
                            <a href="#" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#create_permission">
                                <em class="icon ni ni-plus"></em>
                            </a>
                        </div>
                    </li>
                </ul>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="card card-preview">
        <div class="card-inner">
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Permission</th>
                        <th>Permission Slug</th>
                        <th>Created at</th>
                        <th class="nk-tb-col nk-tb-col-tools text-right"></th>
                    </tr>
                </thead>
                <tbody id="roles">
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{ ucfirst($permission->name) }}</td>
                            <td>{{ $permission->slug }}</td>
                            <td>{{ $permission->created_at->format('d M Y') }}</td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#" data-toggle="modal" data-target="#edit_permission_{{ $permission->slug }}"><em class="icon ni ni-edit"></em><span>Edit permission</span></a></li>
                                                    <li>
                                                        <a class="delete-permission" href="#">
                                                            <em class="icon ni ni-trash delete-permission"></em>
                                                            <span class="delete-permission">Delete permission</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>

                        <!-- edit role modal -->
                        <div class="modal fade" tabindex="-1" id="edit_permission_{{ $permission->slug }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Permission</h5>
                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <em class="icon ni ni-cross"></em>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-validate is-alter" action="{{ route('admin.auth.update.permission', $permission->id) }}" method="post" autocomplete="off">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label class="form-label" for="permission">Permission Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control form-control-lg @error('permission') is-invalid @enderror" id="permission" name="permission" value="{{ $permission->name }}" required placeholder="Permission Name">
                                                    @error('permission')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row pt-3 gy-4">
                                                <div class="col-12">
                                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                        <li>
                                                            <button type="submit" class="btn btn-lg btn-primary">Edit Permission</button>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- <div class="modal-footer bg-light">
                                        <span class="sub-text">Modal Footer Text</span>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- create role modal -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->

    <!-- create role modal -->
    <div class="modal fade" tabindex="-1" id="create_permission">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Role</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form class="form-validate is-alter" action="{{ route('admin.auth.create.permission') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="permission">Permission Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg @error('permission') is-invalid @enderror" id="permission" name="permission" value="{{ old('permission') }}" required placeholder="Permission Name">
                                @error('permission')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-3 gy-4">
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit" class="btn btn-lg btn-primary">Create Permission</button>
                                    </li>
                                    <li>
                                        <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer bg-light">
                    <span class="sub-text">Modal Footer Text</span>
                </div> -->
            </div>
        </div>
    </div>
    <!-- create role modal -->
</div>
@endsection

@push('scripts')
    <script>
        let roleTable, target, request;

        roleTable = $('tbody#roles');
        roleTable.click((e) => {
            e.preventDefault();
            target = $(event.target);
            request = target.hasClass('delete-permission');
            
            if (request) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            type: 'DELETE',
                            url: `{{ route('admin.auth.delete.permission', $permission->id) }}`,
                            data: {"_token": "{{ csrf_token() }}"},
                            dataType: 'json',
                            clearForm: null,
                            success: function(response) {
                                Swal.fire('Deleted!', 'Permission has been deleted.', 'success');
                                setTimeout( () =>  window.location.replace(`${window.location.origin}${window.location.pathname}`), 3000);
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                console.log(XMLHttpRequest.status)
                                console.log(XMLHttpRequest.statusText)
                                console.log(errorThrown)
                        
                                // display toast alert
                                toastr.clear();
                                toastr.options = {
                                    "timeOut": "7000",
                                }
                                NioApp.Toast('Unable to process request now.', 'error', {position: 'top-right'});
                            }
                        });
                    }
                });
            }
        });
    </script>
@endpush