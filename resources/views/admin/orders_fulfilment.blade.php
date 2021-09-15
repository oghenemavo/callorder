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
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col">Order#</th>
                            <th class="nk-tb-col tb-col-sm">Customer</th>
                            <th class="nk-tb-col">Email</th>
                            <th class="nk-tb-col">Phone</th>
                            <th class="nk-tb-col tb-col-md">Total</th>
                            <th class="nk-tb-col nk-tb-col-tools text-right"></th>
                        </tr>
                    </thead>
                    <tbody id="orders">
                        @foreach($orders as $order)
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col">{{ substr(md5($order->id), 0, 8) }}</td>
                                <td class="nk-tb-col tb-col-sm">{{ $order->customer_name }}</td>
                                <td class="nk-tb-col">{{ $order->customer_email }}</td>
                                <td class="nk-tb-col">{{ $order->phone_number }}</td>
                                <td class="nk-tb-col tb-col-md">{{ $order->total }}</td>
                                <td class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        @if($order->is_delivered)
                                        <li class="nk-tb-action-hidden">
                                            <a href="#" class="btn btn-icon btn-trigger btn-tooltip" title="Order Delivered" data-toggle="dropdown">
                                                <em class="icon ni ni-truck text-success"></em>
                                            </a>
                                        </li>
                                        @endif
                                        <li class="nk-tb-action-hidden">
                                            <a href="#" data-toggle="modal" data-target="#view_order{{ $order->id }}" class="btn btn-icon btn-trigger btn-tooltip" title="View Order" data-toggle="dropdown">
                                                <em class="icon ni ni-eye text-primary"></em>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="drodown mr-n1">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#" data-toggle="modal" data-target="#view_order{{ $order->id }}" ><em class="icon ni ni-eye"></em><span>Order Details</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
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

                                                <dt class="col-sm-3">Delivery Status</dt>
                                                <dd class="col-sm-9">
                                                    @if($order->is_delivered)
                                                        <span class="dot bg-success d-mb-none"></span>
                                                        <span class="badge badge-sm badge-dot has-bg badge-success d-none d-mb-inline-flex">Delivered</span>
                                                    @else
                                                        <span class="dot bg-warning d-mb-none"></span>
                                                        <span class="badge badge-sm badge-dot has-bg badge-warning d-none d-mb-inline-flex">Pending</span>
                                                    @endif
                                                </dd>
                                                
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
