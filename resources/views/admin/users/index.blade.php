@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('admin.users.create') }}">
                        Add New
                    </a>
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
                            <a href="{{route('admin.users.index')}}" class="btn btn-warning">Reset</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('admin.users.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $users])
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@push('third_party_scripts')
 <script type="text/javascript">

        $(function() {

            var start = moment().startOf('month');
            var end = moment().endOf('month');

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
      <script>
        $("#UserInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#user-table tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
@endpush
