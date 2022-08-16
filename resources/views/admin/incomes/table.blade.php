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

  <div class="custom-filter">
    <form data-action="{{ route('admin.incomeesincomecolums.incomecolums') }}" method="post" style="margin-top: 20px;" id="batchform">
    @csrf

    <div class="multiselect">
        <div class="selectBox" onclick="showCheckboxes()">
          <select>
            <option>Select an option</option>
          </select>
          <div class="overSelect"></div>
        </div>
        <div id="checkboxes">
          <label for="one">
            <input type="checkbox" class="incomehidecol"  name="income_col_1" @if(!empty($field) && $field->income_col_1 == 1) Checked @endif/>&nbsp; Name&nbsp;
          <label for="two">
            <input type="checkbox" class="incomehidecol" name="income_col_2" @if(!empty($field) && $field->income_col_2 == 1) Checked @endif/>&nbsp;Email
          <label for="three">
            <input type="checkbox" class="incomehidecol" name="income_col_3" @if(!empty($field) && $field->income_col_3 == 1) Checked @endif/>&nbsp;Income Type
          
        </div>
    </div>

    <input type="hidden" name="income" value="income">
    </form>
    <input type="submit" class="btn btn-danger btn-sm batchsubmit" value="Save">

    <form action="{{ route('admin.incomesFilter.filter') }}" method="get" style="margin-top: 20px;">
    <div class="form-group col-sm-6">
         {!! Form::label('income_type_id', 'Income Type:') !!}
    {!! Form::select('income_type_id', $incomeType, null, ['class' => 'form-control custom-select','onchange'=>'ChangeIncomeType()','id'=>'income_type','placeholder'=>'Please Select Income Type']) !!}
         
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('mode_of_payment', 'Mode of Payment:') !!}
        {!! Form::select('mode_of_payment', $modeOfPayment, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Mode of Payment']) !!}
    
    </div>
    <input type="submit" class="btn btn-danger btn-sm" value="Filter">
    <a href="{{ route('admin.incomes.index') }}">clear</a>
    </form>
  </div>
    <table class="table" id="incomes-table">
        <thead>
        <tr>
            @if(!empty($field) && $field->income_col_1 == 1)<th>Name</th>@endif
            @if(!empty($field) && $field->income_col_2 == 1)<th>Email</th>@endif
            @if(!empty($field) && $field->income_col_3 == 1)<th>Income Type</th>@endif
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($merge as $record)
            <tr>
                @if(!empty($field) && $field->income_col_1 == 1)<td>@if(isset($record['name'])) {{ $record['name'] }} @elseif(isset($record['company_name'])) {{$record['company_name']}} @else {{"N/A"}} @endif </td>@endif
                @if(!empty($field) && $field->income_col_2 == 1)<td>{{ $record['email']  ?? 'N/A'}}</td>@endif
                @if(!empty($field) && $field->income_col_3 == 1)<td> @if(isset($record['student_income'])) {{ getIncomeType($record['student_income'][0]['income_id']) }} @elseif(isset($record['corporate_income'])) {{getIncomeType($record['corporate_income'][0]['income_id'])}} @else {{getIncomeType($record['id'])}} @endif </td>@endif
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
