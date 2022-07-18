@push('third_party_stylesheets')
<style>
    .main {
        margin-top: 100px;
    }

    .add-height {
        height: 1400px;
    }
</style>
@endpush
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Income</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p>Hello world!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="content px-3">
        <div class="alert alert-danger alert-dismissible" style="display: none">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                <strong id="dueMsg"></strong>
            </div>
        </div>
{{--        @include('adminlte-templates::common.errors')--}}

        <div class="card">

            {!! Form::open(['route' => 'admin.incomes.store','id'=>'create-form']) !!}
            <div class="card-body">
                <div class="row">
                    @include('admin.incomes.fields')
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary','onclick'=>"checkText()"]) !!}
                <a href="{{ route('admin.incomes.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

