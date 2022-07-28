<div class="table-responsive">
    <table class="table" id="trainers-table">
        <thead>
        <tr>
            <th>Trainer Name</th>
            <th>Batch</th>
           <!--  <th>Image</th> -->
            <th>Email</th>
            <th>Contact No.</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trainers as $trainer)
        @if((isset(auth()->user()->branch_id) && $trainer['branch_id'] == auth()->user()->branch_id) || (auth()->user()->branch_id == '' && auth()->user()->role_id == 0))
      
            <tr>
                <td>{{ $trainer->trainer_name }}</td>
                <td>{{ $trainer->branch->title }}</td>
               <!--  <th><img alt="image" src="{{asset('storage/trainer/'.$trainer->profile_pic)}}" style="width: 106px;height: 80px;"></th> -->
            <td>{{ $trainer->email }}</td>
            <td>{{ $trainer->contact_no }}</td>
                <td><span class='badge @if($trainer->status == 1)badge-success @else badge-danger @endif'>{{ $trainer->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.trainers.destroy', $trainer->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $trainer->id,"trainers", $trainer->status]) }}" class='btn @if($trainer->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($trainer->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
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
        @endif
        @endforeach
        </tbody>
    </table>
</div>
