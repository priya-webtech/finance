
<!-- Branch Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch :') !!}
    {!! Form::select('branch_id', $branch,null, ['class' => 'form-control','placeholder'=>'Select Branch']) !!}
    <span class="error text-danger">{{ $errors->first('branch_id') }}</span>
</div>

<!-- Batch Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('batch_id', 'Batch:') !!}
    {!! Form::select('batch_id',$batch, null, ['class' => 'form-control','placeholder'=>'Select Batch']) !!}
    <span class="error text-danger">{{ $errors->first('batch_id') }}</span>
</div>

<!-- Enquiry Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('enquiry_type_id', 'Enquiry Type:') !!}
    {!! Form::select('enquiry_type_id',$leadsouce, null, ['class' => 'form-control','placeholder'=>'Select Enquiry Type']) !!}
    <span class="error text-danger">{{ $errors->first('enquiry_type_id') }}</span>
</div>

<!-- Lead Source Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lead_source_id', 'Lead Source:') !!}
    {!! Form::select('lead_source_id',$enquiryType, null, ['class' => 'form-control','placeholder'=>'Select Lead Source']) !!}
    <span class="error text-danger">{{ $errors->first('lead_source_id') }}</span>
</div>
<!-- Company Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_name', 'Company Name:') !!}
    {!! Form::text('company_name', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('company_name') }}</span>
</div>

<!-- Contact No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_no', 'Contact No:') !!}
    {!! Form::text('contact_no', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('contact_no') }}</span>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('email') }}</span>
</div>

<!-- Web Site Field -->
<div class="form-group col-sm-6">
    {!! Form::label('web_site', 'Web Site:') !!}
    {!! Form::text('web_site', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('web_site') }}</span>
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('address') }}</span>
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', 'State:') !!}
    {!! Form::text('state', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('state') }}</span>
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('city') }}</span>
</div>



<!-- Trainer Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trainer_amount', 'Trainer Amount:') !!}
    {!! Form::text('trainer_amount', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('trainer_amount') }}</span>
</div>

<!-- Agreed Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('agreed_amount', 'Agreed Amount:') !!}
    {!! Form::text('agreed_amount', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('agreed_amount') }}</span>
</div>

{{--<!-- Gst Amount Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('gst_amount', 'Gst Amount:') !!}--}}
{{--    {!! Form::text('gst_amount', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Reg For Month Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reg_for_month', 'Reg For Month:') !!}
    {!! Form::select('reg_for_month',['1month'=> '1 Month','2month'=> '2 Month','3month'=>'3 Month','4month'=>'4 Month','5month'=>'5 Month','6month'=>'6 Month'], null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('reg_for_month') }}</span>
</div>

<!-- Remark Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remark', 'Remark:') !!}
    {!! Form::text('remark', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('remark') }}</span>
</div>

