
@if(!\Illuminate\Support\Facades\Auth::user()->hasRole('student_co-ordinator'))

<!-- Branch Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch :') !!}
    {!! Form::select('branch_id', $branch,null, ['class' => 'form-control','placeholder'=>'Select Branch']) !!}
</div> -->

<!-- Batch Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('batch_id', 'Batch:') !!}
    {!! Form::select('batch_id',$batch, null, ['class' => 'form-control','placeholder'=>'Select Batch']) !!}
</div> -->

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name') !!}<span style="color:red;">*</span> :
    {!! Form::text('name', null, ['class' => 'form-control','readonly']) !!}
    <span class="error text-danger">{{ $errors->first('name') }}</span>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email') !!}<span style="color:red;">*</span> :
    {!! Form::email('email', null, ['class' => 'form-control','readonly']) !!}
    <span class="error text-danger">{{ $errors->first('email') }}</span>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch') !!}<span style="color:red;">*</span> :
    {!! Form::select('branch_id',$branch, null, ['class' => 'form-control select2']) !!}
    <span class="error text-danger">{{ $errors->first('name') }}</span>
</div>

<!-- Mobile No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile_no', 'Mobile No') !!}<span style="color:red;">*</span> :
    {!! Form::number('mobile_no', null, ['class' => 'form-control','readonly']) !!}
    <span class="error text-danger">{{ $errors->first('mobile_no') }}</span>
</div>

<!-- Lead Source Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lead_source_id', 'Lead Source:') !!}
    {!! Form::select('lead_source_id', $leadSource, null, ['class' => 'form-control','placeholder'=>'Please Select Lead Source']) !!}
    <span class="error text-danger">{{ $errors->first('lead_source') }}</span>
</div>

<!-- Enquiry Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('enquiry_type', 'Enquiry Type') !!}<span style="color:red;">*</span> :
    {!! Form::select('enquiry_type', $enquiryType, null, ['class' => 'form-control','placeholder'=>'Please Select Enquiry Type']) !!}
    <span class="error text-danger">{{ $errors->first('enquiry_type') }}</span>
</div>

<!-- Student Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('student_type', 'Student Type') !!}<span style="color:red;">*</span> :
    {!! Form::select('student_type',$studentType, null, ['class' => 'form-control','placeholder'=>'Please Select Student Type']) !!}
    <span class="error text-danger">{{ $errors->first('student_type') }}</span>
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', 'State') !!}<span style="color:red;">*</span> :
    {!! Form::text('state', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('state') }}</span>
</div>

<!-- Agreed Amount Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('agreed_amount', 'Agreed Amount:') !!}
    {!! Form::text('agreed_amount', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('agreed_amount') }}</span>
</div> -->

<!-- Placement Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('placement', 'Placement:') !!}
    {!! Form::select('placement',['yes'=>'YES','no'=>'NO'], null, ['class' => 'form-control']) !!}
</div> -->

<!-- Reg For Month Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('reg_for_month', 'Reg For Month:') !!}
    {!! Form::select('reg_for_month',['1month'=> '1 Month','2month'=> '2 Month','3month'=>'3 Month','4month'=>'4 Month','5month'=>'5 Month','6month'=>'6 Month','7month'=>'7 Month','8month'=>'8 Month','9month'=>'9 Month','10month'=>'10 Month','11month'=>'11 Month','12month'=>'12 Month'], null, ['class' => 'form-control']) !!}
</div> -->

<!-- Registration Taken -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('reg_taken_id', 'Registration Taken:') !!}
    {!! Form::select('reg_taken_id',$user, null, ['class' => 'form-control','placeholder'=>'Please Select']) !!}
</div> -->
<!-- Remark Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remark', 'Remark') !!}<span style="color:red;">*</span> :
    {!! Form::text('remark', null, ['class' => 'form-control']) !!}
</div>
<!-- Placement Field -->
<div class="form-group col-sm-6 both">
    {!! Form::label('placement', 'Placement:') !!}
    {!! Form::select('placement',['yes'=>'YES','no'=>'NO'], null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('placement') }}</span>
</div>
<!-- <div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status',['1'=>'Ongoing','2'=>'Not assigned','3'=>'Completed','4'=>'Placed'], null, ['class' => 'form-control','placeholder'=>'select status']) !!}
    <span class="error text-danger">{{ $errors->first('status') }}</span>
</div> -->

  @if(!empty($student->studDetail))
    @foreach($student->studDetail as $keys=>$studDetail)
