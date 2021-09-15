@extends('layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title page-title">Dashboard</h4>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-12 col-md-12">
                <div class="card is-dark h-100">
                    <div class="nk-ecwg nk-ecwg1">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Total Sales</h6>
                                </div>
                                <div class="card-tools">
                                    <a href="#" class="link">View Report</a>
                                </div>
                            </div>
                            <div class="data">
                                <div class="amount">₦{{ $monthlyrevenue }}</div>
                                <!-- <div class="info"><strong>$7,395.37</strong> in last month</div> -->
                            </div>
                            <!-- <div class="data">
                                <h6 class="sub-title">This week so far</h6>
                                <div class="data-group">
                                    <div class="amount">$1,338.72</div>
                                    <div class="info text-right"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last week</span></div>
                                </div>
                            </div> -->
                        </div><!-- .card-inner -->
                        <div class="nk-ecwg1-ck">
                            <canvas class="ecommerce-line-chart-s1" id="totalSales"></canvas>
                        </div>
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-4">
                <div class="row g-gs">
                    <div class="col-xxl-12 col-md-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg3">
                                <div class="card-inner pb-0">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Sales</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{ $sales }}</div>
                                            <div class="info text-right"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last week</span></div>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="nk-ecwg3-ck">
                                    <canvas class="ecommerce-line-chart-s1" id="totalSales"></canvas>
                                </div>
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-xxl-12 col-md-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg3">
                                <div class="card-inner pb-0">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Orders</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{ $orders }}</div>
                                            <div class="info text-right"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last week</span></div>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="nk-ecwg3-ck">
                                    <canvas class="ecommerce-line-chart-s1" id="totalOrders"></canvas>
                                </div>
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-xxl-12 col-md-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg3">
                                <div class="card-inner pb-0">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Users</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{ $users }}</div>
                                            <!-- <div class="info text-right"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last week</span></div> -->
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="nk-ecwg3-ck">
                                    <!-- <canvas class="ecommerce-line-chart-s1" id="totalCustomers"></canvas> -->
                                </div>
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-xxl-12 col-md-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg3">
                                <div class="card-inner pb-0">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Supermarkets</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{ $supermarkets }}</div>
                                            <div class="info text-right"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last week</span></div>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="nk-ecwg3-ck">
                                    <!-- <canvas class="ecommerce-line-chart-s1" id="totalCustomers"></canvas> -->
                                </div>
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .col -->
            <div class="col-xxl-8">
                <div class="card card-full">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Recent Orders</h6>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list mt-n2">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Order No.</span></div>
                            <div class="nk-tb-col tb-col-sm"><span>Customer</span></div>
                            <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                            <div class="nk-tb-col"><span>Amount</span></div>
                            <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                        </div>
                        @foreach($main_orders as $general_order)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <span class="tb-lead"><a href="#">#{{ substr(md5($general_order->id), 0, 8) }}</a></span>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <div class="user-card">
                                        <div class="user-avatar sm bg-purple-dim">
                                            <span>AB</span>
                                        </div>
                                        <div class="user-name">
                                            <span class="tb-lead">{{ $general_order->customer_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub">{{ $general_order->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-sub tb-amount"><span>₦</span>{{ $general_order->total ?? 0.00 }}</span>
                                </div>
                                <div class="nk-tb-col">
                                    @if($general_order->is_confirmed == '1')
                                    <span class="badge badge-dot badge-dot-xs badge-success">Paid</span>
                                    @else
                                    <span class="badge badge-dot badge-dot-xs badge-danger">Not Paid</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div><!-- .card -->
            </div>
            <div class="col-xxl-4 col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Top products</h6>
                            </div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle link link-light link-sm dropdown-indicator" data-toggle="dropdown">Weekly</a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Daily</span></a></li>
                                            <li><a href="#" class="active"><span>Weekly</span></a></li>
                                            <li><a href="#"><span>Monthly</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nk-top-products">
                            <li class="item">
                                <div class="thumb">
                                    <img src="./images/product/a.png" alt="">
                                </div>
                                <div class="info">
                                    <div class="title">Pink Fitness Tracker</div>
                                    <div class="price">$99.00</div>
                                </div>
                                <div class="total">
                                    <div class="amount">$990.00</div>
                                    <div class="count">10 Sold</div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="thumb">
                                    <img src="./images/product/b.png" alt="">
                                </div>
                                <div class="info">
                                    <div class="title">Purple Smartwatch</div>
                                    <div class="price">$99.00</div>
                                </div>
                                <div class="total">
                                    <div class="amount">$990.00</div>
                                    <div class="count">10 Sold</div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="thumb">
                                    <img src="./images/product/c.png" alt="">
                                </div>
                                <div class="info">
                                    <div class="title">Black Mi Band Smartwatch</div>
                                    <div class="price">$99.00</div>
                                </div>
                                <div class="total">
                                    <div class="amount">$990.00</div>
                                    <div class="count">10 Sold</div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="thumb">
                                    <img src="./images/product/d.png" alt="">
                                </div>
                                <div class="info">
                                    <div class="title">Black Headphones</div>
                                    <div class="price">$99.00</div>
                                </div>
                                <div class="total">
                                    <div class="amount">$990.00</div>
                                    <div class="count">10 Sold</div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="thumb">
                                    <img src="./images/product/e.png" alt="">
                                </div>
                                <div class="info">
                                    <div class="title">iPhone 7 Headphones</div>
                                    <div class="price">$99.00</div>
                                </div>
                                <div class="total">
                                    <div class="amount">$990.00</div>
                                    <div class="count">10 Sold</div>
                                </div>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Store Statistics</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Orders</div>
                                    <div class="count">1,795</div>
                                </div>
                                <em class="icon bg-primary-dim ni ni-bag"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Customers</div>
                                    <div class="count">2,327</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-users"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Products</div>
                                    <div class="count">674</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-box"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Categories</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->
@endsection


@push('scripts')
<script>
    !(function (NioApp, $) {
    "use strict";

    let days, revenue;
    days = JSON.parse(`<?= $chart->keys() ?>`);
    revenue = JSON.parse(`<?= $chart->values() ?>`);

    let ordersdays, ordersrevenue;
    ordersdays = JSON.parse(`<?= $order_chart->keys() ?>`);
    ordersrevenue = JSON.parse(`<?= $order_chart->values() ?>`);

    var totalSales = {
        labels : days,
        dataUnit : 'Sales',
        lineTension : .3,
        datasets : [{
            label : "Sales",
            color : "#9d72ff",
            background : NioApp.hexRGB('#9d72ff',.25),
            data: revenue
        }]
    };

    var totalOrders = {
        labels : ordersdays,
        dataUnit : 'Orders',
        lineTension : .3,
        datasets : [{
            label : "Orders",
            color : "#7de1f8",
            background : NioApp.hexRGB('#7de1f8',.25),
            data: ordersrevenue
        }]
    };

    var totalCustomers = {
        labels : ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan", "08 Jan", "09 Jan", "10 Jan", "11 Jan", "12 Jan", "13 Jan", "14 Jan", "15 Jan", "16 Jan", "17 Jan", "18 Jan", "19 Jan", "20 Jan", "21 Jan", "22 Jan", "23 Jan", "24 Jan", "25 Jan", "26 Jan", "27 Jan", "28 Jan", "29 Jan", "30 Jan"],
        dataUnit : 'Customers',
        lineTension : .3,
        datasets : [{
            label : "Customers",
            color : "#83bcff",
            background : NioApp.hexRGB('#83bcff',.25),
            data: [92, 105, 125, 85, 110, 106, 131, 105, 110, 115, 135, 105, 120, 85, 122, 100, 125, 110, 120, 125, 85, 105, 123, 115, 90, 117, 125, 100, 95, 65]
        }]
    };

    function ecommerceLineS1(selector, set_data){
        var $selector = (selector) ? $(selector) : $('.ecommerce-line-chart-s1');
        $selector.each(function(){
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data;
            var selectCanvas = document.getElementById(_self_id).getContext("2d");

            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension:_get_data.lineTension,
                    backgroundColor: _get_data.datasets[i].background,
                    borderWidth:2,
                    borderColor: _get_data.datasets[i].color,
                    pointBorderColor: 'transparent',
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: _get_data.datasets[i].color,
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 4,
                    data: _get_data.datasets[i].data,
                });
            } 
            var chart = new Chart(selectCanvas, {
                type: 'line',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: (_get_data.legend) ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth:12,
                            padding:20,
                            fontColor: '#6783b8',
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function(tooltipItem, data) {
                                return data['labels'][tooltipItem[0]['index']];
                            },
                            label: function(tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' +  _get_data.dataUnit;
                            }
                        },
                        backgroundColor: '#1c2b46',
                        titleFontSize: 10,
                        titleFontColor: '#fff',
                        titleMarginBottom: 4,
                        bodyFontColor: '#fff',
                        bodyFontSize: 10,
                        bodySpacing:4,
                        yPadding: 6,
                        xPadding: 6,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: false,
                            ticks: {
                                beginAtZero: true,
                                fontSize:12,
                                fontColor:'#9eaecf',
                                padding: 0
                            },
                            gridLines: { 
                                color: NioApp.hexRGB("#526484",.2),
                                tickMarkLength:0,
                                zeroLineColor: NioApp.hexRGB("#526484",.2)
                            },
                        }],
                        xAxes: [{
                            display: false,
                            ticks: {
                                fontSize:12,
                                fontColor:'#9eaecf',
                                source: 'auto',
                                padding: 0,
                                reverse: NioApp.State.isRTL
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength:0,
                                zeroLineColor: NioApp.hexRGB("#526484",.2),
                                offsetGridLines: true,
                            }
                        }]
                    }
                }
            });
        })
    }
    // init chart
    NioApp.coms.docReady.push(function(){ ecommerceLineS1(); });  

    var storeVisitors = {
        labels : ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan", "08 Jan", "09 Jan", "10 Jan", "11 Jan", "12 Jan","13 Jan", "14 Jan", "15 Jan", "16 Jan", "17 Jan", "18 Jan", "19 Jan", "20 Jan", "21 Jan", "22 Jan", "23 Jan", "24 Jan", "25 Jan", "26 Jan", "27 Jan", "28 Jan", "29 Jan", "30 Jan"],
        dataUnit : 'People',
        lineTension : .1,
        datasets : [{
            label : "Current Month",
            color : "#9d72ff",
            dash : 0,
            background : "transparent",
            data: [4110, 4220, 4810, 5480, 4600, 5670, 6660, 4830, 5590, 5730, 4790, 4950, 5100, 5800, 5950, 5850, 5950, 4450, 4900, 8000, 7200, 7250, 7900, 8950,6300, 7200, 7250, 7650, 6950, 4750]
        }]
    };

    function ecommerceLineS2(selector, set_data){
        var $selector = (selector) ? $(selector) : $('.ecommerce-line-chart-s2');
        $selector.each(function(){
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data;
            var selectCanvas = document.getElementById(_self_id).getContext("2d");

            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension:_get_data.lineTension,
                    backgroundColor: _get_data.datasets[i].background,
                    borderWidth:2,
                    borderDash:_get_data.datasets[i].dash,
                    borderColor: _get_data.datasets[i].color,
                    pointBorderColor: 'transparent',
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: _get_data.datasets[i].color,
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 4,
                    data: _get_data.datasets[i].data,
                });
            } 
            var chart = new Chart(selectCanvas, {
                type: 'line',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: (_get_data.legend) ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth:12,
                            padding:20,
                            fontColor: '#6783b8',
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function(tooltipItem, data) {
                                return data['labels'][tooltipItem[0]['index']];
                            },
                            label: function(tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']];
                            }
                        },
                        backgroundColor: '#1c2b46',
                        titleFontSize: 13,
                        titleFontColor: '#fff',
                        titleMarginBottom: 6,
                        bodyFontColor: '#fff',
                        bodyFontSize: 12,
                        bodySpacing:4,
                        yPadding: 10,
                        xPadding: 10,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            position : NioApp.State.isRTL ? "right" : "left",
                            ticks: {
                                fontSize:12,
                                fontColor:'#9eaecf',
                                padding: 8,
                                stepSize:2400,
                                display: false
                            },
                            gridLines: { 
                                color: NioApp.hexRGB("#526484",.2),
                                tickMarkLength:0,
                                zeroLineColor: NioApp.hexRGB("#526484",.2),
                            },
                        }],
                        xAxes: [{
                            display: false,
                            ticks: {
                                fontSize:12,
                                fontColor:'#9eaecf',
                                source: 'auto',
                                padding: 0,
                                reverse: NioApp.State.isRTL
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength:0,
                                zeroLineColor: 'transparent',
                                offsetGridLines: true,
                            }
                        }]
                    }
                }
            });
        })
    }
    // init chart
    NioApp.coms.docReady.push(function(){ ecommerceLineS2(); });

    var todayOrders = {
        labels : ["12AM - 02AM", "02AM - 04AM", "04AM - 06AM", "06AM - 08AM", "08AM - 10AM", "10AM - 12PM", "12PM - 02PM", "02PM - 04PM", "04PM - 06PM", "06PM - 08PM", "08PM - 10PM", "10PM - 12PM"],
        dataUnit : 'Orders',
        lineTension : .3,
        datasets : [{
            label : "Orders",
            color : "#854fff",
            background : "transparent",
            data: [92, 105, 125, 85, 110, 106, 131, 105, 110, 131, 105, 110]
        }]
    };

    var todayRevenue = {
        labels : ["12AM - 02AM", "02AM - 04AM", "04AM - 06AM", "06AM - 08AM", "08AM - 10AM", "10AM - 12PM", "12PM - 02PM", "02PM - 04PM", "04PM - 06PM", "06PM - 08PM", "08PM - 10PM", "10PM - 12PM"],
        dataUnit : 'Orders',
        lineTension : .3,
        datasets : [{
            label : "Revenue",
            color : "#33d895",
            background : "transparent",
            data: [92, 105, 125, 85, 110, 106, 131, 105, 110, 131, 105, 110]
        }]
    };

    var todayCustomers = {
        labels : ["12AM - 02AM", "02AM - 04AM", "04AM - 06AM", "06AM - 08AM", "08AM - 10AM", "10AM - 12PM", "12PM - 02PM", "02PM - 04PM", "04PM - 06PM", "06PM - 08PM", "08PM - 10PM", "10PM - 12PM"],
        dataUnit : 'Orders',
        lineTension : .3,
        datasets : [{
            label : "Customers",
            color : "#ff63a5",
            background : "transparent",
            data: [92, 105, 125, 85, 110, 106, 131, 105, 110, 131, 105, 110]
        }]
    };

    var todayVisitors = {
        labels : ["12AM - 02AM", "02AM - 04AM", "04AM - 06AM", "06AM - 08AM", "08AM - 10AM", "10AM - 12PM", "12PM - 02PM", "02PM - 04PM", "04PM - 06PM", "06PM - 08PM", "08PM - 10PM", "10PM - 12PM"],
        dataUnit : 'Orders',
        lineTension : .3,
        datasets : [{
            label : "Visitors",
            color : "#559bfb",
            background : "transparent",
            data: [92, 105, 125, 85, 110, 106, 131, 105, 110, 131, 105, 110]
        }]
    };

    function ecommerceLineS3(selector, set_data){
        var $selector = (selector) ? $(selector) : $('.ecommerce-line-chart-s3');
        $selector.each(function(){
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data;
            var selectCanvas = document.getElementById(_self_id).getContext("2d");

            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension:_get_data.lineTension,
                    backgroundColor: _get_data.datasets[i].background,
                    borderWidth:2,
                    borderColor: _get_data.datasets[i].color,
                    pointBorderColor: 'transparent',
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: _get_data.datasets[i].color,
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 4,
                    data: _get_data.datasets[i].data,
                });
            } 
            var chart = new Chart(selectCanvas, {
                type: 'line',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: (_get_data.legend) ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth:12,
                            padding:20,
                            fontColor: '#6783b8',
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function(tooltipItem, data) {
                                return false;
                            },
                            label: function(tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' +  _get_data.dataUnit;
                            }
                        },
                        backgroundColor: '#1c2b46',
                        titleFontSize: 8,
                        titleFontColor: '#fff',
                        titleMarginBottom: 4,
                        bodyFontColor: '#fff',
                        bodyFontSize: 8,
                        bodySpacing:4,
                        yPadding: 6,
                        xPadding: 6,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: false,
                            ticks: {
                                beginAtZero: false,
                                fontSize:12,
                                fontColor:'#9eaecf',
                                padding: 0
                            },
                            gridLines: { 
                                color: NioApp.hexRGB("#526484",.2),
                                tickMarkLength:0,
                                zeroLineColor: NioApp.hexRGB("#526484",.2)
                            },
                        }],
                        xAxes: [{
                            display: false,
                            ticks: {
                                fontSize:12,
                                fontColor:'#9eaecf',
                                source: 'auto',
                                padding: 0,
                                reverse: NioApp.State.isRTL
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength:0,
                                zeroLineColor: NioApp.hexRGB("#526484",.2),
                                offsetGridLines: true,
                            }
                        }]
                    }
                }
            });
        })
    }
    // init chart
    NioApp.coms.docReady.push(function(){ ecommerceLineS3(); });

    var salesStatistics = {
        labels : ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan", "08 Jan", "09 Jan", "10 Jan", "11 Jan", "12 Jan","13 Jan", "14 Jan", "15 Jan", "16 Jan", "17 Jan", "18 Jan", "19 Jan", "20 Jan", "21 Jan", "22 Jan", "23 Jan", "24 Jan", "25 Jan", "26 Jan", "27 Jan", "28 Jan", "29 Jan", "30 Jan"],
        dataUnit : 'People',
        lineTension : .4,
        datasets : [{
            label : "Total orders",
            color : "#9d72ff",
            dash : 0,
            background : NioApp.hexRGB('#9d72ff',.15),
            data: [3710, 4820, 4810, 5480, 5300, 5670, 6660, 4830, 5590, 5730, 4790, 4950, 5100, 5800, 5950, 5850, 5950, 4450, 4900, 8000, 7200, 7250, 7900, 8950,6300, 7200, 7250, 7650, 6950, 4750]
        },{
            label : "Canceled orders",
            color : "#eb6459",
            dash : [5],
            background : "transparent",
            data: [110, 220, 810, 480, 600, 670, 660, 830, 590, 730, 790, 950, 100, 800, 950, 850, 950, 450, 900, 0, 200, 250, 900, 950, 300, 200, 250, 650, 950, 750]
        }]
    };

    function ecommerceLineS4(selector, set_data){
        var $selector = (selector) ? $(selector) : $('.ecommerce-line-chart-s4');
        $selector.each(function(){
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data;
            var selectCanvas = document.getElementById(_self_id).getContext("2d");

            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension:_get_data.lineTension,
                    backgroundColor: _get_data.datasets[i].background,
                    borderWidth:2,
                    borderDash:_get_data.datasets[i].dash,
                    borderColor: _get_data.datasets[i].color,
                    pointBorderColor: 'transparent',
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: _get_data.datasets[i].color,
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 4,
                    data: _get_data.datasets[i].data,
                });
            } 
            var chart = new Chart(selectCanvas, {
                type: 'line',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: (_get_data.legend) ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth:12,
                            padding:20,
                            fontColor: '#6783b8',
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function(tooltipItem, data) {
                                return data['labels'][tooltipItem[0]['index']];
                            },
                            label: function(tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']];
                            }
                        },
                        backgroundColor: '#1c2b46',
                        titleFontSize: 13,
                        titleFontColor: '#fff',
                        titleMarginBottom: 6,
                        bodyFontColor: '#fff',
                        bodyFontSize: 12,
                        bodySpacing:4,
                        yPadding: 10,
                        xPadding: 10,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            position : NioApp.State.isRTL ? "right" : "left",
                            ticks: {
                                beginAtZero:true,
                                fontSize:11,
                                fontColor:'#9eaecf',
                                padding:10,
                                callback: function(value, index, values) {
                                    return '$ ' + value;
                                },
                                min:0,
                                stepSize:3000
                            },
                            gridLines: { 
                                color: NioApp.hexRGB("#526484",.2),
                                tickMarkLength:0,
                                zeroLineColor: NioApp.hexRGB("#526484",.2)
                            },
                            
                        }],
                        xAxes: [{
                            display: false,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            ticks: {
                                fontSize:9,
                                fontColor:'#9eaecf',
                                source: 'auto',
                                padding:10,
                                reverse: NioApp.State.isRTL
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength: 0,
                                zeroLineColor: 'transparent',
                            },
                        }]
                    }
                }
            });
        })
    }
    // init chart
    NioApp.coms.docReady.push(function(){ ecommerceLineS4(); });


    var averargeOrder = {
        labels : ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan", "08 Jan", "09 Jan", "10 Jan", "11 Jan", "12 Jan","13 Jan", "14 Jan", "15 Jan", "16 Jan", "17 Jan", "18 Jan", "19 Jan", "20 Jan", "21 Jan", "22 Jan", "23 Jan", "24 Jan", "25 Jan", "26 Jan", "27 Jan", "28 Jan", "29 Jan", "30 Jan"],
        dataUnit : 'People',
        lineTension : .1,
        datasets : [{
            label : "Active Users",
            color : "#b695ff",
            background : "#b695ff",
            data: [1110, 1220, 1310, 980, 900, 770, 1060, 830, 690, 730, 790, 950, 1100, 800, 1250, 850, 950, 450, 900, 1000, 1200, 1250, 900, 950,1300, 1200, 1250, 650, 950, 750]
        }]
    };

    function ecommerceBarS1(selector, set_data){
        var $selector = (selector) ? $(selector) : $('.ecommerce-bar-chart-s1');
        $selector.each(function(){
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data;
            var selectCanvas = document.getElementById(_self_id).getContext("2d");

            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension:_get_data.lineTension,
                    backgroundColor: _get_data.datasets[i].background,
                    borderWidth:2,
                    borderColor: _get_data.datasets[i].color,
                    data: _get_data.datasets[i].data,
                    barPercentage : .7,
                    categoryPercentage : .7
                });
            } 
            var chart = new Chart(selectCanvas, {
                type: 'bar',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: (_get_data.legend) ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth:12,
                            padding:20,
                            fontColor: '#6783b8',
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function(tooltipItem, data) {
                                return false; //data['labels'][tooltipItem[0]['index']];
                            },
                            label: function(tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']];
                            }
                        },
                        backgroundColor: '#1c2b46',
                        titleFontSize: 9,
                        titleFontColor: '#fff',
                        titleMarginBottom: 6,
                        bodyFontColor: '#fff',
                        bodyFontSize: 9,
                        bodySpacing:4,
                        yPadding: 6,
                        xPadding: 6,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            position : NioApp.State.isRTL ? "right" : "left",
                            ticks: {
                                beginAtZero: false,
                                fontSize:12,
                                fontColor:'#9eaecf',
                                padding: 0,
                                display: false,
                                stepSize:100
                            },
                            gridLines: { 
                                color: NioApp.hexRGB("#526484",.2),
                                tickMarkLength:0,
                                zeroLineColor: NioApp.hexRGB("#526484",.2),
                            },
                        }],
                        xAxes: [{
                            display: false,
                            ticks: {
                                fontSize:12,
                                fontColor:'#9eaecf',
                                source: 'auto',
                                padding: 0,
                                reverse: NioApp.State.isRTL
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength:0,
                                zeroLineColor: 'transparent',
                                offsetGridLines: true,
                            }
                        }]
                    }
                }
            });
        })
    }
    // init chart
    NioApp.coms.docReady.push(function(){ ecommerceBarS1(); });  


    var trafficSources = {
        labels : ["Organic Search", "Social Media", "Referrals", "Others"],
        dataUnit : 'People',
        legend: false,
        datasets : [{
            borderColor : "#fff",
            background : ["#b695ff","#b8acff","#ffa9ce","#f9db7b"],
            data: [4305, 859, 482, 138]
        }]
    };
    var orderStatistics = {
        labels : ["Completed", "Processing", "Canclled"],
        dataUnit : 'People',
        legend: false,
        datasets : [{
            borderColor : "#fff",
            background : ["#816bff","#13c9f2","#ff82b7"],
            data: [4305, 859, 482]
        }]
    };

    function ecommerceDoughnutS1(selector, set_data){
        var $selector = (selector) ? $(selector) : $('.ecommerce-doughnut-s1');
        $selector.each(function(){
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data;
            var selectCanvas = document.getElementById(_self_id).getContext("2d");

            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    backgroundColor: _get_data.datasets[i].background,
                    borderWidth:2,
                    borderColor: _get_data.datasets[i].borderColor,
                    hoverBorderColor: _get_data.datasets[i].borderColor,
                    data: _get_data.datasets[i].data,
                });
            } 
            var chart = new Chart(selectCanvas, {
                type: 'doughnut',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: (_get_data.legend) ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth:12,
                            padding:20,
                            fontColor: '#6783b8',
                        }
                    },
                    rotation: -1.5,
                    cutoutPercentage:70,
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function(tooltipItem, data) {
                                return data['labels'][tooltipItem[0]['index']];
                            },
                            label: function(tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                            }
                        },
                        backgroundColor: '#1c2b46',
                        titleFontSize: 13,
                        titleFontColor: '#fff',
                        titleMarginBottom: 6,
                        bodyFontColor: '#fff',
                        bodyFontSize: 12,
                        bodySpacing:4,
                        yPadding: 10,
                        xPadding: 10,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                }
            });
        })
    }
    // init chart
    NioApp.coms.docReady.push(function(){ ecommerceDoughnutS1(); });  

})(NioApp, jQuery);
</script>
@endpush

