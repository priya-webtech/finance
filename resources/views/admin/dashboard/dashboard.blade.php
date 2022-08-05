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
                        <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">User</span>
                            <span class="info-box-number">{{$user}}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Branch</span>
                            <span class="info-box-number">{{$branch}}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Trainer</span>
                            <span class="info-box-number">{{$trainer}}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Corporate</span>
                            <span class="info-box-number">{{$corporate}}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Student</span>
                            <span class="info-box-number">{{$student}}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Course</span>
                            <span class="info-box-number">{{$course}}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Batch</span>
                            <span class="info-box-number">{{$batch}}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Income</span>
                            <span class="info-box-number">{{$income}}</span>
                        </div>

                    </div>

                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">ExpenceMaster</span>
                            <span class="info-box-number">{{$expenceMaster}}</span>
                        </div>

                    </div>

                </div>

            </div>

         <!--    <div id="chartContainer" style="height: 300px; width: 100%;"></div> -->


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
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    title: {
        text: "Monthly Sales Data"
    },
    axisX: {
        valueFormatString: "MMM"
    },
    axisY: {
        prefix: "$",
        labelFormatter: addSymbols
    },
    toolTip: {
        shared: true
    },
    legend: {
        cursor: "pointer",
        itemclick: toggleDataSeries
    },
    data: [
    {
        type: "column",
        name: "Actual Sales",
        showInLegend: true,
        xValueFormatString: "MMMM YYYY",
        yValueFormatString: "$#,##0",
        dataPoints: [
            { x: new Date(2016, 0), y: 20000 },
            { x: new Date(2016, 1), y: 30000 },
            { x: new Date(2016, 2), y: 25000 },
            { x: new Date(2016, 3), y: 70000, indexLabel: "High Renewals" },
            { x: new Date(2016, 4), y: 50000 },
            { x: new Date(2016, 5), y: 35000 },
            { x: new Date(2016, 6), y: 30000 },
            { x: new Date(2016, 7), y: 43000 },
            { x: new Date(2016, 8), y: 35000 },
            { x: new Date(2016, 9), y:  30000},
            { x: new Date(2016, 10), y: 40000 },
            { x: new Date(2016, 11), y: 50000 }
        ]
    }, 
    {
        type: "line",
        name: "Expected Sales",
        showInLegend: true,
        yValueFormatString: "$#,##0",
        dataPoints: [
            { x: new Date(2016, 0), y: 40000 },
            { x: new Date(2016, 1), y: 42000 },
            { x: new Date(2016, 2), y: 45000 },
            { x: new Date(2016, 3), y: 45000 },
            { x: new Date(2016, 4), y: 47000 },
            { x: new Date(2016, 5), y: 43000 },
            { x: new Date(2016, 6), y: 42000 },
            { x: new Date(2016, 7), y: 43000 },
            { x: new Date(2016, 8), y: 41000 },
            { x: new Date(2016, 9), y: 45000 },
            { x: new Date(2016, 10), y: 42000 },
            { x: new Date(2016, 11), y: 50000 }
        ]
    },
    {
        type: "area",
        name: "Profit",
        markerBorderColor: "white",
        markerBorderThickness: 2,
        showInLegend: true,
        yValueFormatString: "$#,##0",
        dataPoints: [
            { x: new Date(2016, 0), y: 5000 },
            { x: new Date(2016, 1), y: 7000 },
            { x: new Date(2016, 2), y: 6000},
            { x: new Date(2016, 3), y: 30000 },
            { x: new Date(2016, 4), y: 20000 },
            { x: new Date(2016, 5), y: 15000 },
            { x: new Date(2016, 6), y: 13000 },
            { x: new Date(2016, 7), y: 20000 },
            { x: new Date(2016, 8), y: 15000 },
            { x: new Date(2016, 9), y:  10000},
            { x: new Date(2016, 10), y: 19000 },
            { x: new Date(2016, 11), y: 22000 }
        ]
    }]
});
chart.render();

function addSymbols(e) {
    var suffixes = ["", "K", "M", "B"];
    var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);

    if(order > suffixes.length - 1)                 
        order = suffixes.length - 1;

    var suffix = suffixes[order];      
    return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
}

function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    } else {
        e.dataSeries.visible = true;
    }
    e.chart.render();
}

}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
