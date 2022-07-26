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

                 {!! Form::open(['route' => 'admin.students.store']) !!}
                <div class="row">
                    <div class="form-group col-sm-2">
                        {!! Form::label('branch_id', 'Branch :') !!}
                        {!! Form::select('branch_id', $branch,null, ['class' => 'form-control','placeholder'=>'Select Branch']) !!}
                    </div>
                    <div class="form-group col-sm-2">
                        {!! Form::label('course_id', 'Course :') !!}
                        {!! Form::select('course_id', $course,null, ['class' => 'form-control','placeholder'=>'Select Course']) !!}
                    </div>
                    <div class="form-group col-sm-2">
                        {!! Form::label('bank_acc_id', 'Bank:') !!}
                        {!! Form::select('bank_acc_id',$bank,null, ['class' => 'form-control','placeholder'=>'Select Bank']) !!}
                    </div>
                    <div class="form-group col-sm-2">
                        {!! Form::label('paying_amount', 'Amount:') !!}
                        {!! Form::text('paying_amount',null, ['class' => 'form-control','placeholder'=>'Enter Amount']) !!}
                    </div>
                    <div class="form-group col-sm-1 trainer" style="margin-top: 37px;">
                        {!! Form::label('gst', 'GST:') !!}
                        <input type="checkbox" id="vehicle1" name="gst">
                        <span class="error text-danger">{{ $errors->first('gst') }}</span>
                    </div>
                    <div class="form-group col-sm-2"><br>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
{{--                        <a href="{{ route('admin.students.index') }}" class="btn btn-default">Cancel</a>--}}
                    </div>
                </div>
                {!! Form::close() !!}

                <div class="col-sm-12">
                    {!! Form::label('branch_id', 'Branch Name:') !!}
                    <p>@if($user['branch']){{ $user['branch']['title'] }}@else No Branch @endif</p>
                </div>

                <div class="table-responsive">
                    <table class="table" id="corporates-table">
                        <thead>
                        <tr>
                        <th>{!! Form::label('course_id', 'Course Name:') !!}</th>
                        <th> {!! Form::label('agreed', 'Agreed Amount:') !!}</th>
                        <th colspan="3">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         @if($userdetail)
                            @foreach($userdetail as $row)
                            <tr>
                                <td>@if($row['course']){{ $row['course']['course_name'] }}@else No Course @endif</td>
                                <td>{{ $row['agreed_amount'] }}</td>
                                <td width="120">
                                   Action
                                </td>
                            </tr>
                        @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
