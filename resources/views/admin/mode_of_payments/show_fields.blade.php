<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $modeOfPayment->id }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $modeOfPayment->title }}</p>
</div>

{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('name', 'Name:') !!}--}}
{{--    <p>{{ $modeOfPayment->name }}</p>--}}
{{--</div>--}}

{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('ifsc_code', 'IFSC Code:') !!}--}}
{{--    <p>{{ $modeOfPayment->ifsc_code }}</p>--}}
{{--</div>--}}

{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('account_no', 'Account No:') !!}--}}
{{--    <p>{{ $modeOfPayment->account_no }}</p>--}}
{{--</div>--}}

<div class="col-sm-12">
    {!! Form::label('opening_balance', 'Balance:') !!}
    <p>{{ $modeOfPayment->opening_balance }}</p>
</div>
<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $modeOfPayment->status == 1 ? "Active" : "Block"  }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $modeOfPayment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $modeOfPayment->updated_at }}</p>
</div>

