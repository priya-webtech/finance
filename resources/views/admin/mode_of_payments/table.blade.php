<div class="table-responsive">
    <input id="modeOfPaymentsInput" class="form-control" type="text" placeholder="Search..">
    <table class="table" id="modeOfPayments-table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Name</th>
            <th>IFSC Code</th>
            <th>Account No</th>
            <th>Balance</th>
              <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($modeOfPayments as $modeOfPayment)
{{--            @dd($modeOfPayment)--}}
            <tr>
                <td>{{ $modeOfPayment->title }}</td>
                <td>{{ $modeOfPayment->name }}</td>
                <td>{{ $modeOfPayment->ifsc_code }}</td>
                <td>{{ $modeOfPayment->account_no }}</td>
                <td>{{ $modeOfPayment->opening_balance }}</td>
                <td><span class='badge @if($modeOfPayment->status == 1)badge-success @else badge-danger @endif'>{{ $modeOfPayment->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.modeOfPayments.destroy', $modeOfPayment->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('table.status', [ $modeOfPayment->id,"mode_of_payments", $modeOfPayment->status]) }}" class='btn @if($modeOfPayment->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($modeOfPayment->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @can('payments_view')
                        <a href="{{ route('admin.modeOfPayments.show', [$modeOfPayment->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('payments_edit')
                        <a href="{{ route('admin.modeOfPayments.edit', [$modeOfPayment->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('payments_delete')
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