<br> <input type="hidden" name="student[{{$keys}}][studDetail_id]" value="{{$studDetail->id}}" >
<br> <input type="hidden" name="student[{{$keys}}][in_id]" value="{{$studDetail->studFeesColl->income_id}}" >
<div class="col-sm-4">
<div class="form-group">
    <label class="required">Course Name</label><span style="color:red;">*</span></th><span class="error-course" style="color: red"></span>
    <select name="student[{{$keys}}][course_id]" class="form-control course"
            aria-required="true" aria-invalid="false" onchange="changeCourse(this)">
        <option value="">--Select Course--</option>

        @foreach ($course as $key=>$value)
            <option value="{{ $key }}" {{ $key == $studDetail->course_id ? "selected" : " " }}>{{ $value }}</option>
        @endforeach
    </select>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
    <label>Mode of Payment</label><span style="color:red;">*</span></th><br>
    <select name="student[{{$keys}}][mode_of_payment]" class="form-control mode_of_payment"
           id="batch{{$keys}}" aria-required="true" aria-invalid="false" onchange=modeOfPay(this,{{$keys}}) disabled>
        <option value="">--Select Mode of Payment--</option>

        @foreach ($modeOfPayment as $key=>$value)
            <option value="{{ $key }}" {{ $key == $studDetail->studFeesColl->getIncome->bank_acc_id ? "selected" : " " }}>{{ $value }}</option>
        @endforeach
    </select>
    <span class="error-mode_of_payment" style="color:red"></span>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
    <label>Agreed Amount</label><span style="color:red;">*</span></th><br>
    <input id="value" step=".01" name="student[{{$keys}}][agreed_amount]"
           class="form-control agreed_amount" type="text" value="{{$studDetail->agreed_amount}}" disabled>
    <span class="error-is_required" style="color:red"></span>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
    <label>Pay Amount</label><span style="color:red;">*</span></th><br>
    <input id="value" step=".01" name="student[{{$keys}}][pay_amount]"
           class="form-control pay_amount" type="text" value="{{$studDetail->studFeesColl->getIncome->paying_amount + $studDetail->studFeesColl->gst}}" disabled>
    <span class="error-is_required" style="color:red"></span>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
    <label>Due date</label><span style="color:red;">*</span></th><br>
    <input id="value" name="student[{{$keys}}][due_date]"
           class="form-control due_date" type="date" value="{{$studDetail->due_date}}" disabled>
    <span class="error-is_required" style="color:red"></span>
</div>
</div>

<div class="col-sm-1 gst{{$keys}}"  @if($studDetail->studFeesColl->gst == 0) style="display: none"  @endif >
<div class="form-group">
    <label>Gst</label>
    <input id="value" step=".01" name="student[{{$keys}}][gst]"
            type="text"  class="form-control" value="{{$studDetail->studFeesColl->gst > 0 ? $studDetail->studFeesColl->gst : " " }}" disabled>

           <span class="error-is_required" style="color:red" ></span>
</div>
</div>

<div class="col-sm-2">
    <div class="form-group">
        <br>
        <br>
        <input id="nobAtch" step=".01" name="student[{{$keys}}][no_batch]"
              class="no-batch" value="1" type="checkbox" {{count($studDetail->studBatchDetail) == 0 ? "checked" : " " }} onclick="batchDisplay(this.checked, {{$keys}})">
               <label>Batch Not Yet</label>
               <span class="error-is_required" style="color:red"></span>
    </div>
</div>

<!-- <button type="button" class="btn btn-success addNewRow" id="addNewRow" style="margin: auto;" onclick="addnewrow({{$keys}})">
    Add New Row
</button>
<br><br> -->

