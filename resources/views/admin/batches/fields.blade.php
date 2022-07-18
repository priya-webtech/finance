<!-- Course Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('course_id', 'Course Name:') !!}
    {!! Form::select('course_id', $course, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Course']) !!}
        <span class="error text-danger">{{ $errors->first('course_id') }}</span>

</div>


<!-- Batch Mode Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('batch_mode_id', 'Batch Mode:') !!}
    {!! Form::select('batch_mode_id', $batchMode, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Batch Mode']) !!}
        <span class="error text-danger">{{ $errors->first('batch_mode_id') }}</span>

</div>


<!-- Trainer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trainer_id', 'Trainer Name:') !!}
    {!! Form::select('trainer_id', $trainer, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Trainer']) !!}
        <span class="error text-danger">{{ $errors->first('trainer_id') }}</span>

</div>
<div class="form-group col-sm-6">
    {!! Form::label('batch_type_id', 'Batch Type:') !!}
    {!! Form::select('batch_type_id', $batchType, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Batch Type']) !!}
        <span class="error text-danger">{{ $errors->first('batch_type_id') }}</span>

</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('name') }}</span>

</div>

<!-- Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start', 'Start:') !!}
    {!! Form::text('start', null, ['class' => 'form-control datepicker']) !!}
        <span class="error text-danger">{{ $errors->first('start') }}</span>

</div>

<div class="form-group col-sm-6">
    {!! Form::label('batch_status', 'Batch Status:') !!}
    {!! Form::select('batch_status', ['open'=>'Open','close'=>'Close'], null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Batch Status']) !!}
        <span class="error text-danger">{{ $errors->first('batch_status') }}</span>

</div>
