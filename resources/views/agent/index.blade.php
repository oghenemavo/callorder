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
                        <th>Location</th>
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
                    url: `{{ route('ajax.all.products') }}`,
                    dataSrc: 'products'
                },
                columns: [
                    { data: 'product' },
                    { data: 'lga' },
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
                        'targets': 6,
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
                                                    <li><a class="add_order" href="#add_to_cart"><em class="icon ni ni-cart-fill"></em><span>Add Order</span></a></li>
                                                    <li><a class="delete_order" href="#remove_from_cart"><em class="icon ni ni-trash"></em><span>Remove Order</span></a></li>
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

            $('#hi tbody').on('click', 'a[href="#remove_from_cart"]', function (e) { // add product to cart
                e.preventDefault();
                const dt = $.fn.DataTable.Api( $('#hi') ).row( $(this).parents('tr') );

                let data = dt.data(); // row data

                $.ajax({
                    type: 'POST',
                    url: "{{ route('agent.remove.from.cart') }}",
                    data: {
                       "_token": "{{ csrf_token() }}", 
                        supermarket_id: data.supermarket_id,
                        product: data.product,
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

            $('#hi tbody').on('click', 'a[href="#add_to_cart"]', function (e) { // add product to cart
                e.preventDefault();
                const dt = $.fn.DataTable.Api( $('#hi') ).row( $(this).parents('tr') );

                let data = dt.data(); // row data

                $.ajax({
                    type: 'POST',
                    url: "{{ route('agent.add.to.cart') }}",
                    data: {
                       "_token": "{{ csrf_token() }}", 
                        supermarket_id: data.supermarket_id,
                        product: data.product,
                        quantity: data.quantity,
                        price: data.price,
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