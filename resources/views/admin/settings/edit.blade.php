@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Setting</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

{{--        @include('adminlte-templates::common.errors')--}}

        <div class="card">

            {!! Form::model($setting, ['route' => ['admin.settings.update', $setting->id], 'method' => 'patch', 'files' => true]) !!}

            <div class="card-body">
                <div class="row">
                    @include('admin.settings.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('admin.settings.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
