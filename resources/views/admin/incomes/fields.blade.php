
<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch:') !!}
    {!! Form::select('branch_id', $branch, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Branch']) !!}
    <span class="error text-danger">{{ $errors->first('branch_id') }}</span>
</div>
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('mode_of_payment', 'Mode of Payment:') !!}--}}
{{--    {!! Form::select('mode_of_payment', $modeOfPayment, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Mode of Payment']) !!}--}}
{{--    <span class="error text-danger">{{ $errors->first('income_type_id') }}</span>--}}
{{--</div>--}}
<!-- Income Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('income_type_id', 'Income Type:') !!}
    {!! Form::select('income_type_id', $incomeType, null, ['class' => 'form-control custom-select','onchange'=>'ChangeIncomeType()','id'=>'income_type','placeholder'=>'Please Select Income Type']) !!}
      <span class="error text-danger">{{ $errors->first('income_type_id') }}</span>
</div>


<!-- Mobile No Field -->
<div class="form-group col-sm-6 both">
    {!! Form::label('mobile_no', 'Mobile No:') !!}
    {!! Form::text('mobile_no', null, ['class' => 'form-control','id'=>'mob']) !!}
    <span class="error text-danger">{{ $errors->first('mobile_no') }}</span>
</div>
<!-- Name Field -->

<div class="form-group col-sm-6 both">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('name') }}</span>
</div>
<!-- Email Field -->
<div class="form-group col-sm-6 both">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('email') }}</span>
</div>

{{--    <!-- Batch Id Field -->--}}
{{--    <div class="form-group col-sm-6 both">--}}
{{--        {!! Form::label('batch_id', 'Batch:') !!}--}}
{{--        {!! Form::select('batch_id',$batch, null, ['class' => 'form-control','onchange'=>'bath()','id'=>'batch','placeholder'=>'Select Batch']) !!}--}}
{{--        <span class="error text-danger">{{ $errors->first('batch_id') }}</span>--}}
{{--    </div>--}}
    <!-- Student Type Field -->
<div class="form-group col-sm-6 stud">
    {!! Form::label('student_type', 'Student Type:') !!}
    {!! Form::select('student_type',$studentType, null, ['class' => 'form-control','placeholder'=>'Please Select Student Type']) !!}
    <span class="error text-danger">{{ $errors->first('student_type') }}</span>
</div>
    <div class="form-group col-sm-6 both">
        {!! Form::label('lead_source_id', 'Lead Source :') !!}
        {!! Form::select('lead_source_id',$leadSources, null, ['class' => 'form-control','placeholder'=>'Please Select Student Type']) !!}
        <span class="error text-danger">{{ $errors->first('lead_source') }}</span>
    </div>
    <div class="form-group col-sm-6 both">
        {!! Form::label('enquiry_type', 'Enquiry Type:') !!}
        {!! Form::select('enquiry_type',$enquiryType, null, ['class' => 'form-control','placeholder'=>'Please Select Student Type']) !!}
        <span class="error text-danger">{{ $errors->first('enquiry_type') }}</span>
    </div>
<!-- State Field -->
<div class="form-group col-sm-6 both">
    {!! Form::label('state', 'State:') !!}
    {!! Form::select('state', $country, null,['class' => 'form-control', 'placeholder'=> '--Please Select State--']) !!}
    <span class="error text-danger">{{ $errors->first('state') }}</span>
