@extends('layouts.app')

@section('content')

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="title nk-block-title">Number Spinner</h4>
                <div class="nk-block-des">
                    <p>With number spinner input you can use <code>min, max, step</code> same as <code>input[type="number"]</code>.</p>
                </div>
            </div>
        </div>
        <div class="card card-preview">
            <div class="card-inner">
                <a href="#empty_cart" class="btn btn-danger">Empty Cart <em class="icon ni ni-cart"></em></a>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Store</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cart_list">
                            @foreach($carts as $cart)
                                <tr>
                                    <td>{{ $cart->product }}</td>
                                    <td>{{ $cart->supermarket->name }}</td>
                                    <td>{{ $cart->supermarket->lga }}</td>
                                    <td class="price">{{ number_format($cart->price * $cart->quantity, 2) }}</td>
                                    
                                    <td class="quantity">
                                        <div class="form-group">
                                            <div class="form-control-wrap number-spinner-wrap">
                                                <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>
                                                <input type="number" data-cart="{{ $cart->id }}" data-price="{{ $cart->price }}" class="form-control number-spinner" value="{{ $cart->quantity }}" min="1" max="{{ $stock($cart->supermarket_id, $cart->product, $cart->quantity) }}">
                                                <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#delete_item" data-cart="{{ $cart->id }}" class="btn btn-primary btn-sm"><em class="icon ni ni-trash"></em> Delete Item</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                </table>

                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create_order">
                    <em class="icon ni ni-plus"></em> Create Order
                </a>

            </div>
        </div><!-- .card-preview -->
    </div>

    <!-- create order modal -->
    <div class="modal fade" tabindex="-1" id="create_order">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Order</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form class="form-validate is-alter" action="{{ route('agent.create.order') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="customer_name">Customer Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required placeholder="Customer Name">
                                @error('customer_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="customer_email">Customer Email</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control form-control-lg @error('customer_email') is-invalid @enderror" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required placeholder="Customer Email">
                                @error('customer_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone_number">Customer Phone Number</label>
                            <div class="form-control-wrap">
                                <input type="tel" class="form-control form-control-lg @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required placeholder="Customer Phone Number">
                                @error('phone_number')
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
                                        <button type="submit" class="btn btn-lg btn-primary">Create Order</button>
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
    <!-- create order modal -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // update cart quantity
            $('#cart_list .form-group').on('click', 'button', function(e) {
                e.preventDefault();
                let init_price = $(this).siblings('input').attr('data-price');
                let qty = $(this).siblings('input').val();
                let price_col = $(this).parents('td').siblings('td.price');
                price_col.text(qty * init_price);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'PUT',
                    url: "{{ route('agent.update.cart.item.quantity') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        cart_id: $(this).siblings('input').attr('data-cart'),
                        quantity: qty,
                    },
                    success: function(response) {
                        // toastr.clear();
                        // toastr.options = {
                        //     "timeOut": "50000",
                        // }
                        // if (response.hasOwnProperty('success')) {
                        //     NioApp.Toast(response.success, 'success', {position: 'top-left'});
                        // } else {
                        //     NioApp.Toast(response[Object.keys(response)[0]], Object.keys(response)[0], {position: 'top-left'});
                        // }
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

            // delete cart item
            $('#cart_list').on('click', 'a[href="#delete_item"]', function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('agent.delete.from.cart') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        cart_id: $(this).attr('data-cart'),
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
                        $(this).parents('tr').hide(500)
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

            // empty cart
            $('a[href="#empty_cart"]').on('click', function(e) {
                e.preventDefault();

                $('tbody tr').each(function(index, data) {
                    $(this).hide(1000);
                })

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('agent.empty.cart') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
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
                        setTimeout( () =>  window.location.replace(`${window.location.origin}${window.location.pathname}`), 3000);
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
        });
    </script>
@endpush
