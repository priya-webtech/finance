<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
    hr {
        border: 0;
        clear:both;
        display:block;
        width: 96%;
        background-color:black;
        height: 1px;
    }
    #line {
        float: left;
        width: 1036px;
    }
    .modal {
        --gap: 15px;

        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;

        align-items: center;
        justify-content: center;
        box-sizing: border-box;
        padding: var(--gap);
        background: rgba(0, 0, 0, 0.5);
        font-family: sans-serif;
    }

    .modal__inner {
        background: #ffffff;
        width: 100%;
        max-width: 800px;
        overflow: hidden;
        border-radius: 4px;
    }

    .modal__top {
        display: flex;
        align-items: center;
        background-color: #eeeeee;
    }

    .modal__title {
        flex-grow: 1;
        padding: 0 var(--gap);
        font-size: 20px;
    }

    .modal__close {
        display: flex;
        align-items: center;
        cursor: pointer;
        padding: var(--gap);
        background: none;
        border: none;
        outline: none;
    }

    .modal__content {
        padding: 0 var(--gap);
        line-height: 1.5;
    }

    .modal__bottom {
        text-align: right;
        padding: 0 var(--gap) var(--gap) var(--gap);
    }

    .modal__button {
        display: inline-block;
        padding: 6px 12px;
        background: #009578;
        border: none;
        outline: none;
        border-radius: 3px;
        color: #ffffff;
        cursor: pointer;
        font-size: 18px;
    }

    .modal__button:not(:last-child) {
        margin-right: var(--gap);
    }

    .modal__button:hover {
        background: #008066;
    }

</style>
<div class="container-fluid p-0">
    <div class="row pb-4">
        <div class="col-lg-12" style="background-color: #f4f6f9">
            <h4 class="custom-h4">Add new student registration:</h4>
        </div>
    </div>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch') !!}<span style="color:red;">*</span><span class="error-branch" style="color: red"></span> :
    {!! Form::select('branch_id', $branch, null, ['class' => 'form-control custom-select changeincomebaranch','placeholder'=>'Please Select Branch']) !!}
    <span class="error text-danger ">{{ $errors->first('branch_id') }}</span>
</div>
<!-- Income Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('income_type_id', 'Income Type') !!}<span style="color:red;">*</span> :
    {!! Form::select('income_type_id', $incomeType, null, ['class' => 'form-control custom-select','onchange'=>'ChangeIncomeType()','id'=>'income_type']) !!}
    <span class="error text-danger">{{ $errors->first('income_type_id') }}</span>
</div>


<!-- Mobile No Field -->
<div class="form-group col-sm-6 both">
    {!! Form::label('mobile_no', 'Mobile No') !!}<span style="color:red;">*</span> :<span class="error-mobile_no" style="color: red"></span>
    {!! Form::text('mobile_no', null, ['class' => 'form-control','id'=>'mob']) !!}
    <span class="error text-danger">{{ $errors->first('mobile_no') }}</span>
</div>
<!-- Name Field -->

<div class="form-group col-sm-6 both">
    {!! Form::label('name', 'Student Name') !!}<span style="color:red;">*</span> :<span class="error-name" style="color: red"></span>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('name') }}</span>
</div>
<!-- Email Field -->
<div class="form-group col-sm-6 both">
    {!! Form::label('email', 'Student Email') !!}<span style="color:red;">*</span> :<span class="error-email" style="color: red"></span>
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('email') }}</span>
</div>
<!-- Student Type Field -->
<div class="form-group col-sm-6 stud">
    {!! Form::label('student_type', 'Student Type:') !!}
    {!! Form::select('student_type',$studentType, null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('student_type') }}</span>
</div>
<div class="form-group col-sm-6 both">
    {!! Form::label('lead_source_id', 'Lead Source :') !!}
    {!! Form::select('lead_source_id',$leadSources, null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('lead_source') }}</span>
</div>
<div class="form-group col-sm-6 both">
    {!! Form::label('enquiry_type', 'Enquiry Type:') !!}
    {!! Form::select('enquiry_type',$enquiryType, null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('enquiry_type') }}</span>
</div>
<!-- State Field -->
<div class="form-group col-sm-6 both">
    {!! Form::label('state', 'State') !!}<span style="color:red;">*</span> :<span class="error-state" style="color: red"></span>
    {!! Form::select('state', $country, null,['class' => 'form-control', 'placeholder'=> '--Please Select State--']) !!}
    <span class="error text-danger">{{ $errors->first('state') }}</span>
