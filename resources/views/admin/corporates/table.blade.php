<div class="table-responsive">
    <table class="table" id="corporates-table">
        <thead>
        <tr>
            <th>Company Name</th>
        <th>Contact No</th>
        <th>Email</th>
        <th>Web Site</th>
{{--        <th>Address</th>--}}
{{--        <th>State</th>--}}
{{--        <th>City</th>--}}
        <th>Status</th>
        <th>Branch</th>
{{--        <th>Batch</th>--}}
{{--        <th>Trainer Amount</th>--}}
{{--        <th>Agreed Amount</th>--}}
{{--        <th>Gst Amount</th>--}}
        <th>Reg For Month</th>
{{--        <th>Remark</th>--}}
        <th>Enquiry Type</th>
        <th>Lead Source</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($corporates as $corporate)
            <tr>
                <td>{{ $corporate->company_name }}</td>
            <td>{{ $corporate->contact_no }}</td>
            <td>{{ $corporate->email }}</td>
            <td>{{ $corporate->web_site }}</td>
{{--            <td>{{ $corporate->address }}</td>--}}
{{--            <td>{{ $corporate->state }}</td>--}}
{{--            <td>{{ $corporate->city }}</td>--}}
                <td><span class='badge @if($corporate->status == 1)badge-success @else badge-danger @endif'>{{ $corporate->status == 1 ? "Active" : "Block" }}</span></td>
            <td>{{ $corporate->branch->title }}</td>
{{--            <td>{{ $corporate->batch->name }}</td>--}}
{{--            <td>{{ $corporate->trainer_amount }}</td>--}}
{{--            <td>{{ $corporate->agreed_amount }}</td>--}}
{{--            <td>{{ $corporate->gst_amount }}</td>--}}
            <td>{{ $corporate->reg_for_month }}</td>
{{--            <td>{{ $corporate->remark }}</td>--}}
            <td>{{ $corporate->enquiry->title }}</td>
            <td>{{ $corporate->lead->title }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.corporates.destroy', $corporate->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $corporate->id,"corporates", $corporate->status]) }}" class='btn @if($corporate->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($corporate->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @can('corporates_view')
                        <a href="{{ route('admin.corporates.show', [$corporate->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('corporates_edit')
                        <a href="{{ route('admin.corporates.edit', [$corporate->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('corporates_delete')
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
