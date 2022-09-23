<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Course</th>
                        <th>Lead Source</th>
                        <th>Branch</th>
                        <th>Reg Taken</th>
                        <th>Agreed Amount</th>
                        <!-- <th>Placement</th>
                        <th>Reg For Month</th> -->
                        <th colspan="3">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($student->studDetail as $key=>$studentDetail)
                    <tr data-toggle="collapse" data-target="#demo{{$studentDetail->id}}" class="accordion-toggle">
                        <td>{{$key + 1}}</td>
                        <td>{{ $studentDetail->course->course_name  }}</td>
                        <td>{{ $studentDetail->leadSource->title ?? 'N/A'  }}</td>
                        <td>{{ $studentDetail->branch->title  }}</td>
                        <td>{{$studentDetail->user->name  }}</td>
                        <td>{{ $studentDetail->agreed_amount  }}</td>
                       <!--  <td>{{ $studentDetail->placement  }}</td>
                        <td>{{ $studentDetail->reg_for_month  }}</td> -->
                        <td width="120">
                            {!! Form::open(['route' => ['admin.students.destroy', $studentDetail->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                {{--                        <a href="{{ route('table.status', [ $studentDetail->id,"students", $studentDetail->status]) }}" class='btn @if($student->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>--}}
                                {{--                            <i class="fa @if($student->status==1) fa-ban @else fa-check @endif"></i>--}}
                                {{--                        </a>--}}
                                <a data-target="#demo{{$studentDetail->id}}"
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

                                <table class="table" id="corporates-table">
                                    <thead class="thead-dark">
                                    <tr>
                                    <th>Date</th>
                                    <th>Mode Of Payment</th>
                                    <th>Amount</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php $total =0; @endphp
                                      @foreach($studentDetail->StudentCoruseWisePayment as $data)
                                          @if($data->course_id == $studentDetail->course_id)
                                        <tr class="table-success">
                                            <td width="120">{{date('d-m-Y', strtotime($data->getIncome->created_at))}}
                                            <td>{{$data->getIncome->bankAcc->title}}</td>
                                            <td>₹ {{$data->getIncome->paying_amount}}</td>

                                            </td>
                                        </tr>
                                        @php
                                            $t = $data->getIncome->paying_amount;
                                          $total +=$t;
                                        @endphp
                                          @endif
                                      @endforeach
                                        <tr class="table-warning">
                                            <td></td>
                                            <td>Agreed Amount:</td>
                                            <td>₹ {{$student->studDetail[0]->agreed_amount}}</td>

                                        </tr>
                                      <tr class="table-info">
                                          <td></td>
                                          <td>Total Pay</td>
                                          <td>₹ {{$total}}</td>

                                      </tr>
                                      <tr class="table-danger">
                                          <td></td>
                                          <td>Payment Due</td>
                                          <td>₹ {{$student->studDetail[0]->agreed_amount - $total}}</td>

                                      </tr>
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


