
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name') !!}<span style="color:red;">*</span> :
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('name') }}</span>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch:') !!}
    {!! Form::select('branch_id',$branch, null, ['class' => 'form-control select2']) !!}
    <span class="error text-danger">{{ $errors->first('name') }}</span>
</div>
<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email') !!}<span style="color:red;">*</span> :
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('email') }}</span>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile_no', 'Mobile No:') !!}
    {!! Form::number('mobile_no',null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('mobile_no') }}</span>
</div>
<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_id', 'Role:') !!}
    {!! Form::select('role_id',$role, null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('role_id') }}</span>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password') !!}<span style="color:red;">*</span> :
    {{-- {!! Form::password('password', null, ['class' => 'form-control']) !!} --}}
    {!! Form::password('password', array('class'=>'form-control' ) ) !!}
    
    <span class="error text-danger">{{ $errors->first('password') }}</span>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Confirm Password:') !!}
    {!! Form::text('password_confirmation', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('password_confirmation') }}</span>
</div>
