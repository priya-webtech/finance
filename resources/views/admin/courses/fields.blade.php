<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch Name:') !!}
    {!! Form::select('branch_id', $branch,null, ['class' => 'form-control','placeholder'=>"Please Select Branch"]) !!}
    <span class="error text-danger">{{ $errors->first('branch_id') }}</span>
</div>
<!-- Course Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('course_name', 'Course Name:') !!}
    {!! Form::text('course_name', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('course_name') }}</span>
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
