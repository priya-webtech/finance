@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Due Fees</h1>
                </div>
{{--                <div class="col-sm-6">--}}
{{--                    <a class="btn btn-primary float-right"--}}
{{--                       href="{{ route('admin.students.create') }}">--}}
{{--                        Add New--}}
{{--                    </a>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>

{{--    <div class="content px-3" id="studentDueFeesDataTable">--}}

{{--        @include('flash::message')--}}

{{--        <div class="clearfix"></div>--}}

{{--        <div class="card">--}}
{{--            <div class="card-body p-0">--}}
{{--                @include('admin.due-fees.table')--}}

{{--                <div class="card-footer clearfix">--}}
{{--                    <div class="float-right">--}}
{{--                        @include('adminlte-templates::common.paginate', ['records' => $dueFees])--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="content px-3" id="dueFeesDataTable">--}}

{{--        @include('flash::message')--}}

{{--        <div class="clearfix"></div>--}}

{{--        <div class="card">--}}
{{--            <div class="card-body p-0">--}}
{{--                @include('admin.due-fees.table')--}}

{{--                <div class="card-footer clearfix">--}}
{{--                    <div class="float-right">--}}
{{--                        --}}{{--                        @include('adminlte-templates::common.paginate', ['records' => $dueFees])--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--        <div class="card" id="corporateDueFeesDataTable">--}}
{{--            <div class="card-body p-0">--}}
{{--                @include('admin.due-fees.copro-table')--}}

{{--                <div class="card-footer clearfix">--}}
{{--                    <div class="float-right">--}}
{{--                        --}}{{--                        @include('adminlte-templates::common.paginate', ['records' => $dueFees])--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}




    <div class="content px-3">
                <div class="card">
                    <div class="card-body p-0">
{{--    <div class="tabs">--}}
                        <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a class="nav-link active" role="tab" data-toggle="tab" href="#users">Students</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" role="tab" data-toggle="tab" onclick="postsDataTables()" href="#posts">Corporate</a>
                            </li>
                        </ul>
{{--        <ul class="nav nav-tabs">--}}
{{--            <li class="nav-item active">--}}
{{--                <a href="#users" role="tab" data-toggle="tab">--}}
{{--                    <icon class="fa fa-home"></icon>Users--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a href="#posts" role="tab" data-toggle="tab" onclick="postsDataTables()">--}}
{{--                    <i class="fa fa-user"></i>Posts--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
        <div class="tab-content">
            <div class="tab-pane fade active in" id="users">
{{--                <h5><b>Student Due Fees</b></h5>--}}
                @include('admin.due-fees.table')

            </div>
            <div class="tab-pane fade" id="posts">
{{--                <h5><b>Corporate Due Fees</b></h5>--}}
                <table class="table table-bordered table-condensed"  style="width:100%" id="postsTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Agreed Amount</th>
                        <th>Total Amount</th>
                        <th>Due Fees</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
{{--    </div>--}}
@endsection
@push('third_party_scripts')
    <script>
        {{--function postsDataTables() {--}}
        {{--    $.get("{{ route('due-fees-corporate') }}", function( data ) {--}}
        {{--        if(data){--}}
        {{--            console.log(data);--}}
        {{--            $('#posts').html(data);--}}
        {{--        }--}}
        {{--    });--}}

        {{--}--}}
        function postsDataTables() {
            if (!$.fn.dataTable.isDataTable('#postsTable')) {
                $('#postsTable').DataTable({
                    dom: 'Bfrtip',
                    processing: true,
                    serverSide: true,
                    order: [[0, 'desc']],
                    // buttons: [
                    //     'csv', 'excel', 'pdf', 'print', 'reset', 'reload'
                    // ],
                    ajax: 'due-fees-corporate',
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'company_name', name: 'company_name'},
                        {data: 'email', name: 'email', width: '110px'},
                        {data: 'contact_no', name: 'contact_no', width: '120px'},
                        {data: 'agreed_amount', name: 'agreed_amount', width: '120px'},
                        {data: 'total_amount', name: 'total_amount', width: '120px'},
                        {data: 'due_fees', name: 'due_fees', width: '120px'},
                        {data: 'action', name: 'action', width: '120px'},
                    ],
                    // order: [[0, 'desc']]
                });
            }
        }
    </script>
@endpush
