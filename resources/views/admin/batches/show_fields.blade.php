<!-- Id Field -->
<div class="col-sm-1">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $batch->id }}</p>
</div>

<!-- Course Id Field -->
<div class="col-sm-2">
    {!! Form::label('course_id', 'Course:') !!}
    <p>{{ $batch->course->course_name }}</p>
</div>

<!-- Batch Mode Id Field -->
<div class="col-sm-2">
    {!! Form::label('batch_mode_id', 'Batch Mode:') !!}
    <p>{{ $batch->batchMode->title }}</p>
</div>

<!-- Trainer Id Field -->
<div class="col-sm-2">
    {!! Form::label('trainer_id', 'Trainer:') !!}
    <p>{{ $batch->trainer->trainer_name }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-2">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $batch->name }}</p>
</div>

<!-- Start Field -->
<div class="col-sm-2">
    {!! Form::label('start', 'Start:') !!}
    <p>{{ $batch->start }}</p>
</div>
<div class="container">
    <table class="table">
        <thead>
        <tr class="table-blue">
            <th>Student</th>
            <th>Trainer</th>
            <th>FEES</th>
        </tr>
        </thead>
        <tbody>

        @foreach($batch->assignBatch as $assignStudBatch)
            <tr class="table-gray">
                <td>{{ $assignStudBatch->StudDetail->student->name}}</td>
                <td>{{$assignStudBatch->trainer->trainer_name}}</td>
                <td>{{$assignStudBatch->trainer_fees}}</td>
            </tr>
        @endforeach
        @foreach($batch->assignCorpoBatch as $assignCorpoBatch)

            <tr class="table-gray">
                <td>{{ $assignCorpoBatch->corporateDetail->corporate->company_name}}</td>
                <td>{{$assignCorpoBatch->trainer->trainer_name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
