<div class="table-responsive">
    <table class="table" id="batchTypes-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($batchTypes as $batchType)
            <tr>
                <td>{{ $batchType->title }}</td>
                <td><span class='badge @if($batchType->status == 1)badge-success @else badge-danger @endif'>{{ $batchType->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.batchTypes.destroy', $batchType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $batchType->id,"batch_types", $batchType->status]) }}" class='btn @if($batchType->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($batchType->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @can('batchtypes_view')
                        <a href="{{ route('admin.batchTypes.show', [$batchType->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('batchtypes_edit')
                        <a href="{{ route('admin.batchTypes.edit', [$batchType->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('batchtypes_delete')
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
