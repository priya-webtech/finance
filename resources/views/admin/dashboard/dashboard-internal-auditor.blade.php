@extends('layouts.app')

@section('content')
    @php
        $auth = \Illuminate\Support\Facades\Auth::user();
    @endphp
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

    <div class="content px-3">
        <div class="clearfix"></div>
        <div class="card">
            <div class="card-body p-0">
                <div class="card-footer clearfix">
                    <div class="row">
                            <div class="form-group col-sm-2">
                                {!! Form::label('type', 'Table:') !!}
                                {!! Form::select('type',['expense'=>'Expense','revenue'=>'Revenue'], null, ['class' => 'form-control','onchange'=>'ChangeType()']) !!}
                            </div>
                        <div class="form-group col-sm-2 incomeFilter" style="display: none">
                            {!! Form::label('income_type', 'Category:') !!}
                            {!! Form::select('income_type',$incomeType, null, ['class' => 'form-control filter','placeholder'=>'Select']) !!}
                        </div>
                        <div class="form-group  col-sm-4 dateFilter">
                            <div style="max-width:400px;margin:auto">
                                <div class="input-icons">
                                    <label class="form-label fs-5 fw-bold">Date:</label>
                                    <i class="icon glyphicon glyphicon-calendar fa fa-calendar"> </i>&nbsp;
                                    <input class="input-field form-control reportrange filter" id="reportrange" name="dates"  value=""  style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%" >

                                    <span></span> <b class="caret"></b>

                                </div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content px-3">
        <div class="clearfix"></div>
        <div class="card">
            <div class="" id="expense" style="display: none">
                <table class="table table-bordered table-condensed" id="ExpenseTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category Name</th>
                        <th>Total Expense</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="" id="income" style="display: none">
                <table class="table table-bordered table-condensed" id="IncomeTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category Name</th>
                        <th>Total Revenue</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('third_party_scripts')
    @include('layouts.datatables_css')
    @include('layouts.datatables_js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <script>
        function ChangeType() {
            var Type = $('#type').val();

            if(Type == 'expense'){

                $('#income').hide();
                $('#expense').show();
                $('.dateFilter').show();
                $('.incomeFilter').hide();
                var filter = true;
                // var dates = $('#reportrange').val();
                // alert(dates);
                if (!$.fn.dataTable.isDataTable('#ExpenseTable') || filter == true) {
                    var ExpTable = $('#ExpenseTable').DataTable({
                        dom: 'Bfrtip',
                        processing: true,
                        serverSide: true,
                        stateSave: true,
                        retrieve: true,
                        paging: false,
                        // order: [[0, 'desc']],
                        ajax:
                            {
                                // "url": 'expense-data-table',
                                "url":"{{ route('expense-data-table') }}",
                                "data": function (d) {
                                    d.dates = $('#reportrange').val();
                                    // d.status = $('#status').val();
                                }
                            },
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'title', name: 'title'},
                            {data: 'total_expense', name: 'total_expense'},
                            {data: 'action', name: 'action'},
                        ],
                    });
                    ExpTable.draw();
                }

            }
            else if(Type == 'revenue'){
                $('#expense').hide();
                $('#income').show();
                $('.dateFilter').show();
                $('.incomeFilter').show();
                var filter = true;
                if (!$.fn.dataTable.isDataTable('#IncomeTable') || filter == true) {
                    var IncomeTable = $('#IncomeTable').DataTable({
                        dom: 'Bfrtip',
                        processing: true,
                        serverSide: true,
                        stateSave: true,
                        retrieve: true,
                        paging: false,
                        // order: [[0, 'desc']],
                        ajax:
                            {
                                "url": 'income-data-table',
                                "data": function (d) {
                                    d.dates = $('#reportrange').val();
                                    d.income_type = $('#income_type').val();
                                }
                            },
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'course_name', name: 'course_name'},
                            {data: 'total_revenue', name: 'total_revenue'},
                            {data: 'action', name: 'action'},
                        ],
                    });
                    IncomeTable.draw();
                }

            }

        }
    </script>
    <script type="text/javascript">

        $(function() {

            var start = moment().subtract(365, 'days');
            var end = moment();

            function cb(start, end) {

                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                // autoUpdateInput: false,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });

    </script>

    <script type="text/javascript">
        $( document ).ready(function() {
            ChangeType();
        });
        function dataTable() {
            var  filter = true;
            if (!$.fn.dataTable.isDataTable('#StudentTable') || filter==true) {
                var table = $('#StudentTable').DataTable({
                    dom: 'Bfrtip',
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    "searchDelay" : 500,
                    "responsive": {
                        orthogonal: 'responsive'
                    },
                    // paging: false,
                    order: [[0, 'desc']],
                    // buttons: [
                    //     'csv', 'excel', 'pdf', 'print', 'reset', 'reload'
                    // ],
                    // ajax: 'student-data-table',
                    // data: function (d) {
                    //    d.lead_source = $('#lead_source').val();
                    // },
                    ajax:
                        {
                            "url": 'student-data-table',
                            "data": function (d) {
                                d.lead_source = $('#lead_source').val();
                                d.enquiry_type = $('#enquiry_type').val();
                                d.student_type = $('#student_type').val();
                                d.state = $('#state').val();
                                d.dates = $('#reportrange').val();
                                d.status = $('#status').val();
                            }
                        },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'mobile_no', name: 'mobile_no'},
                        {data: 'student_type', name: 'student_type'},
                        {data: 'enquiry_type', name: 'enquiry_type'},
                        {data: 'lead_source_id', name: 'lead_source_id'},
                        {data: 'branch_id', name: 'branch_id'},
                        {data: 'state', name: 'state'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action'},
                    ],
                    order: [[0, 'desc']]
                });
            }


        }
        $('.filter').change(function(){
            alert('okay');
            dataTable();
            // table.draw();
            ChangeType();
        });
    </script>
@endpush
