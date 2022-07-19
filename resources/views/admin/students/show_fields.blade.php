{{--<div class="table-responsive">--}}
{{--    <table class="table" id="students-table">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Course</th>--}}
{{--            <th>Lead Source</th>--}}
{{--            <th>Branch</th>--}}
{{--            <th>Reg Taken</th>--}}
{{--            <th>Batch</th>--}}
{{--            <th>Agreed Amount</th>--}}
{{--            <th>Placement</th>--}}
{{--            <th>Reg For Month</th>--}}
{{--            <th colspan="3">Action</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}

{{--        @foreach($student->studDetail as $studentDetail)--}}
{{--            <tr>--}}

{{--                <td>{{ $studentDetail->course->course_name  }}</td>--}}
{{--                <td>{{ $studentDetail->leadSource->title  }}</td>--}}
{{--                <td>{{ $studentDetail->branch->title  }}</td>--}}
{{--                <td>{{$studentDetail->user->name  }}</td>--}}
{{--                <td>{{ $studentDetail->batch->name  }}</td>--}}
{{--                <td>{{ $studentDetail->agreed_amount  }}</td>--}}
{{--                <td>{{ $studentDetail->placement  }}</td>--}}
{{--                <td>{{ $studentDetail->reg_for_month  }}</td>--}}
{{--                <td><span class='badge @if($student->status == 1)badge-success @else badge-danger @endif'>{{ $student->status == 1 ? "Active" : "Block" }}</span></td>--}}
{{--                <td width="120">--}}
{{--                    {!! Form::open(['route' => ['admin.students.destroy', $studentDetail->id], 'method' => 'delete']) !!}--}}
{{--                    <div class='btn-group'>--}}
{{--                        <a href="{{ route('table.status', [ $studentDetail->id,"students", $studentDetail->status]) }}" class='btn @if($student->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>--}}
{{--                            <i class="fa @if($student->status==1) fa-ban @else fa-check @endif"></i>--}}
{{--                        </a>--}}
{{--                        <a href="{{ route('admin.students.show', [$studentDetail->id]) }}"--}}
{{--                           class='btn btn-default action-btn btn-sm'>--}}
{{--                            <i class="far fa-eye"></i>--}}
{{--                        </a>--}}

{{--                        <a href="{{ route('admin.students.edit', [$studentDetail->id]) }}"--}}
{{--                           class='btn btn-primary action-btn btn-sm'>--}}
{{--                            <i class="far fa-edit"></i>--}}
{{--                        </a>--}}
{{--                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
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
                        <th>Lead Source</th>
                        <th>Branch</th>
                        <th>Reg Taken</th>
                        <th>Agreed Amount</th>
                        <th>Placement</th>
                        <th>Reg For Month</th>
                        <th colspan="3">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($student->studDetail as $studentDetail)
                    <tr data-toggle="collapse" data-target="#demo{{$studentDetail->id}}" class="accordion-toggle">
                        <td><button class="btn btn-default btn-xs"><i class="far fa-eye"></i></button></td>
                        <td>{{ $studentDetail->course->course_name  }}</td>
                        <td>{{ $studentDetail->leadSource->title ?? 'N/A'  }}</td>
                        <td>{{ $studentDetail->branch->title  }}</td>
                        <td>{{$studentDetail->user->name  }}</td>
                        <td>{{ $studentDetail->agreed_amount  }}</td>
                        <td>{{ $studentDetail->placement  }}</td>
                        <td>{{ $studentDetail->reg_for_month  }}</td>
                        <td width="120">
                            {!! Form::open(['route' => ['admin.students.destroy', $studentDetail->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                {{--                        <a href="{{ route('table.status', [ $studentDetail->id,"students", $studentDetail->status]) }}" class='btn @if($student->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>--}}
                                {{--                            <i class="fa @if($student->status==1) fa-ban @else fa-check @endif"></i>--}}
                                {{--                        </a>--}}
                                <a href="{{ route('admin.students.show', [$studentDetail->id]) }}"
                                   class='btn btn-default action-btn btn-sm'>
                                    <i class="far fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.students.edit', [$studentDetail->id]) }}"
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
                            <div class="accordian-body collapse" id="demo{{$studentDetail->id}}">

                                <table class="table table-striped">
                                    <thead>
                                    <tr class="info">
                                        <th>Batch Name</th>
                                        <th>Trainer Name</th>
                                        <th>Trainer Fees</th>
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                    @dd($batchDetail->batchTrainerDetail)--}}
                                   @foreach($studentDetail->studBatchDetail as $batchDetail)

                                       <tr data-toggle="collapse"  class="accordion-toggle" data-target="#demo10">
                                        <td>{{$batchDetail->batch->name}}</td>
                                        <td>{{$batchDetail->trainer->trainer_name}}</td>
                                        <td>{{$batchDetail->trainer_fees ?? "N/A"}}</td>
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

