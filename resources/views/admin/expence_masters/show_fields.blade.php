<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $expenceMaster->id }}</p>
</div>

<!-- Expence Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('expence_type_id', 'Expence Type Id:') !!}
    <p>{{ $expenceMaster->expenceType->title }}</p>
</div>

<!-- Branch Id Field -->
<div class="col-sm-12">
    {!! Form::label('branch_id', 'Branch Id:') !!}
    <p>{{ $expenceMaster->branch->title }}</p>
</div>

<!-- Bank Ac Id Field -->
<div class="col-sm-12">
    {!! Form::label('bank_ac_id', 'Bank Ac Id:') !!}
    <p>{{ $expenceMaster->bankAcc->name }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $expenceMaster->amount }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $expenceMaster->date }}</p>
</div>

<!-- Remark Field -->
<div class="col-sm-12">
    {!! Form::label('remark', 'Remark:') !!}
    <p>{{ $expenceMaster->remark }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $expenceMaster->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $expenceMaster->updated_at }}</p>
</div>

