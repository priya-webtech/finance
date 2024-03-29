@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Due Fees</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="clearfix"></div>
        <div class="card">
            <div class="card-body p-0">
                <div class="card-footer clearfix">
                    <form method="GET">
                    <div class="row">
                        <div class="col-sm-4 dateFilter">
                            <div style="max-width:400px;margin:auto">
                                <div class="input-icons">

                                    <input class="input-field form-control reportrange filter" id="reportrange" name="dates"  value=""  style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%" >
                                </div></div>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{route('due-fees')}}" class="btn btn-warning">Reset</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content px-3" id="dueFeesDataTable">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive due-fees-tbl">
                @include('admin.due-fees.table')
                </div>
                <div class="card-footer clearfix">
                    <div class="float-right">
{{--                                                @include('adminlte-templates::common.paginate', ['records' => $dueFees])--}}
                    </div>
                </div>
            </div>

        </div>
    </div>




{{--    <div class="content px-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body p-0">--}}

{{--                        <ul class="nav nav-tabs">--}}
{{--                            <li class="nav-item active">--}}
{{--                                <a class="nav-link active" role="tab" data-toggle="tab" href="#users">Students</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" role="tab" data-toggle="tab" onclick="postsDataTables()" href="#posts">Corporate</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--        <div class="tab-content">--}}
{{--            <div class="tab-pane fade active in" id="users">--}}

{{--                @include('admin.due-fees.table')--}}

{{--            </div>--}}
{{--            <div class="tab-pane fade" id="posts">--}}

{{--                <table class="table table-bordered table-condensed"  style="width:100%" id="postsTable">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Id</th>--}}
{{--                        <th>Name</th>--}}
{{--                        <th>Email</th>--}}
{{--                        <th>Contact No.</th>--}}
{{--                        <th>Agreed Amount</th>--}}
{{--                        <th>Total Amount</th>--}}
{{--                        <th>Due Fees</th>--}}
{{--                        <th>Action</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    </div>--}}
{{--    </div>--}}

@endsection
{{--@push('third_party_scripts')--}}
{{--    <script>--}}
{{--        --}}{{--function postsDataTables() {--}}
{{--        --}}{{--    $.get("{{ route('due-fees-corporate') }}", function( data ) {--}}
{{--        --}}{{--        if(data){--}}
{{--        --}}{{--            console.log(data);--}}
{{--        --}}{{--            $('#posts').html(data);--}}
{{--        --}}{{--        }--}}
{{--        --}}{{--    });--}}

{{--        --}}{{--}--}}
{{--        function postsDataTables() {--}}
{{--            if (!$.fn.dataTable.isDataTable('#postsTable')) {--}}
{{--                $('#postsTable').DataTable({--}}
{{--                    dom: 'Bfrtip',--}}
{{--                    processing: true,--}}
{{--                    serverSide: true,--}}
{{--                    order: [[0, 'desc']],--}}
{{--                    // buttons: [--}}
{{--                    //     'csv', 'excel', 'pdf', 'print', 'reset', 'reload'--}}
{{--                    // ],--}}
{{--                    ajax: 'due-fees-corporate',--}}
{{--                    columns: [--}}
{{--                        {data: 'id', name: 'id'},--}}
{{--                        {data: 'company_name', name: 'company_name'},--}}
{{--                        {data: 'email', name: 'email', width: '110px'},--}}
{{--                        {data: 'contact_no', name: 'contact_no', width: '120px'},--}}
{{--                        {data: 'agreed_amount', name: 'agreed_amount', width: '120px'},--}}
{{--                        {data: 'total_amount', name: 'total_amount', width: '120px'},--}}
{{--                        {data: 'due_fees', name: 'due_fees', width: '120px'},--}}
{{--                        {data: 'action', name: 'action', width: '120px'},--}}
{{--                    ],--}}
{{--                    // order: [[0, 'desc']]--}}
{{--                });--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
{{--@endpush--}}
