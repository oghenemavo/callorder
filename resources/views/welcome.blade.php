<!Doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('images/grocery-icon2x.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Call Order</title>

    <style>
        .search-form {
            width: 80%;
            margin: 0 auto;
            margin-top: 1rem;
        }
        .search-form input {
            height: 100%;
            background: transparent;
            border: 0;
            display: block;
            width: 100%;
            padding: 1rem;
            height: 100%;
            font-size: 1rem;
        }

        .search-form select {
            background-color: transparent;
            border: 0;
            padding: 1rem;
            height: 100%;
            font-size: 1rem;
        }

        .search-form select:focus {
            border: 0;
        }

        .search-form button {
            height: 100%;
            width: 100%;
            font-size: 1rem;
        }

        .search-form button svg {
            width: 24px;
            height: 24px;
        }
    </style>
  </head>
  <body>
      <header>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/grocery-icon2x.png') }}" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    Call Order
                </a>
            </div>
        </nav>
      </header>

      <main class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 card-margin">
                    <div class="card search-form">
                        <div class="card-body p-0">
                            <form id="search-form">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row no-gutters">
                                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                                <select class="form-select" id="location">
                                                    <option value="">Location</option>
                                                    @foreach($locations as $location)
                                                        <option value="{{ $location->lga }}">{{ $location->lga }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-12 p-0">
                                                <input type="search" placeholder="Search..." class="form-control" id="searchbox" name="searchbox">
                                            </div>
                                            <div class="col-lg-1 col-md-3 col-sm-12 p-0">
                                                <button type="submit" class="btn btn-base">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <section class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <!-- results -->
                        <div class="card">
                            <div class="card-body">
                                <!-- <h5 class="card-title">Card title</h5> -->
                                <h6 class="card-subtitle mb-2 text-muted">Results: <b>1-20</b></h6>

                                <div class="result-body">
                                    <div class="table-responsive">
                                        <table class="table widget-26">
                                            <tbody id="results"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- results -->
                    </div>

                    <!-- cart -->
                    <div class="col-md-5">
                        <h4>Cart</h4>
                        <div class="cart-body">
                            <div class="table-responsive">
                                <table class="table widget-26">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Sub total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart_items">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">Total</th>
                                            <th id="total"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Order Now</button>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Buyer Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('create.order') }}" method="post" id="create_order">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="customer_name" class="col-form-label">Customer Name:</label>
                                                            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="customer_email" class="col-form-label">Customer Email:</label>
                                                            <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone_number" class="col-form-label">Customer Phone Number:</label>
                                                            <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" id="purchase" class="btn btn-primary">Purchase</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
      </main>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="myToastEl" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="{{ asset('images/grocery-icon2x.png') }}" width="20" class="rounded me-2" alt="...">
                    <strong class="me-auto">Notification</strong>
                    <!-- <small>11 mins ago</small> -->
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body"></div>
            </div>
        </div>

      <footer>
      </footer>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#purchase').click(function() {
                // alert(111)
                $('#create_order').submit();
            });

            let searchForm, location, searchbox, result;

            searchForm = $('#search-form');
            location = searchForm.find('#location');
            searchbox = searchForm.find('#searchbox');

            searchbox.attr('disabled', true);

            result = $('#results');

            getCartItems();
            
            location.change(() => {
                if (location.val() != '') {
                    searchbox.attr('disabled', false);                    
                }
            });

            searchbox.on('input', () => {
                if (searchbox.val().length > 3) {
                    $.get({
                        url: `{{ url('/') }}/ajax/get/search/${location.val()}/${searchbox.val()}`,
                        success: function(response) {
                            let displayProducts;
                            result.empty();
                            $.each(response.products, function (indexInArray, product) { 
                                // console.log(valueOfElement);
                                displayProducts = `
                                    <tr>
                                        <td>
                                            <div class="widget-26-job-emp-img">
                                                <img src="{{ asset('images/grocery-icon2x.png') }}" alt="${product.product}" width="50" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="widget-26-job-title">
                                                <p class="m-0">${product.product}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="widget-26-job-info">
                                                <p class="type m-0">${product.lga}, ${product.state}</p>
                                                <p class="text-muted m-0">in <span class="location">${product.name}</span></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="widget-26-job-salary">₦${product.price}</div>
                                        </td>
                                        <td>
                                            <div class="widget-26-job-category bg-soft-base">
                                                <i class="indicator bg-base"></i>
                                                <span>${product.quantity} left</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="widget-26-job-starred">
                                                <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#productModal${product.id}">View</a>
                                                
                                                <div class="modal fade" id="productModal${product.id}" tabindex="-1" aria-labelledby="productLabel${product.id}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="productLabel${product.id}">Product Description</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>${product.description}</p>
                                                                <div class="d-flex">
                                                                    <input type="number" value="1" min="1" max="${product.quantity}" step="1"/>
                                                                    <a href="#add_to_cart" data-product="${product.id}" class="add_to_cart btn btn-primary">Add to Cart</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                `;
                                result.append(displayProducts);
                            });
                        },
                        dataType: 'json',
                    });
                } else {
                    result.empty();
                }
            });

            $('#results').on('click', 'a[href="#add_to_cart"]', function(e) {
                e.preventDefault();
                let addToCart = $(e.target);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('ajax.add.to.cart') }}",
                    data: {
                       "_token": "{{ csrf_token() }}",
                        product_id: addToCart.attr('data-product'),
                        quantity: addToCart.prev().val(),
                    },
                    success: function(response) {
                        getCartItems();
                        if (response.hasOwnProperty('success')) {
                            toast(response['success'], 'bg-success text-white');

                        } else {
                            toast(response['warning'], 'bg-warning text-white');
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log( XMLHttpRequest.responseJSON.errors);
                        console.log(XMLHttpRequest.status)
                        console.log(XMLHttpRequest.statusText)
                        console.log(errorThrown)
                
                        // display toast alert
                        toast('failed', 'bg-danger text-white');
                    }
                });
            })

            function toast(body, color) {
                var myToastEl = $('#myToastEl');
                myToastEl.addClass(color)
                myToastEl.find('.toast-body').text(body);
                var myToast = bootstrap.Toast.getOrCreateInstance(myToastEl) // Returns a Bootstrap toast instance
                return myToast.show();
            }

            function getCartItems() {
                $.get({
                    url: `{{ route('ajax.get.cart') }}`,
                    success: function(response) {
                        $('#cart_items').empty();
                        var displayCart, tots = 0;
                        $.each(response, function(index, cart) {
                            console.log(cart)
                            tots += (cart.quantity * cart.price);
                            displayCart = `
                                <tr>
                                    <td>${cart.product}</td>
                                    <td>${cart.price}</td>
                                    <td>${cart.quantity}</td>
                                    <td>${cart.quantity * cart.price}</td>
                                    <td><a href="#" data-product="${cart.product_id}" class="remove-from-cart">remove</a></td>
                                </tr>
                            `;
                            $('#cart_items').append(displayCart);
                        });
                        $('#total').text(tots);
                    },
                    dataType: 'json',
                });
            }

            $('#cart_items').on('click', 'a[class="remove-from-cart"]', function(e) {
                e.preventDefault();
                $.post({
                    url: `{{ route('ajax.remove.from.cart') }}`,
                    data: {
                       "_token": "{{ csrf_token() }}",
                        product_id: $(e.target).attr('data-product'),
                    },
                    success: function(response) {
                        if (response.hasOwnProperty('success')) {
                            toast(response['success'], 'bg-success text-white');
                        } 
                        getCartItems();
                    },
                    dataType: 'json',
                });
            });

        });
    </script>

  </body>
</html>