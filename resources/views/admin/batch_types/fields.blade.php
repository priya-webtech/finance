<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title') !!}<span style="color:red;">*</span> :
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('title') }}</span>
</div>