</div>
{{--<!-- Course Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('course_id', 'Course:') !!}--}}
{{--    {!! Form::select('course_id', $course, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Course']) !!}--}}
{{--    <span class="error text-danger">{{ $errors->first('course_id') }}</span>--}}
{{--</div>--}}
<!-- Agreed Amount Field -->
{{--<div class="form-group col-sm-6 both">--}}
{{--    {!! Form::label('agreed_amount', 'Agreed Amount:') !!}--}}
{{--    {!! Form::text('agreed_amount', null, ['class' => 'form-control']) !!}--}}
{{--    <span class="error text-danger">{{ $errors->first('agreed_amount') }}</span>--}}
{{--</div>--}}

<!-- Placement Field -->
<div class="form-group col-sm-6 stud">
    {!! Form::label('placement', 'Placement:') !!}
    {!! Form::select('placement',['yes'=>'YES','no'=>'NO'], null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('placement') }}</span>
</div>
<!-- Remark Field -->
{{--<div class="form-group col-sm-6 stud">--}}
{{--    {!! Form::label('reg_taken_id', 'Registration Taken:') !!}--}}
{{--    {!! Form::select('reg_taken_id',$user, null, ['class' => 'form-control','placeholder'=>'Please Select']) !!}--}}
{{--    <span class="error text-danger">{{ $errors->first('reg_taken_id') }}</span>--}}
{{--</div>--}}
{{--<!-- Reg For Month Field -->--}}
{{--<div class="form-group col-sm-6 both">--}}
{{--    {!! Form::label('reg_for_month', 'Reg For Month:') !!}--}}
{{--    {!! Form::select('reg_for_month',['1month'=> '1 Month','2month'=> '2 Month','3month'=>'3 Month','4month'=>'4 Month','5month'=>'5 Month','6month'=>'6 Month','7month'=>'7 Month','8month'=>'8 Month','9month'=>'9 Month','10month'=>'10 Month','11month'=>'11 Month','12month'=>'12 Month'], null, ['class' => 'form-control']) !!}--}}
{{--    <span class="error text-danger">{{ $errors->first('reg_for_month') }}</span>--}}
{{--</div>--}}

<!-- Student End Field -->

<!-- Corporate Start Field -->
{{--<div class="row ">--}}
    <!-- Company Name Field -->
    <div class="form-group col-sm-6 corpo">
        {!! Form::label('web_site', 'Web Site:') !!}
        {!! Form::text('web_site', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('web_site') }}</span>
    </div>
    <div class="form-group col-sm-6 corpo">
        {!! Form::label('address', 'Address:') !!}
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('address') }}</span>
    </div>
<div class="form-group col-sm-6 corpo">
    {!! Form::label('city', 'city:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('address') }}</span>
</div>
{{--<!-- Trainer Name Field -->--}}
{{--   <div class="form-group col-sm-6">--}}
{{--    {!! Form::label('trainer_name', 'Trainer Name:') !!}<span class="badge badge-success">0</span>--}}
{{--    {!! Form::select('trainer_name',$trainer, null, ['class' => 'form-control']) !!}--}}
{{--    <span class="error text-danger">{{ $errors->first('trainer_name') }}</span>--}}
{{--    </div>--}}
    <div class="form-group col-sm-6 corpo">
        {!! Form::label('trainer_amount', 'Trainer Amount:') !!}
        {!! Form::text('trainer_amount', null, ['class' => 'form-control']) !!}
        <span class="error text-danger">{{ $errors->first('trainer_amount') }}</span>
    </div>
<div class="form-group col-sm-6 franchises" style="display: none;">
    {!! Form::label('franchises_id', 'Franchises:') !!}
    {!! Form::select('franchises_id', $franchise, null, ['class' => 'form-control custom-select','placeholder'=>'Please Select Franchises']) !!}
    <span class="error text-danger">{{ $errors->first('student_id') }}</span>
</div>


{{--<!-- Paying  Amount Field -->--}}
{{--<div class="form-group col-sm-3">--}}
{{--    {!! Form::label('paying_amount', 'Paying  Amount:') !!}--}}
{{--    {!! Form::text('paying_amount', null, ['class' => 'form-control']) !!}--}}
{{--      <span class="error text-danger">{{ $errors->first('paying_amount') }}</span>--}}
{{--</div>--}}
{{--<div class="form-group col-sm-3" style="margin-top: 37px;">--}}
{{--    {!! Form::label('gst', 'Gst:') !!}--}}
{{--     <input type="checkbox" id="vehicle1" name="gst" >--}}
{{--      <span class="error text-danger">{{ $errors->first('gst') }}</span>--}}
{{--</div>--}}

<!-- Register Date Field -->
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('register_date', 'Register Date:') !!}--}}
{{--    {!! Form::text('register_date', null, ['class' => 'form-control datepicker']) !!}--}}
{{--    {!! Form::date('register_date', null, ['class' => 'form-control']) !!}--}}
{{--      <span class="error text-danger">{{ $errors->first('register_date') }}</span>--}}
{{--</div>--}}

{{--<!-- Comment Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('comment', 'Comment:') !!}--}}
{{--    {!! Form::text('comment', null, ['class' => 'form-control']) !!}--}}
{{--      <span class="error text-danger">{{ $errors->first('comment') }}</span>--}}
{{--</div>--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('description', 'Description:') !!}--}}
{{--    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}--}}
{{--    <span class="error text-danger">{{ $errors->first('description') }}</span>--}}
{{--</div>--}}

{{--<div class="form-group col-sm-12">--}}
{{--    <div class="nav-tabs-custom">--}}
{{--        <div class="tab-content">--}}
{{--            <div class="tab-pane active" id="categories">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <button type="button" class="btn btn-primary btn-sm" id="addNew" type="button"><span--}}
{{--                                class="fa fa-plus"></span> Add New--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div id="itemDetails">--}}
{{--                    @if(isset($setattribute) && !$setattribute->isEmpty())--}}

{{--                        @foreach($setattribute as $row)--}}

{{--                            <div class="row product">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="required">Attribute</label><span class="error-attribute"style="color: red"></span>--}}
{{--                                        <select  name="product[{{ $loop->index }}][Attribute]" onchange="changeCompany(this)" type="text" class="form-control attribute"--}}
{{--                                                 aria-required="true" aria-invalid="false" required >--}}
{{--                                            <option value=" ">--Select Attribute--</option>--}}

