<!-- Expence Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expence_type_id', 'Expence Type Id:') !!}
    {!! Form::select('expence_type_id', $expenseTypes, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Branch Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch Id:') !!}
    {!! Form::select('branch_id', $branch, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Bank Ac Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_ac_id', 'Bank Ac Id:') !!}
    {!! Form::select('bank_ac_id', $bankAccounts, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'form-control']) !!}
</div>

<!-- Remark Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remark', 'Remark:') !!}
    {!! Form::text('remark', null, ['class' => 'form-control']) !!}
</div>
