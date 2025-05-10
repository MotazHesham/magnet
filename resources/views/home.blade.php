@extends('layouts.admin')
@section('content')
    <!-- Start::page-header -->
    <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
        <div>
            <nav>
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">
                            {{ trans('global.dashboard') }}
                        </a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End::page-header -->

    <!-- Start:: row-1 -->
    <div class="row">
        <div class="col-xxl-9">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card custom-card overflow-hidden main-content-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between gap-1">
                                <div>
                                    <div class="flex-fill fs-13 text-muted">{{ trans('panel.dashboard.total_sales') }}</div>
                                    <div class="fs-23 fw-medium mb-0">{{ number_format($totalSales, 2) }}</div>
                                    <div class="text-muted fs-13">
                                        @if ($salesGrowth >= 0)
                                            {{ trans('panel.dashboard.increased_by') }} <span class="text-success"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ trans('panel.dashboard.sales_growth_tooltip', ['current' => number_format($currentMonthSales, 2), 'last' => number_format($lastMonthSales, 2)]) }}">{{ number_format($salesGrowth, 1) }}%<i
                                                    class="ti ti-trending-up fs-16"></i></span>
                                        @else
                                            {{ trans('panel.dashboard.decreased_by') }} <span class="text-danger"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ trans('panel.dashboard.sales_growth_tooltip', ['current' => number_format($currentMonthSales, 2), 'last' => number_format($lastMonthSales, 2)]) }}">{{ number_format(abs($salesGrowth), 1) }}%<i
                                                    class="ti ti-trending-down fs-16"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="avatar avatar-md bg-primary avatar-rounded flex-shrink-0 svg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M136,120v56a8,8,0,0,1-16,0V120a8,8,0,0,1,16,0ZM239.86,98.11,226,202.12A16,16,0,0,1,210.13,216H45.87A16,16,0,0,1,30,202.12l-13.87-104A16,16,0,0,1,32,80H68.37L122,18.73a8,8,0,0,1,12,0L187.63,80H224a16,16,0,0,1,15.85,18.11ZM89.63,80h76.74L128,36.15ZM224,96H32L45.87,200H210.13Zm-51.16,23.2-5.6,56A8,8,0,0,0,174.4,184a7.44,7.44,0,0,0,.81,0,8,8,0,0,0,7.95-7.2l5.6-56a8,8,0,0,0-15.92-1.6Zm-89.68,0a8,8,0,0,0-15.92,1.6l5.6,56a8,8,0,0,0,8,7.2,7.44,7.44,0,0,0,.81,0,8,8,0,0,0,7.16-8.76Z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card custom-card overflow-hidden main-content-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between gap-1">
                                <div>
                                    <div class="flex-fill fs-13 text-muted">{{ trans('panel.dashboard.total_customers') }}
                                    </div>
                                    <div class="fs-23 fw-medium mb-0">{{ number_format($totalCustomers) }}</div>
                                    <div class="text-muted fs-13">
                                        @if ($totalCustomersGrowth >= 0)
                                            {{ trans('panel.dashboard.increased_by') }} <span class="text-success"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ trans('panel.dashboard.customers_growth_tooltip', ['current' => number_format($currentMonthCustomers), 'last' => number_format($lastMonthCustomers)]) }}">{{ number_format($totalCustomersGrowth, 1) }}%<i
                                                    class="ti ti-trending-up fs-16"></i></span>
                                        @else
                                            {{ trans('panel.dashboard.decreased_by') }} <span class="text-danger"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ trans('panel.dashboard.customers_growth_tooltip', ['current' => number_format($currentMonthCustomers), 'last' => number_format($lastMonthCustomers)]) }}">{{ number_format(abs($totalCustomersGrowth), 1) }}%<i
                                                    class="ti ti-trending-down fs-16"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="avatar avatar-md bg-success avatar-rounded flex-shrink-0 svg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M168,56a8,8,0,0,1,8-8h16V32a8,8,0,0,1,16,0V48h16a8,8,0,0,1,0,16H208V80a8,8,0,0,1-16,0V64H176A8,8,0,0,1,168,56Zm62.56,54.68a103.92,103.92,0,1,1-85.24-85.24,8,8,0,0,1-2.64,15.78A88.07,88.07,0,0,0,40,128a87.62,87.62,0,0,0,22.24,58.41A79.66,79.66,0,0,1,98.3,157.66a48,48,0,1,1,59.4,0,79.66,79.66,0,0,1,36.06,28.75A87.62,87.62,0,0,0,216,128a88.85,88.85,0,0,0-1.22-14.68,8,8,0,1,1,15.78-2.64ZM128,152a32,32,0,1,0-32-32A32,32,0,0,0,128,152Zm0,64a87.57,87.57,0,0,0,53.92-18.5,64,64,0,0,0-107.84,0A87.57,87.57,0,0,0,128,216Z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card custom-card overflow-hidden main-content-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between gap-1">
                                <div>
                                    <div class="flex-fill fs-13 text-muted">{{ trans('panel.dashboard.avg_order_value') }}
                                    </div>
                                    <div class="fs-23 fw-medium mb-0">{{ number_format($avgOrderValue, 2) }}</div>
                                    <div class="text-muted fs-13">
                                        @if ($avgOrderValueGrowth >= 0)
                                            {{ trans('panel.dashboard.increased_by') }} <span class="text-success"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ trans('panel.dashboard.avg_order_growth_tooltip', ['current' => number_format($currentMonthAvgOrderValue, 2), 'last' => number_format($lastMonthAvgOrderValue, 2)]) }}">{{ number_format($avgOrderValueGrowth, 1) }}%<i
                                                    class="ti ti-trending-up fs-16"></i></span>
                                        @else
                                            {{ trans('panel.dashboard.decreased_by') }} <span class="text-danger"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ trans('panel.dashboard.avg_order_growth_tooltip', ['current' => number_format($currentMonthAvgOrderValue, 2), 'last' => number_format($lastMonthAvgOrderValue, 2)]) }}">{{ number_format(abs($avgOrderValueGrowth), 1) }}%<i
                                                    class="ti ti-trending-down fs-16"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="avatar avatar-md bg-info avatar-rounded flex-shrink-0 svg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M224,200h-8V40a8,8,0,0,0-8-8H152a8,8,0,0,0-8,8V80H96a8,8,0,0,0-8,8v40H48a8,8,0,0,0-8,8v64H32a8,8,0,0,0,0,16H224a8,8,0,0,0,0-16ZM160,48h40V200H160ZM104,96h40V200H104ZM56,144H88v56H56Z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card custom-card overflow-hidden main-content-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between gap-1">
                                <div>
                                    <div class="flex-fill fs-13 text-muted">{{ trans('panel.dashboard.total_orders') }}
                                    </div>
                                    <div class="fs-23 fw-medium mb-0">{{ number_format($totalOrders) }}</div>
                                    <div class="text-muted fs-13">
                                        @if ($totalOrdersGrowth >= 0)
                                            {{ trans('panel.dashboard.increased_by') }} <span class="text-success"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ trans('panel.dashboard.orders_growth_tooltip', ['current' => number_format($currentMonthOrders), 'last' => number_format($lastMonthOrders)]) }}">{{ number_format($totalOrdersGrowth, 1) }}%<i
                                                    class="ti ti-trending-up fs-16"></i></span>
                                        @else
                                            {{ trans('panel.dashboard.decreased_by') }} <span class="text-danger"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ trans('panel.dashboard.orders_growth_tooltip', ['current' => number_format($currentMonthOrders), 'last' => number_format($lastMonthOrders)]) }}">{{ number_format(abs($totalOrdersGrowth), 1) }}%<i
                                                    class="ti ti-trending-down fs-16"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="avatar avatar-md bg-secondary avatar-rounded flex-shrink-0 svg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32l80.34,44-29.77,16.3-80.35-44ZM128,120,47.66,76l33.9-18.56,80.34,44ZM40,90l80,43.78v85.79L40,175.82Zm176,85.78h0l-80,43.79V133.82l32-17.51V152a8,8,0,0,0,16,0V107.55L216,90v85.77Z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">{{ trans('panel.dashboard.order_status') }}</div> 
                        </div>
                        <div class="card-body pb-2">
                            <div id="order-status"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header justify-content-between">
                            <div class="card-title">{{ trans('panel.dashboard.recent_orders') }}</div> 
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table text-nowrap table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ trans('cruds.order.fields.id') }}</th>
                                            <th scope="col">{{ trans('cruds.order.fields.user') }}</th>
                                            <th scope="col">{{ trans('cruds.order.fields.total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentOrders as $order)
                                            <tr>
                                                <td><a href="javascript:void(0);"
                                                        class="text-primary">#{{ $order->order_num }}</a></td>
                                                <td>
                                                    <div class="d-flex align-items-center"> 
                                                        <div>
                                                            <a href="javascript:void(0)"
                                                                class="fw-medium">{{ $order->user->name ?? 'N/A' }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="d-block mb-1">{{ number_format($order->total, 2) }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                {{ trans('panel.dashboard.newly_added_products') }}
                            </div> 
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ trans('cruds.product.fields.id') }}</th>
                                            <th scope="col">{{ trans('cruds.product.fields.name') }}</th>
                                            <th scope="col">{{ trans('cruds.product.fields.categories') }}</th>
                                            <th scope="col">{{ trans('cruds.product.fields.discount') }}</th>
                                            <th scope="col">{{ trans('cruds.product.fields.unit_price') }}</th> 
                                            <th scope="col">{{ trans('cruds.product.fields.created_at') }}</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($newProducts as $product)
                                            <tr>
                                                <td>
                                                    <span class="fw-medium">#{{ $product->id }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-2 lh-1">
                                                            <span class="avatar avatar-md bg-light">
                                                                <img src="{{ $product->main_photo?->getUrl() ?? getNonImage() }}"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                        <div>{{ $product->name }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @foreach ($product->product_categories as $category)
                                                        <span class="badge bg-success-transparent">{{ $category->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if ($product->discount > 0)
                                                        <span
                                                            class="badge bg-primary-transparent">{{ $product->discount }}{{ $product->discount_type === 'percentage' ? '%' : '' }}</span>
                                                    @else
                                                        <span class="badge bg-primary-transparent">0%</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ number_format($product->unit_price, 2) }}
                                                </td> 
                                                <td>
                                                    <span
                                                        class="fw-medium">{{ $product->created_at->format('d-m-Y') }}</span>
                                                </td>
                                                <td>
                                                    <div class="btn-list">
                                                        <a aria-label="anchor" href="{{ route('admin.products.show', $product->id) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-title="View"
                                                            class="btn btn-icon btn-secondary-light"><i
                                                                class="ti ti-eye"></i></a>
                                                        <a aria-label="anchor" href="{{ route('admin.products.edit', $product->id) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-title="Edit" class="btn btn-icon btn-info-light"><i
                                                                class="ti ti-pencil"></i></a> 
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                {{ trans('panel.dashboard.total_orders') }}
                            </div>
                        </div>
                        <div class="card-body">
                            <div
                                class="d-flex justify-content-between align-items-center text-center bg-light p-3 rounded-1 order-content">
                                <div>
                                    <p class="mb-1">{{ trans('panel.dashboard.total_orders') }}</p>
                                    <h4 class="text-primary mb-0">{{ number_format($totalOrders) }}</h4>
                                </div>
                                <div class="text-end">
                                    <p class="mb-1">{{ trans('panel.dashboard.overall_growth_from_last_year') }}</p>

                                    @if ($overallGrowthFromLastYear >= 0)
                                        {{ trans('panel.dashboard.increased_by') }} <span class="text-success"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ trans('panel.dashboard.sales_growth_tooltip', ['current' => number_format($currentYearOrders, 2), 'last' => number_format($lastYearOrders, 2)]) }}">{{ number_format($overallGrowthFromLastYear, 1) }}%<i
                                                class="ti ti-trending-up fs-16"></i></span>
                                    @else
                                        {{ trans('panel.dashboard.decreased_by') }} <span class="text-danger"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ trans('panel.dashboard.sales_growth_tooltip', ['current' => number_format($currentYearOrders, 2), 'last' => number_format($lastYearOrders, 2)]) }}">{{ number_format(abs($overallGrowthFromLastYear), 1) }}%<i
                                                class="ti ti-trending-down fs-16"></i></span>
                                    @endif
                                </div>
                            </div>
                            <div id="total-orders"></div>
                            <small class="text-muted text-center d-block">{{trans('panel.dashboard.total_orders_tooltip')}}</small>
                        </div>
                    </div>
                </div> 
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">{{ trans('panel.dashboard.top_selling_products') }}</div> 
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($topSellingProducts as $product)
                                    <li class="list-group-item">
                                        <div class="d-flex align-items-center flex-wrap">
                                            <div class="me-3 lh-1">
                                                <span class="avatar avatar-lg bg-gray-200">
                                                    <img src="{{ $product->main_photo?->getUrl() ?? getNonImage() }}"
                                                        alt="">
                                                </span>
                                            </div>
                                            <div class="flex-fill">
                                                <span class="d-block mb-0 fw-medium">{{ $product->name }}</span>
                                                <span
                                                    class="text-muted fs-12">{{ $product->store->store_name ?? '' }}</span>
                                            </div>
                                            <div class="text-end">
                                                <p class="mb-0 fw-medium"> {{ number_format($product->unit_price, 2) }}
                                                </p>
                                                <p class="mb-0 text-muted"> {{trans('panel.dashboard.sales')}} {{ $product->num_of_sale ?? 0 }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    
                    <div class="card custom-card">
                        <div class="card-header justify-content-between flex-wrap">
                            <div class="card-title">
                                {{ trans('panel.dashboard.top_selling_categories') }}
                            </div> 
                        </div>
                        <div class="card-body py-0">
                            <div id="top-selling-categories"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: row-1 -->
@endsection
@section('scripts')
    <!-- Apex Charts JS -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Echarts JS -->
    <script src="{{ asset('assets/libs/echarts/echarts.min.js') }}"></script>
    <script>
        /* Order Status */
        var options = {
            series: [{
                name: "{{trans('panel.dashboard.store_rejected')}}",
                type: "column",
                data: @json(array_column($monthlyOrderStats, 'store_rejected'))
            }, {
                name: "{{trans('panel.dashboard.client_received')}}",
                type: "area",
                data: @json(array_column($monthlyOrderStats, 'client_received'))
            }, {
                name: "{{trans('panel.dashboard.canceled_from_client')}}",
                type: "line",
                data: @json(array_column($monthlyOrderStats, 'canceled_from_client'))
            }],
            chart: {
                height: 300,
                type: "line",
                stacked: !1,
                toolbar: {
                    show: !1
                }
            },
            stroke: {
                width: [0, 0, 2],
                dashArray: [0, 0, 4],
                show: true,
                curve: 'smooth',
                lineCap: 'butt',
            },
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 3
            },
            xaxis: {
                axisBorder: {
                    color: 'rgba(119, 119, 142, 0.05)',
                    offsetX: 0,
                    offsetY: 0,
                },
                axisTicks: {
                    color: 'rgba(119, 119, 142, 0.05)',
                    width: 6,
                    offsetX: 0,
                    offsetY: 0
                },
                categories: @json(array_column($monthlyOrderStats, 'month'))
            },
            plotOptions: {
                bar: {
                    columnWidth: "10%",
                    borderRadius: 3
                }
            },
            legend: {
                position: "top",
                markers: {
                    size: 7,
                    strokeWidth: 0,
                },
            },
            colors: ['var(--primary-color)', "rgba(244, 110, 244, 0.05)", 'rgb(133, 204, 65)'],
            tooltip: {
                theme: "dark",
            },
        };
        var chart = new ApexCharts(document.querySelector("#order-status"), options);
        chart.render();
        /* Order Status */

        /* Total Orders */
        var options = {
            chart: {
                height: 295,
                type: 'radialBar',
                responsive: 'true',
                offsetX: 0,
                offsetY: 15,
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    size: 120,
                    imageWidth: 50,
                    imageHeight: 50,
                    track: {
                        strokeWidth: '97%',
                    },
                    dropShadow: {
                        enabled: false,
                        top: 0,
                        left: 0,
                        bottom: 0,
                        blur: 3,
                        opacity: 0.5
                    },
                    dataLabels: {
                        name: {
                            fontSize: '16px',
                            color: undefined,
                            offsetY: 30,
                        },
                        hollow: {
                            size: "60%"
                        },
                        value: {
                            offsetY: -10,
                            fontSize: '22px',
                            color: undefined,
                            formatter: function(val) {
                                return val + "%";
                            }
                        }
                    }
                }
            },
            colors: ['var(--primary-color)'],
            fill: {
                type: "solid",
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    shadeIntensity: .5,
                    gradientToColors: ["#b94eed"],
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                }
            },
            stroke: {
                dashArray: 3
            },
            series: [{{ $totalOrdersPercentage }}],
            labels: ["{{trans('panel.dashboard.orders')}}"]
        };
        var chart1 = new ApexCharts(document.querySelector("#total-orders"), options);
        chart1.render();
        /* Total Orders */

        /* top selling categories */
        var options = {
            series: [{
                name: 'Sales',
                data: @json($topSellingCategories->pluck('products_sum_num_of_sale'))
            }],
            chart: {
                height: 312,
                type: 'bar',
                events: {
                    click: function(chart, w, e) {}
                },
                toolbar: {
                    show: false,
                }
            },
            colors: ['var(--primary-color)', 'rgba(133, 204, 65, 1)', 'rgba(40, 200, 235, 1)', 'rgba(244, 110, 244, 1)',
                'rgba(250, 182, 50, 1)', 'rgba(250, 75, 66, 1)'
            ],
            plotOptions: {
                bar: {
                    barHeight: '15%',
                    distributed: true,
                    horizontal: true,
                    borderRadius: 3,
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 3
            },
            xaxis: {
                categories: @json($topSellingCategories->pluck('name')),
                labels: {
                    show: false,
                    style: {
                        fontSize: '12px'
                    },
                }
            },
            yaxis: {
                offsetX: 30,
                offsetY: 30,
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 500,
                        cssClass: 'apexcharts-yaxis-label',
                    },
                    offsetY: 8,
                }
            },
            tooltip: {
                enabled: true,
                shared: false,
                intersect: true,
                x: {
                    show: false
                },
                theme: "dark",
            },
        };
        var chart2 = new ApexCharts(document.querySelector("#top-selling-categories"), options);
        chart2.render();
        /* top selling categories */
    </script>
@endsection
