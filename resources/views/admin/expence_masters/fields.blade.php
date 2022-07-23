<!-- Expence Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expence_type_id', 'Expence Type:') !!}
    {!! Form::select('expence_type_id', $expenseTypes, null, ['class' => 'form-control custom-select','onchange'=>'ChangeExpenseType()','id'=>'expense_type','placeholder'=>'Please Select Expense Type']) !!}
</div>


<!-- Branch Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch:') !!}
    {!! Form::select('branch_id', $branch, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Branch']) !!}
</div>

<!-- Branch Id Field -->
<div class="form-group col-sm-6 trainer" style="display: none">
    {!! Form::label('trainer_id', 'Trainer Name:') !!}
    {!! Form::select('trainer_id', $trainer, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Trainer','onchange'=>"changeTrainer(this)"]) !!}
</div>

<!-- Branch Id Field -->
<div class="form-group col-sm-6 trainer" style="display: none">
    {!! Form::label('batch_id', 'Batch Name:') !!}
    {!! Form::select('batch_id', $batch, null, ['class' => 'form-control custom-select batch','placeholder'=>'Please Select Batch']) !!}
</div>
<!-- Bank Ac Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_ac_id', 'Bank Ac:') !!}
    {!! Form::select('bank_ac_id', $bankAccounts, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Bank']) !!}
</div>

<div class="form-group col-sm-6 student">
    {!! Form::label('student_id', 'Student  Name:') !!}
    {!! Form::select('student_id', $student, null, ['class' => 'form-control custom-select select2search','id'=>'student','placeholder'=>'Please Select Student']) !!}
</div>
<!-- Amount Field -->
<div class="form-group col-sm-5">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-1 trainer" style="margin-top: 37px;">
    {!! Form::label('tds', 'TDS:') !!}
    <input type="checkbox" id="vehicle1" name="tds">
    <span class="error text-danger">{{ $errors->first('gst') }}</span>
</div>
<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::text('date', null, ['class' => 'form-control','id'=>'datetimepicker']) !!}
</div>

<!-- Remark Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remark', 'Remark:') !!}
    {!! Form::text('remark', null, ['class' => 'form-control']) !!}
</div>
@push('third_party_scripts')

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>--}}
    <script>
        $(document).ready(function() {
            $("#expense_type").trigger('change');
        });
function ChangeExpenseType() {
    var ExpenseType = $('#expense_type option:selected').text();
    if (ExpenseType == 'Trainer Fees') {
        $('.trainer').show();
        $('.student').hide();
    }else if(ExpenseType == 'Student Refund'){
        $('.student').show();
        $('.trainer').hide();
    }
    else{
        $('.trainer').hide();
        $('.student').hide();
    }
}

function changeTrainer(el) {
    var trainerID = $(el).val();

    if (trainerID) {
        $.ajax({
            type: 'GET',
            url: "{{route('get-trainer-batch')}}",
            data: {'trainerID': trainerID},
            dataTypes: 'json',
            success: function (res) {
                if (res) {
                    $(".batch").empty();
                    // batchRow.find(".trainer").append('<option value="">-- Select Batch --</option>');
                    $.each(res, function (key, value) {
                        $(".batch")
                            .append('<option value="' + key + '">' + value + '</option>');
                    });
                    // $('.multiple').select2();
                }
            }
        });

    } else {
        $(".batch").empty();
    }

}
</script>
    @endpush
