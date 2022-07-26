<div class="table-responsive">
    <table class="table" id="students-table">
        <thead>
        <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Mobile No</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <?php $new = array_diff($user->branch_id,auth()->user()->branch_id); if(!$new){ ?>
            <tr>
                <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
            <td>{{ $user->mobile_no }}</td>

                <td><span class='badge @if($user->status == 1)badge-success @else badge-danger @endif'>{{ $user->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $user->id,"users", $user->status]) }}" class='btn @if($user->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($user->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        <a href="{{ route('admin.users.show', [$user->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>

                        <a href="{{ route('admin.users.edit', [$user->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            <?php } ?>
        @endforeach
        </tbody>
    </table>
</div>
