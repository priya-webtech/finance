<div class="table-responsive">
    <table class="table" id="settings-table">
        <thead>
        <tr>
            <th>App Logo</th>
        <th>App Title</th>
        <th>Gst Per</th>
        <th>Tds Per</th>
        <th>Email</th>
        <th>Website</th>
        <th>Phone 1</th>
        <th>Phone 2</th>
        <th>Gst No</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($settings as $setting)
            <tr>
                <td><img alt="image" src="{{asset('storage/setting/'.$setting->app_logo)}}" style="width: 106px;height: 47px;"></td>
            <td>{{ $setting->app_title }}</td>
            <td>{{ $setting->gst_per }}%</td>
            <td>{{ $setting->tds_per }}%</td>
            <td>{{ $setting->email }}</td>
            <td>{{ $setting->website }}</td>
            <td>{{ $setting->phone_1 }}</td>
            <td>{{ $setting->phone_2 }}</td>
            <td>{{ $setting->gst_no }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.settings.destroy', $setting->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('settings_view')
                        <a href="{{ route('admin.settings.show', [$setting->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('settings_edit')
                        <a href="{{ route('admin.settings.edit', [$setting->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('settings_delete')
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
