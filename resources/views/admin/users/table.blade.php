<div class="table-responsive">
  <div class="custom-filter">
    <form data-action="{{ route('admin.useresusercolums.usercolums') }}" method="post" style="margin-top: 20px;" id="batchform">
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
            <input type="checkbox" class="userhidecol"  name="user_col_1" @if(!empty($field) && $field->user_col_1 == 1) Checked @endif/>&nbsp;Name&nbsp;
          <label for="two">
            <input type="checkbox" class="userhidecol" name="user_col_2" @if(!empty($field) && $field->user_col_2 == 1) Checked @endif/>&nbsp;Email
          <label for="three">
            <input type="checkbox" class="userhidecol" name="user_col_3" @if(!empty($field) && $field->user_col_3 == 1) Checked @endif/>&nbsp;Role
          <label for="four">
            <input type="checkbox" class="userhidecol" name="user_col_4" @if(!empty($field) && $field->user_col_4 == 1) Checked @endif/>&nbsp;Mobile No
          <label for="five">
            <input type="checkbox" class="userhidecol" name="user_col_5" @if(!empty($field) && $field->user_col_5 == 1) Checked @endif/>&nbsp;Status
        </div>
    </div>

    <input type="hidden" name="user" value="user">
    </form>

    <input type="submit" class="btn btn-danger btn-sm batchsubmit" value="Save">

</div>
    <table class="table" id="students-table">
        <thead>
        <tr>
        @if(!empty($field) && $field->user_col_1 == 1)<th>Name</th>@endif
        @if(!empty($field) && $field->user_col_2 == 1)<th>Email</th>@endif
        @if(!empty($field) && $field->user_col_3 == 1)<th>Role</th>@endif
        @if(!empty($field) && $field->user_col_4 == 1)<th>Mobile No</th>@endif
        @if(!empty($field) && $field->user_col_5 == 1)<th>Status</th>@endif
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($users) > 0)
        @foreach($users as $user)
            <tr>
            @if(!empty($field) && $field->user_col_1 == 1)<td>{{ $user->name }}</td>@endif
            @if(!empty($field) && $field->user_col_2 == 1)<td>{{ $user->email }}</td>@endif
            @if(!empty($field) && $field->user_col_3 == 1)<td>{{ $user->role->name }}</td>@endif
            @if(!empty($field) && $field->user_col_4 == 1)<td>{{ $user->mobile_no }}</td>@endif

                @if(!empty($field) && $field->user_col_5 == 1)<td><span class='badge @if($user->status == 1)badge-success @else badge-danger @endif'>{{ $user->status == 1 ? "Active" : "Block" }}</span></td>@endif
                <td width="120">
                    {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('user_status')
                        <a href="{{ route('table.status', [ $user->id,"users", $user->status]) }}" class='btn @if($user->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($user->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @endcan
                        @can('user_view')
                        <a href="{{ route('admin.users.show', [$user->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('user_edit')
                        <a href="{{ route('admin.users.edit', [$user->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('user_delete')
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
