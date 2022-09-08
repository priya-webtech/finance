<div class="table-responsive">
    <input id="expenseTypesInput" class="form-control" type="text" placeholder="Search..">
    <table class="table" id="expenseTypes-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($expenseTypes as $expenseTypes)
            <tr>
                <td>{{ $expenseTypes->title }}</td>
                <td><span class='badge @if($expenseTypes->status == 1)badge-success @else badge-danger @endif'>{{ $expenseTypes->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.expenseTypes.destroy', $expenseTypes->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $expenseTypes->id,"expense_types", $expenseTypes->status]) }}" class='btn @if($expenseTypes->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($expenseTypes->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @can('expensetypes_view')
                        <a href="{{ route('admin.expenseTypes.show', [$expenseTypes->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('expensetypes_edit')
                        <a href="{{ route('admin.expenseTypes.edit', [$expenseTypes->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('expensetypes_delete')
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
