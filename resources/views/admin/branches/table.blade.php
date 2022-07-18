<div class="table-responsive">
    <table class="table" id="branches-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($branches as $branch)
            <tr>
                <td>{{ $branch->title }}</td>
                <td><span class='badge @if($branch->status == 1)badge-success @else badge-danger @endif'>{{ $branch->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.branches.destroy', $branch->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('admin.branches.show', [$branch->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.branches.edit', [$branch->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
