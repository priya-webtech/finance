<div class="table-responsive">
    <table class="table" id="batchModes-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($batchModes as $batchMode)
            <tr>
                <td>{{ $batchMode->title }}</td>
            <td><span class='badge @if($batchMode->status == 1)badge-success @else badge-danger @endif'>{{ $batchMode->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.batchModes.destroy', $batchMode->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $batchMode->id,"batch_modes", $batchMode->status]) }}" class='btn @if($batchMode->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($batchMode->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        <a href="{{ route('admin.batchModes.show', [$batchMode->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.batchModes.edit', [$batchMode->id]) }}"
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
