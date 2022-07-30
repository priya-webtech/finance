<div class="table-responsive">
    <form action="{{ route('admin.batchesFilter.filter') }}" method="post" style="margin-top: 20px;">
        @csrf

    <div class="form-group col-sm-6">
       {!! Form::label('course_id', 'Course Name:') !!}
        {!! Form::select('course_id', $course, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Course']) !!}
         
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('batch_mode_id', 'Batch Mode:') !!}
        {!! Form::select('batch_mode_id', $batchMode, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Batch Mode']) !!}
    
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('trainer_id', 'Trainer Name:') !!}
        {!! Form::select('trainer_id', $trainer, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Trainer']) !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('batch_type_id', 'Batch Type:') !!}
        {!! Form::select('batch_type_id', $batchType, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Batch Type']) !!}
    </div>
    <input type="submit" class="btn btn-danger btn-sm" value="Filter">
    <a href="{{ route('admin.batches.index') }}">clear</a>
    </form>
    <table class="table" id="batches-table">
        <thead>
        <tr>
            <th>Course Name</th>
        <th>Batch Mode</th>
         <th>Batch Type</th>
        <th>Trainer Name</th>
        <th>Name</th>
        <th>Start</th>
        <th>Status</th>
        <th>Batch Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($batches as $batch)
            <tr>
                <td>{{ $batch->course->course_name }}</td>
            <td>{{ $batch->batchMode->title }}</td>
            <td>{{ $batch->batchType->title }}</td>
            <td>{{ $batch->trainer->trainer_name }}</td>
            <td>{{ $batch->name }}</td>
            <td>{{ $batch->start }}</td>
                <td><span class='badge @if($batch->status == 1)badge-success @else badge-danger @endif'>{{ $batch->status == 1 ? "Active" : "Block" }}</span></td>
            <td>{{ $batch->batch_status }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.batches.destroy', $batch->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('batches_status')
                        <a href="{{ route('table.status', [ $batch->id,"batches", $batch->status]) }}" class='btn @if($batch->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($batch->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @endcan
                        @can('batches_view')
                        <a href="{{ route('admin.batches.show', [$batch->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('batches_edit')
                        <a href="{{ route('admin.batches.edit', [$batch->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('batches_delete')
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
