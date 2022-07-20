{{--<!-- Id Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('id', 'Id:') !!}--}}
{{--    <p>{{ $corporate->id }}</p>--}}
{{--</div>--}}

{{--<!-- Company Name Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('company_name', 'Company Name:') !!}--}}
{{--    <p>{{ $corporate->company_name }}</p>--}}
{{--</div>--}}

{{--<!-- Contact No Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('contact_no', 'Contact No:') !!}--}}
{{--    <p>{{ $corporate->contact_no }}</p>--}}
{{--</div>--}}

{{--<!-- Email Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('email', 'Email:') !!}--}}
{{--    <p>{{ $corporate->email }}</p>--}}
{{--</div>--}}

{{--<!-- Web Site Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('web_site', 'Web Site:') !!}--}}
{{--    <p>{{ $corporate->web_site }}</p>--}}
{{--</div>--}}

{{--<!-- Address Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('address', 'Address:') !!}--}}
{{--    <p>{{ $corporate->address }}</p>--}}
{{--</div>--}}

{{--<!-- State Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('state', 'State:') !!}--}}
{{--    <p>{{ $corporate->state }}</p>--}}
{{--</div>--}}

{{--<!-- City Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('city', 'City:') !!}--}}
{{--    <p>{{ $corporate->city }}</p>--}}
{{--</div>--}}

{{--<!-- Status Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('status', 'Status:') !!}--}}
{{--    <p>{{ $corporate->status }}</p>--}}
{{--</div>--}}

{{--<!-- Branch Id Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('branch_id', 'Branch Id:') !!}--}}
{{--    <p>{{ $corporate->branch_id }}</p>--}}
{{--</div>--}}

{{--<!-- Batch Id Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('batch_id', 'Batch Id:') !!}--}}
{{--    <p>{{ $corporate->batch_id }}</p>--}}
{{--</div>--}}

{{--<!-- Trainer Amount Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('trainer_amount', 'Trainer Amount:') !!}--}}
{{--    <p>{{ $corporate->trainer_amount }}</p>--}}
{{--</div>--}}

{{--<!-- Agreed Amount Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('agreed_amount', 'Agreed Amount:') !!}--}}
{{--    <p>{{ $corporate->agreed_amount }}</p>--}}
{{--</div>--}}

{{--<!-- Gst Amount Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('gst_amount', 'Gst Amount:') !!}--}}
{{--    <p>{{ $corporate->gst_amount }}</p>--}}
{{--</div>--}}

{{--<!-- Reg For Month Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('reg_for_month', 'Reg For Month:') !!}--}}
{{--    <p>{{ $corporate->reg_for_month }}</p>--}}
{{--</div>--}}

{{--<!-- Remark Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('remark', 'Remark:') !!}--}}
{{--    <p>{{ $corporate->remark }}</p>--}}
{{--</div>--}}

{{--<!-- Enquiry Type Id Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('enquiry_type_id', 'Enquiry Type Id:') !!}--}}
{{--    <p>{{ $corporate->enquiry_type_id }}</p>--}}
{{--</div>--}}

{{--<!-- Lead Source Id Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('lead_source_id', 'Lead Source Id:') !!}--}}
{{--    <p>{{ $corporate->lead_source_id }}</p>--}}
{{--</div>--}}

{{--<!-- Created At Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('created_at', 'Created At:') !!}--}}
{{--    <p>{{ $corporate->created_at }}</p>--}}
{{--</div>--}}

{{--<!-- Updated At Field -->--}}
{{--<div class="col-sm-12">--}}
{{--    {!! Form::label('updated_at', 'Updated At:') !!}--}}
{{--    <p>{{ $corporate->updated_at }}</p>--}}
{{--</div>--}}


<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Course</th>
                        <th>Agreed Amount</th>
                        <th>Placement</th>
                        <th>Reg For Month</th>
                        <th colspan="3">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($corporate->corporateDetail as $corporat)
                        <tr data-toggle="collapse" data-target="#demo{{$corporat->id}}" class="accordion-toggle">
                            <td><button class="btn btn-default btn-xs"><i class="far fa-eye"></i></button></td>
                            <td>{{ $corporat->course->course_name  }}</td>
                            <td>{{ $corporat->agreed_amount}}</td>
                            <td>{{ $corporat->placement  }}</td>
                            <td>{{ $corporat->reg_for_month  }}</td>
                            <td width="120">
                                {!! Form::open(['route' => ['admin.students.destroy', $corporat->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    {{--                        <a href="{{ route('table.status', [ $studentDetail->id,"students", $studentDetail->status]) }}" class='btn @if($student->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>--}}
                                    {{--                            <i class="fa @if($student->status==1) fa-ban @else fa-check @endif"></i>--}}
                                    {{--                        </a>--}}
                                    <a href="{{ route('admin.students.show', [$corporat->id]) }}"
                                       class='btn btn-default action-btn btn-sm'>
                                        <i class="far fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.students.edit', [$corporat->id]) }}"
                                       class='btn btn-primary action-btn btn-sm'>
                                        <i class="far fa-edit"></i>
                                    </a>
                                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>

                        <tr>
                            <td colspan="12" class="hiddenRow">
                                <div class="accordian-body collapse" id="demo{{$corporat->id}}">

                                    <table class="table table-striped">
                                        <thead>
                                        <tr class="info">
                                            <th>Batch Name</th>
                                            <th>Trainer Name</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{--                                    @dd($batchDetail->batchTrainerDetail)--}}
                                        @foreach($corporat->corporateBatchDetail as $batchDetail)

                                            <tr data-toggle="collapse"  class="accordion-toggle" data-target="#demo10">
                                                <td>{{$batchDetail->batch->name}}</td>
                                                <td>{{$batchDetail->trainer->trainer_name}}</td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @endforeach



                    {{--                    <tr data-toggle="collapse" data-target="#demo2" class="accordion-toggle">--}}
                    {{--                        <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>--}}
                    {{--                        <td>Silvio</td>--}}
                    {{--                        <td>Santos</td>--}}
                    {{--                        <td>São Paulo</td>--}}
                    {{--                        <td>SP</td>--}}
                    {{--                        <td> new</td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr>--}}
                    {{--                        <td colspan="6" class="hiddenRow"><div id="demo2" class="accordian-body collapse">Demo2</div></td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr data-toggle="collapse" data-target="#demo3" class="accordion-toggle">--}}
                    {{--                        <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>--}}
                    {{--                        <td>John</td>--}}
                    {{--                        <td>Doe</td>--}}
                    {{--                        <td>Dracena</td>--}}
                    {{--                        <td>SP</td>--}}
                    {{--                        <td> New</td>--}}
                    {{--                    </tr>--}}
                    {{--                    <tr>--}}
                    {{--                        <td colspan="6" class="hiddenRow"><div id="demo3" class="accordian-body collapse">Demo3 sadasdasdasdasdas</div></td>--}}
                    {{--                    </tr>--}}
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
