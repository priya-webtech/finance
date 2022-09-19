<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $trainer->id }}</p>
</div>

<!-- Trainer Name Field -->
<div class="col-sm-12">
    {!! Form::label('trainer_name', 'Trainer Name:') !!}
    <p>{{ $trainer->trainer_name }}</p>
</div>

<!-- Trainer Name Field -->
<div class="col-sm-12">
    {!! Form::label('branch_id', 'Branch:') !!}
    <p>{{ $trainer->branch->title }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $trainer->email }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $trainer->status == 1 ? "Active" : "Block" }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $trainer->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $trainer->updated_at }}</p>
</div>
    <table class="table" id="corporates-table">
        <thead class="thead-dark">
        <tr>
        <th>Course Name</th>
        <th>Batch Name</th>
        <th>Student Count</th>
        <th>Total</th>
        <th>Pay amount</th>
        <th>Final Amount</th>

        </tr>
        </thead>
        <tbody>
        @foreach($studentbatch as $row)
            <tr class="table-success">
                <td width="120">{{$row->batch->course->course_name}}</td>
                <td width="120">{{$row->batch->name}}
                <td>{{$studentcount}}</td>
                <td>${{$studentfees}}</td>
                <td>${{$ExpenceMaster}}</td>
                <td>${{ $studentfees - $ExpenceMaster }}</td>
          
               

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


