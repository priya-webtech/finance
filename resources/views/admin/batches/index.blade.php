@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Batches</h1>
                </div>
                @can('batches_create')
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('admin.batches.create') }}">
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
                @include('admin.batches.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $batches])
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

