<div class="table-responsive">
    <input id="enquiryTypesInput" class="form-control" type="text" placeholder="Search..">
    <table class="table" id="enquiryTypes-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($enquiryTypes as $enquiryType)
            <tr>
                <td>{{ $enquiryType->title }}</td>
                <td><span class='badge @if($enquiryType->status == 1)badge-success @else badge-danger @endif'>{{ $enquiryType->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.enquiryTypes.destroy', $enquiryType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $enquiryType->id,"enquiry_types", $enquiryType->status]) }}" class='btn @if($enquiryType->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($enquiryType->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @can('enquiry_view')
                        <a href="{{ route('admin.enquiryTypes.show', [$enquiryType->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('enquiry_edit')
                        <a href="{{ route('admin.enquiryTypes.edit', [$enquiryType->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('enquiry_delete')
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
