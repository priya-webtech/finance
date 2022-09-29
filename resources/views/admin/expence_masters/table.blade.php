<div class="table-responsive">
  <div class="custom-filter">
    <form data-action="{{ route('admin.expenceesexpencecolums.expencecolums') }}" method="post" style="margin-top: 20px;" id="batchform">
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
            <input type="checkbox" class="expencemasterhidecol"  name="expencemaster_col_1" @if(!empty($field) && $field->expencemaster_col_1 == 1) Checked @endif/>&nbsp;Expence Type&nbsp;
          <label for="two">
            <input type="checkbox" class="expencemasterhidecol" name="expencemaster_col_2" @if(!empty($field) && $field->expencemaster_col_2 == 1) Checked @endif/>&nbsp;Branch
          <label for="three">
            <input type="checkbox" class="expencemasterhidecol" name="expencemaster_col_3" @if(!empty($field) && $field->expencemaster_col_3 == 1) Checked @endif/>&nbsp;Bank Ac
          <label for="four">
            <input type="checkbox" class="expencemasterhidecol" name="expencemaster_col_4" @if(!empty($field) && $field->expencemaster_col_4 == 1) Checked @endif/>&nbsp;Batch
          <label for="five">
            <input type="checkbox" class="expencemasterhidecol" name="expencemaster_col_5" @if(!empty($field) && $field->expencemaster_col_5 == 1) Checked @endif/>&nbsp;Trainer
          <label for="si6">
            <input type="checkbox" class="expencemasterhidecol" name="expencemaster_col_6" @if(!empty($field) && $field->expencemaster_col_6 == 1) Checked @endif/>&nbsp;Student
          <label for="seven">
           <input type="checkbox" class="expencemasterhidecol" name="expencemaster_col_7" @if(!empty($field) && $field->expencemaster_col_7 == 1) Checked @endif/>&nbsp;Amount
          <label for="eight">
            <input type="checkbox" class="expencemasterhidecol" name="expencemaster_col_8" @if(!empty($field) && $field->expencemaster_col_8 == 1) Checked @endif/>&nbsp;Date
        </div>
    </div>

    <input type="hidden" name="expencemaster" value="expencemaster">
    </form>

    <input type="submit" class="btn btn-danger btn-sm batchsubmit" value="Save">

    <form action="{{ route('admin.expenseFilter.filter') }}" method="get" style="margin-top: 20px;">
    <div class="form-group col-sm-6">
        {!! Form::label('expence_type_id', 'Expence Type:') !!}
        {!! Form::select('expence_type_id', $expenseTypes, null, ['class' => 'form-control custom-select','onchange'=>'ChangeExpenseType()','id'=>'expense_type','placeholder'=>'Please Select Expense Type']) !!}

    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('trainer_id', 'Trainer Name:') !!}
        {!! Form::select('trainer_id', $trainer, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Trainer','onchange'=>"changeTrainer(this)"]) !!}

    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('bank_ac_id', 'Bank Ac:') !!}
        {!! Form::select('bank_ac_id', $bankAccounts, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Bank']) !!}
        <span class="error text-danger">{{ $errors->first('expence_type_id') }}</span>
    </div>
    <input type="submit" class="btn btn-danger btn-sm" value="Filter">
    <a href="{{ route('admin.expenceMasters.index') }}">clear</a>
    </form>
  </div>
   <div class="row float-right">
        <input id="expenceMastersInput" type="text" class="form-control" placeholder="Search..">
    </div>
    <table class="table" id="expenceMasters-table">
        <thead>
        <tr>
           <!--  <th>Category</th>
            <th>Total</th> -->
        @if(!empty($field) && $field->expencemaster_col_1 == 1)<th>S.No</th>@endif
        @if(!empty($field) && $field->expencemaster_col_1 == 1)<th>Name</th>@endif
        @if(!empty($field) && $field->expencemaster_col_1 == 1)<th>Expence Type </th>@endif
        @if(!empty($field) && $field->expencemaster_col_2 == 1)<th>Branch</th>@endif
        @if(!empty($field) && $field->expencemaster_col_3 == 1)<th>Bank Ac </th>@endif
        {{-- @if(!empty($field) && $field->expencemaster_col_4 == 1)<th>Batch</th>@endif--}}
        {{-- @if(!empty($field) && $field->expencemaster_col_5 == 1)<th>Trainer</th>@endif--}}
        {{-- @if(!empty($field) && $field->expencemaster_col_6 == 1)<th>Student</th>@endif--}}
        @if(!empty($field) && $field->expencemaster_col_7 == 1)<th>Amount</th>@endif
        <th>Remark</th>
            <th colspan="3" id="noExl">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($expenceMasters) >0 )
        @foreach($expenceMasters as $key=>$expenceMaster)
        @if((isset(auth()->user()->branch_id) && $expenceMaster['branch_id'] == auth()->user()->branch_id) || (auth()->user()->branch_id == '' && auth()->user()->role_id == 0))
        <tr>
                <td>{{$key + $expenceMasters->firstItem()}}</td>
                <td>{{ $expenceMaster->trainer->trainer_name  ?? 'N/A' }}</td>
                <td>{{ $expenceMaster->expenceType->title }}</td>
                <td>{{ $expenceMaster->branch->title  ?? 'N/A' }}</td>
                <td>{{ $expenceMaster->bankAcc->name ?? 'N/A'  }}</td>
                <td>{{ $expenceMaster->amount }}</td>
                <td>{{ $expenceMaster->remark }}</td>
                <td id="noExl">
                    @can('expence_view')
                    <a href="{{ route('admin.expenceMasters.show', [$expenceMaster->id]) }}"
                       class='btn btn-default action-btn btn-sm'>
                        <i class="far fa-eye"></i>
                    </a>
                    @endcan
                </td>

        </tr>
        @endif
        @endforeach
        @else
        <tr><td colspan="6" class="text-center">No record found</td></tr>
        @endif
{{--        @foreach($expenceMasters as $expenceMaster)--}}
{{--          @if((isset(auth()->user()->branch_id) && $expenceMaster['branch_id'] == auth()->user()->branch_id) || (auth()->user()->branch_id == '' && auth()->user()->role_id == 0))--}}
{{--            <tr>--}}
{{--            @if(!empty($field) && $field->expencemaster_col_1 == 1)<td>{{ $expenceMaster->expenceType->title }}</td>@endif--}}
{{--            @if(!empty($field) && $field->expencemaster_col_2 == 1)<td>{{ $expenceMaster->branch->title  ?? 'N/A' }}</td>@endif--}}
{{--            @if(!empty($field) && $field->expencemaster_col_3 == 1)<td>{{ $expenceMaster->bankAcc->name ?? 'N/A'  }}</td>@endif--}}
{{--            @if(!empty($field) && $field->expencemaster_col_4 == 1)<td>{{ $expenceMaster->batch->name ?? 'N/A' }}</td>@endif--}}
{{--            @if(!empty($field) && $field->expencemaster_col_5 == 1)<td>{{ $expenceMaster->trainer->trainer_name ?? 'N/A'}}</td>@endif--}}
{{--            @if(!empty($field) && $field->expencemaster_col_6 == 1)<td>{{ $expenceMaster->student->name ?? 'N/A' }}</td>@endif--}}
{{--            @if(!empty($field) && $field->expencemaster_col_7 == 1)<td>{{ $expenceMaster->amount }}</td>@endif--}}
{{--            @if(!empty($field) && $field->expencemaster_col_8 == 1)<td>{{ $expenceMaster->date }}</td>@endif--}}
{{--            <td>{{ $expenceMaster->remark }}</td>--}}
{{--                <td width="120">--}}
{{--                    {!! Form::open(['route' => ['admin.expenceMasters.destroy', $expenceMaster->id], 'method' => 'delete']) !!}--}}
{{--                    <div class='btn-group'>--}}
{{--                         @can('expence_view')--}}
{{--                        <a href="{{ route('admin.expenceMasters.show', [$expenceMaster->id]) }}"--}}
{{--                           class='btn btn-default action-btn btn-sm'>--}}
{{--                            <i class="far fa-eye"></i>--}}
{{--                        </a>--}}
{{--                        @endcan--}}
{{--                         @can('expence_edit')--}}
{{--                        <a href="{{ route('admin.expenceMasters.edit', [$expenceMaster->id]) }}"--}}
{{--                           class='btn btn-primary action-btn btn-sm'>--}}
{{--                            <i class="far fa-edit"></i>--}}
{{--                        </a>--}}
{{--                        @endcan--}}
{{--                         @can('expence_delete')--}}
{{--                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
{{--                        @endcan--}}
{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            @endif--}}
{{--        @endforeach--}}
        </tbody>
    </table>
</div>