</div>
<!-- Placement Field -->
<div class="form-group col-sm-6 both">
    {!! Form::label('placement', 'Placement Assistance required?”:') !!}
    {!! Form::select('placement',['yes'=>'YES','no'=>'NO'], null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('placement') }}</span>
</div>

<!-- Corporate Start Field -->
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
<div class="form-group col-sm-6 franchises" style="display: none;">
    {!! Form::label('title', 'Franchises Name:') !!}
    {!! Form::text('title', null, ['class' => 'form-control custom-select','placeholder'=>'Please Enter Franchises Name']) !!}
    <span class="error text-danger">{{ $errors->first('student_id') }}</span>
</div>

<div class="form-group col-sm-6 other">
    {!! Form::label('mode_of_payment', 'Mode of Payment:') !!}
    {!! Form::select('mode_of_payment', $modeOfPayment, null, ['class' => 'form-control custom-select mode_of_payment','placeholder'=>'Please Select Mode of Payment','onclick'=>"modeOfPay(this, 51)",'id'=>"batch51"]) !!}
    <span class="error text-danger">{{ $errors->first('income_type_id') }}</span>
</div>
<!-- Paying  Amount Field -->
<div class="form-group col-sm-4 other ">
    {!! Form::label('paying_amount', 'Paying  Amount:') !!}
    {!! Form::text('paying_amount', null, ['class' => 'form-control pay_amount']) !!}
    <span class="error text-danger">{{ $errors->first('paying_amount') }}</span>
</div>
<div class="col-sm-2 gstTextBox gst51" id="gstAmount"  style="display: none;">
    <div class="form-group">
        <label>Gst</label><br>
        <input step=".01" name="gst_amount" id="topGst"
               class="form-control gst_amount" type="number">
    </div>
</div>
{{--<div class="form-group col-sm-1 other" style="margin-top: 37px;">--}}
{{--    <input type="checkbox" id="vehicle1" class="gstCheck" name="gst">--}}
{{--    {!! Form::label('gst', 'Gst') !!}--}}
{{--    <span class="error text-danger">{{ $errors->first('gst') }}</span>--}}
{{--</div>--}}

<!-- Register Date Field -->
<div class="form-group col-sm-6 other">
    {!! Form::label('register_date', 'Register Date:') !!}
    {!! Form::text('register_date', null, ['class' => 'form-control datepicker']) !!}
    <span class="error text-danger">{{ $errors->first('register_date') }}</span>
</div>

