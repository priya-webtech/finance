<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Mode of Payment Title') !!}<span style="color:red;">*</span> :
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('title') }}</span>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Bank Name') !!}<span style="color:red;">*</span> :
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('name') }}</span>

</div>

<!-- Ifsc Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ifsc_code', 'Ifsc Code') !!}<span style="color:red;">*</span> :
    {!! Form::text('ifsc_code', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('ifsc_code') }}</span>

</div>

<!-- Account No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('account_no', 'Account No') !!}<span style="color:red;">*</span> :
    {!! Form::text('account_no', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('account_no') }}</span>

</div>

<!-- Other  Detail Field -->
<div class="form-group col-sm-6">
    {!! Form::label('other_detail', 'Other  Detail') !!}<span style="color:red;">*</span> :
    {!! Form::text('other_detail', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('other_detail') }}</span>

</div>

<!-- Opening Balance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('opening_balance', 'Opening Balance') !!}<span style="color:red;">*</span> :
    {!! Form::text('opening_balance', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('opening_balance') }}</span>

</div>
