<div class="table-responsive">
    <table class="table" id="expenceMasters-table">
        <thead>
        <tr>
        <th>Expence Type </th>
        <th>Branch</th>
        <th>Bank Ac </th>
        <th>Batch</th>
        <th>Trainer</th>
        <th>Student</th>

        <th>Amount</th>
        <th>Date</th>
{{--        <th>Remark</th>--}}
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($expenceMasters as $expenceMaster)
          @if((isset(auth()->user()->branch_id) && in_array($expenceMaster['branch_id'], auth()->user()->branch_id)) || (auth()->user()->branch_id == '' && auth()->user()->role_id == 0))
            <tr>
                <td>{{ $expenceMaster->expenceType->title }}</td>
            <td>{{ $expenceMaster->branch->title  ?? 'N/A' }}</td>
                <td>{{ $expenceMaster->bankAcc->name ?? 'N/A'  }}</td>
            <td>{{ $expenceMaster->batch->name ?? 'N/A' }}</td>
            <td>{{ $expenceMaster->trainer->trainer_name ?? 'N/A'}}</td>
            <td>{{ $expenceMaster->student->name ?? 'N/A' }}</td>

            <td>{{ $expenceMaster->amount }}</td>
            <td>{{ $expenceMaster->date }}</td>
{{--            <td>{{ $expenceMaster->remark }}</td>--}}
                <td width="120">
                    {!! Form::open(['route' => ['admin.expenceMasters.destroy', $expenceMaster->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                         @can('expence_view')
                        <a href="{{ route('admin.expenceMasters.show', [$expenceMaster->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                         @can('expence_edit')
                        <a href="{{ route('admin.expenceMasters.edit', [$expenceMaster->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                         @can('expence_delete')
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
