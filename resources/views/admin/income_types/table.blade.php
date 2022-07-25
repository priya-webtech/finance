<div class="table-responsive">
    <table class="table" id="incomeTypes-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($incomeTypes as $incomeType)
            <tr>
                <td>{{ $incomeType->title }}</td>
                <td><span class='badge @if($incomeType->status == 1)badge-success @else badge-danger @endif'>{{ $incomeType->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.incomeTypes.destroy', $incomeType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $incomeType->id,"income_types", $incomeType->status]) }}" class='btn @if($incomeType->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($incomeType->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @can('incometypes_view')
                        <a href="{{ route('admin.incomeTypes.show', [$incomeType->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('incometypes_edit')
                        <a href="{{ route('admin.incomeTypes.edit', [$incomeType->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('incometypes_delete')
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
