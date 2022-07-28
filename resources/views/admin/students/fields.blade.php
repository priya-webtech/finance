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
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('name') }}</span>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('email') }}</span>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch:') !!}
    {!! Form::select('branch_id',$branch, null, ['class' => 'form-control select2']) !!}
    <span class="error text-danger">{{ $errors->first('name') }}</span>
</div>

<!-- Mobile No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile_no', 'Mobile No:') !!}
    {!! Form::number('mobile_no', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('mobile_no') }}</span>
</div>

<!-- Lead Source Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('lead_source', 'Lead Source:') !!}
    {!! Form::select('lead_source', $leadSource, null, ['class' => 'form-control','placeholder'=>'Please Select Lead Source']) !!}
    <span class="error text-danger">{{ $errors->first('lead_source') }}</span>
</div> -->

<!-- Enquiry Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('enquiry_type', 'Enquiry Type:') !!}
    {!! Form::select('enquiry_type', $enquiryType, null, ['class' => 'form-control','placeholder'=>'Please Select Enquiry Type']) !!}
    <span class="error text-danger">{{ $errors->first('enquiry_type') }}</span>
</div>

<!-- Student Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('student_type', 'Student Type:') !!}
    {!! Form::select('student_type',$studentType, null, ['class' => 'form-control','placeholder'=>'Please Select Student Type']) !!}
    <span class="error text-danger">{{ $errors->first('student_type') }}</span>
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', 'State:') !!}
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
    {!! Form::label('remark', 'Remark:') !!}
    {!! Form::text('remark', null, ['class' => 'form-control']) !!}
</div>
