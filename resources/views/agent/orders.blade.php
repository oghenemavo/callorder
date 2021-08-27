@extends('layouts.app')

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