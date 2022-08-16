<!-- Expence Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expence_type_id', 'Expence Type') !!}<span style="color:red;">*</span> :
    {!! Form::select('expence_type_id', $expenseTypes, null, ['class' => 'form-control custom-select','onchange'=>'ChangeExpenseType()','id'=>'expense_type','placeholder'=>'Please Select Expense Type']) !!}
     <span class="error text-danger">{{ $errors->first('expence_type_id') }}</span>
</div>


<!-- Branch Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch') !!}<span style="color:red;">*</span> :
    {!! Form::select('branch_id', $branch, null, ['class' => 'form-control custom-select changeexpencebranch','placeholder'=>'Please Select Branch']) !!}
    <span class="error text-danger">{{ $errors->first('bank_ac_id') }}</span>
</div>

<!-- Branch Id Field -->
<div class="form-group col-sm-6 trainer" style="display: none">
    {!! Form::label('trainer_id', 'Trainer Name') !!}
    {!! Form::select('trainer_id', $trainer, null, ['class' => 'form-control custom-select changeexpencetrainer','placeholder'=>'Please Select Trainer','onchange'=>"changeTrainer(this)"]) !!}
</div>

<!-- Branch Id Field -->
<div class="form-group col-sm-6 trainer" style="display: none">
    {!! Form::label('batch_id', 'Batch Name') !!}
    {!! Form::select('batch_id', $batch, null, ['class' => 'form-control custom-select batch','placeholder'=>'Please Select Batch']) !!}
</div>
<!-- Bank Ac Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_ac_id', 'Bank Ac') !!}<span style="color:red;">*</span> :
    {!! Form::select('bank_ac_id', $bankAccounts, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Bank']) !!}
    <span class="error text-danger">{{ $errors->first('expence_type_id') }}</span>
</div>

<div class="form-group col-sm-6 student">
    {!! Form::label('student_id', 'Student  Name') !!}<span style="color:red;">*</span> :
    {!! Form::select('student_id', $student, null, ['class' => 'form-control custom-select select2search','id'=>'student','placeholder'=>'Please Select Student']) !!}
</div>
<!-- Amount Field -->
<div class="form-group col-sm-5">
    {!! Form::label('amount', 'Amount') !!}<span style="color:red;">*</span> :
    {!! Form::number('amount', null, ['class' => 'form-control','id'=>'amount']) !!}
    <span class="error text-danger">{{ $errors->first('amount') }}</span>
</div>
<div class="form-group col-sm-1 trainer" style="margin-top: 37px;">
    <input type="checkbox" id="vehicle1" name="tds">
    {!! Form::label('tds', 'TDS') !!}<span style="color:red;">*</span> 
    <span class="error text-danger">{{ $errors->first('gst') }}</span>
</div>
<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date') !!}<span style="color:red;">*</span> :
    {!! Form::text('date', null, ['class' => 'form-control','id'=>'datetimepicker']) !!}
    <span class="error text-danger">{{ $errors->first('date') }}</span>
</div>

<!-- Remark Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remark', 'Remark') !!}<span style="color:red;">*</span> :
    {!! Form::text('remark', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12">
<a class="btn btn-warning float-left"
   href="#" onclick="verify()">
    verify
</a>
<div id="show_verify" ></div>
@push('third_party_scripts')

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>--}}
    <script>

    $(document).ready(function(){
        $(".changeexpencetrainer").html('');
         $(".changeexpencetrainer").append('<option value="">Not avalible Trainer</option>');
    });
       $(".changeexpencebranch").change(function(el){
            var branchID = $('#branch_id').val();
            $(".changeexpencetrainer").html('');
            if (branchID) {
                $.ajax({
                    type: 'GET',
                    url: "{{route('get-expencetrainer')}}",
                    data: {'branchID': branchID},
                    dataTypes: 'json',
                    success: function (res) {
                        if (res) {
                            if(res != ''){
                                $(".changeexpencetrainer").append('<option value="">Please Select Trainer</option>');
                            }else{
                                $(".changeexpencetrainer").append('<option value="">Not avalible Trainer</option>');
                            }
                            $.each(res, function (key, value) {
                                $(".changeexpencetrainer").append('<option value="'+key+'">'+value+'</option>');

                            });
                        }
                    }
                });
            } else {
                //$(".batch").empty();
            }

        });

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
function verify() {
    var BankAccount = $('#bank_ac_id option:selected').val();
    var Amount = $('#amount').val();

    if(BankAccount != "" && Amount != ""){
        $.ajax({
            type: 'GET',
            url: "{{route('expense-verify')}}",
            data: {'bank_Acc': BankAccount,'amount': Amount},
            dataTypes: 'json',
            success: function (res) {
                if (res) {
                     $('#show_verify').html(res.verify).css('color','black');
                }
            }
        });
    }else{
        $('#show_verify').html('Please Select Bank Account And Enter Amount').css('color','red');
    }
}
</script>
    @endpush
