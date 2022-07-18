<div class="table-responsive">
    <table class="table" id="trainerFreeSlabs-table">
        <thead>
        <tr>
            <th>Trainer Id</th>
        <th>Min Std</th>
        <th>Max Std</th>
        <th>Fees</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trainerFreeSlabs as $trainerFreeSlab)
            <tr>
                <td>{{ $trainerFreeSlab->trainer->trainer_name }}</td>
            <td>{{ $trainerFreeSlab->min_std }}</td>
            <td>{{ $trainerFreeSlab->max_std }}</td>
            <td>{{ $trainerFreeSlab->fees }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.trainerFreeSlabs.destroy', $trainerFreeSlab->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('admin.trainerFreeSlabs.show', [$trainerFreeSlab->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.trainerFreeSlabs.edit', [$trainerFreeSlab->id]) }}"
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
