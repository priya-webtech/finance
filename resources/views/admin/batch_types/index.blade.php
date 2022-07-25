@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Batch Types</h1>
                </div>
                @can('batchtypes_create')
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('admin.batchTypes.create') }}">
                        Add New
                    </a>
                </div>
               @endcan
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('admin.batch_types.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $batchTypes])
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

