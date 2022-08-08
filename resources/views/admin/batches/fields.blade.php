<!-- Course Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('course_id', 'Course Name') !!}<span style="color:red;">*</span> :
    {!! Form::select('course_id', $course, null, ['class' => 'form-control custom-select changebatchcourse','placeholder'=>'Please Select Course']) !!}
        <span class="error text-danger">{{ $errors->first('course_id') }}</span>

</div>


<!-- Batch Mode Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('batch_mode_id', 'Batch Mode') !!}<span style="color:red;">*</span> :
    {!! Form::select('batch_mode_id', $batchMode, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Batch Mode']) !!}
        <span class="error text-danger">{{ $errors->first('batch_mode_id') }}</span>

</div>


<!-- Trainer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trainer_id', 'Trainer Name') !!}<span style="color:red;">*</span> :
    {!! Form::select('trainer_id', $trainer, null, ['class' => 'form-control custom-select changebatchtrainer','placeholder'=>'Please Select Trainer']) !!}
        <span class="error text-danger">{{ $errors->first('trainer_id') }}</span>

</div>
<div class="form-group col-sm-6">
    {!! Form::label('batch_type_id', 'Batch Type') !!}<span style="color:red;">*</span> :
    {!! Form::select('batch_type_id', $batchType, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Batch Type']) !!}
        <span class="error text-danger">{{ $errors->first('batch_type_id') }}</span>

</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name') !!}<span style="color:red;">*</span> :
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('name') }}</span>

</div>

<!-- Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start', 'Start') !!}<span style="color:red;">*</span> :
    {!! Form::text('start', null, ['class' => 'form-control datepicker']) !!}
        <span class="error text-danger">{{ $errors->first('start') }}</span>

</div>

<div class="form-group col-sm-6">
    {!! Form::label('batch_status', 'Batch Status') !!}<span style="color:red;">*</span> :
    {!! Form::select('batch_status', ['open'=>'Open','close'=>'Close'], null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Batch Status']) !!}
        <span class="error text-danger">{{ $errors->first('batch_status') }}</span>

</div>


@push('third_party_scripts')
<script type="text/javascript">

    $(document).ready(function(){
        $(".changebatchtrainer").html('');
         $(".changebatchtrainer").append('<option value="">Not avalible Trainer</option>');
    });
       $(".changebatchcourse").change(function(el){
            var courseID = $('#course_id').val();
            $(".changebatchtrainer").html('');
            if (courseID) {
                $.ajax({
                    type: 'GET',
                    url: "{{route('get-batchtrainer')}}",
                    data: {'courseID': courseID},
                    dataTypes: 'json',
                    success: function (res) {
                        if (res) {
                            if(res != ''){
                                $(".changebatchtrainer").append('<option value="">Please Select Trainer</option>');
                            }else{
                                $(".changebatchtrainer").append('<option value="">Not avalible Trainer</option>');
                            }
                            $.each(res, function (key, value) {
                                $(".changebatchtrainer").append('<option value="'+key+'">'+value+'</option>');

                            });
                        }
                    }
                });
            } else {
                //$(".batch").empty();
            }

        });
</script>
@endpush