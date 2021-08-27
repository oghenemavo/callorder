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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ substr(md5($order->id), 0, 8) }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_email }}</td>
                                <td>{{ $order->phone_number }}</td>
                                <td>{{ $order->total }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#view_order{{ $order->id }}">
                                        <em class="icon ni ni-eye"></em><span>View</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div><!-- .card-preview -->
    </div>
@endsection