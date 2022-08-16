<div class="table-responsive">
  <div class="custom-filter">
    <form data-action="{{ route('admin.trainerestrainercolums.trainercolums') }}" method="post" style="margin-top: 20px;" id="batchform">
    @csrf

    <div class="multiselect">
        <div class="selectBox" onclick="showCheckboxes()">
          <select>
            <option>Select an option</option>
          </select>
          <div class="overSelect"></div>
        </div>
        <div id="checkboxes">
          <label for="one">
            <input type="checkbox" class="trainerhidecol"  name="trainer_col_1" @if(!empty($field) && $field->trainer_col_1 == 1) Checked @endif/>&nbsp;Trainer Name&nbsp;
          <label for="two">
            <input type="checkbox" class="trainerhidecol" name="trainer_col_2" @if(!empty($field) && $field->trainer_col_2 == 1) Checked @endif/>&nbsp;Batch
          <label for="three">
            <input type="checkbox" class="trainerhidecol" name="trainer_col_3" @if(!empty($field) && $field->trainer_col_3 == 1) Checked @endif/>&nbsp;Email
          <label for="four">
            <input type="checkbox" class="trainerhidecol" name="trainer_col_4" @if(!empty($field) && $field->trainer_col_4 == 1) Checked @endif/>&nbsp;Contact No.
          <label for="five">
            <input type="checkbox" class="trainerhidecol" name="trainer_col_5" @if(!empty($field) && $field->trainer_col_5 == 1) Checked @endif/>&nbsp;Status
        </div>
    </div>

    <input type="hidden" name="trainer" value="trainer">
    </form>

    <input type="submit" class="btn btn-danger btn-sm batchsubmit" value="Save">
  </div>
    <table class="table" id="trainers-table">
        <thead>
        <tr>
            @if(!empty($field) && $field->trainer_col_1 == 1)<th>Trainer Name</th>@endif
            @if(!empty($field) && $field->trainer_col_2 == 1)<th>Batch</th>@endif
           <!-- <th>Image</th> -->
            @if(!empty($field) && $field->trainer_col_3 == 1)<th>Email</th>@endif
            @if(!empty($field) && $field->trainer_col_4 == 1)<th>Contact No.</th>@endif
            @if(!empty($field) && $field->trainer_col_5 == 1)<th>Status</th>@endif
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($trainers) > 0)
        @foreach($trainers as $trainer)
            <tr>
                 @if(!empty($field) && $field->trainer_col_1 == 1)<td>{{ $trainer->trainer_name }}</td>@endif
                 @if(!empty($field) && $field->trainer_col_2 == 1)<td>{{ $trainer->branch->title }}</td>@endif
               <!--  <th><img alt="image" src="{{asset('storage/trainer/'.$trainer->profile_pic)}}" style="width: 106px;height: 80px;"></th> -->
             @if(!empty($field) && $field->trainer_col_3 == 1)<td>{{ $trainer->email }}</td>@endif
             @if(!empty($field) && $field->trainer_col_4 == 1)<td>{{ $trainer->contact_no }}</td>@endif
                 @if(!empty($field) && $field->trainer_col_4 == 1)<td><span class='badge @if($trainer->status == 1)badge-success @else badge-danger @endif'>{{ $trainer->status == 1 ? "Active" : "Block" }}</span></td>@endif
                <td width="120">
                    {!! Form::open(['route' => ['admin.trainers.destroy', $trainer->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('trainers_status')
                        <a href="{{ route('table.status', [ $trainer->id,"trainers", $trainer->status]) }}" class='btn @if($trainer->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($trainer->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @endcan
                        @can('trainers_view')
                        <a href="{{ route('admin.trainers.show', [$trainer->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('trainers_edit')
                        <a href="{{ route('admin.trainers.edit', [$trainer->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('trainers_delete')
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
            @endif
        </tbody>
    </table>
</div>
