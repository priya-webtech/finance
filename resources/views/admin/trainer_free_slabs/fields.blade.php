<!-- Trainer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trainer_id', 'Trainer Name:') !!}
    {!! Form::select('trainer_id', $trainer, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Trainer']) !!}
    <span class="error text-danger">{{ $errors->first('trainer_id') }}</span>

</div>


<!-- Min Std Field -->
<div class="form-group col-sm-6">
    {!! Form::label('min_std', 'Min Std:') !!}
    {!! Form::text('min_std', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('min_std') }}</span>

</div>

<!-- Max Std Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_std', 'Max Std:') !!}
    {!! Form::text('max_std', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('max_std') }}</span>

</div>

<!-- Fees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fees', 'Fees:') !!}
    {!! Form::text('fees', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('fees') }}</span>

</div>
