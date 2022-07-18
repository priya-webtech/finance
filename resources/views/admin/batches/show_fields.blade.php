<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $batch->id }}</p>
</div>

<!-- Course Id Field -->
<div class="col-sm-12">
    {!! Form::label('course_id', 'Course Id:') !!}
    <p>{{ $batch->course->course_name }}</p>
</div>

<!-- Batch Mode Id Field -->
<div class="col-sm-12">
    {!! Form::label('batch_mode_id', 'Batch Mode Id:') !!}
    <p>{{ $batch->batchMode->title }}</p>
</div>

<!-- Trainer Id Field -->
<div class="col-sm-12">
    {!! Form::label('trainer_id', 'Trainer Id:') !!}
    <p>{{ $batch->trainer->trainer_name }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $batch->name }}</p>
</div>

<!-- Start Field -->
<div class="col-sm-12">
    {!! Form::label('start', 'Start:') !!}
    <p>{{ $batch->start }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $batch->status }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $batch->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $batch->updated_at }}</p>
</div>

