@extends('layouts.app')

@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">User Management</h3>
                <div class="nk-block-des text-soft">
                    <p>Manage user & settings.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    <li class="nk-block-tools-opt">
                        <a href="#" data-target="add_user" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                        <a href="#" data-target="add_user" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add User</span></a>
                    </li>
                </ul>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="card card-preview">
        <div class="card-inner">
            <table id="users_table" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">User</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Role</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Created at</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                </thead>
                <tbody id="user_list">
                    @foreach($users as $user)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                        <span>{{ $user->initials }}</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $user->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $user->phone }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $user->roles->first()->name }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <span>{{ $user->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @if($user->is_active)
                                    <span class="badge badge-dot badge-dot-xs badge-success">Active</span>
                                @else
                                    <span class="badge badge-dot badge-dot-xs badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                @if($user->is_active)
                                                    <li>
                                                        <form action="{{ route('admin.manage.deactivate.user', $user->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <a href="#" class="deactivate-user"><em class="icon ni ni-na"></em><span>Deactivate user</span></a>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li>
                                                        <form action="{{ route('admin.manage.activate.user', $user->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <a href="#" class="activate-user"><em class="icon ni ni-check-circle"></em><span>Activate user</span></a>
                                                        </form>
                                                    </li>
                                                @endif
                                                    <li><a href="#" data-toggle="modal" data-target="#edit_user_{{ $user->id }}"><em class="icon ni ni-edit"></em><span>Edit user</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr><!-- .nk-tb-item  -->

                        <!-- edit user modal -->
                        <div class="modal fade" tabindex="-1" id="edit_user_{{ $user->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit User</h5>
                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <em class="icon ni ni-cross"></em>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-validate is-alter existing_user" action="{{ route('admin.manage.edit.user', $user->id) }}" method="post" autocomplete="off">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label class="form-label" for="name">Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}" required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="text-danger" data-error="name"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="email">Email</label>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" required>
                                                    @error('user')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="text-danger" data-error="email"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="phone">Phone</label>
                                                <div class="form-control-wrap">
                                                    <input type="tel" class="form-control form-control-lg @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $user->phone }}" required>
                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="text-danger" data-error="phone"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="role">Role</label>
                                                <div class="form-control-wrap">
                                                    <select name="role" class="form-select @error('role') is-invalid @enderror" data-ui="lg" data-search="on">
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}" @if($role->id == $user->roles()->first()->id) {{ 'selected' }} @endif>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('role')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="text-danger" data-error="role"></div>
                                                </div>
                                            </div>

                                            <div class="row pt-3 gy-4">
                                                <div class="col-12">
                                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                        <li>
                                                            <button type="submit" class="btn btn-lg btn-primary">Edit User</button>
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
                        <!-- edit user modal -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->

    <!-- create role modal -->
    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="add_user" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">New User</h5>
                <div class="nk-block-des">
                    <p>Add information and add new user.</p>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <form id="user" action="{{ route('admin.manage.create.user') }}" method="post">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="name">Full Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="text-danger" data-error="name"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone</label>
                            <div class="form-control-wrap">
                                <input type="tel" class="form-control form-control-lg @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="text-danger" data-error="phone"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="text-danger" data-error="email"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="stock">Role</label>
                            <div class="form-control-wrap">
                                <select name="role" class="form-select @error('role') is-invalid @enderror" data-ui="lg" data-search="on">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="text-danger" data-error="role"></div>
                            </div>
                        </div>
                        <button class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                    </div>
                    
                </div>
            </form>
        </div><!-- .nk-block -->
    <!-- create user modal -->
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/plugins/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.form.js') }}"></script>
    <script>
        $(document).ready(function () {
            const user = $('#user');
            // const existing_user = $('.existing_user');
            // console.log(existing_user)
            const check = {
                name: 'required',
                phone: {
                    required: {
                        depends: function() {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                    minlength: 7,
                    integer: true,
                },
                email: {
                    required: {
                        depends: function() {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                    email: true,
                },
                role: 'required',
            };

            // existing_user.validate({
            //     rules: check,
            //     submitHandler: function(form) {
            //         $(form).find('button').attr('disabled', true)
            //         $(form).ajaxSubmit(existing_options);
            //     }
            // });
    
            // const existing_options = {
            //     type: 'PUT',
            //     url: $(this).attr('action'),
            //     data: $(this).serialize(),
            //     dataType: 'json',
            //     clearForm: null,
            //     success: function(response) {
            //         toastr.clear();
            //         toastr.options = {
            //             "timeOut": "50000",
            //         }
            //         if (response.hasOwnProperty('success')) {
            //             NioApp.Toast(response.success, 'success', {position: 'top-left'});
            //             setTimeout( () =>  window.location.replace(`${window.location.origin}${window.location.pathname}`), 3000);
            //         } else {
            //             NioApp.Toast(response.info, 'info', {position: 'top-left'});
            //         }
            //     },
            //     error: function(XMLHttpRequest, textStatus, errorThrown) {
            //         console.log(XMLHttpRequest.status)
            //         console.log(XMLHttpRequest.statusText)
            //         console.log(errorThrown)
    
            //         let errors = XMLHttpRequest.responseJSON.errors;
            //         if (errors.hasOwnProperty('name')) {
            //             $('div[data-error="name"]').text(errors.name[0])
            //         } 
            //         if (errors.hasOwnProperty('phone')) {
            //             $('div[data-error="phone"]').text(errors.phone[0])
            //         }
            //         if (errors.hasOwnProperty('email')) {
            //             $('div[data-error="email"]').text(errors.email[0])
            //         } 
            //         if (errors.hasOwnProperty('role')) {
            //             $('div[data-error="role"]').text(errors.role[0])
            //         }
            
            //         $(user).find('button').attr('disabled', false);
            
            //         // display toast alert
            //         toastr.clear();
            //         toastr.options = {
            //             "timeOut": "7000",
            //         }
            //         NioApp.Toast('Unable to process request now.', 'error', {position: 'top-right'});
            //     }
            // };

            let user_list, target, activate_request, deactivate_request;

            user_list = $('tbody#user_list');
            user_list.click((e) => {
                target = $(event.target);
                
                if (target.parent().hasClass('activate-user')) {
                    activate_request = target.parent();
                } else if (target.hasClass('activate-user')) {
                    activate_request = target;
                }
                
                if (target.parent().hasClass('deactivate-user')) {
                    deactivate_request = target.parent();
                } else if (target.hasClass('deactivate-user')) {
                    deactivate_request = target;
                }
                
                if (activate_request || deactivate_request) {
                    e.preventDefault();
                    let form, action;
                    if (deactivate_request) {
                        form = deactivate_request.parent();
                        action = 'deactivate';
                    } else {
                        form = activate_request.parent();
                        action = 'activate';
                    }
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You won't be able to revert this!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: `Yes, ${action} user!`
                    }).then(function (result) {
                        if (result.value) {
                            $.ajax({
                                type: 'PUT',
                                url: form.attr('action'),
                                data: {"_token": "{{ csrf_token() }}"},
                                dataType: 'json',
                                clearForm: null,
                                success: function(response) {
                                    Swal.fire('Done!', `User has been ${action}d.`, 'success');
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

            user.validate({
                rules: check,
                submitHandler: function(form) {
                    $(form).find('button').attr('disabled', true)
                    $(form).ajaxSubmit(options);
                }
            });
    
            const options = {
                type: 'POST',
                url: $(this).prop('action'),
                data: $(this).serialize(),
                dataType: 'json',
                clearForm: null,
                success: function(response) {
                    toastr.clear();
                    toastr.options = {
                        "timeOut": "50000",
                    }
                    NioApp.Toast('User Created Successfully!', 'success', {position: 'top-left'});
                    $('#users_table').Datatable().ajax().reload();
                    setTimeout( () =>  window.location.replace(`${window.location.origin}${window.location.pathname}`), 3000);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.status)
                    console.log(XMLHttpRequest.statusText)
                    console.log(errorThrown)
    
                    let errors = XMLHttpRequest.responseJSON.errors;
                    if (errors.hasOwnProperty('name')) {
                        $('div[data-error="name"]').text(errors.name[0])
                    } 
                    if (errors.hasOwnProperty('phone')) {
                        $('div[data-error="phone"]').text(errors.phone[0])
                    }
                    if (errors.hasOwnProperty('email')) {
                        $('div[data-error="email"]').text(errors.email[0])
                    } 
                    if (errors.hasOwnProperty('role')) {
                        $('div[data-error="role"]').text(errors.role[0])
                    }
            
                    $(user).find('button').attr('disabled', false);
            
                    // display toast alert
                    toastr.clear();
                    toastr.options = {
                        "timeOut": "7000",
                    }
                    NioApp.Toast('Unable to process request now.', 'error', {position: 'top-right'});
                }
            };

        });
    </script>
@endpush