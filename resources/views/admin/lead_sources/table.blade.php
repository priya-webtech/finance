<div class="table-responsive">
    <input id="leadSourcesInput" type="text" placeholder="Search.." class="form-control">
    <table class="table" id="leadSources-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($leadSources as $leadSources)
            <tr>
                <td>{{ $leadSources->title }}</td>
                <td><span class='badge @if($leadSources->status == 1)badge-success @else badge-danger @endif'>{{ $leadSources->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.leadSources.destroy', $leadSources->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $leadSources->id,"lead_sources", $leadSources->status]) }}" class='btn @if($leadSources->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($leadSources->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @can('leadsources_view')
                        <a href="{{ route('admin.leadSources.show', [$leadSources->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('leadsources_edit')
                        <a href="{{ route('admin.leadSources.edit', [$leadSources->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('leadsources_delete')
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
