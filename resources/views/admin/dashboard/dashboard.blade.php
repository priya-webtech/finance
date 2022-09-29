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

                        @if($auth->hasRole('super_admin') || $auth->hasRole('admin'))
                            <div class="form-group col-sm-2">
                                {!! Form::label('type', 'Select category:') !!}
                                {!! Form::select('type',['student'=>'Retail Student','user'=>'User','corporate'=>'Corporate training','due-fees'=>'Due Fees','expense'=>'Expenses','revenue'=>'All Revenues','trainer'=>'Trainer','batch'=>'Batches','transactions'=>'Transactions','gst'=>"GST"], null, ['class' => 'form-control','onchange'=>'ChangeType()']) !!}
                            </div>
                            @elseif($auth->hasRole('branch_manager'))
                            <div class="form-group col-sm-2">
                                {!! Form::label('type', 'Select category:') !!}
                                {!! Form::select('type',['student'=>'Retail Student','user'=>'User' ,'corporate'=>'Corporate training','due-fees'=>'Due Fees','expense'=>'Expenses','revenue'=>'All Revenues','trainer'=>'Trainer','batch'=>'Batches'], null, ['class' => 'form-control','onchange'=>'ChangeType()']) !!}
                            </div>
                        @elseif($auth->hasRole('counsellor'))
                            <div class="form-group col-sm-2">
                                {!! Form::label('type', 'Select category:') !!}
                                {!! Form::select('type',['user'=>'User' ,'student'=>'Retail Student','corporate'=>'Corporate training','due-fees'=>'Due Fees','batch'=>'Batches'], null, ['class' => 'form-control','onchange'=>'ChangeType()']) !!}
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

                        <div class="form-group col-sm-2 userFilter" style="display: none">
                            {!! Form::label('role_id', 'Role:') !!}
                            {!! Form::select('role_id',$role, null, ['class' => 'form-control filter','placeholder'=>'Select']) !!}
                        </div>
                        <div class="form-group col-sm-2 userFilter" style="display: none">
                            {!! Form::label('branch_id', 'Branch:') !!}
                            {!! Form::select('branch_id',$branch, null, ['class' => 'form-control filter','placeholder'=>'Select']) !!}
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
                            {!! Form::select('income_type', $course, null, ['class' => 'form-control filter','placeholder'=>'Select']) !!}
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
                <table class="table table-striped table-bordered" id="StudentTable" style="width:100%">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Email</th>
                        <th>Placement</th>
                        <th>Student Type</th>
                        <th>Enquiry Type</th>
                        <th>lead Source</th>
                        <th>Branch</th>
                        <th>Course</th>
                        <th>Agreed course fees</th>
                        <th>Trainer name</th>
                        <th>State</th>
                        <th>Reg date</th>
                        <th>Status</th>
                       <!--  <th>Trainer Name</th>
                        <th>State</th>
                        <th>Placement</th>
                        <th>Reg. date</th> -->
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="" id="corporate" style="display: none">
                <table class="table table-striped table-bordered" id="CorporateTable">
                    <thead>
                    <tr>
                        <th>S.No</th>
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
                <table class="table table-striped table-bordered" id="ExpenseTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Expence Type</th>
                        <th>Branch</th>
                        <th>Bank Ac</th>
                        <th>TDS</th>
                        <th>Amount</th>
                        <th>Remark</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="" id="income" style="display: none">
                <table class="table table-striped table-bordered" id="IncomeTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Category Name</th>
                        <th>Total Revenue</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="" id="trainer" style="display: none">
                <table class="table table-striped table-bordered" id="TrainerTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>S.No</th>
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
                <table class="table table-striped table-bordered" id="BatchTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>S.No</th>
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

             <div class="user" id="user" style="display: none">
                <table class="table table-striped table-bordered" id="UserTable" style="width:100%">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Mobile No</th>
                        <th>Branch</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                </table>
            </div>

            <div class="" id="transactions" style="display: none">
                <table class="table table-striped table-bordered" id="TransactionsTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Type(Income or expsense)</th>
                        <th>Bank Name</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="" id="cash" style="display: none">
                <table class="table table-striped table-bordered" id="CashTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>S.No</th>
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
                <table class="table table-striped table-bordered" id="GstTable" width="100%" border=1>
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
                <table class="table table-striped table-bordered" id="DueFeesTable" width="100%" border=1>
                    <thead>
                    <tr>
                        <th>S.No</th>
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
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
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
                $('#user').hide();
                $('.userFilter').hide();
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
                $('#user').hide();
                $('.userFilter').hide();
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
                        ordering: false,
                        buttons: [
                            'excel',
                        ],
                        ajax:
                            {
                                "url": 'corporate-data-table',
                                "data": function (d) {
                                    d.dates = $('#reportrange').val();
                                    d.status = $('#status').val();
                                }
                            },
                        columns: [
                            {data: 'rank', name: 'rank'},
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
            else if(Type == 'user'){
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
                $('#expense').hide();
                $('#user').show();
                $('.userFilter').show();
                $('.dateFilter').show();
                $('.incomeFilter').hide();
                $('#due-fees').hide();
                var filter = true;
                if (!$.fn.dataTable.isDataTable('#UserTable') || filter == true) {
                    var ExpTable = $('#UserTable').DataTable({
                        dom: 'Bfrtip',
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        retrieve: true,

                        buttons: [
                            'excel',
                        ],

                        "searchDelay" : 500,
                        "responsive": {
                            orthogonal: 'responsive'
                        },
                     
                        ajax:
                            {
                                "url":"{{ route('user-data-table') }}",
                                "data": function (d) {
                                    d.dates = $('#reportrange').val();
                                    d.role_id = $('#role_id').val();
                                    d.branch_id = $('#branch_id').val();
                                    // d.status = $('#status').val();
                                }
                            },
                        columns: [
                            {data: 'rank', name: 'rank'},
                            {data: 'name', name: 'name'},
                            {data: 'email', name: 'email'},
                            {data: 'role_id', name: 'role_id'},
                            {data: 'mobile_no', name: 'mobile_no'},
                            {data: 'branch_id', name: 'branch_id'},
                            {data: 'status', name: 'status'},
                        ],
                        order: [[0, 'asc']]
                    });
                    ExpTable.draw();
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
                $('#user').hide();
                $('.userFilter').hide();
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
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        retrieve: true,
                        "searchDelay" : 500,
                        "responsive": {
                            orthogonal: 'responsive'
                        },
                        // order: [[0, 'desc']],

                        buttons: [
                            'excel',
                        ],

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
                            {data: 'rank', name: 'rank'},
                            {data: 'trainer_id', name: 'trainer_id'},
                            {data: 'expence_type_id', name: 'expence_type_id'},
                            {data: 'branch_id', name: 'branch_id'},
                            {data: 'bank_ac_id', name: 'bank_ac_id'},
                            {data: 'tds', name: 'tds'},
                            {data: 'amount', name: 'amount'},
                            {data: 'remark', name: 'remark'},
                        ],
                        order: [[0, 'asc']]
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
                $('#user').hide();
                $('.userFilter').hide();
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
                        ordering: false,
                        // order: [[0, 'desc']],
                        buttons: [
                            'excel',
                        ],
                        ajax:
                            {
                                "url": 'income-data-table',
                                "data": function (d) {
                                    d.dates = $('#reportrange').val();
                                    d.income_type = $('#income_type').val();
                                }
                            },
                        columns: [
                            {data: 'rank', name: 'rank'},
                            {data: 'course_name', name: 'course_name'},
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
                $('#user').hide();
                $('.userFilter').hide();
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
                        ordering: false,
                        buttons: [
                            'excel',
                        ],
                        ajax:
                            {
                                "url": 'trainer-data-table',
                                "data": function (d) {
                                    // d.dates = $('#reportrange').val();
                                }
                            },
                        columns: [
                            {data: 'rank', name: 'rank'},
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
                $('#user').hide();
                $('.userFilter').hide();
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
                        buttons: [
                            'excel',
                        ],
                        ajax:
                            {
                                "url": 'due-fees-data-table',
                                "data": function (d) {
                                    d.dates = $('#reportrange').val();
                                }
                            },
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                            // {data: 'id', name: 'id'},
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
                $('#user').hide();
                $('.userFilter').hide();
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
                        ordering: false,
                        buttons: [
                            'excel',
                        ],
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
                            {data: 'rank', name: 'rank'},
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
                $('#user').hide();
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
                        ordering: false,
                        buttons: [
                            'excel',
                        ],
                        ajax:
                            {
                                "url": 'bank-data-table',
                                "data": function (d) {
                                    d.balance_type = 'bank';
                                }
                            },

                        columns: [
                            //  {data: 'rank', name: 'rank'},
                            // {data: 'title', name: 'title'},
                            {data: 'created_at', name: 'created_at'},
                            {data: 'id', name: 'id'},
                            {data: 'type', name: 'type'},
                            {data: 'income_bankk', name: 'income_bankk'},
                            {data: 'ExpenceMaster_amount', name: 'ExpenceMaster_amount'},
                            

                            
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
                $('#user').hide();
                $('.userFilter').hide();
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
                        ordering: false,
                        buttons: [
                            'excel',
                        ],
                        ajax:
                            {
                                "url": 'cash-data-table',
                                "data": function (d) {
                                    d.balance_type = 'cash';
                                }
                            },

                        columns: [
                            {data: 'rank', name: 'rank'},
                            // {data: 'title', name: 'title'},
                            {data: 'title', name: 'title'},
                            // {data: 'ifsc_code', name: 'ifsc_code'},
                            // {data: 'account_no', name: 'account_no'},
                            {data: 'opening_balance', name: 'opening_balance'},
                            {data: 'status', name: 'status'},
                            {data: 'action', name: 'action'},
                        ],
                        // order: [[0, 'asc']],
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
                $('#`').hide();
                $('#income').hide();
                $('#trainer').hide();
                $('#batch').hide();
                $('.dateFilter').hide();
                $('#transactions').hide();
                $('#user').hide();
                $('.userFilter').hide();
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
                        buttons: [
                            'excel',
                        ],
                        ajax:
                            {
                                "url": 'gst-data-table',
                                "data": function (d) {
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
        $( document ).ready(function() {
            dataTable();
        });
        function dataTable() {
            var  filter = true;
            if (!$.fn.dataTable.isDataTable('#StudentTable') || filter==true) {
                var table = $('#StudentTable').DataTable({
                    dom: 'Bfrtip',
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    "searchDelay" : 500,
                    buttons: [
                            'excel',
                        ],

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
                        {data: 'rank', name: 'rank'},
                        {data: 'name', name: 'name'},
                        {data: 'mobile_no', name: 'mobile_no'},
                        {data: 'email', name: 'email'},
                        {data: 'placement', name: 'placement'},
                        {data: 'student_type', name: 'student_type'},
                        {data: 'enquiry_type', name: 'enquiry_type'},
                        {data: 'lead_source_id', name: 'lead_source_id'},
                        {data: 'branch_id', name: 'branch_id'},
                        {data: 'course', name: 'course'},
                        {data: 'agreed_amount', name: 'agreed_amount'},
                        {data: 'trainer_name', name: 'trainer_name'},
                        {data: 'state', name: 'state'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'status', name: 'status'},
                       /* {data: 'state', name: 'state'},*/
                        /*{data: 'status', name: 'status'},
                        {data: 'action', name: 'action'},*/
                    ],
                    order: [[0, 'asc']]
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


