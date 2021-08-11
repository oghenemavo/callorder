@extends('layouts.app')

@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Supermarket Management</h3>
                <div class="nk-block-des text-soft">
                    <p>Manage supermarket & settings.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    <li class="nk-block-tools-opt">
                        <a href="#" data-target="add_market" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                        <a href="#" data-target="add_market" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Market</span></a>
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
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Market</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Address</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Lga</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Created at</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                </thead>
                <tbody id="user_list">
                    @foreach($markets as $market)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                        <span>{{ $market->user->initials }}</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $market->user->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                        <span>{{ $market->user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $market->name }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $market->address }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $market->lga }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $market->user->phone }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <span>{{ $market->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#" data-toggle="modal" data-target="#edit_market_{{ $market->id }}"><em class="icon ni ni-edit"></em><span>Edit Supermarket</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr><!-- .nk-tb-item  -->

                        <!-- edit user modal -->
                        <div class="modal fade" tabindex="-1" id="edit_market_{{ $market->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Market</h5>
                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <em class="icon ni ni-cross"></em>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-validate is-alter existing_market" action="{{ route('admin.manage.edit.market', $market->id) }}" method="post" autocomplete="off">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label class="form-label" for="name">Supermarket Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" value="{{ $market->name }}">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="text-danger" data-error="name"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="address">Address</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control form-control-lg @error('address') is-invalid @enderror" id="address" name="address" value="{{ $market->address }}">
                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="text-danger" data-error="address"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="lga">Lga</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control form-control-lg @error('lga') is-invalid @enderror" id="lga" name="lga" value="{{ $market->lga }}">
                                                    @error('lga')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="text-danger" data-error="lga"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="state">State</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control form-control-lg @error('state') is-invalid @enderror" id="state" name="state" value="{{ $market->state }}">
                                                    @error('state')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="text-danger" data-error="state"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="user">User</label>
                                                <div class="form-control-wrap">
                                                    <select name="user" class="form-select @error('user') is-invalid @enderror" data-ui="lg" data-search="on">
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}" @if ($user->id == $market->user->id) {{ 'selected' }} @endif>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('user')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="text-danger" data-error="user"></div>
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
    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="add_market" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">New Super Market</h5>
                <div class="nk-block-des">
                    <p>Add information and add new mall.</p>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <form id="market" action="{{ route('admin.manage.create.market') }}" method="post">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="name">Supermarket Name</label>
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
                            <label class="form-label" for="address">Address</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="text-danger" data-error="address"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="lga">Lga</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg @error('lga') is-invalid @enderror" id="lga" name="lga" value="{{ old('lga') }}">
                                @error('lga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="text-danger" data-error="lga"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="state">State</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state') }}">
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="text-danger" data-error="state"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="user">User</label>
                            <div class="form-control-wrap">
                                <select name="user" class="form-select @error('user') is-invalid @enderror" data-ui="lg" data-search="on">
                                    @foreach($users as $user)
                                        @if(!$sm_users->contains($user->id))
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="text-danger" data-error="user"></div>
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