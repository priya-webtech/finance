@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Expense</h1>
                </div>
                @can('expence_create')
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('admin.expenceMasters.create') }}">
                        Add New
                    </a>
                </div>
                @endcan
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
                            <a href="{{route('admin.expenceMasters.index')}}" class="btn btn-warning">Reset</a>
                        </div>
                    </div>
                    </form>
                    <button onclick="exportexcel()">Export to Excel</button>  
                </div>
            </div>
        </div>
    </div>
    
    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('admin.expence_masters.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $expenceMasters])
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@push('third_party_scripts')

    <script>
        $('.alert-msg').text('This Month Total Expense: ₹ ' + '{{$currentMonthExpense}}').css("color", 'red');
    </script>
    <script type="text/javascript">  
            function exportexcel() {  
                $("#expenceMasters-table").remove("#noExl").table2excel({ 
                    exclude: "#noExl",  
                    name: "Table2Excel",  
                    filename: "excelexpence",  
                    fileext: ".xls"  
                });  
            }  
    </script>
     <script>
        $("#expenceMastersInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#expenceMasters-table tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
@endpush

