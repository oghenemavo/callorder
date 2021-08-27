@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endpush

@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Orders</h4>
            <div class="nk-block-des">
                <p>With number spinner input you can use <code>min, max, step</code> same as <code>input[type="number"]</code>.</p>
            </div>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner">
            
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Order#</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Total</th>
                        <th>Created at</th>
                        <th class="nk-tb-col nk-tb-col-tools text-right"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td><a href="#" data-toggle="modal" data-target="#view_order{{ $order->id }}">{{ substr(md5($order->id), 0, 8) }}</a></td>
                            <td>
                                {{ $order->customer_name }} <br>
                                {{ $order->customer_email }}
                            </td>
                            <td>{{ $order->phone_number }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->created_at->format('d M Y H:i A') }}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#view_order{{ $order->id }}"><em class="icon ni ni-eye"></em><span>View</span></a>
                            </td>
                        </tr>

                        <div class="modal fade" tabindex="-1" id="view_order{{ $order->id }}">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Order Details</h5>
                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <em class="icon ni ni-cross"></em>
                                        </a>
                                    </div>
                                    <div class="modal-body modal-body-lg">
                                        <dl class="row">
                                            <dt class="col-sm-3">Customer</dt>
                                            <dd class="col-sm-9">{{ $order->customer_name ?? 'n/a' }}</dd>

                                            <dt class="col-sm-3">Email</dt>
                                            <dd class="col-sm-9">{{ $order->customer_email }}</dd>

                                            <dt class="col-sm-3">Tel Number</dt>
                                            <dd class="col-sm-9">{{ $order->phone_number ?? 'n/a' }}</dd>

                                            <dt class="col-sm-3">Items</dt>
                                            <dd class="col-sm-9">
                                                <dl class="row">
                                                    <dt class="col-sm-4">Product</dt>
                                                    <dt class="col-sm-4">Quantity</dt>
                                                    <dt class="col-sm-4">Price</dt>
                                                </dl>
                                                @if(!empty($order->items))
                                                    @foreach(json_decode($order->items) as $item)
                                                        <dl class="row">
                                                            <dd class="col-sm-4">{{ $item->product }}</dd>
                                                            <dd class="col-sm-4">{{ $item->quantity }}</dd>
                                                            <dd class="col-sm-4">&#8358;{{ number_format($item->price * $item->quantity, 2) }}</dd>
                                                        </dl>
                                                    @endforeach
                                                @endif
                                            </dd>

                                            <dt class="col-sm-3">Customer Link</dt>
                                            <dd class="col-sm-9"><a href="{{ route('purchase.items', $order->slug ) }}" target="_blank" rel="noopener noreferrer">{{ $order->slug }}</a></dd>
                                            
                                        </dl>
                                    </div>
                                    <div class="modal-footer bg-light">
                                        <span class="sub-text">Total: &#8358;{{ $order->total }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div><!-- .card-preview -->
</div>

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