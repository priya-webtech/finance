@if($income != " ")
<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $income->id }}</p>
</div>

<!-- Income Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('income_type_id', 'Income Type:') !!}
    <p>{{ $income->incomeType->title }}</p>
</div>
@if($income->incomeType->title == "Franchise Royalty")
    <div class="col-sm-12">
        {!! Form::label('franchise_name', 'Franchise Name:') !!}
        <p>{{ $income->franchise->title }}</p>
    </div>
@endif
<!-- Paying  Amount Field -->
<div class="col-sm-12">
    {!! Form::label('paying _amount', 'Paying  Amount:') !!}
    <p>{{ $income->paying_amount }}</p>
</div>

<!-- Gst Field -->
<div class="col-sm-12">
    {!! Form::label('gst', 'Gst:') !!}
    <p>{{ $income->gst }}</p>
</div>
<!-- Gst Field -->
<div class="col-sm-12">
    {!! Form::label('totalPay', 'Total Pay:') !!}
    <p>{{ $income->total_pay }}</p>
</div>
<!-- Register Date Field -->
<div class="col-sm-12">
    {!! Form::label('register_date', 'Register Date:') !!}
    <p>{{ $income->register_date }}</p>
</div>

<!-- Registration Taken By Field -->
<div class="col-sm-12">
    {!! Form::label('registration_taken_by', 'Registration Taken By:') !!}
    <p>{{ $income->user->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $income->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $income->updated_at }}</p>
</div>

@elseif($students != " ")
{{--    @dd($students)--}}
    <div class="col-sm-12">
        {!! Form::label('Id', 'Student ID:') !!}
        <p>{{ $students->id }}</p>
    </div>
    <div class="col-sm-12">
        {!! Form::label('name', 'Name:') !!}
        <p>{{ $students->name }}</p>
    </div>
    <div class="col-sm-12">
        {!! Form::label('Email', 'Email:') !!}
        <p>{{ $students->email }}</p>
    </div>
    <div class="col-sm-12">
        {!! Form::label('mobile_no', 'Mobile No.:') !!}
        <p>{{ $students->mobile_no }}</p>
    </div>
<div class="col-sm-12">
    {!! Form::label('income_type_id', 'Income Type:') !!}
    <p>{{getIncomeType($students->studDetail[0]->studFeesColl->getIncome->id)  }}</p>
</div>
    <div class="col-sm-12">
        {!! Form::label('branch', 'Branch Name.:') !!}
        <p>{{ $students->branch->title }}</p>
    </div>
<div class="col-sm-12">
    {!! Form::label('branch', 'Course Name.:') !!}
    <p>{{ $students->studDetail[0]->course->course_name }}</p>
</div>
<div class="col-sm-12">
    {!! Form::label('agreed_amount', 'Agreed Amount:') !!}
    <p>{{ $students->studDetail[0]->agreed_amount }}</p>
</div>
<div class="col-sm-12">
    {!! Form::label('trainer_name', 'Trainer Name:') !!}
    <p> @if(isset($students->studDetail[0]->studBatchDetail[0])){{$students->studDetail[0]->studBatchDetail[0]->trainer->trainer_name }}@endif</p>
</div>
<div class="col-sm-12">
    {!! Form::label('trainer_fees', 'Trainer Fees:') !!}
    <p> @if(isset($students->studDetail[0]->studBatchDetail[0])){{$students->studDetail[0]->studBatchDetail[0]->trainer_fees }}@endif</p>
</div>
<div class="col-sm-12">
    {!! Form::label('pay_fees', 'Pay Fees:') !!}
    <p> @if(isset($students->studDetail[0]->StudentCoruseWisePayment[0])){{number_format($students->studDetail[0]->StudentCoruseWisePayment[0]->gst+$students->studDetail[0]->StudentCoruseWisePayment[0]->getIncome->paying_amount,2)}}@endif</p>
</div>

@elseif($corporate != " ")
    {{--    @dd($students)--}}
    <div class="col-sm-12">
        {!! Form::label('Id', 'Corporate ID:') !!}
        <p>{{ $corporate->id }}</p>
    </div>
    <div class="col-sm-12">
        {!! Form::label('name', 'Name:') !!}
        <p>{{ $corporate->company_name }}</p>
    </div>
    <div class="col-sm-12">
        {!! Form::label('Email', 'Email:') !!}
        <p>{{ $corporate->email }}</p>
    </div>
    <div class="col-sm-12">
        {!! Form::label('mobile_no', 'Mobile No.:') !!}
        <p>{{ $corporate->contact_no }}</p>
    </div>
    <div class="col-sm-12">
        {!! Form::label('income_type_id', 'Income Type:') !!}
        <p>{{getIncomeType($corporate->corporateDetail[0]->corpoFeesColl->getIncome->id)  }}</p>
    </div>
    <div class="col-sm-12">
        {!! Form::label('branch', 'Branch Name.:') !!}
        <p>{{ $corporate->branch->title }}</p>
    </div>
    <div class="col-sm-12">
        {!! Form::label('branch', 'Course Name.:') !!}
        <p>{{ $corporate->corporateDetail[0]->course->course_name }}</p>
    </div>
    <div class="col-sm-12">
        {!! Form::label('agreed_amount', 'Agreed Amount:') !!}
        <p>{{ $corporate->corporateDetail[0]->agreed_amount }}</p>
    </div>
    <div class="col-sm-12">
        {!! Form::label('trainer_name', 'Trainer Name:') !!}
        <p> @if(isset($corporate->corporateDetail[0]->corporateBatchDetail[0])){{$corporate->corporateDetail[0]->corporateBatchDetail[0]->trainer->trainer_name }}@endif</p>
    </div>
    <div class="col-sm-12">
        {!! Form::label('pay_fees', 'Pay Fees:') !!}
        <p> @if(isset($corporate->corporateDetail[0]->coruseWisePayment[0])){{number_format($corporate->corporateDetail[0]->coruseWisePayment[0]->gst+$corporate->corporateDetail[0]->coruseWisePayment[0]->getIncome->paying_amount,2)}}@endif</p>
    </div>
@endif
