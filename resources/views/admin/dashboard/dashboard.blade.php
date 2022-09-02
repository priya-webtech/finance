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
                        @if($auth->hasRole('super_admin') || $auth->hasRole('admin') || $auth->hasRole('branch_manager'))
                     <div class="form-group col-sm-2">
                        {!! Form::label('type', 'Table:') !!}
                        {!! Form::select('type',['student'=>'Retail Student','corporate'=>'Corporate','due-fees'=>'DueFees','expense'=>'Expense','revenue'=>'Revenue','trainer'=>'Trainer','batch'=>'Batch','transactions'=>'Transactions','gst'=>"GST"], null, ['class' => 'form-control','onchange'=>'ChangeType()']) !!}
                     </div>
                        @elseif($auth->hasRole('counsellor'))
                            <div class="form-group col-sm-2">
                                {!! Form::label('type', 'Table:') !!}
                                {!! Form::select('type',['student'=>'Retail Student','corporate'=>'Corporate','due-fees'=>'DueFees','batch'=>'Batch'], null, ['class' => 'form-control','onchange'=>'ChangeType()']) !!}
                            </div>
                            @endif
                    <div class="form-group col-sm-2 status">
                        {!! Form::label('status', 'Type:') !!}
                        {!! Form::select('status',[''=>'All','assigned'=>'Assigned','unassigned'=>'Unassigned'], null, ['class' => 'form-control filter']) !!}
                    </div>
                        <div class="form-group col-sm-2 student" >
                            {!! Form::label('lead_source', 'Lead source:') !!}
                            {!! Form::select('lead_source',$leadSources, null, ['class' => 'form-control filter','id'=>'lead_source','placeholder'=>'Select']) !!}
                        </div>
                        <div class="form-group col-sm-2 student">
                            {!! Form::label('enquiry_type', 'Enquiry Type:') !!}
                            {!! Form::select('enquiry_type',$enquirytype, null, ['class' => 'form-control filter','placeholder'=>'Select']) !!}
                        </div>
                        <div class="form-group col-sm-2 student">
                            {!! Form::label('student_type', 'Student Type:') !!}
                            {!! Form::select('student_type',$studentType, null, ['class' => 'form-control filter','placeholder'=>'Select']) !!}
                        </div>
                        <div class="form-group col-sm-2 student" >
                            {!! Form::label('state', 'State:') !!}
                            {!! Form::select('state',$state, null, ['class' => 'form-control filter','placeholder'=>'Select']) !!}
                        </div>
                        <div class="form-group col-sm-2 batchFilter" style="display: none">
                            {!! Form::label('batch_mode', 'Batch Mode:') !!}
                            {!! Form::select('batch_mode',$batchMode, null, ['class' => 'form-control filter','placeholder'=>'Select']) !!}
                        </div>
                        <div class="form-group col-sm-2 batchFilter" style="display: none">
                            {!! Form::label('batch_type', 'Batch Type:') !!}
                            {!! Form::select('batch_type',$batchType, null, ['class' => 'form-control filter','placeholder'=>'Select']) !!}
                        </div>
                        <div class="form-group col-sm-2 incomeFilter" style="display: none">
                            {!! Form::label('income_type', 'Category:') !!}
                            {!! Form::select('income_type',$incomeType, null, ['class' => 'form-control filter','placeholder'=>'Select']) !!}
                        </div>
{{--                        <div class="form-group  col-sm-4">--}}
{{--                            {!! Form::label('date', 'Date:') !!}--}}
{{--                            <div>--}}
{{--                            <input id="reportrange" name="dates" class="pull-left form-control filter" value="" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;" placeholder="select Date" >--}}
{{--                                <i class="glyphicon glyphicon-calendar fa fa-calendar filter" ></i>&nbsp;--}}
{{--                                <span id="dates"></span> <b class="caret"></b>--}}
{{--                            </input>--}}
{{--                            </div>--}}
{{--                    </div>--}}
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
                <div class="" id="student">
                    <table class="table table-bordered table-condensed" id="StudentTable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Student Type</th>
                            <th>Enquiry Type</th>
                            <th>lead Source</th>
                            <th>Branch</th>
                            <th>State</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="" id="corporate" style="display: none">
                    <table class="table table-bordered table-condensed" id="CorporateTable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Web Site</th>
                            <th>Lead Source</th>
                            <th>Enquiry Type</th>
                            <th>Branch</th>
                            <th>State</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
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
            <div class="" id="trainer" style="display: none">
                <table class="table table-bordered table-condensed" id="TrainerTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Course Name</th>
                        <th>Trainer Name</th>
                        <th>Fees</th>
                        <th>Paid</th>
                        <th>Out Standing</th>
                        <th>Payment Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="" id="batch" style="display: none">
                <table class="table table-bordered table-condensed" id="BatchTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Course Name</th>
                        <th>Batch Mode</th>
                        <th>Trainer</th>
                        <th>Batch Name</th>
                        <th>Batch Status</th>
                        <th>Batch Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="" id="transactions" style="display: none">
                <table class="table table-bordered table-condensed" id="TransactionsTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>Id</th>
{{--                        <th>Mode</th>--}}
                        <th>Name</th>
                        <th>Ifsc Code</th>
                        <th>Account No.</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="" id="cash" style="display: none">
                <table class="table table-bordered table-condensed" id="CashTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>Id</th>
                        {{--                        <th>Mode</th>--}}
                        <th>Name</th>
{{--                        <th>Ifsc Code</th>--}}
{{--                        <th>Account No.</th>--}}
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="" id="gst" style="display: none">
                <table class="table table-bordered table-condensed" id="GstTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Total GST</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="" id="due-fees" style="display: none">
                <table class="table table-bordered table-condensed" id="DueFeesTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course Name</th>
                        <th>Due Date</th>
                        <th>Agreed Amount</th>
                        <th>Pay Amount</th>
                        <th>GST</th>
                        <th>Due Fees</th>
                        <th>Type</th>
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
                if (Type == "student") {
                    $('.student').show();
                    $('#corporate').hide();
                    $('#expense').hide();
                    $('.status').show();
                    $('.batchFilter').hide();
                    $('#income').hide();
                    $('#trainer').hide();
                    $('#batch').hide();
                    $('#cash').hide();
                    $('#transactions').hide();
                    $('#gst').hide();
                    $('#student').show();
                    $('.dateFilter').show();
                    $('.incomeFilter').hide();
                    $('#due-fees').hide();
                } else if (Type == 'corporate'){
                    $('.student').hide();
                    $('.batchFilter').hide();
                    $('#student').hide();
                    $('#expense').hide();
                    $('#income').hide();
                    $('.status').show();
                    $('#trainer').hide();
                    $('.incomeFilter').hide();
                    $('#batch').hide();
                    $('#cash').hide();
                    $('#transactions').hide();
                    $('#gst').hide();
                    $('#corporate').show();
                    $('.dateFilter').show();
                    $('#due-fees').hide();
                    var filter = true;
                    if (!$.fn.dataTable.isDataTable('#CorporateTable') || filter == true) {
                        let CorpoTable = $('#CorporateTable').DataTable({
                            dom: 'Bfrtip',
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            retrieve: true,
                            paging: false,
                            order: [[0, 'desc']],
                            ajax:
                                {
                                    "url": 'corporate-data-table',
                                    "data": function (d) {
                                        d.dates = $('#reportrange').val();
                                        d.status = $('#status').val();
                                    }
                                },
                            columns: [
                                {data: 'id', name: 'id'},
                                {data: 'company_name', name: 'company_name'},
                                {data: 'email', name: 'email'},
                                {data: 'web_site', name: 'web_site'},
                                {data: 'lead_source_id', name: 'lead_source_id'},
                                {data: 'enquiry_type_id', name: 'enquiry_type_id'},
                                {data: 'branch_id', name: 'branch_id'},
                                {data: 'state', name: 'state'},
                                {data: 'status', name: 'status'},
                                {data: 'action', name: 'action'},
                            ],
                        });
                        CorpoTable.draw();
                    }

                }
                else if(Type == 'expense'){
                    $('.student').hide();
                    $('.batchFilter').hide();
                    $('#student').hide();
                    $('.status').hide();
                    $('#corporate').hide();
                    $('#income').hide();
                    $('#trainer').hide();
                    $('#batch').hide();
                    $('#transactions').hide();
                    $('#gst').hide();
                    $('#cash').hide();
                    $('#expense').show();
                    $('.dateFilter').show();
                    $('.incomeFilter').hide();
                    $('#due-fees').hide();
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
                    $('.student').hide();
                    $('#student').hide();
                    $('.batchFilter').hide();
                    $('#corporate').hide();
                    $('.status').hide();
                    $('#expense').hide();
                    $('#trainer').hide();
                    $('#batch').hide();
                    $('#income').show();
                    $('#transactions').hide();
                    $('#gst').hide();
                    $('#cash').hide();
                    $('.dateFilter').show();
                    $('.incomeFilter').show();
                    $('#due-fees').hide();
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
                                {data: 'title', name: 'title'},
                                {data: 'total_revenue', name: 'total_revenue'},
                                {data: 'action', name: 'action'},
                            ],
                        });
                        IncomeTable.draw();
                    }

                }

            else if(Type == 'trainer'){
                    $('.student').hide();
                    $('#student').hide();
                    $('.batchFilter').hide();
                    $('#corporate').hide();
                    $('.status').hide();
                    $('#expense').hide();
                    $('#income').hide();
                    $('#trainer').show();
                    $('#batch').hide();
                    $('#transactions').hide();
                    $('#gst').hide();
                    $('#cash').hide();
                    $('.incomeFilter').hide();
                    $('.dateFilter').show();
                    $('#due-fees').hide();
                    var filter = true;
                    if (!$.fn.dataTable.isDataTable('#TrainerTable') || filter == true) {
                        let TrainerTable = $('#TrainerTable').DataTable({
                            dom: 'Bfrtip',
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            retrieve: true,
                            paging: false,
                            ajax:
                                {
                                    "url": 'trainer-data-table',
                                    "data": function (d) {
                                        // d.dates = $('#reportrange').val();
                                    }
                                },
                            columns: [
                                {data: 'id', name: 'id'},
                                {data: 'course_id', name: 'course_id'},
                                {data: 'trainer_name', name: 'trainer_name'},
                                 {data: 'fees', name: 'fees'},
                                 {data: 'paid', name: 'paid'},
                                 {data: 'out_Standing', name: 'out_Standing'},
                                 {data: 'payment_status', name: 'payment_status'},
                                {data: 'action', name: 'action'},
                            ],
                        });
                        TrainerTable.draw();
                    }

                }
                else if(Type == 'due-fees'){
                    $('.student').hide();
                    $('#student').hide();
                    $('.batchFilter').hide();
                    $('#corporate').hide();
                    $('.status').hide();
                    $('#expense').hide();
                    $('#income').hide();
                    $('#trainer').hide();
                    $('#transactions').hide();
                    $('#gst').hide();
                    $('.incomeFilter').hide();
                    $('#cash').hide();
                    $('#batch').hide();
                    $('#batch').hide();
                    $('#due-fees').show();
                    var filter = true;
                    if (!$.fn.dataTable.isDataTable('#DueFeesTable') || filter == true) {
                        var DueFeesTable = $('#DueFeesTable').DataTable({
                            dom: 'Bfrtip',
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            retrieve: true,
                            paging: false,
                            ajax:
                                {
                                    "url": 'due-fees-data-table',
                                    "data": function (d) {
                                        d.dates = $('#reportrange').val();
                                    }
                                },
                            columns: [
                                {data: 'id', name: 'id'},
                                {data: 'name', name: 'name'},
                                {data: 'email', name: 'email'},
                                {data: 'course_name', name: 'course_name'},
                                {data: 'due_date', name: 'due_date'},
                                {data: 'agreed_amount', name: 'agreed_amount'},
                                {data: 'due_fees', name: 'due_fees'},
                                {data: 'gst', name: 'gst'},
                                {data: 'pay_amount', name: 'pay_amount'},
                                {data: 'type', name: 'type'},
                                {data: 'action', name: 'action'},
                            ],
                        });
                        DueFeesTable.draw();
                    }
                }
                else if(Type == 'batch'){
                    $('.student').hide();
                    $('#student').hide();
                    $('.batchFilter').show();
                    $('#corporate').hide();
                    $('.status').hide();
                    $('#expense').hide();
                    $('#income').hide();
                    $('#trainer').hide();
                    $('#transactions').hide();
                    $('#gst').hide();
                    $('.incomeFilter').hide();
                    $('#cash').hide();
                    $('#batch').show();
                    $('.dateFilter').show();
                    $('#due-fees').hide();
                    var filter = true;
                    if (!$.fn.dataTable.isDataTable('#BatchTable') || filter == true) {
                        var BatchTable = $('#BatchTable').DataTable({
                            dom: 'Bfrtip',
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            retrieve: true,
                            paging: false,
                            ajax:
                                {
                                    "url": 'batch-data-table',
                                    "data": function (d) {
                                        d.dates = $('#reportrange').val();
                                        d.batch_type = $('#batch_type').val();
                                        d.batch_mode = $('#batch_mode').val();
                                    }
                                },
                            columns: [
                                {data: 'id', name: 'id'},
                                {data: 'course_id', name: 'course_id'},
                                {data: 'batch_mode_id', name: 'batch_mode_id'},
                                {data: 'trainer_id', name: 'trainer_id'},
                                {data: 'name', name: 'name'},
                                {data: 'batch_status', name: 'batch_status'},
                                {data: 'batch_type_id', name: 'batch_type_id'},
                                {data: 'action', name: 'action'},
                            ],
                        });
                        BatchTable.draw();
                    }
                }

                else if(Type == 'transactions'){
                    $('.student').hide();
                    $('#student').hide();
                    $('.batchFilter').hide();
                    $('#corporate').hide();
                    $('.status').hide();
                    $('#expense').hide();
                    $('#income').hide();
                    $('#trainer').hide();
                    $('#batch').hide();
                    $('.dateFilter').hide();
                    $('#cash').hide();
                    $('#transactions').show();
                    $('#gst').hide();
                    $('.incomeFilter').hide();
                    $('#due-fees').hide();
                    var filter = true;
                    if (!$.fn.dataTable.isDataTable('#TransactionsTable') || filter == true) {
                        var BankTable = $('#TransactionsTable').DataTable({
                            dom: 'Bfrtip',
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            retrieve: true,
                            paging: false,
                            ajax:
                                {
                                    "url": 'bank-data-table',
                                    "data": function (d) {
                                        d.balance_type = 'bank';
                                    }
                                },

                            columns: [
                                {data: 'id', name: 'id'},
                                // {data: 'title', name: 'title'},
                                {data: 'name', name: 'name'},
                                {data: 'ifsc_code', name: 'ifsc_code'},
                                {data: 'account_no', name: 'account_no'},
                                {data: 'opening_balance', name: 'opening_balance'},
                                {data: 'status', name: 'status'},
                                {data: 'action', name: 'action'},
                            ],
                        });
                        // BankTable.draw();
                    }
                }
                else if(Type == 'cash') {
                    $('.student').hide();
                    $('#student').hide();
                    $('.batchFilter').hide();
                    $('#corporate').hide();
                    $('.status').hide();
                    $('#expense').hide();
                    $('#income').hide();
                    $('#trainer').hide();
                    $('#batch').hide();
                    $('.dateFilter').hide();
                    $('#transactions').hide();
                    $('#cash').show();
                    $('#gst').hide();
                    $('.incomeFilter').hide();
                    $('#due-fees').hide();
                    var filter = true;
                    if (!$.fn.dataTable.isDataTable('#CashTable') || filter == true) {
                        $('#CashTable').DataTable({
                            dom: 'Bfrtip',
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            retrieve: true,
                            paging: false,
                            ajax:
                                {
                                    "url": 'cash-data-table',
                                    "data": function (d) {
                                        d.balance_type = 'cash';
                                    }
                                },

                            columns: [
                                {data: 'id', name: 'id'},
                                // {data: 'title', name: 'title'},
                                {data: 'name', name: 'name'},
                                // {data: 'ifsc_code', name: 'ifsc_code'},
                                // {data: 'account_no', name: 'account_no'},
                                {data: 'opening_balance', name: 'opening_balance'},
                                {data: 'status', name: 'status'},
                                {data: 'action', name: 'action'},
                            ],
                        });
                        // BankTable.draw();
                    }
                }
                else if(Type == 'gst'){
                    $('.incomeFilter').hide();
                    $('.student').hide();
                    $('#student').hide();
                    $('.batchFilter').hide();
                    $('#corporate').hide();
                    $('.status').hide();
                    $('#expense').hide();
                    $('#income').hide();
                    $('#trainer').hide();
                    $('#batch').hide();
                    $('.dateFilter').hide();
                    $('#transactions').hide();
                    $('#cash').hide();
                    $('#gst').show();
                    $('#due-fees').hide();
                    var filter = true;
                    if (!$.fn.dataTable.isDataTable('#GstTable') || filter == true) {

                        var GstTable = $('#GstTable').DataTable({
                            dom: 'Bfrtip',
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            retrieve: true,
                            paging: false,
                            ajax:
                                {
                                    "url": 'gst-data-table',
                                    "data": function (d) {
                                        // d.balance_type = $('#type').val();
                                    }
                                },
                            columns: [
                                {data: 'id', name: 'id'},
                                {data: 'name', name: 'name'},
                                {data: 'total_gst', name: 'total_gst'},
                                {data: 'action', name: 'action'},
                            ],
                        });
                        GstTable.draw();
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
            dataTable();
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
            $('.filter').change(function(){

                dataTable();
                table.draw();
                ChangeType();
            });

        }
        </script>
    @endpush