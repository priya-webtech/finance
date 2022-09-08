<div class="row float-right">
    <input id="incomeInput" type="text" class="form-control" placeholder="Search..">
</div>
<div class="table-responsive">
    <div class="custom-filter">
        <form data-action="{{ route('admin.incomeesincomecolums.incomecolums') }}" method="post"
              style="margin-top: 20px;" id="batchform">
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
                        <input type="checkbox" class="incomehidecol" name="income_col_1"
                               @if(!empty($field) && $field->income_col_1 == 1) Checked @endif/>&nbsp; Name&nbsp;
                        <label for="two">
                            <input type="checkbox" class="incomehidecol" name="income_col_2"
                                   @if(!empty($field) && $field->income_col_2 == 1) Checked @endif/>&nbsp;Email
                            <label for="three">
                                <input type="checkbox" class="incomehidecol" name="income_col_3"
                                       @if(!empty($field) && $field->income_col_3 == 1) Checked @endif/>&nbsp;Income
                                Type

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
            @if(!empty($field) && $field->income_col_1 == 1)
                <th>Name</th>@endif
            <th>Mobile No.</th>
            <th>Course Name</th>
            <th>Trainer Name</th>
            <th>Agreed Amount</th>
            <th>Paid Fees</th>

            @if(!empty($field) && $field->income_col_3 == 1)
             <th>Income Type</th>@endif
            <th>Reg Date</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($merge as $record)
            <tr>
                @if(!empty($field) && $field->income_col_1 == 1)
                <td>@if(isset($record['name'])) {{ $record['name'] }} @elseif(isset($record['company_name'])) {{$record['company_name']}} @else {{"N/A"}} @endif </td>@endif
                <td>@if(isset($record['mobile_no'])) {{ $record['mobile_no'] }} @elseif(isset($record['contact_no'])) {{$record['contact_no']}} @else {{"N/A"}} @endif </td>
                <td>@if(isset($record->studDetail)){{$record->studDetail[0]->course->course_name}} @elseif(isset($record->corporateDetail)){{$record->corporateDetail[0]->course->course_name}} @else {{"N/A"}} @endif</td>
                <td>@if(isset($record->studDetail[0]->studBatchDetail[0])){{$record->studDetail[0]->studBatchDetail[0]->trainer->trainer_name}} @elseif(isset($record->corporateDetail[0]->corporateBatchDetail[0])){{$record->corporateDetail[0]->corporateBatchDetail[0]->trainer->trainer_name}} @else {{"N/A"}} @endif</td>
                <td>@if(isset($record->studDetail)){{$record->studDetail[0]->agreed_amount}} @elseif(isset($record->corporateDetail)){{$record->corporateDetail[0]->agreed_amount}} @else {{"N/A"}} @endif</td>
                <td>@if(isset($record->studDetail[0]->StudentCoruseWisePayment[0])){{number_format($record->studDetail[0]->StudentCoruseWisePayment[0]->getIncome->paying_amount,2)}} @elseif(isset($record->corporateDetail[0]->coruseWisePayment[0])){{number_format($record->corporateDetail[0]->coruseWisePayment[0]->getIncome->paying_amount,2)}} @else {{"N/A"}} @endif</td>
                @if(!empty($field) && $field->income_col_3 == 1)
                    <td> @if(isset($record->StudentIncome)) {{ getIncomeType($record->StudentIncome[0]['income_id']) }} @elseif(isset($record->corporateIncome)) {{getIncomeType($record->corporateIncome[0]['income_id'])}} @else {{getIncomeType($record['id'])}} @endif </td>@endif
                <td>{{ date('d/m/Y', strtotime($record['created_at'])) }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.incomes.destroy', $record->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('incomes_view')
                            @if(isset($record->StudentIncome))
                            <a href="{{ route('admin.incomes.show', [$record->id]) }}?type=student"
                               class='btn btn-default action-btn btn-sm'>
                                @elseif(isset($record->corporateIncome))
                                    <a href="{{ route('admin.incomes.show', [$record->id]) }}?type=corporate"
                                       class='btn btn-default action-btn btn-sm'>
                                        @else
                                            <a href="{{ route('admin.incomes.show', [$record->id]) }}"
                                               class='btn btn-default action-btn btn-sm'>
                                                @endif
                                                <i class="far fa-eye"></i>
                                            </a>

{{--                            <a href="{{ route('admin.incomes.show', [$record->id]) }}?type=student"--}}
{{--                               class='btn btn-default action-btn btn-sm'>--}}
{{--                                <i class="far fa-eye"></i>--}}
{{--                            </a>--}}
                        @endcan
                        @can('incomes_edit')
                            @if(isset($record->StudentIncome))
                                <a href="{{ route('admin.incomes.edit', [$record->id]) }}?type=student"

                                   class='btn btn-primary action-btn btn-sm'>
                                    @elseif(isset($record->corporateIncome))
                                        <a href="{{ route('admin.incomes.edit', [$record->id]) }}?type=corporate"
                                           class='btn btn-primary action-btn btn-sm'>
                                            @else
                                                <a href="{{ route('admin.incomes.edit', [$record->id]) }}"
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
        </tbody>
    </table>
</div>