{{--<div class="form-group col-sm-6 other">--}}
{{--    {!! Form::label('description', 'Description:') !!}--}}
{{--    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}--}}
{{--    <span class="error text-danger">{{ $errors->first('description') }}</span>--}}
{{--</div>--}}
<div class="form-group col-sm-6 ">
    {!! Form::label('reg_taken_id', 'Registration taken by:') !!}
    {!! Form::select('reg_taken_id', $user, null,['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('registration_taken_by') }}</span>
</div>
<div class="form-group col-sm-6 comment">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">{{ $errors->first('comment') }}</span>
</div>
<div id="line"><hr  style="" /></div>
<!-- Test -->
{{--<br><br><br><br>--}}
{{--<div class="container-fluid p-0 reg-detail" >--}}
{{--    <div class="row pb-4">--}}
{{--        <div class="col-lg-12" style="background-color: #f4f6f9">--}}
{{--            <hr class="m-0">--}}
{{--            <h4 class="custom-h4">Registration Details:</h4>--}}
{{--            <hr class="m-0">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- <div class="form-group col-sm-12 reg-detail">
    <button type="button" class="btn btn-success" id="addNew" ><span
            class="fa fa-plus"></span> Add Course
    </button>
</div> -->
<br><br>

<div id="itemDetails" class="main0 row-course reg-detail">
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
                    <label class="required">Course Enrolling for</label><span style="color:red;">*</span> :<span class="error-course"
                                                                              style="color: red"></span>
                    <select name="student[0][course_id]" class="form-control course changeincomecourse"
                            aria-required="true" aria-invalid="false" onchange="changeCourse(this)">
                        <option value="">--Select Course--</option>

                        @foreach ($course as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Agreed Amount</label><span style="color:red;">*</span> :<span class="error-agreed_amount" style="color:red"></span><br>
                    <input id="value" step=".01" name="student[0][agreed_amount]"
                           class="form-control agreed_amount" type="number">
                    {{--                    <span class="error-agreed_amount" style="color:red"></span>--}}
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Due date</label> <span style="color:red;">*</span> :<span class="error-due_date" style="color:red"></span><br>
                    <input id="value" name="student[0][due_date]"
                           class="form-control due_date" type="date">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Mode of Payment</label> <span style="color:red;">*</span> :<span class="error-mode_of_payment" style="color:red"></span><br>
                    <select id="batch0" name="student[0][mode_of_payment]" class="form-control mode_of_payment mop"
                            aria-required="true" aria-invalid="false" onclick="modeOfPay(this, 0)">
                        <option value="">--Select Mode of Payment--</option>
                        @foreach ($modeOfPayment as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>1st instalment amount</label> <span style="color:red;">*</span> : <span class="error-pay_amount" style="color:red"></span><br>
                    <input id="value" step=".01" name="student[0][pay_amount]"
                           class="form-control pay_amount pa payamt0" type="number" readonly>

                </div>
            </div>
            <div class="col-sm-2 gstTextBox gst0" id="gst_amount" style="display: none;">
                <div class="form-group">
                    <label>Gst</label><br>
                    <input step=".01" name="student[0][gst_amount]"
                           class="form-control gst_amount" id="bottomGst" type="number">
                </div>
            </div>
{{--            <div class="col-sm-1 gst0" style="display: none;">--}}
{{--                <div class="form-group">--}}
{{--                    <br>--}}
{{--                    <br>--}}
{{--                    <input id="value" step=".01" name="student[0][gst]"--}}
{{--                           value="1" type="checkbox" class="gstCheck">--}}
{{--                    <label>Gst</label>--}}

{{--                    <span class="error-is_required" style="color:red"></span>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-2">--}}
{{--                <div class="form-group">--}}
{{--                    <br>--}}
{{--                    <br>--}}
{{--                    <button id="value" step=".01" class="btn btn-warning" name="student[0][no_batch]"--}}
{{--                            value="1" type="button" onclick="batchDisplay(this.checked, 0)">--}}
{{--                        Assign to Batch--}}
{{--                    </button>--}}
{{--                    <span class="error-is_required" style="color:red"></span>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-sm-2">
                <div class="form-group">
                    <br>
                    <br>
{{--                    <input id="value" step=".01" name="student[0][no_batch]"--}}
{{--                           value="1" type="checkbox" class="no-batch" onchange="batchDisplay(this.checked, 0)">--}}
{{--                    <span class="error-is_required" style="color:red"></span>--}}
                    <input id="value" step=".01" name="student[0][no_batch]"
                            value="1" type="checkbox" class="no-batch" onclick="batchDisplay(this.checked, 0)">
                           Not Assigned to Any Batch

                    <span class="error-is_required" style="color:red"></span>
                </div>
            </div>
        </div>
        <span class="batch_table0">
{{--        <button type="button" class="btn btn-success addNewRow" id="addNewRow" onclick="addnewrow(0)">--}}
            {{--            Add Batch--}}
            {{--        </button>--}}
            {{--        <br><br>--}}

        <div id="addNewTableRow">
            <div class="row">
                <div class="table-responsive">
                    <table class="options table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Batch Name<span style="color:red;">*</span></th>
                            <th>Trainer Name<span style="color:red;">*</span></th>
                            <th class="retail_col">Fees<span style="color:red;">*</span></th>
                                                        <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr id="tr0_0" class="addrowbellow sub_0">
                            <td class="text-center drag-td"><span class="drag-icon"> <i class="fa"></i> <i
                                        class="fa"></i> </span>
                            </td>
                            <td>
                                <select name="student[0][course][0][batch_id]" class="form-control batch"
                                        aria-required="true" aria-invalid="false" onchange="changeBatch(this)">
                                    <option value="">--Select Batch--</option>

                                    @foreach ($batch as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select><span class="error-batch" style="color: red"></span>
                            </td>
                            <td>
                                <select name="student[0][course][0][trainer_id]" class="form-control trainer"
                                        aria-required="true" aria-invalid="false">
                                    <option value="">--Select Trainer--</option>

                                    @foreach ($trainer as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select><span class="error-trainer" style="color: red"></span>
                            </td>
                            <td class="retail_col"><input id="price" step=".01"
                                                          name="student[0][course][0][trainer_fees]"
                                                          value=""
                                                          class="form-control input-sm trainer_fees" type="number"
                                                          placeholder="Enter Price"><span class="error-trainer_fees"
                                                                                          style="color: red"></span>
                            </td>
                            <td></td>
                        </tr>
                        <tr id="ltr0"></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </span>

        {{--        @endif--}}
    </div>
</div>
{{--<hr>--}}
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
                <p class="text-danger">Student with this mobile no already registered.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal__button" onclick="HideModel()">Decline</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="verifyModel" style="display:none;">
    <div class="modal__inner">
        <div class="modal__top">
            <div class="modal__title ">Verify Bank Balance</div>
            <button class="modal__close close" type="button" onclick="HideModel()">
                <span class="material-icons">close</span>
            </button>
        </div>
        <div class="modal__content"><p>I am the content of this modal</p></div>
        <div class="modal__bottom">
            <button type="button" class="modal__button" onclick="SubmitFrom()">Verify!</button>
            <button type="button" class="modal__button" onclick="HideModel()">Decline</button>
        </div>
    </div>
</div>
<input type="button" value="0" id="clickme" style="display:none;" data-toggle="modal" data-target="#exampleModal"/>

{{--<button id="btn"></button>--}}
@push('third_party_scripts')
    <script>
        $(document).ready(function(){
            $(".changeincomecourse").html('');
             $(".changeincomecourse").append('<option value="">Not avalible Course</option>');
        });
       $(".changeincomebaranch").change(function(el){
            var branchID = $('#branch_id').val();
            $(".changeincomecourse").html('');
            if (branchID) {
                $.ajax({
                    type: 'GET',
                    url: "{{route('get-incomecourse')}}",
                    data: {'branchID': branchID},
                    dataTypes: 'json',
                    success: function (res) {
                        if (res) {
                            if(res != ''){
                                $(".changeincomecourse").append('<option value="">Please Select Course</option>');
                            }else{
                                $(".changeincomecourse").append('<option value="">Not avalible Course</option>');
                            }
                            $.each(res, function (key, value) {
                                $(".changeincomecourse").append('<option value="'+key+'">'+value+'</option>');

                            });
                        }
                    }
                });
            } else {
                //$(".batch").empty();
            }

        });


        $(document).ready(function() {
            $("#income_type").trigger('change');
        });
        function ChangeIncomeType() {
            var IncomeType = $('#income_type option:selected').text();
            if(IncomeType == 'Retail Training'){
                $('.stud').show();
                $('.both').show();
                $('.reg-detail').show();
                $('.corpo').hide();
                $('.franchises').hide();
                $('.retail_col').show();
                $('.comment').hide();
                $('.other').hide();
                $('#gstAmount').hide();
            }else if(IncomeType == 'Corporate Training'){
                $('.reg-detail').show();
                $('.corpo').show();
                $('.both').show();
                $('.stud').hide();
                $('.retail_col').hide();
                $('.franchises').hide();
                $('.other').hide();
                $('.comment').show();
                $('#gstAmount').hide();
            }else if(IncomeType == 'Franchise Royalty'){
                $('.franchises').show();
                $('.corpo').hide();
                $('.stud').hide();
                $('.reg-detail').hide();
                $('.both').hide();
                $('.comment').show();
                $('.other').show();
            }else if(IncomeType == 'Others' || IncomeType == 'Digital Marketing' || IncomeType == 'HR Consultancy'){
                $('.other').show();
                $('.franchises').hide();
                $('.reg-detail').hide();
                $('.corpo').hide();
                $('.stud').hide();
                $('.reg-detail').hide();
                $('.both').hide();

                if(IncomeType == 'Others'){
                    $('.comment').hide();
                }else{
                    $('.comment').show();
                }
                $('.other').show();
            }else if(IncomeType == 'Others'){
                $('.other').show();
                $('.franchises').hide();
                $('.reg-detail').hide();
                $('.corpo').hide();
                $('.stud').hide();
                $('.comment').hide();
                $('.both').hide();
            }else{
                $('.franchises').hide();
                $('.reg-detail').hide();
                $('.corpo').hide();
                $('.stud').hide();
                $('.both').hide();
                $('.other').hide();
                $('.comment').hide();
            }
        }
        function batchDisplay(value, index) {
            //alert('okay');
            if(value) {
                $('.batch_table'+ index).hide();
            } else {
                $('.batch_table'+ index).show();

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
                        // $( "#clickme" ).trigger('click');
                        $('#exampleModal').show();
                    }
                });
            }
        });
        {{--function bath() {--}}
        {{--    var batch = $('#batch option:selected').val();--}}
        {{--    if(batch){--}}
        {{--        $.get("{{ route('count-batch-student') }}?batch= "+batch+"", function( data ) {--}}
        {{--            if(data){--}}
        {{--                    $('.badge').text(data);--}}
        {{--            }--}}
        {{--        });--}}
        {{--    }--}}
        {{--}--}}

    </script>
    <script>

        var mindex = 0;
        var subindx = 0;
        var option = " ";
        $("#addNew").click(function () {


            mindex += 1;
            // alert(mindex)


            $('#lmain').before('<div id="itemDetails" class="main' + mindex + ' row-course reg-detail">\n' +
                '                    <div class="parent options[' + mindex + ']">\n' +
                '                        <div class="row product">\n' +
                '                            <div class="col-sm-4">\n' +
                '                                <div class="form-group">\n' +
                '                                    <label class="required">Course Name</label><span class="error-course"style="color: red"></span>\n' +
                '<select  name="student[' + mindex + '][course_id]" type="text" class="form-control course changeincomecourse" aria-required="true" aria-invalid="false" onchange="changeCourse(this)" >\n' +
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
                '<label>Mode of Payment</label><span class="error-mode_of_payment" style="color:red"></span><br>\n' +
                '<select  id="batch'+mindex+'" name="student[' + mindex + '][mode_of_payment]" type="text" class="form-control mode_of_payment" onclick=modeOfPay(this,'+mindex+') aria-required="true" aria-invalid="false" >\n' +
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
                '</div> \n' +
                ' </div> \n' +
                ' <div class="col-sm-4">\n' +
            ' <div class="form-group">\n' +
            '<label>Agreed Amount</label><span class="error-agreed_amount" style="color:red"></span><br>\n' +
            '<input id="value" step=".01" name="student[' + mindex + '][agreed_amount]" class="form-control agreed_amount" type="number">\n' +
            '</div>\n' +
            '</div>\n' +


            '<div class="col-sm-4"> \n' +
            '<div class="form-group"> \n' +
            '<label>Pay Amount</label><span class="error-pay_amount" style="color:red"></span><br> \n' +
            '<input id="value" step=".01" name="student[' + mindex + '][pay_amount]" class="form-control pay_amount" type="number"> \n' +
            '</div> \n' +
            '</div> \n' +
            '<div class="col-sm-4"> \n' +
            '<div class="form-group"> \n' +
            '<label>Due Date</label><span class="error-due_date" style="color:red"></span><br> \n' +
            '<input id="value" name="student[' + mindex + '][due_date]" class="form-control due_date" type="date"> \n' +
            '</div> \n' +
            '</div> \n' +
            '<div class="col-sm-1 gst'+mindex+'" style="display:none;"> \n' +
            ' <div class="form-group"> \n' +
            ' <br> \n' +
            ' <br> \n' +
            ' <input id="value" step=".01" name="student[' + mindex + '][gst]" value="1" type="checkbox"> \n' +
            '<label>Gst</label> \n' +

                '<span class="error-is_required" style="color:red"></span> \n' +
            '</div>\n' +
            '</div> \n' +
                '<div class="col-sm-2"> \n' +
                ' <div class="form-group"> \n' +
                ' <br> \n' +
                '<br> \n' +

                '<input id="value" step=".01" name="student[' + mindex + '][no_batch]" value="1" type="checkbox" onchange="batchDisplay(this.checked, '+mindex+')"> \n' +
                '<label>Batch Not Yet</label> \n' +
                '  <span class="error-is_required" style="color:red"></span> \n' +

                '  </div> \n' +
                ' </div> \n' +
                '<div class="col-sm-2"> \n' +
                '                       <button type="button" class="btn btn-sm" \n' +
                '                           onclick="return remove_course_item(this);" style="margin-top:40px">\n' +
                '                          <span class="fa fa-trash" ></span>\n' +
                '                      </button>\n' +
                ' </div> \n' +
                '                            <br><br>\n' +
                '                        </div>\n' +
                '                               <span class="batch_table'+mindex+'"> <button type="button" class="btn btn-success addNewRow" id="addNewRow" onclick="addnewrow(' + mindex + ')">Add New Row</button>\n' +
                '                        <br><br>\n' +
                '\n' +
                '                        <div id="addNewTableRow" class="batch-row">\n' +
                '                            <div class="row product">\n' +
                '                                <div class="table-responsive">\n' +
                '                                    <table class="options table table-bordered table-striped">\n' +
                '                                        <thead>\n' +
                '                                        <tr>\n' +
                '                                            <th></th>\n' +
                '                                            <th>Batch Name<span style="color:red;">*</span></th>\n' +
                '                                            <th>Trainer Name<span style="color:red;">*</span></th>\n' +
                '                                            <th class="retail_col">Fees<span style="color:red;">*</span></th>\n' +
                '                                            <th></th>\n' +
                '                                        </tr>\n' +
                '                                        </thead>\n' +
                '\n' +
                '                                        <tbody>\n' +
                '                                        <tr id="tr' + mindex + '_0" class="addrowbellow sub_' + mindex + '">\n' +
                '                                            <td class="text-center drag-td"><span class="drag-icon"> <i class="fa"></i> <i\n' +
                '                                                        class="fa"></i> </span>\n' +
                '                                            </td>\n' +
                '\n' +
                '                                            <td>\n' +
                '<select  name="student[' + mindex + '][course][0][batch_id]" type="text" class="form-control batch" aria-required="true" aria-invalid="false"  onchange="changeBatch(this)"><span class="error-batch"style="color: red"></span>\n' +

                @php
                    $option = '';

                @endphp
                    '<?php echo $option; ?>\n' +
                '</select>\n' +
                '<span class="error-batch"style="color: red"></span>\n'+
                '                                            </td>\n' +
                '                                            <td>\n' +
                '<select  name="student[' + mindex + '][course][0][trainer_id]" type="text" class="form-control trainer" aria-required="true" aria-invalid="false" >\n' +
                '<option value="">--Select Trainer --</option>\n' +
                @php
                    $op = '';
                    foreach ($trainer as $key=>$value)
                 {

                     $op .= '<option value="' . $key . '">' . $value. "</option>";
                 }
                @endphp
                    '<?php echo $op; ?>\n' +
                '</select>\n' +
                '<span class="error-trainer"style="color: red"></span>\n'+
                '                                            </td>\n' +
                '                                            <td class="retail_col"><input id="price" step=".01" name="student[' + mindex + '][course][0][trainer_fees]"\n' +
                '                                                       value=""\n' +
                '                                                       class="form-control input-sm trainer_fees" type="number"\n' +
                '                                                       placeholder="Enter Price"><span class="error-trainer_fees"style="color: red"></span>\n' +
                '                                            </td>\n' +
                '                   <td>\n' +
                '                       <button type="button" class="btn btn-sm" \n' +
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
                '                        </div></span>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '                <br><br>');
            var IncomeType = $('#income_type option:selected').text();

             var branchID = $('#branch_id').val();
            $(".changeincomecourse").html('');
            if (branchID) {
                $.ajax({
                    type: 'GET',
                    url: "{{route('get-incomecourse')}}",
                    data: {'branchID': branchID},
                    dataTypes: 'json',
                    success: function (res) {
                        if (res) {
                            if(res != ''){
                                $(".changeincomecourse").append('<option value="">Please Select Course</option>');
                            }else{
                                $(".changeincomecourse").append('<option value="">Not avalible Course</option>');
                            }
                            $.each(res, function (key, value) {
                                $(".changeincomecourse").append('<option value="'+key+'">'+value+'</option>');

                            });
                        }
                    }
                });
            } else {
                //$(".batch").empty();
            }

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

            if(IncomeType == 'Corporate Training') {
                $('.retail_col').hide();
            }else{
                $('.retail_col').show();
            }
        });
    </script>

    {{-- End Script File For Collection Form--}}

    {{-- Script File For Table Collection Form--}}

    <script>

        function addnewrow(mindex1) {
            subindx = $('.sub_' + mindex1).length;
            var html = '<tr id="tr' + mindex1 + '_' + subindx + '" class="addrowbellow sub_' + mindex1 + '">\n' +
                '                                                <td class="text-center drag-td"><span class="drag-icon"> <i class="fa"></i> <i\n' +
                '                                                            class="fa"></i> </span>\n' +
                '                                                </td>\n' +
                '\n' +
                '                                                <td>\n' +
                '<select  name="student[' + mindex1 + '][course][' + subindx + '][batch_id]" type="text" class="form-control batch" onchange="changeBatch(this)" aria-required="true" aria-invalid="false" >\n' +
                '<option value="">--Select Batch--</option>\n' +
                    '<?php echo $option; ?>\n' +
                '</select>\n' +
                '<span class="error-batch"style="color: red"></span>\n'+
                '                                                </td>\n' +
                '                                                <td>\n' +
                '<select  name="student[' + mindex1 + '][course][' + subindx + '][trainer_id]" type="text" class="form-control trainer" aria-required="true" aria-invalid="false">\n' +
                '<option value="">--Select Trainer--</option>\n' +
                    '<?php echo $op; ?>\n' +
                '</select>\n' +
                '<span class="error-trainer"style="color: red"></span>\n'+
                '                                                </td>\n' +
                '                                                <td class="retail_col"><input id="price" step=".01" name="student[' + mindex1 + '][course][' + subindx + '][trainer_fees]"\n' +
                '                                                           value=""\n' +
                '                                                           class="form-control input-sm trainer_fees" type="number"\n' +
                '                                                           placeholder="Enter Price"><span class="error-trainer_fees"style="color: red"></span>\n' +
                '                                                </td>\n' +
                '<td>\n' +
                '         <button type="button" class="btn btn-sm" \n' +
                '                    onclick="return remove_item(this);">\n' +
                '              <span class="fa fa-trash"></span>\n' +
                '           </button>\n' +
                '        \n' +
                '                                                </td>\n' +

                '                                            </tr>';
            $('#ltr' + mindex1).before(html);
            var IncomeType = $('#income_type option:selected').text();
            if(IncomeType == 'Corporate Training') {
                $('.retail_col').hide();
            }else{
                $('.retail_col').show();
            }
            $('.course').trigger('change');
        }

    </script>
    {{-- End Script File For Table Collection Form--}}

    <script>
        function remove_item(mi) {
            $(mi).closest('.addrowbellow').remove();
            // $('#tr'+mi+'_'+si).remove();
        }
        function remove_course_item(gi){
            $(gi).closest('#itemDetails').remove();
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

        function modeOfPay(el,index) {
            var batch = $('#batch'+index+' option:selected').val();
            $('.payamt'+index).attr("readonly", false);

            if(batch){
                $.get("{{ route('count-batch-student') }}?batch= "+batch+"", function( data ) {
                    if(data){
                        if(data['gst']==1){
                            $('.gst'+index).show();
                        }else{
                            $('.gst'+index).hide();
                        }
                        // $('.badge').text(data);
                    }
                });
            } else {
                $('.gst'+index).hide();
            }
        }

        function checkText() {
            var IncomeType = $('#income_type option:selected').text();
            if(IncomeType == 'Retail Training' || IncomeType == 'Corporate Training') {

                event.preventDefault();
                var t = 0;
                var branch_id = $('#branch_id').val();
                var mobile_no = $('#mob').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var state = $('#state').val();
                if (branch_id == "") {
                    t++;
                    $(".error-branch").text('required');
                } else {
                    $(".error-branch").text('');
                }
                if (mobile_no == "") {
                    t++;
                    $(".error-mobile_no").text('required');
                } else {
                    $(".error-mobile_no").text('');
                }
                if (name == "") {
                    t++;
                    $(".error-name").text('required');
                } else {
                    $(".error-name").text('');
                }
                if (email == "") {
                    t++;
                    $(".error-email").text('required');
                } else {
                    $(".error-email").text('');
                } if (state == "") {
                    t++;
                    $(".error-state").text('required');
                } else {
                    $(".error-state").text('');
                }
                $(".parent").each(function () {
                    var course = $(this).find(".course").val();
                    var mode_of_payment = $(this).find(".mode_of_payment").val();
                    var agreed_amount = $(this).find(".agreed_amount").val();
                    var pay_amount = $(this).find(".pay_amount").val();
                    var due_date = $(this).find(".due_date").val();
                    if (course == "") {
                        t++;
                        $(this).find(".error-course").text('required');
                    } else {
                        $(this).find(".error-course").text('');
                    }
                    if (mode_of_payment == "") {
                        t++;
                        $(this).find(".error-mode_of_payment").text('required');

                    } else {
                        $(this).find(".error-mode_of_payment").text('');
                    }
                    if (agreed_amount == "") {
                        t++;
                        $(this).find(".error-agreed_amount").text('required');

                    } else {
                        $(this).find(".error-agreed_amount").text('');
                    }
                    if (pay_amount == "") {
                        t++;
                        $(this).find(".error-pay_amount").text('required');

                    } else {
                        $(this).find(".error-pay_amount").text('');
                    }
                    if (due_date == "") {
                        t++;
                        $(this).find(".error-due_date").text('required');

                    } else {
                        $(this).find(".error-due_date").text('');
                    }
                    if($(this).find(".no-batch").prop('checked') == false) {
                        $(this).find(".addrowbellow").each(function () {
                            var batch = $(this).find(".batch").val();
                            var trainer = $(this).find(".trainer").val();
                            var trainer_fees = $(this).find(".trainer_fees").val();

                            if (batch == "") {
                                t++;
                                $(this).find(".error-batch").text('required');

                            } else {
                                $(this).find(".error-batch").text('');
                            }
                            if (trainer == "") {
                                t++;
                                $(this).find(".error-trainer").text('required');

                            } else {
                                $(this).find(".error-trainer").text('');
                            }

                            if (IncomeType == 'Retail Training') {
                                if (trainer_fees == "") {
                                    t++;
                                    $(this).find(".error-trainer_fees").text('required');

                                } else {
                                    $(this).find(".error-trainer_fees").text('');
                                }
                            }
                        });
                    }
                });
                if (t == 0) {
                    //alert('success');
                    var BankAccount = $('.mop').val();
                    var Amount =$('.pa').val();
                    $.ajax({
                        type: 'GET',
                        url: "{{route('income-verify')}}",
                        data: {'bank_Acc': BankAccount, 'amount': Amount},
                        dataTypes: 'json',
                        success: function (res) {
                            if (res) {
                                //alert('okay');
                                $('.modal__content').html(res.verify);
                                $('.modal').show();
                                $('.modal').css('display', 'flex');
                            }
                        }
                    });
                    // $('#create-form').submit();
                   // $('#edit-form').submit();
                    return true;
                } else {
                   // alert('Enter Data Properly');
                    return false;
                }
            }
            Verify();
        }
        function Verify() {
            event.preventDefault();

            var BankAccount = $('.mode_of_payment').val();
            var Amount =$('.pay_amount').val();
            $.ajax({
                type: 'GET',
                url: "{{route('income-verify')}}",
                data: {'bank_Acc': BankAccount, 'amount': Amount},
                dataTypes: 'json',
                success: function (res) {
                    if (res) {
                        console.log(res.verify);
                        $('.modal__content').html(res.verify);
                        $('.modal').show();
                        $('.modal').css('display', 'flex');

                    }
                }
            });
        }
        function HideModel() {
            $('.modal').hide();
        }
        $('.gstCheck').change(function()
        {
            if($(this).is(':checked'))
            {
                var IncomeType = $('#income_type option:selected').text();
                if(IncomeType == 'Retail Training' || IncomeType == 'Corporate Training') {
                    $('#gst_amount').show();
                }else{
                    $('#gstAmount').show();
                }
               // selected_checkbox.push($(this).val());
            }
            else
            {
                //If unchecked remove it from array
                $('.gstTextBox').hide();
            }
            $('#CD_Supplr').val(selected_checkbox.join(','));
        });
        {{--$(".pay_amount").keyup(function(){--}}
        {{--    var IncomeType = $('#income_type option:selected').text();--}}
        {{--    if(IncomeType == 'Retail Training' || IncomeType == 'Corporate Training') {--}}
        {{--        var firstInstallment = $('.pa').val();--}}
        {{--        var Text = "{{site_setting()->gst_per/100+1}}";--}}
        {{--        var gstamt  = firstInstallment - firstInstallment/Text;--}}
        {{--        $('#bottomGst').val(gstamt.toFixed(2));--}}
        {{--    }else{--}}
        {{--        var firstInstallment = $('#paying_amount').val();--}}
        {{--        var Text = "{{site_setting()->gst_per/100+1}}";--}}
        {{--        var gstamt  = firstInstallment - firstInstallment/Text;--}}
        {{--        $('#topGst').val(gstamt.toFixed(2));--}}
        {{--    }--}}


           // alert();
        // });
        // function HideModel() {
        //     $('.verifyModel').hide();
        // }
        function SubmitFrom() {
            $('#create-form').submit();
        }
    </script>

    @endpush
