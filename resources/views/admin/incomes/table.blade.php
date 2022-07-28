{{--<div class="table-responsive">--}}
{{--    <table class="table" id="incomes-table">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--        <th>Branch</th>--}}
{{--        <th>Income Type</th>--}}
{{--        <th>Student/Corporate Name</th>--}}
{{--        <th>Course Name</th>--}}
{{--        <th>Paying Amount</th>--}}
{{--        <th>GST</th>--}}
{{--        <th>Register Date</th>--}}
{{--        <th>Registration Taken By</th>--}}


{{--            <th colspan="3">Action</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($incomes as $income)--}}
{{--            <tr>--}}

{{--            <td>{{ $income->branch->title }}</td>--}}
{{--            <td>{{ $income->incomeType->title }}</td>--}}
{{--            <td>  @if($income->incomeStudFees){{ $income->incomeStudFees->student->name ?? 'N/A'}} @elseif($income->incomeCorpo){{$income->incomeCorpo->company_name}}  @else -  @endif</td>--}}
{{--            <td>{{ $income->course->course_name}}</td>--}}
{{--            <td>₹ {{ $income->paying_amount }}</td>--}}
{{--            <td>₹{{ number_format($income->incomeStudFees->gst , 2) ?? 'N/A'}} </td>--}}
{{--            <td>{{ $income->register_date }}</td>--}}
{{--            <td>{{ $income->registration_take->name }}</td>--}}
{{--                <td width="120">--}}
{{--                    {!! Form::open(['route' => ['admin.incomes.destroy', $income->id], 'method' => 'delete']) !!}--}}
{{--                    <div class='btn-group'>--}}
{{--                        <a href="{{ route('admin.incomes.show', [$income->id]) }}"--}}
{{--                           class='btn btn-default action-btn btn-sm'>--}}
{{--                            <i class="far fa-eye"></i>--}}
{{--                        </a>--}}
{{--                        <a href="{{ route('admin.incomes.edit', [$income->id]) }}"--}}
{{--                           class='btn btn-primary action-btn btn-sm'>--}}
{{--                            <i class="far fa-edit"></i>--}}
{{--                        </a>--}}
{{--                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--</div>--}}



<div class="table-responsive">
    <table class="table" id="incomes-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Income Type</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($merge as $record)
            <tr>
                <td>@if(isset($record['name'])) {{ $record['name'] }} @elseif(isset($record['company_name'])) {{$record['company_name']}} @else {{"N/A"}} @endif </td>
                <td>{{ $record['email']  ?? 'N/A'}}</td>
                <td> @if(isset($record['student_income'])) {{ getIncomeType($record['student_income'][0]['income_id']) }} @elseif(isset($record['corporate_income'])) {{getIncomeType($record['corporate_income'][0]['income_id'])}} @else {{getIncomeType($record['id'])}} @endif </td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.incomes.destroy', $record['id']], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('incomes_view')
                        <a href="{{ route('admin.incomes.show', [$record['id']]) }}?type=student"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('incomes_edit')
                        @if(isset($record['student_income']))
                         <a href="{{ route('admin.incomes.edit', [$record['id']]) }}?type=student"

                           class='btn btn-primary action-btn btn-sm'>
                            @elseif(isset($record['corporate_income']))
                                <a href="{{ route('admin.incomes.edit', [$record['id']]) }}?type=corporate"
                                   class='btn btn-primary action-btn btn-sm'>
                                    @else
                                        <a href="{{ route('admin.incomes.edit', [$record['id']]) }}"
                                           class='btn btn-primary action-btn btn-sm'>
                                            @endif
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('incomes_delete')
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
{{--            @endif--}}
        @endforeach
{{--        @foreach($corporate as $corpo)--}}
{{--            <tr>--}}
{{--                <td>{{ $corpo->company_name }}</td>--}}
{{--                <td>{{ $corpo->email }}</td>--}}
{{--                <td width="120">--}}
{{--                    {!! Form::open(['route' => ['admin.incomes.destroy', $corpo->id], 'method' => 'delete']) !!}--}}
{{--                    <div class='btn-group'>--}}
{{--                        <a href="{{ route('admin.incomes.show', [$corpo->id]) }}"--}}
{{--                           class='btn btn-default action-btn btn-sm'>--}}
{{--                            <i class="far fa-eye"></i>--}}
{{--                        </a>--}}
{{--                        <a href="{{ route('admin.incomes.edit', [$corpo->id]) }}?type=corporate"--}}
{{--                           class='btn btn-primary action-btn btn-sm'>--}}
{{--                            <i class="far fa-edit"></i>--}}
{{--                        </a>--}}
{{--                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
        </tbody>
    </table>
</div>
