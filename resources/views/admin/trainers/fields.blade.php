<?php //dd($course); ?>
<!-- Trainer Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trainer_name', 'Trainer Name') !!}<span style="color:red;">*</span> :
    {!! Form::text('trainer_name', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('trainer_name') }}</span>
</div>
<!-- Email Field -->
<div class="form-group col-sm-6 branchtrainer">
    {!! Form::label('branch_id', 'Branch') !!}<span style="color:red;">*</span> :
    {!! Form::select('branch_id', $branch , null, ['class' => 'form-control changetrainerbranch','placeholder'=>'Please select Branch']) !!}
    <span class="error text-danger">{{ $errors->first('branch_id') }}</span>
</div>

<?php if(request()->route()->getName() == 'admin.trainers.create'){ ?>
<div class="form-group col-sm-6">
    {!! Form::label('course_id', 'Course Name') !!}<span style="color:red;">*</span> :
    <select id="id_SelectElement" name="course_id[]" multiple class="form-control custom-select changecourse select2">
        <option value="">--- Select ---</option>
        @foreach ($course as $key => $value)
            <option value="{{ $key }}">
               {{ $value }}
            </option>
        @endforeach
    </select>
    <span class="error text-danger">{{ $errors->first('course_id') }}</span>
</div>
<?php }else{ ?>
    <div class="form-group col-sm-6">
    {!! Form::label('course_id', 'Course Name') !!}<span style="color:red;">*</span> :
   <?php $check = json_decode($trainer->course_id);  ?>
    <select id="id_SelectElement" name="course_id[]" multiple class="form-control custom-select changecourse select2">
        <option value="">--- Select ---</option>
        @foreach ($course as $key => $value)
            <option value="{{ $key }}" {{ (in_array($key,$check)) ? 'selected' : ''}}>
               {{ $value }}
            </option>
        @endforeach
    </select>
    <span class="error text-danger">{{ $errors->first('course_id') }}</span>
</div>

<?php } ?>
{{--<!-- Email Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('email', 'Email') !!}<span style="color:red;">*</span> :--}}
{{--    {!! Form::email('email', null, ['class' => 'form-control']) !!}--}}
{{--    <span class="error text-danger">{{ $errors->first('email') }}</span>--}}
{{--</div>--}}

<!-- Contact Field -->
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('contact_no', 'Contact No.') !!}<span style="color:red;">*</span> :--}}
{{--    {!! Form::number('contact_no', null, ['class' => 'form-control']) !!}--}}
{{--    <span class="error text-danger">{{ $errors->first('contact_no') }}</span>--}}
{{--</div>--}}
<!-- Contact Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('profile_pic', 'Profile Pic:') !!}
    {!! Form::file('profile_pic', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('profile_pic') }}</span>
</div> -->
@push('third_party_scripts')
<script type="text/javascript">



    <?php if(request()->route()->getName() == 'admin.trainers.create'){ ?>
    $(document).ready(function(){
        $(".changecourse").html('');
        $(".changecourse").append('<option value="">Not avalible Course</option>');
    });

    <?php } ?>
       $(".changetrainerbranch").change(function(el){
       //     var batchRow = $(el).parents('.branchtrainer');
            var batchID = $('#branch_id').val();
            $(".changecourse").html('');
            if (batchID) {
                $.ajax({
                    type: 'GET',
                    url: "{{route('get-course')}}",
                    data: {'batchID': batchID},
                    dataTypes: 'json',
                    success: function (res) {
                        if (res) {
                            if(res != ''){
                                $(".changecourse").append('<option value="">Please Select Course</option>');
                            }else{
                                $(".changecourse").append('<option value="">Not avalible Course</option>');
                            }
                            $.each(res, function (key, value) {
                                $(".changecourse").append('<option value="'+key+'">'+value+'</option>');

                            });
                        }
                    }
                });
            } else {
                //$(".batch").empty();
            }

        });


$('.select2[multiple]').select2({
    width: '100%',
    closeOnSelect: false
})
</script>
@endpush