{{--                                            @foreach ($attributes as $key=>$value)--}}
{{--                                                <option value="{{ $key }}" @if($key == $row->attribute_id) selected @endif>{{ $value }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="required">Value</label><span class="error-value"--}}
{{--                                                                                   style="color: red"></span><br>--}}

{{--                                        <select  step=".01"  class="form-control input-sm value multiple"--}}
{{--                                                  name="product[{{ $loop->index }}][value][]"  type="text" multiple="multiple" required--}}
{{--                                        >--}}
{{--                                            <option value=" ">--Select Value--</option>--}}

{{--                                            @foreach ($row->Attribute->attributeValue->pluck('value','id')->toArray() as $key=>$value)--}}
{{--                                                <option value="{{ $key }}" @if(in_array($key,$row->productAttValue->pluck('attribute_value_id')->toArray())) selected @endif>{{ $value }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}

{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                @if($loop->index !=0)--}}
{{--                                    <div class="col-sm-1" style="text-align: center;">--}}
{{--                                        <button type="button" class="btn btn-danger btn-sm" style="margin-top: 25px;"--}}
{{--                                                onclick="removeItem(this)">--}}
{{--                                            <span class="fa fa-trash"></span>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}

{{--                                @endif--}}

{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    @else--}}

{{--                        <div class="row product">--}}
{{--                            <div class="form-group col-sm-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="required">Batch</label><span class="error-attribute"style="color: red"></span>--}}
{{--                                    <select  name="student[0][batch_id]"  type="text" class="form-control attribute"--}}
{{--                                             aria-required="true" aria-invalid="false" required >--}}
{{--                                        <option value=" ">--Select Batch--</option>--}}

{{--                                        @foreach ($batch as $key=>$value)--}}
{{--                                            <option value="{{ $key }}">{{ $value }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="required">Trainer Name</label><span class="error-value"style="color: red"></span><br>--}}
{{--                                    <select   step=".01" id="item__index__"  class="form-control input-sm value"--}}
{{--                                              name="student[0][trainer_id]"  type="text" required>--}}
{{--                                        @foreach ($trainer as $key=>$value)--}}
{{--                                            <option value="{{ $key }}">{{ $value }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="required">Trainer Fees</label><span class="error-value"style="color: red"></span><br>--}}
{{--                                    <input   step=".01" id="item__index__"  class="form-control input-sm value"--}}
{{--                                              name="student[0][trainer_fees]"  type="text" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    <hr style='margin-top: 0.1rem;margin-bottom: 0.1rem;'>--}}

{{--                </div>--}}


{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


<!-- Test -->
<br>
<br>
<br>
<br>
<div class="container-fluid p-0">
    <div class="row pb-4">
        <div class="col-lg-12" style="background-color: #f4f6f9">
            <hr class="m-0">
            <h4>Registration Details:</h4>
            <hr class="m-0">
        </div>
    </div>
</div>
<div class="form-group col-sm-12">
    <button type="button" class="btn btn-success" id="addNew" ><span
            class="fa fa-plus"></span> Add Course
    </button>
</div>
<br><br>

<div id="itemDetails" class="main0 row-course">
    <div class="parent options[0]">
        <div class="row product">

            {{--            @if(!empty($productoption))--}}

            {{--                @foreach($productoption as $optionkey=> $product_option)--}}

            {{--                    @foreach($product_option->productMultiOption as $option)--}}
            {{--                        <input type="hidden" class="options_key" value="{{$optionkey}}">--}}
            {{--                        <input type="hidden" name="option[{{ $optionkey }}][option_id]" value="{{$option->id}}">--}}

            {{--                        <div class="col-sm-3">--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label class="required">Label</label>--}}
            {{--                                <input id="value" step=".01" name="option[{{ $optionkey }}][lable]"--}}
            {{--                                       value="{{$option->lable}}"--}}
            {{--                                       class="form-control input-sm value"--}}
            {{--                                       type="text"--}}
            {{--                                       placeholder="Enter Label">--}}
            {{--                                <span class="error-lable" style="color: red"></span>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-sm-3">--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label>Type</label>--}}
            {{--                                <select step=".01" id="item__index__"--}}
            {{--                                        name="option[{{ $optionkey}}][type]"--}}
            {{--                                        class="custom-select custom_select_category">--}}
            {{--                                    <optgroup label="Text">--}}
            {{--                                        <option--}}
            {{--                                            value="field" {{($option->type == 'field') ? 'Selected' : ''}}>--}}
            {{--                                            Field--}}
            {{--                                        </option>--}}
            {{--                                        <option--}}
            {{--                                            value="textarea" {{($option->type == 'textarea') ? 'Selected' : ''}}>--}}
            {{--                                            Textarea--}}
            {{--                                        </option>--}}
            {{--                                    </optgroup>--}}
            {{--                                    <optgroup label="Select">--}}
            {{--                                        <option--}}
            {{--                                            value="dropdown" {{($option->type == 'dropdown') ? 'Selected' : ''}}>--}}
            {{--                                            Dropdown--}}
            {{--                                        </option>--}}
            {{--                                        <option--}}
            {{--                                            value="checkbox" {{($option->type == 'checkbox') ? 'Selected' : ''}}>--}}
            {{--                                            Checkbox--}}
            {{--                                        </option>--}}
            {{--                                        <option--}}
            {{--                                            value="radio" {{($option->type == 'radio') ? 'Selected' : ''}}>--}}
            {{--                                            Radio Button--}}
            {{--                                        </option>--}}
            {{--                                        <option--}}
            {{--                                            value="multiple_select" {{($option->type == 'multiple_select') ? 'Selected' : ''}}>--}}
            {{--                                            Multiple Select--}}
            {{--                                        </option>--}}
            {{--                                    </optgroup>--}}
            {{--                                </select>--}}
            {{--                                <span class="error-type" style="color:red"></span>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-sm-3 mt-3 ml-5">--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label></label><br>--}}
            {{--                                <input id="value" step=".01"--}}
            {{--                                       name="option[{{ $optionkey}}][is_required]"--}}
            {{--                                       value="1" {{($option->is_required == 1) ? 'checked' : ''}} type="checkbox">--}}
            {{--                                &nbsp; Required--}}
            {{--                                <span class="error-is_required" style="color:red"></span>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        @if(!empty($option->optionValue))--}}

            {{--                            <button type="button" class="btn btn-success addNewRow" id="addNewRow" style="margin: auto;"--}}
            {{--                                    onclick="addnewrow({{$optionkey}})">--}}
            {{--                                Add New Row--}}
            {{--                            </button>--}}
            {{--                            <br><br>--}}

            {{--                            <div id="addNewTableRow">--}}
            {{--                                <div class="row product">--}}
            {{--                                    <div class="table-responsive">--}}
            {{--                                        <table class="options table table-bordered table-striped">--}}
            {{--                                            <thead>--}}
            {{--                                            <tr>--}}
            {{--                                                <th></th>--}}
            {{--                                                <th>Label</th>--}}
            {{--                                                <th>Price</th>--}}
            {{--                                                <th>Price Type</th>--}}
            {{--                                                <th>Position</th>--}}
            {{--                                                <th>Image</th>--}}
            {{--                                                <th></th>--}}
            {{--                                            </tr>--}}
            {{--                                            </thead>--}}

            {{--                                            <tbody>--}}


            {{--                                            @foreach($option->optionValue as $value)--}}

            {{--                                                <tr id="tr{{$optionkey}}_{{$loop->index}}" class="addrowbellow sub_{{$optionkey}}" >--}}
            {{--                                                    <td class="text-center"><span class="drag-icon"> <i--}}
            {{--                                                                class="fa"></i> <i--}}
            {{--                                                                class="fa"></i> </span>--}}
            {{--                                                    </td>--}}
            {{--                                                    <input type="hidden" name="option[{{ $optionkey }}][values][{{ $loop->index }}][optionvalue_id]" value="{{$value->id}}">--}}
            {{--                                                    <td><input id="lable" step=".01"--}}
            {{--                                                               name="option[{{$optionkey}}][values][{{ $loop->index }}][lable]"--}}
            {{--                                                               value="{{$value->lable}}"--}}
            {{--                                                               class="form-control input-sm value"--}}
            {{--                                                               type="text"--}}
            {{--                                                               placeholder="Enter Label Name">--}}
            {{--                                                    </td>--}}
            {{--                                                    <td><input id="price" step=".01"--}}
            {{--                                                               name="option[{{$optionkey}}][values][{{ $loop->index }}][price]"--}}
            {{--                                                               value="{{$value->price}}"--}}
            {{--                                                               class="form-control input-sm value"--}}
            {{--                                                               type="text"--}}
            {{--                                                               placeholder="Enter Price">--}}
            {{--                                                    </td>--}}
            {{--                                                    <td><select id="price_type" step=".01"--}}
            {{--                                                                name="option[{{$optionkey}}][values][{{ $loop->index }}][price_type]"--}}
            {{--                                                                value=""--}}
            {{--                                                                is=""--}}
            {{--                                                                class="custom-select custom_select_category">--}}
            {{--                                                            <option--}}
            {{--                                                                value="Fixed" {{($value->price_type == 'Fixed') ? 'Selected' : ''}}>--}}
            {{--                                                                Fixed--}}
            {{--                                                            </option>--}}
            {{--                                                            <option--}}
            {{--                                                                value="Percent" {{($value->price_type == 'Percent') ? 'Selected' : ''}}>--}}
            {{--                                                                Percent--}}
            {{--                                                            </option>--}}
            {{--                                                        </select></td>--}}
            {{--                                                    <td><input id="position" step=".01"--}}
            {{--                                                               name="option[{{$optionkey}}][values][{{ $loop->index }}][position]"--}}
            {{--                                                               value="{{$value->position}}"--}}
            {{--                                                               class="form-control input-sm value"--}}
            {{--                                                               type="text"--}}
            {{--                                                               placeholder="Enter Position">--}}
            {{--                                                    </td>--}}

            {{--                                                    <td><input id="image" step=".01"--}}
            {{--                                                               name="option[{{$optionkey}}][values][{{ $loop->index }}][image]"--}}
            {{--                                                               value="{{$value->image}}"--}}
            {{--                                                               class="form-control input-sm value"--}}
            {{--                                                               type="file">--}}
            {{--                                                        <input type="hidden" value="{{$value->image}}" name="option[{{$optionkey}}][values][{{ $loop->index }}][oldimage]">--}}
            {{--                                                        <img style="width: 60px;height:60px"--}}
            {{--                                                             src="{{asset('public/storage/image/'.$value->image)}}"/>--}}
            {{--                                                    </td>--}}
            {{--                                                    <td>--}}
            {{--                                                        <button type="button"--}}
            {{--                                                                class="btn btn-danger btn-sm btn-delete"  onclick="return remove_item(this);">--}}
            {{--                                                            <span class="fa fa-trash"></span>--}}
            {{--                                                        </button>--}}
            {{--                                                    </td>--}}
            {{--                                                </tr>--}}
            {{--                                                @php--}}
            {{--                                                    $hello =$loop->count-1;--}}
            {{--                                                @endphp--}}
            {{--                                                @if($loop->index==$hello)--}}
            {{--                                                    <tr id="ltr{{$optionkey}}"></tr>--}}
            {{--                                                @endif--}}
            {{--                                            @endforeach--}}
            {{--                                            </tbody>--}}
            {{--                                        </table>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        @endif--}}
            {{--                    @endforeach--}}
            {{--                @endforeach--}}
            {{--            @else--}}
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="required">Course Name</label><span class="error-course" style="color: red"></span>
                    <select name="student[0][course_id]" class="form-control course"
                            aria-required="true" aria-invalid="false" onchange="changeCourse(this)" required>
                        <option value="">--Select Course--</option>

                        @foreach ($course as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Mode of Payment</label><br>
                    <select name="student[0][mode_of_payment]" class="form-control mode_of_payment"
                            aria-required="true" aria-invalid="false" onclick=modeOfPay(this) required>
                        <option value="">--Select Mode of Payment--</option>

                        @foreach ($modeOfPayment as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <span class="error-mode_of_payment" style="color:red"></span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Agreed Amount</label><br>
                    <input id="value" step=".01" name="student[0][agreed_amount]"
                           class="form-control" type="text">
                    <span class="error-is_required" style="color:red"></span>
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group">
                    <label>Pay Amount</label><br>
                    <input id="value" step=".01" name="student[0][pay_amount]"
                           class="form-control" type="text">
                    <span class="error-is_required" style="color:red"></span>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <br>
                    <br>
                    <label>Gst</label>
                    <input id="value" step=".01" name="student[0][gst]"
                           value="1" type="checkbox">
                    <span class="error-is_required" style="color:red"></span>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <br>
                    <br>
                    <label>Batch Not Yet</label>
                    <input id="value" step=".01" name="student[0][no_batch]"
                           value="1" type="checkbox">
                    <span class="error-is_required" style="color:red"></span>
                </div>
            </div>
            {{--                <div class="col-sm-3">--}}
            {{--                    <div class="form-group">--}}
            {{--                        <label>Type</label>--}}
            {{--                        <select step=".01" id="item__index__" name="option[0][type]"--}}
            {{--                                class="custom-select custom_select_category">--}}
            {{--                            <option value=""> Please Select</option>--}}
            {{--                            <optgroup label="Text">--}}
            {{--                                <option value="field"> Field</option>--}}
            {{--                                <option value="textarea"> Textarea</option>--}}
            {{--                            </optgroup>--}}
            {{--                            <optgroup label="Select">--}}
            {{--                                <option value="dropdown"> Dropdown</option>--}}
            {{--                                <option value="checkbox"> Checkbox</option>--}}
            {{--                                <option value="radio" selected=""> Radio Button</option>--}}
            {{--                                <option value="multiple_select"> Multiple Select</option>--}}
            {{--                            </optgroup>--}}
            {{--                        </select>--}}
            {{--                        <span class="error-type" style="color:red"></span>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-sm-3 mt-3 ml-5">--}}
            {{--                    <div class="form-group">--}}
            {{--                        <label></label><br>--}}
            {{--                        <input id="value" step=".01" name="option[0][is_required]"--}}
            {{--                               value="1" type="checkbox"> &nbsp; Required--}}
            {{--                        <span class="error-is_required" style="color:red"></span>--}}
            {{--                    </div>--}}
            {{--                </div>--}}


        </div>
        <button type="button" class="btn btn-success addNewRow" id="addNewRow" onclick="addnewrow(0)">
            Add Batch
        </button>
        <br><br>

        <div id="addNewTableRow" >
            <div class="row">
                <div class="table-responsive">
                    <table class="options table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Batch Name</th>
                            <th>Trainer Name</th>
                            <th>Fees</th>
                            {{--                            <th>Price Type</th>--}}
                            {{--                            <th>Position</th>--}}
                            {{--                            <th>Image</th>--}}
                                                        <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr id="tr0_0" class="addrowbellow sub_0">
                            <td class="text-center"><span class="drag-icon"> <i class="fa"></i> <i
                                        class="fa"></i> </span>
                            </td>
                            <td>
                                <select  name="student[0][course][0][batch_id]"class="form-control batch"
                                         aria-required="true" aria-invalid="false" onchange="changeBatch(this)" >
                                    <option value="">--Select Batch--</option>

                                    @foreach ($batch as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select><span class="error-trainer"style="color: red"></span>
                            </td>
                            <td>
                                <select  name="student[0][course][0][trainer_id]"class="form-control trainer"
                                         aria-required="true" aria-invalid="false" >
                                    <option value="">--Select Trainer--</option>

                                    @foreach ($trainer as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select><span class="error-trainer"style="color: red"></span>
                            </td>
                            <td><input id="price" step=".01" name="student[0][course][0][trainer_fees]"
                                       value=""
                                       class="form-control input-sm trainer_fees" type="text"
                                       placeholder="Enter Price" ><span class="error-trainer_fees"style="color: red"></span>
                            </td>
                            <td></td>
                            {{--                            <td><select id="price_type" step=".01"--}}
                            {{--                                        name="option[0][values][0][price_type]"--}}
                            {{--                                        value=""--}}
                            {{--                                        is="" class="custom-select custom_select_category">--}}
                            {{--                                    <option>Fixed</option>--}}
                            {{--                                    <option>Percent</option>--}}
                            {{--                                </select></td>--}}
                            {{--                            <td><input id="position" step=".01"--}}
                            {{--                                       name="option[0][values][0][position]"--}}
                            {{--                                       value=""--}}
                            {{--                                       class="form-control input-sm value" type="text"--}}
                            {{--                                       placeholder="Enter Position">--}}
                            {{--                            </td>--}}
                            {{--                            <td><input id="image" step=".01" name="option[0][values][0][image]"--}}
                            {{--                                       value="" class="form-control input-sm value" type="file">--}}
                            {{--                            </td>--}}
                        </tr>
                        <tr id="ltr0"></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{--        @endif--}}
    </div>
</div>
<hr>
<div id="lmain"></div>
<!-- End Test -->


<div id="exampleModal" class="modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Warning ! </b></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="text-danger">This Student is already taken.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<input type="button" value="0"  id="clickme" style="display:none;" data-toggle="modal" data-target="#exampleModal" />

{{--<button id="btn"></button>--}}
@push('third_party_scripts')
    <script>
        $(document).ready(function() {
            $("#income_type").trigger('change');
        });
        function ChangeIncomeType() {
            var IncomeType = $('#income_type option:selected').text();
            if(IncomeType == 'Retail Training'){
                $('.stud').show();
                $('.both').show();
                $('.corpo').hide();
                $('.franchises').hide();
            }else if(IncomeType == 'Corporate Training'){
                $('.corpo').show();
                $('.both').show();
                $('.stud').hide();
                $('.franchises').hide();
            }else if(IncomeType == 'Franchise Royalty'){
                $('.franchises').show();
                $('.corpo').hide();
                $('.stud').hide();

                $('.both').hide();
            }else {
                $('.franchises').hide();
                $('.corpo').hide();
                $('.stud').hide();
                $('.both').hide();
            }
        }
        $("#mob").keyup(function(){
            var mobile = $('#mob').val();
            var no_len = mobile.length;
            var type = $('#income_type option:selected').text();
            if(no_len == 10){
                $.get("{{ route('search-record') }}?type= "+type+"&mobile= "+mobile+"", function( data ) {
                    console.log(data);
                    if(data){
                        $("input[name='name']").val(data['student'].name);
                        $("input[name='email']").val(data['student'].email);
                        $("input[name='state']").val(data['student'].state);
                        $("select[name='enquiry_type']").val(data['student'].enquiry_type).change();
                        $("select[name='student_type']").val(data['student'].student_type).change();
                        $( "#clickme" ).trigger('click');
                    }
                });
            }
        });
        function bath() {
            var batch = $('#batch option:selected').val();
            if(batch){
                $.get("{{ route('count-batch-student') }}?batch= "+batch+"", function( data ) {
                    if(data){
                            $('.badge').text(data);
                    }
                });
            }
        }

    </script>
    <script>

        var mindex = 0;
        var subindx = 0;
        var option = " ";
        $("#addNew").click(function () {
            mindex += 1;
            // alert(mindex)
            $('#lmain').before('<div id="itemDetails" class="main' + mindex + ' row-course">\n' +
                '                    <div class="parent options[' + mindex + ']">\n' +
                '                        <div class="row product">\n' +
                '                            <div class="col-sm-4">\n' +
                '                                <div class="form-group">\n' +
                '                                    <label class="required">Course Name</label><span class="error-course"style="color: red"></span>\n' +
                '<select  name="student[' + mindex + '][course_id]" type="text" class="form-control course" aria-required="true" aria-invalid="false" onchange="changeCourse(this)" required >\n' +
                '<option value="">--Select Course--</option>\n' +
                @php
                    $courses = '';
                    foreach ($course as $key=>$value)
                 {

                     $courses .= '<option value="' . $key . '">' . $value. "</option>";
                 }
                @endphp
                    '<?php echo $courses; ?>\n' +
                '</select>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '<div class="col-sm-4">\n' +
                '<div class="form-group">\n' +
                '<label>Mode of Payment</label><br>\n' +
                '<select  name="student[' + mindex + '][mode_of_payment]" type="text" class="form-control mode_of_payment" onclick=modeOfPay(this) aria-required="true" aria-invalid="false" required >\n' +
                '<option value="">--Select Mode of Payment--</option>\n' +
                @php
                    $mode = '';
                    foreach ($modeOfPayment as $key=>$value)
                 {

                     $mode .= '<option value="' . $key . '">' . $value. "</option>";
                 }
                @endphp
                    '<?php echo $mode; ?>\n' +
                '</select>\n' +
                '<span class="error-is_required" style="color:red"></span>\n' +
                '</div> \n' +
                ' </div> \n' +
                ' <div class="col-sm-4">\n' +
            ' <div class="form-group">\n' +
            '<label>Agreed Amount</label><br>\n' +
            '<input id="value" step=".01" name="student[' + mindex + '][agreed_amount]" class="form-control agreed_amount" type="text">\n' +
                ' <span class="error-is_required" style="color:red"></span>\n' +
            '</div>\n' +
            '</div>\n' +


            '<div class="col-sm-4"> \n' +
            '<div class="form-group"> \n' +
            '<label>Pay Amount</label><br> \n' +
            '<input id="value" step=".01" name="student[' + mindex + '][pay_amount]" class="form-control pay_amount" type="text"> \n' +
                '<span class="error-is_required" style="color:red"></span> \n' +
            '</div> \n' +
            '</div> \n' +
            '<div class="col-sm-1"> \n' +
            ' <div class="form-group"> \n' +
            ' <br> \n' +
            ' <br> \n' +
            '<label>Gst</label> \n' +
            ' <input id="value" step=".01" name="student[' + mindex + '][gst]" value="1" type="checkbox"> \n' +
                '<span class="error-is_required" style="color:red"></span> \n' +
            '</div>\n' +
            '</div> \n' +
                '<div class="col-sm-2"> \n' +
                ' <div class="form-group"> \n' +
                ' <br> \n' +
                '<br> \n' +
                '<label>Batch Not Yet</label> \n' +
                '<input id="value" step=".01" name="student[' + mindex + '][no_batch]" value="1" type="checkbox"> \n' +
                '  <span class="error-is_required" style="color:red"></span> \n' +
                '  </div> \n' +
                ' </div> \n' +

                '                            <br><br>\n' +
                '                        </div>\n' +
                '                        <button type="button" class="btn btn-success addNewRow" id="addNewRow" onclick="addnewrow(' + mindex + ')">Add New Row</button>\n' +
                '                        <br><br>\n' +
                '\n' +
                '                        <div id="addNewTableRow" class="batch-row">\n' +
                '                            <div class="row product">\n' +
                '                                <div class="table-responsive">\n' +
                '                                    <table class="options table table-bordered table-striped">\n' +
                '                                        <thead>\n' +
                '                                        <tr>\n' +
                '                                            <th></th>\n' +
                '                                            <th>Batch Name</th>\n' +
                '                                            <th>Trainer Name</th>\n' +
                '                                            <th>Fees</th>\n' +
                '                                            <th></th>\n' +
                '                                        </tr>\n' +
                '                                        </thead>\n' +
                '\n' +
                '                                        <tbody>\n' +
                '                                        <tr id="tr' + mindex + '_0" class="addrowbellow sub_' + mindex + '">\n' +
                '                                            <td class="text-center"><span class="drag-icon"> <i class="fa"></i> <i\n' +
                '                                                        class="fa"></i> </span>\n' +
                '                                            </td>\n' +
                '\n' +
                '                                            <td>\n' +
                '<select  name="student[' + mindex + '][course][0][batch_id]" type="text" class="form-control batch" aria-required="true" aria-invalid="false"  onchange="changeBatch(this)" required ><span class="error-trainer"style="color: red"></span>\n' +
                @php
                    $option = '';
                    foreach ($batch as $key=>$value)
                 {

                     $option .= '<option value="' . $key . '">' . $value. "</option>";
                 }
                @endphp
                    '<?php echo $option; ?>\n' +
                '</select>\n' +
                '                                            </td>\n' +
                '                                            <td>\n' +
                '<select  name="student[' + mindex + '][course][0][trainer_id]" type="text" class="form-control trainer" aria-required="true" aria-invalid="false" required ><span class="error-trainer"style="color: red"></span>\n' +
                @php
                    $op = '';
                    foreach ($trainer as $key=>$value)
                 {

                     $op .= '<option value="' . $key . '">' . $value. "</option>";
                 }
                @endphp
                    '<?php echo $op; ?>\n' +
                '</select>\n' +
                '                                            </td>\n' +
                '                                            <td><input id="price" step=".01" name="student[' + mindex + '][course][0][trainer_fees]"\n' +
                '                                                       value=""\n' +
                '                                                       class="form-control input-sm trainer_fees" type="text"\n' +
                '                                                       placeholder="Enter Price"><span class="error-trainer_fees"style="color: red"></span>\n' +
                '                                            </td>\n' +
                '                   <td>\n' +
                '                       <button type="button" class="btn btn-danger btn-sm" \n' +
                '                           onclick="return remove_item(this);">\n' +
                '                          <span class="fa fa-trash"></span>\n' +
                '                      </button>\n' +
                '                         \n' +
                '                                                </td>\n' +
                '                                        </tr>\n' +

                '                                        <tr id="ltr' + mindex + '"></tr>\n' +
                '                                        </tbody>\n' +
                '                                    </table>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '                <br><br>');
        });
    </script>

    {{-- End Script File For Collection Form--}}

    {{-- Script File For Table Collection Form--}}

    <script>


        function addnewrow(mindex1) {
            subindx = $('.sub_' + mindex1).length;
// alert(mindex1);
            var html = '<tr id="tr' + mindex1 + '_' + subindx + '" class="addrowbellow sub_' + mindex1 + '">\n' +
                '                                                <td class="text-center"><span class="drag-icon"> <i class="fa"></i> <i\n' +
                '                                                            class="fa"></i> </span>\n' +
                '                                                </td>\n' +
                '\n' +
                '                                                <td>\n' +
                '<select  name="student[' + mindex1 + '][course][' + subindx + '][batch_id]" type="text" class="form-control batch" onchange="changeBatch(this)" aria-required="true" aria-invalid="false" required ><span class="error-trainer"style="color: red"></span>\n' +
                '<option value="">--Select Batch--</option>\n' +
                {{--                @php--}}
                    {{--                    $op = '';--}}
                    {{--                    foreach ($trainer as $key=>$value)--}}
                    {{--                 {--}}

                    {{--                     $op .= '<option value="' . $key . '">' . $value. "</option>";--}}
                    {{--                 }--}}
                    {{--                @endphp--}}
                    '<?php echo $option; ?>\n' +
                '</select>\n' +
                '                                                </td>\n' +
                '                                                <td>\n' +
                '<select  name="student[' + mindex1 + '][course][' + subindx + '][trainer_id]" type="text" class="form-control trainer" aria-required="true" aria-invalid="false" required ><span class="error-trainer"style="color: red"></span>\n' +
                '<option value="">--Select Trainer--</option>\n' +
                {{--                @php--}}
                    {{--                    $op = '';--}}
                    {{--                    foreach ($trainer as $key=>$value)--}}
                    {{--                 {--}}

                    {{--                     $op .= '<option value="' . $key . '">' . $value. "</option>";--}}
                    {{--                 }--}}
                    {{--                @endphp--}}
                    '<?php echo $op; ?>\n' +
                '</select>\n' +
                '                                                </td>\n' +
                '                                                <td><input id="price" step=".01" name="student[' + mindex1 + '][course][' + subindx + '][trainer_fees]"\n' +
                '                                                           value=""\n' +
                '                                                           class="form-control input-sm trainer_fees" type="text"\n' +
                '                                                           placeholder="Enter Price"><span class="error-trainer_fees"style="color: red"></span>\n' +
                '                                                </td>\n' +
                '<td>\n' +
                '         <button type="button" class="btn btn-danger btn-sm" \n' +
                '                    onclick="return remove_item(this);">\n' +
                '              <span class="fa fa-trash"></span>\n' +
                '           </button>\n' +
                '        \n' +
                '                                                </td>\n' +

                '                                            </tr>';
            $('#ltr' + mindex1).before(html);
            // $('.course').trigger('change');
        }

    </script>
    {{-- End Script File For Table Collection Form--}}

    <script>
        function remove_item(mi) {
            $(mi).closest('.addrowbellow').remove();
            // $('#tr'+mi+'_'+si).remove();
        }

        $("#tr0_0").on('click', '.btn-delete', function () {
            $(this).closest('tr').remove();
        });

        function changeCourse(el) {
            var courseRow = $(el).parents('.row-course');
            var courseID = $(el).val();

            if (courseID) {
                $.ajax({
                    type: 'GET',
                    url: "{{route('get-batch')}}",
                    data: {'courseID': courseID},
                    dataTypes: 'json',
                    success: function (res) {
                        if (res) {
                            console.log(courseRow.find(".batch"));
                            courseRow.find(".batch").empty();
                            courseRow.find(".batch").append('<option value="">-- Select Batch --</option>');
                            $.each(res, function (key, value) {
                                courseRow.find(".batch")
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
        function changeBatch(el) {
            var batchRow = $(el).parents('.addrowbellow');
            var batchID = $(el).val();

            if (batchID) {
                $.ajax({
                    type: 'GET',
                    url: "{{route('get-trainer')}}",
                    data: {'batchID': batchID},
                    dataTypes: 'json',
                    success: function (res) {
                        if (res) {
                            console.log(batchRow.find(".trainer"));
                            batchRow.find(".trainer").empty();
                            // batchRow.find(".trainer").append('<option value="">-- Select Batch --</option>');
                            $.each(res, function (key, value) {
                                batchRow.find(".trainer")
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

        function modeOfPay(el) {
            var batch = $('#batch option:selected').val();
            if(batch){
                $.get("{{ route('count-batch-student') }}?batch= "+batch+"", function( data ) {
                    if(data){
                        $('.badge').text(data);
                    }
                });
            }
        }
        // function checkText() {
        //     alert('okay');
        //     event.preventDefault();
        //     var t = 0;
        //     $(".product").each(function () {
        //         var batch = $(this).find(".batch").val();
        //         var trainer = $(this).find(".trainer").val();
        //         var trainer_fees = $(this).find(".trainer_fees").val();
        //
        //
        //         if (batch == "") {
        //             t++;
        //             $(this).find(".error-batch").text('*requied');
        //
        //         } else {
        //             $(this).find(".error-batch").text('');
        //         }
        //         if (trainer == "") {
        //             t++;
        //             $(this).find(".error-trainer").text('*requied');
        //
        //         } else {
        //             $(this).find(".error-trainer").text('');
        //         }
        //         if (trainer_fees == "") {
        //             t++;
        //             $(this).find(".error-trainer_fees").text('*requied');
        //
        //         } else {
        //             $(this).find(".error-trainer_fees").text('');
        //         }
        //
        //
        //     });
        //     if (t == 0) {
        //         alert('success');
        //         $('#create-form').submit();
        //         $('#edit-form').submit();
        //         return true;
        //     } else {
        //         alert('Enter Data Properly');
        //         return false;
        //     }
        //
        // }
    </script>

    @endpush