@if(!empty($studDetail->studBatchDetail))
 <span class="batch_table{{$keys}}">
    <div id="addNewTableRow" style="margin-left: 17px;">
        <div class="row product">
            <div class="table-responsive">
                <table class="options table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th style="width: 400px;">Batch Name <span style="color:red;">*</span></th>
                        <th style="width: 400px;">Trainer Name <span style="color:red;">*</span></th>
                        <th style="width: 300px;">Fees</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>

                    @if(count($studDetail->studBatchDetail)>0)
                    @foreach($studDetail->studBatchDetail as $batchDetail)
                        <tr id="tr{{$keys}}_{{$loop->index}}" class="addrowbellow sub_{{$keys}}" >
                            <td class="text-center drag-td"><span class="drag-icon"> <i
                                        class="fa"></i> <i
                                        class="fa"></i> </span>
                            </td>

                            <td>
                                <select  name="student[{{$keys}}][course][{{ $loop->index }}][batch_id]" class="form-control batch"
                                         aria-required="true" aria-invalid="false" onchange="changeBatch(this)" >
                                    <option value="">--Select Batch--</option>

                                    @foreach ($batch as $key=>$value)
                                        <option value="{{ $key }}" {{ $key == $batchDetail->batch_id ? "selected" : " " }}>{{ $value }}</option>
                                    @endforeach
                                </select><span class="error-batch"style="color: red"></span>
                            </td>
                            <td>
                                <select  name="student[{{$keys}}][course][{{ $loop->index }}][trainer_id]" class="form-control trainer"
                                         aria-required="true" aria-invalid="false" >
                                    <option value="">--Select Trainer--</option>

                                    @foreach ($trainer as $key=>$value)
                                        <option value="{{ $key }}" {{ $key == $batchDetail->trainer_id ? "selected" : " " }}>{{ $value }}</option>
                                    @endforeach
                                </select><span class="error-trainer"style="color: red"></span>

                            </td>
                            <td>
                                <input id="price" step=".01" name="student[{{$keys}}][course][{{ $loop->index }}][trainer_fees]"
                                       value="{{ $batchDetail->trainer_fees }}"
                                       class="form-control input-sm trainer_fees" type="text"
                                       placeholder="Enter Price" ><span class="error-trainer_fees"style="color: red"></span>
                            </td>
                            <td>
                                <button type="button"
                                        class="btn btn-sm btn-delete"  onclick="return remove_item(this);">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </td>
                        </tr>
                        @php
                            $hello =$loop->count-1;
                        @endphp
                        @if($loop->index==$hello)
                            <tr id="ltr{{$keys}}"></tr>
                        @endif
                    @endforeach
                        @else
                        <tr id="tr0_0" class="addrowbellow sub_0">
                            <td class="text-center drag-td"><span class="drag-icon"> <i class="fa"></i> <i
                                        class="fa"></i> </span>
                            </td>
                            <td>
                                <select  name="student[0][course][0][batch_id]"class="form-control batch"
                                         aria-required="true" aria-invalid="false" onchange="changeBatch(this)" >
                                    <option value="">--Select Batch--</option>

                                    @foreach ($batch as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select><span class="error-batch"style="color: red"></span>
                            </td>
                            <td>
                                <select  name="student[0][course][0][trainer_id]" class="form-control trainer"
                                         aria-required="true" aria-invalid="false" >
                                    <option value="">--Select Trainer--</option>

                                    @foreach ($trainer as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select><span class="error-trainer"style="color: red"></span>
                            </td>
                            <td>
                                <input id="price" step=".01" name="student[0][course][0][trainer_fees]"
                                       value=""
                                       class="form-control input-sm trainer_fees" type="text"
                                       placeholder="Enter Price" ><span class="error-trainer_fees"style="color: red"></span>
                            </td>
                            <td></td>
                        </tr>
                        <tr id="ltr0"></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</span>                                           
@endif
@endforeach
@endif


@else

    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Name') !!}<span style="color:red;">*</span> :
        {!! Form::text('name', null, ['class' => 'form-control','readonly']) !!}
        <span class="error text-danger">{{ $errors->first('name') }}</span>
    </div>

    <!-- Email Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('email', 'Email') !!}<span style="color:red;">*</span> :
        {!! Form::email('email', null, ['class' => 'form-control','readonly']) !!}
        <span class="error text-danger">{{ $errors->first('email') }}</span>
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('branch_id', 'Branch') !!}<span style="color:red;">*</span> :
        {!! Form::select('branch_id',$branch, null, ['class' => 'form-control select2 co-originator']) !!}
        <span class="error text-danger">{{ $errors->first('branch_id') }}</span>
    </div>

    <!-- Mobile No Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('mobile_no', 'Mobile No') !!}<span style="color:red;">*</span> :
        {!! Form::number('mobile_no', null, ['class' => 'form-control','readonly']) !!}
        <span class="error text-danger">{{ $errors->first('mobile_no') }}</span>
    </div>



    <!-- Enquiry Type Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('enquiry_type', 'Enquiry Type') !!}<span style="color:red;">*</span> :
        {!! Form::select('enquiry_type', $enquiryType, null, ['class' => 'form-control co-originator']) !!}
        <span class="error text-danger">{{ $errors->first('enquiry_type') }}</span>
    </div>

    <!-- Student Type Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('student_type', 'Student Type') !!}<span style="color:red;">*</span> :
        {!! Form::select('student_type',$studentType, null, ['class' => 'form-control co-originator']) !!}
        <span class="error text-danger">{{ $errors->first('student_type') }}</span>
    </div>

    <!-- State Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('state', 'State') !!}<span style="color:red;">*</span> :
        {!! Form::text('state', null, ['class' => 'form-control','readonly']) !!}
        <span class="error text-danger">{{ $errors->first('state') }}</span>
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('remark', 'Remark') !!}<span style="color:red;">*</span> :
        {!! Form::text('remark', null, ['class' => 'form-control co-originator','readonly']) !!}
    </div>
    <!-- Placement Field -->
    <div class="form-group col-sm-6 both">
        {!! Form::label('placement', 'Placement:') !!}
        {!! Form::select('placement',['yes'=>'YES','no'=>'NO'], null, ['class' => 'form-control co-originator']) !!}
{{--        <span class="error text-danger">{{ $errors->first('placement') }}</span>--}}
    </div>

    <!-- Initial call made Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('initial_call_made', 'Initial call made:') !!}
        {!! Form::select('initial_call_made',['yes'=>'YES','no'=>'NO'], null, ['class' => 'form-control']) !!}
{{--        <span class="error text-danger">{{ $errors->first('placement') }}</span>--}}
    </div>
    <!-- Initial call made Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('batch_status', 'Batch completed ?:') !!}
        {!! Form::select('batch_status',['yes'=>'YES','no'=>'NO'], null, ['class' => 'form-control']) !!}
{{--        <span class="error text-danger">{{ $errors->first('batch_status') }}</span>--}}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('tc', 'Placement T& C signed?:') !!}
        {!! Form::select('tc',['yes'=>'YES','no'=>'NO'], null, ['class' => 'form-control']) !!}
{{--        <span class="error text-danger">{{ $errors->first('tc') }}</span>--}}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('placement_exam_conducted', 'Placement exam conducted? :') !!}
        {!! Form::select('placement_exam_conducted',['yes'=>'YES','no'=>'NO'], null, ['class' => 'form-control']) !!}
{{--        <span class="error text-danger">{{ $errors->first('placement_exam_conducted') }}</span>--}}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('exam_passed', 'Exam passed:') !!}
        {!! Form::select('exam_passed',['yes'=>'YES','no'=>'NO'], null, ['class' => 'form-control']) !!}
{{--        <span class="error text-danger">{{ $errors->first('exam_passed') }}</span>--}}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('certificate_issued', 'Certificate issued:') !!}
        {!! Form::select('certificate_issued',['yes'=>'YES','no'=>'NO'], null, ['class' => 'form-control']) !!}
{{--        <span class="error text-danger">{{ $errors->first('certificate_issued') }}</span>--}}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('cv_shared_to_hr', 'CV shared to HR ?:') !!}
        {!! Form::select('cv_shared_to_hr',['yes'=>'YES','no'=>'NO'], null, ['class' => 'form-control']) !!}
{{--        <span class="error text-danger">{{ $errors->first('cv_shared_to_HR') }}</span>--}}
    </div>

