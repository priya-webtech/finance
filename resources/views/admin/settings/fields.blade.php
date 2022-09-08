<!-- App Logo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('app_logo', 'App Logo:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('app_logo', ['class' => 'custom-file-input']) !!}
            {!! Form::label('app_logo', 'Choose file', ['class' => 'custom-file-label']) !!}
            <span class="error text-danger">{{ $errors->first('app_logo') }}</span>

        </div>
    </div>
</div>
<div class="clearfix"></div>


<!-- App Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('app_title', 'App Title:') !!}
    {!! Form::text('app_title', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('app_title') }}</span>
</div>

<!-- Gst Per Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gst_per', 'Gst Per:') !!}
    {!! Form::text('gst_per', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('gst_per') }}</span>
</div>

<!-- Tds Per Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tds_per', 'Tds Per:') !!}
    {!! Form::text('tds_per', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('tds_per') }}</span>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('email') }}</span>
</div>

<!-- Website Field -->
<div class="form-group col-sm-6">
    {!! Form::label('website', 'Website:') !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('website') }}</span>
</div>

<!-- Phone 1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_1', 'Phone 1:') !!}
    {!! Form::text('phone_1', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('phone_1') }}</span>
</div>

<!-- Phone 2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_2', 'Phone 2:') !!}
    {!! Form::text('phone_2', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('phone_2') }}</span>
</div>

<!-- Gst No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gst_no', 'Gst No:') !!}
    {!! Form::text('gst_no', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('gst_no') }}</span>
</div>
