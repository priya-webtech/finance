@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Due Fees {{$type}}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        <div class="card">
            <div class="card-body">
{{--@dd($user->id);--}}
{{--                 {!! Form::open(['route' => 'pay-due-fees',['id' => $editid, 'type' => $type]]) !!}--}}
                <form action="{{route('pay-due-fees',['id' => $editid, 'type' => $type])}}" method="post">
                    @csrf
                <div class="row">
                    <!-- <div class="form-group col-sm-3">
                        {!! Form::label('branch_id', 'Branch :') !!}
                        {!! Form::select('branch_id', $branch,null, ['class' => 'form-control','placeholder'=>'Select Branch']) !!}
                    </div> -->
                   <!--  <div class="form-group col-sm-3">
                        {!! Form::label('course_id', 'Course :') !!}
                        {!! Form::select('course_id', $course,null, ['class' => 'form-control','placeholder'=>'Select Course']) !!}
                    </div> -->
                    <input type="hidden" name="course_id" value="{{$user->course_id}}">
                    <div class="form-group col-sm-2">
                        {!! Form::label('bank_acc_id', 'Bank:') !!}
                        {!! Form::select('bank_acc_id',$bank,null, ['class' => 'form-control','placeholder'=>'Select Bank']) !!}
                    </div>
                    <div class="form-group col-sm-2">
                        {!! Form::label('pay_amount', 'Amount:') !!}
                        {!! Form::text('pay_amount',null, ['class' => 'form-control','placeholder'=>'Enter Amount']) !!}
                    </div>
{{--                    <div class="form-group col-sm-1 trainer" style="margin-top: 37px;">--}}
{{--                        {!! Form::label('gst', 'GST:') !!}--}}
{{--                        <input type="checkbox" id="vehicle1" name="gst">--}}
{{--                        <span class="error text-danger">{{ $errors->first('gst') }}</span>--}}
{{--                    </div>--}}
                    <div class="form-group col-sm-1"><br>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
{{--                        <a href="{{ route('admin.students.index') }}" class="btn btn-default">Cancel</a>--}}
                    </div>
                </div>
                </form>

                <br><br>

          @if(isset($user->student))
              <div class="row">
                  <div class="col-sm-3">
                      {!! Form::label('name', 'Name:') !!}
                      <p>{{ $user->student->name }}</p>
                  </div>
                  <div class="col-sm-3">
                      {!! Form::label('Email', 'Email:') !!}
                      <p>{{ $user->student->email }}</p>
                  </div>
                  <div class="col-sm-3">
                      {!! Form::label('mobile_no', 'Mobile No.:') !!}
                      <p>{{ $user->student->mobile_no }}</p>
                  </div>
                  <div class="col-sm-3">
                      {!! Form::label('branch', 'Branch Name.:') !!}
                      <p>{{ $userdetail[0]->branch->title }}</p>
                  </div>
                  <div class="col-sm-3">
                      {!! Form::label('income_type_id', 'Income Type:') !!}
                      <p>{{getIncomeType($userdetail[0]->studFeesColl->getIncome->id)  }}</p>
                  </div>
                  <div class="col-sm-3">
                      {!! Form::label('branch', 'Course Name.:') !!}
                      <p>{{ $userdetail[0]->course->course_name }}</p>
                  </div>
                  <div class="col-sm-3">
                      {!! Form::label('agreed_amount', 'Agreed Amount:') !!}
                      <p>{{ $userdetail[0]->agreed_amount }}</p>
                  </div>
                  <div class="col-sm-3">
                      {!! Form::label('trainer_name', 'Trainer Name:') !!}
                      <p> @if(isset( $userdetail[0]->studBatchDetail[0])){{ $userdetail[0]->studBatchDetail[0]->trainer->trainer_name }}@endif</p>
                  </div>
                  <div class="col-sm-3">
                      {!! Form::label('trainer_fees', 'Trainer Fees:') !!}
                      <p> @if(isset($userdetail[0]->studBatchDetail[0])){{$userdetail[0]->studBatchDetail[0]->trainer_fees }}@endif</p>
                  </div>
                  <div class="col-sm-3">
                      {!! Form::label('pay_fees', '1st instalment amount:') !!}
                      <p> @if(isset($userdetail[0]->StudentCoruseWisePayment[0])){{number_format($userdetail[0]->StudentCoruseWisePayment[0]->gst+$userdetail[0]->StudentCoruseWisePayment[0]->getIncome->paying_amount,2)}}@endif</p>
                  </div>
{{--                  <div class="col-sm-3">--}}
{{--                      {!! Form::label('total_pay_amount', 'Total Pay Amount:') !!}--}}
{{--                      <p> @if(isset($userdetail[0]->StudentCoruseWisePayment[0])){{number_format($userdetail[0]->StudentCoruseWisePayment[0]->gst+$userdetail[0]->StudentCoruseWisePayment[0]->getIncome->paying_amount,2)}}@endif</p>--}}
{{--                  </div>--}}
              </div>

                    {{--                <div class="col-sm-12">--}}
{{--                    {!! Form::label('trainer_name', 'Trainer Name:') !!}--}}
{{--                    <p> @if(isset($students->studDetail[0]->studBatchDetail[0])){{$students->studDetail[0]->studBatchDetail[0]->trainer->trainer_name }}@endif</p>--}}
{{--                </div>--}}

{{--                <div class="col-sm-12">--}}
{{--                    {!! Form::label('pay_fees', 'Pay Fees:') !!}--}}
{{--                    <p> @if(isset($students->studDetail[0]->StudentCoruseWisePayment[0])){{number_format($students->studDetail[0]->StudentCoruseWisePayment[0]->gst+$students->studDetail[0]->StudentCoruseWisePayment[0]->getIncome->paying_amount,2)}}@endif</p>--}}
{{--                </div>--}}
                @endif

                @foreach($userdetail as $row)
{{--                    <span><b>COURSE NAME : </b>{{$row['course']['course_name']}} <br><b>AGREED AMOUNT: </b>{{ $row['agreed_amount'] }}</span>--}}
                <div class="table-responsive">
                    <table class="table" id="corporates-table">
                        <thead class="thead-dark">
                        <tr>
                        <th>Mode Of Payment</th>
                        <th>Amount</th>
                        <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($type == 'Corporate')
                          @foreach($row->coruseWisePayment as $data)
                              @if($data->course_id == $row->course_id)
                            <tr class="table-success">
                                <td>{{$data->getIncome->bankAcc->title}}</td>
                                <td>₹ {{$data->getIncome->paying_amount + $data->gst}}</td>
                                <td width="120">{{date('d-m-Y', strtotime($data->getIncome->created_at))}}
                                </td>

                            </tr>
                              @endif
                          @endforeach
                            @elseif($type == 'Student')
                            @foreach($row->StudentCoruseWisePayment as $data)
                                @if($data->course_id == $row->course_id)
                                <tr class="table-success">
                                    <td>{{$data->getIncome->bankAcc->title}}</td>
                                    <td>₹ {{$data->getIncome->paying_amount + $data->gst}}</td>
                                    <td width="120">{{date('d-m-Y', strtotime($data->getIncome->created_at))}}

                                </tr>

                                @endif
                            @endforeach
                            <tr class="table-success">
                                <td>
                                   Total
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('third_party_scripts')
    <script>
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
                    }
                });
            } else {
                $('.gst'+index).hide();
            }
        }
    </script>
@endpush
