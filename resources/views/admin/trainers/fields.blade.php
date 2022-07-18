<!-- Trainer Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trainer_name', 'Trainer Name:') !!}
    {!! Form::text('trainer_name', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('trainer_name') }}</span>
</div>
<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch:') !!}
    {!! Form::select('branch_id', $branch , null, ['class' => 'form-control','placeholder'=>'Please select Branch']) !!}
    <span class="error text-danger">{{ $errors->first('branch_id') }}</span>
</div>
<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('email') }}</span>
</div>

<!-- Contact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_no', 'Contact No.:') !!}
    {!! Form::number('contact_no', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('contact_no') }}</span>
</div>
<!-- Contact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('profile_pic', 'Profile Pic:') !!}
    {!! Form::file('profile_pic', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('profile_pic') }}</span>
</div>


