<div class="table-responsive">
    <table class="table" id="franchises-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($franchises as $franchise)
            <tr>
                <td>{{ $franchise->title }}</td>
                <td><span class='badge @if($franchise->status == 1)badge-success @else badge-danger @endif'>{{ $franchise->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.franchises.destroy', $franchise->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $franchise->id,"franchises", $franchise->status]) }}" class='btn @if($franchise->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($franchise->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        <a href="{{ route('admin.franchises.show', [$franchise->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.franchises.edit', [$franchise->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
