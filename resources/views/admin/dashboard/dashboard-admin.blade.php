@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <h5 class="mb-2">Info Box</h5>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Messages</span>
                            <span class="info-box-number">1,410</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Bookmarks</span>
                            <span class="info-box-number">410</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Uploads</span>
                            <span class="info-box-number">13,648</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Likes</span>
                            <span class="info-box-number">93,139</span>
                        </div>

                    </div>

                </div>

            </div>

{{--            <div class="row">--}}
{{--                <div class="col-lg-3 col-6">--}}

{{--                    <div class="small-box bg-info">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>150</h3>--}}
{{--                            <p>New Orders</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-bag"></i>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-lg-3 col-6">--}}

{{--                    <div class="small-box bg-success">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>53<sup style="font-size: 20px">%</sup></h3>--}}
{{--                            <p>Bounce Rate</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-stats-bars"></i>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-lg-3 col-6">--}}

{{--                    <div class="small-box bg-warning">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>44</h3>--}}
{{--                            <p>User Registrations</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-person-add"></i>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-lg-3 col-6">--}}

{{--                    <div class="small-box bg-danger">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>65</h3>--}}
{{--                            <p>Unique Visitors</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-pie-graph"></i>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--            <div class="row">--}}
{{--                <div class="col-lg-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header border-0">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <h3 class="card-title">Online Store Visitors</h3>--}}
{{--                                <a href="javascript:void(0);">View Report</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="d-flex">--}}
{{--                                <p class="d-flex flex-column">--}}
{{--                                    <span class="text-bold text-lg">820</span>--}}
{{--                                    <span>Visitors Over Time</span>--}}
{{--                                </p>--}}
{{--                                <p class="ml-auto d-flex flex-column text-right">--}}
{{--<span class="text-success">--}}
{{--<i class="fas fa-arrow-up"></i> 12.5%--}}
{{--</span>--}}
{{--                                    <span class="text-muted">Since last week</span>--}}
{{--                                </p>--}}
{{--                            </div>--}}

{{--                            <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>--}}
{{--                                <canvas id="visitors-chart" height="200" style="display: block; width: 764px; height: 200px;" width="764" class="chartjs-render-monitor"></canvas>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex flex-row justify-content-end">--}}
{{--<span class="mr-2">--}}
{{--<i class="fas fa-square text-primary"></i> This Week--}}
{{--</span>--}}
{{--                                <span>--}}
{{--<i class="fas fa-square text-gray"></i> Last Week--}}
{{--</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card">--}}
{{--                        <div class="card-header border-0">--}}
{{--                            <h3 class="card-title">Products</h3>--}}
{{--                            <div class="card-tools">--}}
{{--                                <a href="#" class="btn btn-tool btn-sm">--}}
{{--                                    <i class="fas fa-download"></i>--}}
{{--                                </a>--}}
{{--                                <a href="#" class="btn btn-tool btn-sm">--}}
{{--                                    <i class="fas fa-bars"></i>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-body table-responsive p-0">--}}
{{--                            <table class="table table-striped table-valign-middle">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Product</th>--}}
{{--                                    <th>Price</th>--}}
{{--                                    <th>Sales</th>--}}
{{--                                    <th>More</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <img src="{{asset('admin/images/user-icon.png')}}" alt="Product 1" class="img-circle img-size-32 mr-2">--}}
{{--                                        Some Product--}}
{{--                                    </td>--}}
{{--                                    <td>$13 USD</td>--}}
{{--                                    <td>--}}
{{--                                        <small class="text-success mr-1">--}}
{{--                                            <i class="fas fa-arrow-up"></i>--}}
{{--                                            12%--}}
{{--                                        </small>--}}
{{--                                        12,000 Sold--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <a href="#" class="text-muted">--}}
{{--                                            <i class="fas fa-search"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <img src="{{asset('admin/images/user-icon.png')}}" alt="Product 1" class="img-circle img-size-32 mr-2">--}}
{{--                                        Another Product--}}
{{--                                    </td>--}}
{{--                                    <td>$29 USD</td>--}}
{{--                                    <td>--}}
{{--                                        <small class="text-warning mr-1">--}}
{{--                                            <i class="fas fa-arrow-down"></i>--}}
{{--                                            0.5%--}}
{{--                                        </small>--}}
{{--                                        123,234 Sold--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <a href="#" class="text-muted">--}}
{{--                                            <i class="fas fa-search"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <img src="{{asset('admin/images/user-icon.png')}}" alt="Product 1" class="img-circle img-size-32 mr-2">--}}
{{--                                        Amazing Product--}}
{{--                                    </td>--}}
{{--                                    <td>$1,230 USD</td>--}}
{{--                                    <td>--}}
{{--                                        <small class="text-danger mr-1">--}}
{{--                                            <i class="fas fa-arrow-down"></i>--}}
{{--                                            3%--}}
{{--                                        </small>--}}
{{--                                        198 Sold--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <a href="#" class="text-muted">--}}
{{--                                            <i class="fas fa-search"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <img src="{{asset('admin/images/user-icon.png')}}" alt="Product 1" class="img-circle img-size-32 mr-2">--}}
{{--                                        Perfect Item--}}
{{--                                        <span class="badge bg-danger">NEW</span>--}}
{{--                                    </td>--}}
{{--                                    <td>$199 USD</td>--}}
{{--                                    <td>--}}
{{--                                        <small class="text-success mr-1">--}}
{{--                                            <i class="fas fa-arrow-up"></i>--}}
{{--                                            63%--}}
{{--                                        </small>--}}
{{--                                        87 Sold--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <a href="#" class="text-muted">--}}
{{--                                            <i class="fas fa-search"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header border-0">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <h3 class="card-title">Online Store Visitors</h3>--}}
{{--                                <a href="javascript:void(0);">View Report</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="d-flex">--}}
{{--                                <p class="d-flex flex-column">--}}
{{--                                    <span class="text-bold text-lg">820</span>--}}
{{--                                    <span>Visitors Over Time</span>--}}
{{--                                </p>--}}
{{--                                <p class="ml-auto d-flex flex-column text-right">--}}
{{--<span class="text-success">--}}
{{--<i class="fas fa-arrow-up"></i> 12.5%--}}
{{--</span>--}}
{{--                                    <span class="text-muted">Since last week</span>--}}
{{--                                </p>--}}
{{--                            </div>--}}

{{--                            <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>--}}
{{--                                <canvas id="visitors-chart" height="200" style="display: block; width: 764px; height: 200px;" width="764" class="chartjs-render-monitor"></canvas>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex flex-row justify-content-end">--}}
{{--<span class="mr-2">--}}
{{--<i class="fas fa-square text-primary"></i> This Week--}}
{{--</span>--}}
{{--                                <span>--}}
{{--<i class="fas fa-square text-gray"></i> Last Week--}}
{{--</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card">--}}
{{--                        <div class="card-header border-0">--}}
{{--                            <h3 class="card-title">Products</h3>--}}
{{--                            <div class="card-tools">--}}
{{--                                <a href="#" class="btn btn-tool btn-sm">--}}
{{--                                    <i class="fas fa-download"></i>--}}
{{--                                </a>--}}
{{--                                <a href="#" class="btn btn-tool btn-sm">--}}
{{--                                    <i class="fas fa-bars"></i>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-body table-responsive p-0">--}}
{{--                            <table class="table table-striped table-valign-middle">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Product</th>--}}
{{--                                    <th>Price</th>--}}
{{--                                    <th>Sales</th>--}}
{{--                                    <th>More</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <img src="{{asset('admin/images/user-icon.png')}}" alt="Product 1" class="img-circle img-size-32 mr-2">--}}
{{--                                        Some Product--}}
{{--                                    </td>--}}
{{--                                    <td>$13 USD</td>--}}
{{--                                    <td>--}}
{{--                                        <small class="text-success mr-1">--}}
{{--                                            <i class="fas fa-arrow-up"></i>--}}
{{--                                            12%--}}
{{--                                        </small>--}}
{{--                                        12,000 Sold--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <a href="#" class="text-muted">--}}
{{--                                            <i class="fas fa-search"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <img src="{{asset('admin/images/user-icon.png')}}" alt="Product 1" class="img-circle img-size-32 mr-2">--}}
{{--                                        Another Product--}}
{{--                                    </td>--}}
{{--                                    <td>$29 USD</td>--}}
{{--                                    <td>--}}
{{--                                        <small class="text-warning mr-1">--}}
{{--                                            <i class="fas fa-arrow-down"></i>--}}
{{--                                            0.5%--}}
{{--                                        </small>--}}
{{--                                        123,234 Sold--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <a href="#" class="text-muted">--}}
{{--                                            <i class="fas fa-search"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <img src="{{asset('admin/images/user-icon.png')}}" alt="Product 1" class="img-circle img-size-32 mr-2">--}}
{{--                                        Amazing Product--}}
{{--                                    </td>--}}
{{--                                    <td>$1,230 USD</td>--}}
{{--                                    <td>--}}
{{--                                        <small class="text-danger mr-1">--}}
{{--                                            <i class="fas fa-arrow-down"></i>--}}
{{--                                            3%--}}
{{--                                        </small>--}}
{{--                                        198 Sold--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <a href="#" class="text-muted">--}}
{{--                                            <i class="fas fa-search"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <img src="{{asset('admin/images/user-icon.png')}}" alt="Product 1" class="img-circle img-size-32 mr-2">--}}
{{--                                        Perfect Item--}}
{{--                                        <span class="badge bg-danger">NEW</span>--}}
{{--                                    </td>--}}
{{--                                    <td>$199 USD</td>--}}
{{--                                    <td>--}}
{{--                                        <small class="text-success mr-1">--}}
{{--                                            <i class="fas fa-arrow-up"></i>--}}
{{--                                            63%--}}
{{--                                        </small>--}}
{{--                                        87 Sold--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <a href="#" class="text-muted">--}}
{{--                                            <i class="fas fa-search"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>


@endsection
