<div class="table-responsive">
    <input id="revenueTypesInput" class="form-control" type="text" placeholder="Search..">
    <table class="table" id="revenueTypes-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($revenueTypes as $revenueType)
            <tr>
                <td>{{ $revenueType->title }}</td>
                <td><span class='badge @if($revenueType->status == 1)badge-success @else badge-danger @endif'>{{ $revenueType->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.revenueTypes.destroy', $revenueType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $revenueType->id,"revenue_types", $revenueType->status]) }}" class='btn @if($revenueType->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($revenueType->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @can('revenuetypes_view')
                        <a href="{{ route('admin.revenueTypes.show', [$revenueType->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('revenuetypes_edit')
                        <a href="{{ route('admin.revenueTypes.edit', [$revenueType->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('revenuetypes_delete')
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
