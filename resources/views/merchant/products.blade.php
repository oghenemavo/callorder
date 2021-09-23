@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endpush

@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Products</h4>
            <div class="nk-block-des">
                <p>Using the most basic table markup, here’s how <code class="code-class">.table</code> based tables look by default.</p>
            </div>
        </div>
    </div>
    <div id="set" class="card card-preview">
        <div class="card-inner">
            <table id="hi" class="nowrap table data-export">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price(&#8358;)</th>
                        <th>Stock</th>
                        <th>Expires at</th>
                        <th>Created at</th>
                        <th class="nk-tb-col nk-tb-col-tools text-right"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/plugins/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.form.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script>
        $(document).ready(function() {
            NioApp.DataTable('#hi', {
                responsive: {
                    details: false
                },
                lengthMenu: [
                    [25, 50, 75, 100, -1],
                    [25, 50, 75, 100, "All"]
                ],
                ajax: {
                    url: `{{ route('ajax.merchant.products', auth()->user()->supermarket->id) }}`,
                    dataSrc: 'products'
                },
                columns: [
                    { data: 'product' },
                    { data: 'price' },
                    { data: 'quantity' },
                    { data: 'expires_at' },
                    {
                        data: 
                        'created_at', 
                        render: function (data) {
                            return moment(data).format('DD-MM-YYYY hh:mm A');
                        }
                    },
                ],
                columnDefs: [
                    {
                        'targets': 5,
                        className: 'nk-tb-col nk-tb-col-tools',
                        'data': null,
                        'render': function ( data, type, full, meta ) {
                            return `
                                <ul class="nk-tb-actions gx-1 my-n1">
                                    <li class="mr-n1">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a class="view_product" href="#view_product" data-toggle="modal" data-target="#view_products_${meta.row}">
                                                            <em class="icon ni ni-eye"></em><span>View Product</span>
                                                        </a>
                                                    </li>
                                                    <li><a class="edit_product" href="#edit_product" data-toggle="modal" data-target="#edit_product_${meta.row}"><em class="icon ni ni-edit"></em><span>Edit Product</span></a></li>
                                                    <li><a class="remove_proudct" href="#remove_proudct"><em class="icon ni ni-trash"></em><span>Remove Product</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            `;
                        }
                    }
                ],
                buttons: [
                    [ 'copy', 'excel', 'csv', 'pdf' ],
                    {
                        text: 'Reload',
                        className: 'btn reload px-2',
                        action: function ( e, dt, node, config ) {
                            dt.ajax.reload();
                        },
                    },
                ]
            });

            $('.reload').find('span').css({'display': 'block'}); // reload datatable
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#hi tbody').on('click', 'a[href="#remove_proudct"]', function (e) { // add product to cart
                e.preventDefault();
                const dt = $.fn.DataTable.Api( $('#hi') ).row( $(this).parents('tr') );

                let data = dt.data(); // row data

                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('supermarket.delete.product') }}",
                    data: {
                       "_token": "{{ csrf_token() }}", 
                        supermarket_id: data.supermarket_id,
                        product_id: data.id,
                    },
                    success: function(response) {
                        toastr.clear();
                        toastr.options = {
                            "timeOut": "50000",
                        }
                        if (response.hasOwnProperty('success')) {
                            NioApp.Toast(response.success, 'success', {position: 'top-left'});
                        } else {
                            NioApp.Toast(response[Object.keys(response)[0]], Object.keys(response)[0], {position: 'top-left'});
                        }
                        $('#hi').DataTable().ajax.reload();
                        // setTimeout( () =>  window.location.replace(`${window.location.origin}${window.location.pathname}`), 3000);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log( XMLHttpRequest.responseJSON.errors);
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
            });

            $('#hi tbody').on('click', 'a[href="#edit_product"]', function (e) {
                e.preventDefault();
                const dt = $.fn.DataTable.Api( $('#hi') ).row( $(this).parents('tr') );

                let data = dt.data();

                let product = `
                    <div class="modal fade" tabindex="-1" role="dialog" id="edit_product_${dt.index()}">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                                <div class="modal-body modal-body-md">
                                    <h4 class="title">Product Details</h4>
                                    <form id="update_product" class="form-validate" action="{{ route('supermarket.update.product') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="product_id" value="${data.id}">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_name">Product Name</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control form-control-lg @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="${data.product}" required>
                                                        @error('product_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div class="text-danger" data-error="product_name"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="price">Price(&#8358;)</label>
                                                    <div class="form-control-wrap">
                                                        <input type="number" class="form-control form-control-lg @error('price') is-invalid @enderror" id="price" name="price" value="${data.price}" min="10" required>
                                                        @error('price')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div class="text-danger" data-error="price"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="quantity">Quantity</label>
                                                    <div class="form-control-wrap">
                                                        <input type="number" class="form-control form-control-lg @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="${data.quantity}" required>
                                                        @error('quantity')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div class="text-danger" data-error="quantity"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="expires_at">Expires at</label>
                                                    <div class="form-control-wrap">
                                                        <input type="date" class="form-control form-control-lg @error('expires_at') is-invalid @enderror" id="expires_at" name="expires_at" value="${data.expires_at}" required>
                                                        @error('expires_at')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div class="text-danger" data-error="expires_at"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="description">Description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control form-control-lg @error('description') is-invalid @enderror" id="description" name="description" required>${data.description}</textarea>
                                                        @error('description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div class="text-danger" data-error="description"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary"><em class="icon ni ni-edit"></em><span>Edit Product</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                $(product).insertAfter($('#set'));

                const product_options = {
                    type: 'PUT',
                    url: $(this).prop('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    clearForm: null,
                    success: function(response) {
                        toastr.clear();
                        toastr.options = {
                            "timeOut": "50000",
                        }
                        if (response.hasOwnProperty('success')) {
                            NioApp.Toast('Product Updated Successfully!', 'success', {position: 'top-left'});
                            $(`#edit_product_${dt.index()}`).modal('hide');
                        } else {
                            NioApp.Toast('No changes made!', 'info', {position: 'top-left'});
                        }
                        $('#update_product').find('button').attr('disabled', false);

                        $('#hi').DataTable().ajax.reload();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest.status)
                        console.log(XMLHttpRequest.statusText)
                        console.log(errorThrown)
        
                        let errors = XMLHttpRequest.responseJSON.errors;
                        if (errors.hasOwnProperty('product_name')) {
                            $('div[data-error="product_name"]').text(errors.product_name[0])
                        } 
                        if (errors.hasOwnProperty('price')) {
                            $('div[data-error="price"]').text(errors.price[0])
                        }
                        if (errors.hasOwnProperty('quantity')) {
                            $('div[data-error="quantity"]').text(errors.quantity[0])
                        } 
                        if (errors.hasOwnProperty('expires_at')) {
                            $('div[data-error="expires_at"]').text(errors.expires_at[0])
                        }

                        if (errors.hasOwnProperty('description')) {
                            $('div[data-error="description"]').text(errors.description[0])
                        }
                
                        $(this).find('button').attr('disabled', false);
                
                        // display toast alert
                        toastr.clear();
                        toastr.options = {
                            "timeOut": "7000",
                        }
                        NioApp.Toast('Unable to process request now.', 'error', {position: 'top-right'});
                    }
                };
                
                $('#update_product').validate({
                    rules: {
                        product_name: 'required',
                        price: 'required',
                        quantity: 'required',
                        expires_at: 'required',
                        description: 'required',
                    },
                    submitHandler: function(form) {
                        $(form).find('button').attr('disabled', true)
                        $(form).ajaxSubmit(product_options);
                    }
                });
            });

            $('#hi tbody').on('click', 'a[href="#view_product"]', function (e) {
                e.preventDefault();
                const dt = $.fn.DataTable.Api( $('#hi') ).row( $(this).parents('tr') );

                let data = dt.data();

                let product = `
                    <div class="modal fade" tabindex="-1" role="dialog" id="view_products_${dt.index()}">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                                <div class="modal-body modal-body-md">
                                    <h4 class="title">Product Details</h4>
                                    <ul class="nk-nav nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#product_details">Product Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#merchant_details">Merchant Details</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="product_details">
                                            <dl class="row">
                                                <dt class="col-sm-3">Product Name</dt>
                                                <dd class="col-sm-9">${data.product}</dd>

                                                <dt class="col-sm-3">Price</dt>
                                                <dd class="col-sm-9">&#8358;${data.price}</dd>

                                                <dt class="col-sm-3">Stock</dt>
                                                <dd class="col-sm-9">${data.quantity}</dd>

                                                <dt class="col-sm-3">Expires at</dt>
                                                <dd class="col-sm-9">${data.expires_at}</dd>

                                                <dt class="col-sm-3 text-truncate">Product Description</dt>
                                                <dd class="col-sm-9">${data.description}</dd>

                                            
                                            </dl>
                                        </div>
                                        <div class="tab-pane" id="merchant_details">
                                            <dl class="row">
                                                <dt class="col-sm-3">Merchant Name</dt>
                                                <dd class="col-sm-9">${data.name}</dd>

                                                <dt class="col-sm-3">Location</dt>
                                                <dd class="col-sm-9">${data.lga}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                $(product).insertAfter($('#set'));

                // Add Item to Cart


                // console.log()

                // $(this).append(modal);
                // if ($(this).hasClass('view_product')) {
                    
                // }
                // console.log(.data());
                // var data = table.row( $(this).parents('tr') ).data();
                // alert( data[0] +"'s salary is: "+ data[ 5 ] );
            });

            

        });
    </script>
@endpush