@endif
@push('third_party_scripts')
    <script>
    var mindex = 0;
        var subindx = 0;
        var option = " ";
        $("#addNew").click(function () {
            mindex += 1;
            // alert(mindex)
            $('#lmain').before('<div id="itemDetails" class="main' + mindex + ' row-course reg-detail">\n' +
                '                    <div class="parent options[' + mindex + ']">\n' +
                '                        <div class="row product">\n' +
                '                            <div class="col-sm-4">\n' +
                '                                <div class="form-group">\n' +
                '                                    <label class="required">Course Name</label><span class="error-course"style="color: red"></span>\n' +
                '<select  name="student[' + mindex + '][course_id]" type="text" class="form-control course" aria-required="true" aria-invalid="false" onchange="changeCourse(this)">\n' +
                '<option value="">--Select Course--</option>\n' +
                @php
                    $courses = '';
                    foreach ($course as $key=>$value)
                 {

                     $courses .= '<option value="' . $key . '">' . $value. "</option>";
                 }
                @endphp
                    '<?php echo $courses; ?>\n' +
                '</select>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '<div class="col-sm-4">\n' +
                '<div class="form-group">\n' +
                '<label>Mode of Payment</label><br>\n' +
                '<select  name="student[' + mindex + '][mode_of_payment]" type="text" class="form-control mode_of_payment" onclick=modeOfPay(this) aria-required="true" aria-invalid="false">\n' +
                '<option value="">--Select Mode of Payment--</option>\n' +
                @php
                    $mode = '';
                    foreach ($modeOfPayment as $key=>$value)
                 {

                     $mode .= '<option value="' . $key . '">' . $value. "</option>";
                 }
                @endphp
                    '<?php echo $mode; ?>\n' +
                '</select>\n' +
                '<span class="error-is_required" style="color:red"></span>\n' +
                '</div> \n' +
                ' </div> \n' +
                ' <div class="col-sm-4">\n' +
                ' <div class="form-group">\n' +
                '<label>Agreed Amount</label><br>\n' +
                '<input id="value" step=".01" name="student[' + mindex + '][agreed_amount]" class="form-control agreed_amount" type="text">\n' +
                ' <span class="error-is_required" style="color:red"></span>\n' +
                '</div>\n' +
                '</div>\n' +

                '<div class="col-sm-4"> \n' +
                '<div class="form-group"> \n' +
                '<label>Pay Amount</label><br> \n' +
                '<input id="value" step=".01" name="student[' + mindex + '][pay_amount]" class="form-control pay_amount" type="text"> \n' +
                '<span class="error-is_required" style="color:red"></span> \n' +
                '</div> \n' +
                '</div> \n' +

                '<div class="col-sm-4"> \n' +
                '<div class="form-group"> \n' +
                '<label>Due Date</label><br> \n' +
                '<input id="value" name="student[' + mindex + '][due_date]" class="form-control due_date" type="date"> \n' +
                '<span class="error-is_required" style="color:red"></span> \n' +
                '</div> \n' +
                '</div> \n' +
                '<div class="col-sm-1"> \n' +
                ' <div class="form-group"> \n' +
                ' <br> \n' +
                ' <br> \n' +

                ' <input id="value" step=".01" name="student[' + mindex + '][gst]" value="1" type="checkbox"> \n' +
                '<label>Gst</label> \n' +
                '<span class="error-is_required" style="color:red"></span> \n' +
                '</div>\n' +
                '</div> \n' +
                '<div class="col-sm-2"> \n' +
                ' <div class="form-group"> \n' +
                ' <br> \n' +
                '<br> \n' +

                '<input id="value" step=".01" name="student[' + mindex + '][no_batch]" value="1" type="checkbox"> \n' +
                '<label>Batch Not Yet</label> \n' +
                '  <span class="error-is_required" style="color:red"></span> \n' +
                '  </div> \n' +
                ' </div> \n' +

                '                            <br><br>\n' +
                '                        </div>\n' +
                '                        <button type="button" class="btn btn-success addNewRow" id="addNewRow" onclick="addnewrow(' + mindex + ')">Add New Row</button>\n' +
                '                        <br><br>\n' +
                '\n' +
                '                        <div id="addNewTableRow" class="batch-row">\n' +
                '                            <div class="row product">\n' +
                '                                <div class="table-responsive">\n' +
                '                                    <table class="options table table-bordered table-striped">\n' +
                '                                        <thead>\n' +
                '                                        <tr>\n' +
                '                                            <th></th>\n' +
                '                                            <th>Batch Name <span style="color:red;">*</span></th>\n' +
                '                                            <th>Trainer Name <span style="color:red;">*</span></th>\n' +
                '                                            <th class="retail_col">Fees</th>\n' +
                '                                            <th></th>\n' +
                '                                        </tr>\n' +
                '                                        </thead>\n' +
                '\n' +
                '                                        <tbody>\n' +
                '                                        <tr id="tr' + mindex + '_0" class="addrowbellow sub_' + mindex + '">\n' +
                '                                            <td class="text-center drag-td"><span class="drag-icon"> <i class="fa"></i> <i\n' +
                '                                                        class="fa"></i> </span>\n' +
                '                                            </td>\n' +
                '\n' +
                '                                            <td>\n' +
                '<select  name="student[' + mindex + '][course][0][batch_id]" type="text" class="form-control batch" aria-required="true" aria-invalid="false"  onchange="changeBatch(this)"><span class="error-trainer"style="color: red"></span>\n' +
                '<option value="">--Select Batch--</option>\n' +
                @php
                    $option = '';
                    foreach ($batch as $key=>$value)
                 {

                     $option .= '<option value="' . $key . '">' . $value. "</option>";
                 }
                @endphp
                    '<?php echo $option; ?>\n' +
                '</select>\n' +
                '                                            </td>\n' +
                '                                            <td>\n' +
                '<select  name="student[' + mindex + '][course][0][trainer_id]" type="text" class="form-control trainer" aria-required="true" aria-invalid="false" required ><span class="error-trainer"style="color: red"></span>\n' +
                '<option value="">--Select Trainer --</option>\n' +
                @php
                    $op = '';
                    foreach ($trainer as $key=>$value)
                 {

                     $op .= '<option value="' . $key . '">' . $value. "</option>";
                 }
                @endphp
                    '<?php echo $op; ?>\n' +
                '</select>\n' +
                '                                            </td>\n' +
                '                                            <td class="retail_col"><input id="price" step=".01" name="student[' + mindex + '][course][0][trainer_fees]"\n' +
                '                                                       value=""\n' +
                '                                                       class="form-control input-sm trainer_fees" type="text"\n' +
                '                                                       placeholder="Enter Price"><span class="error-trainer_fees"style="color: red"></span>\n' +
                '                                            </td>\n' +
                '                   <td>\n' +
                '                       <button type="button" class="btn btn-sm" \n' +
                '                           onclick="return remove_item(this);">\n' +
                '                          <span class="fa fa-trash"></span>\n' +
                '                      </button>\n' +
                '                         \n' +
                '                                                </td>\n' +
                '                                        </tr>\n' +

                '                                        <tr id="ltr' + mindex + '"></tr>\n' +
                '                                        </tbody>\n' +
                '                                    </table>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '                <br><br>');
            var IncomeType = $('#income_type option:selected').text();
            if(IncomeType == 'Corporate Training') {
                $('.retail_col').hide();
            }else{
                $('.retail_col').show();
            }
        });
    function addnewrow(mindex1) {
            subindx = $('.sub_' + mindex1).length;
// alert(mindex1);
            var html = '<tr id="tr' + mindex1 + '_' + subindx + '" class="addrowbellow sub_' + mindex1 + '">\n' +
                '                                                <td class="text-center drag-td"><span class="drag-icon"> <i class="fa"></i> <i\n' +
                '                                                            class="fa"></i> </span>\n' +
                '                                                </td>\n' +
                '\n' +
                '                                                <td>\n' +
                '<select  name="student[' + mindex1 + '][course][' + subindx + '][batch_id]" type="text" class="form-control batch" onchange="changeBatch(this)" aria-required="true" aria-invalid="false"><span class="error-trainer"style="color: red"></span>\n' +
                '<option value="">--Select Batch--</option>\n' +
                    '<?php echo $option; ?>\n' +
                '</select>\n' +
                '                                                </td>\n' +
                '                                                <td>\n' +
                '<select  name="student[' + mindex1 + '][course][' + subindx + '][trainer_id]" type="text" class="form-control trainer" aria-required="true" aria-invalid="false"><span class="error-trainer"style="color: red"></span>\n' +
                '<option value="">--Select Trainer--</option>\n' +
                    '<?php echo $op; ?>\n' +
                '</select>\n' +
                '                                                </td>\n' +
                '                                                <td class="retail_col"><input id="price" step=".01" name="student[' + mindex1 + '][course][' + subindx + '][trainer_fees]"\n' +
                '                                                           value=""\n' +
                '                                                           class="form-control input-sm trainer_fees" type="text"\n' +
                '                                                           placeholder="Enter Price"><span class="error-trainer_fees"style="color: red"></span>\n' +
                '                                                </td>\n' +
                '<td>\n' +
                '         <button type="button" class="btn btn-sm" \n' +
                '                    onclick="return remove_item(this);">\n' +
                '              <span class="fa fa-trash"></span>\n' +
                '           </button>\n' +
                '        \n' +
                '                                                </td>\n' +

                '                                            </tr>';
            $('#ltr' + mindex1).before(html);
            var IncomeType = $('#income_type option:selected').text();
            if(IncomeType == 'Corporate Training') {
                $('.retail_col').hide();
            }else{
                $('.retail_col').show();
            }
        }

    function remove_item(mi) {
            $(mi).closest('.addrowbellow').remove();
            // $('#tr'+mi+'_'+si).remove();
        }

    function batchDisplay(value, index) {
            if(value) {
                $('.batch_table'+ index).hide();
            } else {
                $('.batch_table'+ index).show();

            }
        }
    $('.co-originator').attr("disabled", true);
    </script>
@endpush
