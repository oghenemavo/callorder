@extends('layouts.app')

@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title">{{ $page_title }}</h4>
                <div class="nk-block-des">
                <p>Manage {{ strtolower($page_title) }}.</p>
                </div>
            </div>
        </div>
        <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
            <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col nk-tb-col-check">
                        <div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" class="custom-control-input" id="puid" disabled>
                            <label class="custom-control-label" for="puid"></label>
                        </div>
                    </th>
                    <th class="nk-tb-col"><span>Permissions</span></th>
                    <th class="nk-tb-col"><span>Permission Slug</span></th>
                    <th class="nk-tb-col"><span>Created at</span></th>
                    <th class="nk-tb-col nk-tb-col-tools"></th>
                </tr><!-- .nk-tb-item -->
            </thead>
            <tbody id="permissions">
                @foreach($permissions as $permission)
                <tr class="nk-tb-item">
                    <td class="nk-tb-col nk-tb-col-check">
                        <div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" class="custom-control-input" id="puid1"
                                @foreach($role->permissions as $role_permission)
                                    @if($role_permission->slug == $permission->slug)
                                        checked 
                                    @endif
                                @endforeach
                                disabled
                            >
                            <label class="custom-control-label" for="puid1"></label>
                        </div>
                    </td>
                    <td class="nk-tb-col tb-col-sm">
                        <span class="tb-product">
                            <span class="title">{{ $permission->name }}</span>
                        </span>
                    </td>
                    <td class="nk-tb-col">
                        <span class="tb-sub">{{ $permission->slug }}</span>
                    </td>
                    <td class="nk-tb-col">
                        <span class="tb-lead">{{ $permission->created_at->format('d M Y') }}</span>
                    </td>
                    <td class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1 my-n1">
                            <li class="mr-n1">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-icon" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            @if($role->permissions->contains($permission))
                                            <li class="abcd">
                                                <form action="{{ route('admin.auth.detach.role_permission', $role->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" value="{{ $permission->id }}">
                                                    <a href="#" class="set-permission">
                                                        <em class="icon ni ni-network"></em><span>Detach Permission</span>
                                                    </a>
                                                </form>
                                            </li>
                                            @else
                                            <li class="abc">
                                                <form action="{{ route('admin.auth.attach.role_permission', $role->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" value="{{ $permission->id }}"> 
                                                    <a href="#" class="set-permission">
                                                        <em class="icon ni ni-network"></em><span>Attach Permission</span>
                                                    </a>
                                                </form>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>
                </tr><!-- .nk-tb-item -->
                @endforeach
            </tbody>
        </table><!-- .nk-tb-list -->
    </div> <!-- nk-block -->
    </div>
@endsection

@push('scripts')
    <script>
        let permissionTable, target, set_perm, url;

        permissionTable = $('tbody#permissions');
        permissionTable.click((e) => {
            e.preventDefault();
            target = $(e.target);

            if (target.parent().hasClass('set-permission')) {
                set_perm = target.parent();
            } else if (target.hasClass('set-permission')) {
                set_perm = target;
            }
            
            if (set_perm) {
                console.log(set_perm)
                url = set_perm.parent().attr('action');
                $.ajax({
                    type: 'PUT',
                    url: url,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: set_perm.parent().serialize(),
                    dataType: 'json',
                    clearForm: null,
                    success: function(response) {
                        // display toast alert
                        toastr.clear();
                        toastr.options = {
                            "timeOut": "7000",
                        }
                        NioApp.Toast('Permission complete.', 'success', {position: 'top-right'});
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
    </script>
@endpush