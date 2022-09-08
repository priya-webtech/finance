<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $bankAccount->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $bankAccount->name }}</p>
</div>

<!-- Ifsc Code Field -->
<div class="col-sm-12">
    {!! Form::label('ifsc_code', 'Ifsc Code:') !!}
    <p>{{ $bankAccount->ifsc_code }}</p>
</div>

<!-- Account No Field -->
<div class="col-sm-12">
    {!! Form::label('account_no', 'Account No:') !!}
    <p>{{ $bankAccount->account_no }}</p>
</div>

<!-- Other  Detail Field -->
<div class="col-sm-12">
    {!! Form::label('other _detail', 'Other  Detail:') !!}
    <p>{{ $bankAccount->other_detail }}</p>
</div>

<!-- Opening Balance Field -->
<div class="col-sm-12">
    {!! Form::label('opening_balance', 'Opening Balance:') !!}
    <p>{{ $bankAccount->opening_balance }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $bankAccount->status }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $bankAccount->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $bankAccount->updated_at }}</p>
</div>

