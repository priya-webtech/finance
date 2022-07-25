@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Due Fees {{$type}}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
{{--                    <div class="form-group col-sm-6">--}}
{{--                        {!! Form::label('branch_id', 'Branch :') !!}--}}
{{--                        {!! Form::select('branch_id', ,null, ['class' => 'form-control','placeholder'=>'Select Branch']) !!}--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
