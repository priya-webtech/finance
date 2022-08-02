
<div class="table-responsive">
    <?php if($columnManage){ $field = json_decode($columnManage->field_status); } ?>
    <form action="{{ route('admin.batchesFilter.filter') }}" method="post" style="margin-top: 20px;">
    @csrf
    <input type="hidden" name="batch" value="batch">
    <input type="checkbox" class="hidecol"  name="batch_col_1" @if(!empty($field) && $field->batch_col_1 == 1) Checked @endif/>&nbsp;Course Name&nbsp;
    <input type="checkbox" class="hidecol" name="batch_col_2" @if(!empty($field) && $field->batch_col_2 == 1) Checked @endif/>&nbsp;Batch Mode
    <input type="checkbox" class="hidecol" name="batch_col_3" @if(!empty($field) && $field->batch_col_3 == 1) Checked @endif/>&nbsp;Batch Type
    <input type="checkbox" class="hidecol" name="batch_col_4" @if(!empty($field) && $field->batch_col_4 == 1) Checked @endif/>&nbsp;Trainer Name
    <input type="checkbox" class="hidecol" name="batch_col_5" @if(!empty($field) && $field->batch_col_5 == 1) Checked @endif/>&nbsp;Name
    <input type="checkbox" class="hidecol" name="batch_col_6" @if(!empty($field) && $field->batch_col_6 == 1) Checked @endif/>&nbsp;Start
    <input type="checkbox" class="hidecol" name="batch_col_7" @if(!empty($field) && $field->batch_col_7 == 1) Checked @endif/>&nbsp;Status
    <input type="checkbox" class="hidecol" name="batch_col_8" @if(!empty($field) && $field->batch_col_8 == 1) Checked @endif/>&nbsp;Batch Status

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

    <div class="form-group col-sm-6">
        <input type="submit" class="btn btn-danger btn-sm" value="Filter">
        <a href="{{ route('admin.batches.index') }}">clear</a>
    </div>
    </form>
    <table class="table" id="batches-table">
        <thead>


        <tr>
        @if(!empty($field) && $field->batch_col_1 == 1)<th>Course Name</th>@endif
        @if(!empty($field) && $field->batch_col_2 == 1)<th>Batch Mode</th>@endif
        @if(!empty($field) && $field->batch_col_3 == 1)<th>Batch Type</th>@endif
        @if(!empty($field) && $field->batch_col_4 == 1)<th>Trainer Name</th>@endif
        @if(!empty($field) && $field->batch_col_5 == 1)<th>Name</th>@endif
        @if(!empty($field) && $field->batch_col_6 == 1)<th>Start</th>@endif
        @if(!empty($field) && $field->batch_col_7 == 1)<th>Status</th>@endif
        @if(!empty($field) && $field->batch_col_8 == 1) <th>Batch Status</th>@endif
        <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($batches as $batch)
            <tr>
            @if(!empty($field) && $field->batch_col_1 == 1)<td>{{ $batch->course->course_name }}</td>@endif
            @if(!empty($field) && $field->batch_col_2 == 1)<td>{{ $batch->batchMode->title }}</td>@endif
            @if(!empty($field) && $field->batch_col_3 == 1)<td>{{ $batch->batchType->title }}</td>@endif
            @if(!empty($field) && $field->batch_col_4 == 1)<td>{{ $batch->trainer->trainer_name }}</td>@endif
            @if(!empty($field) && $field->batch_col_5 == 1)<td>{{ $batch->name }}</td>@endif
            @if(!empty($field) && $field->batch_col_6 == 1)<td>{{ $batch->start }}</td>@endif
            @if(!empty($field) && $field->batch_col_7 == 1)<td><span class='badge @if($batch->status == 1)badge-success @else badge-danger @endif'>{{ $batch->status == 1 ? "Active" : "Block" }}</span></td>@endif
            @if(!empty($field) && $field->batch_col_8 == 1)<td>{{ $batch->batch_status }}</td>@endif
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

