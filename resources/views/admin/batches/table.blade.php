<div class="table-responsive">
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
         @if((isset(auth()->user()->branch_id) && in_array($batch['course']['branch_id'], auth()->user()->branch_id)) || (auth()->user()->branch_id == '' && auth()->user()->role_id == 0))
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
                        <a href="{{ route('table.status', [ $batch->id,"batches", $batch->status]) }}" class='btn @if($batch->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($batch->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
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
            @endif
        @endforeach
        </tbody>
    </table>
</div>
