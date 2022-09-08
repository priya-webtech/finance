<div class="table-responsive">
    <table class="table" id="studentTypes-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($studentTypes as $studentType)
            <tr>
                <td>{{ $studentType->title }}</td>
                <td><span class='badge @if($studentType->status == 1)badge-success @else badge-danger @endif'>{{ $studentType->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.studentTypes.destroy', $studentType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $studentType->id,"student_types", $studentType->status]) }}" class='btn @if($studentType->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($studentType->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @can('studenttypes_view')
                        <a href="{{ route('admin.studentTypes.show', [$studentType->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('studenttypes_edit')
                        <a href="{{ route('admin.studentTypes.edit', [$studentType->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('studenttypes_delete')
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
