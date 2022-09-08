<div class="table-responsive">
    <table class="table" id="bankAccounts-table">
        <thead>
        <tr>
            <th>Name</th>
        <th>Ifsc Code</th>
        <th>Account No</th>
        <th>Other  Detail</th>
        <th>Opening Balance</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bankAccounts as $bankAccount)
            <tr>
                <td>{{ $bankAccount->name }}</td>
            <td>{{ $bankAccount->ifsc_code }}</td>
            <td>{{ $bankAccount->account_no }}</td>
            <td>{{ $bankAccount->other_detail }}</td>
            <td>{{ $bankAccount->opening_balance }}</td>
            <td>{{ $bankAccount->status == 1 ? "Active" : "Block" }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.bankAccounts.destroy', $bankAccount->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('admin.bankAccounts.show', [$bankAccount->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.bankAccounts.edit', [$bankAccount->id]) }}"
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
