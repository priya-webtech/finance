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
                        {!! Form::select('bank_acc_id',$bank,null, ['class' => 'form-control bank_acc_id','placeholder'=>'Select Bank','onclick'=>"modeOfPay(this, 51)",'id'=>"batch51"]) !!}
                    </div>
                    <div class="form-group col-sm-2">
                        {!! Form::label('pay_amount', 'Amount:') !!}
                        {!! Form::text('pay_amount',null, ['class' => 'form-control pay_amount','placeholder'=>'Enter Amount']) !!}
                    </div>
                        <div class="form-group col-sm-2 trainer gstinput">
                            {!! Form::label('gst', 'GST:') !!}
                            <input step=".01" name="gst" class="form-control gst" id="vehicle1" type="number" readonly>

                            <!-- <input type="checkbox" id="vehicle1" class="checkgst" name="gst"> -->
                            <span class="error text-danger">{{ $errors->first('gst') }}</span>
                        </div>
                    <div class="form-group col-sm-1"><br>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary', 'style'=>"margin-top: 7px;"]) !!}
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
{{--                  <div class="col-sm-3">--}}
{{--                      {!! Form::label('pay_fees', '1st instalment amount:') !!}--}}
{{--                      <p> @if(isset($userdetail[0]->StudentCoruseWisePayment[0])){{number_format($userdetail[0]->StudentCoruseWisePayment[0]->gst+$userdetail[0]->StudentCoruseWisePayment[0]->getIncome->paying_amount,2)}}@endif</p>--}}
{{--                  </div>--}}

              </div>
              @elseif(isset($user->corporate))
                    <div class="row">
                    <div class="col-sm-3">
                        {!! Form::label('name', 'Company Name:') !!}
                        <p>{{ $user->corporate->company_name }}</p>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('Email', 'Email:') !!}
                        <p>{{ $user->corporate->email }}</p>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('mobile_no', 'Mobile No.:') !!}
                        <p>{{ $user->corporate->contact_no }}</p>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('income_type_id', 'Income Type:') !!}
                        <p>{{getIncomeType($userdetail[0]->corpoFeesColl->getIncome->id)  }}</p>
                    </div>
{{--                    <div class="col-sm-12">--}}
{{--                        {!! Form::label('branch', 'Branch Name.:') !!}--}}
{{--                        <p>{{ $userdetail[0]->branch->title }}</p>--}}
{{--                    </div>--}}
                    <div class="col-sm-3">
                        {!! Form::label('branch', 'Course Name.:') !!}
                        <p>{{  $userdetail[0]->course->course_name }}</p>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('agreed_amount', 'Agreed Amount:') !!}
                        <p>{{  $userdetail[0]->agreed_amount }}</p>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('trainer_name', 'Trainer Name:') !!}
                        <p> @if(isset( $userdetail[0]->corporateBatchDetail[0])){{ $userdetail[0]->corporateBatchDetail[0]->trainer->trainer_name }}@endif</p>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('pay_fees', 'Pay Fees:') !!}
                        <p> @if(isset( $userdetail[0]->coruseWisePayment[0])){{number_format( $userdetail[0]->coruseWisePayment[0]->gst+ $userdetail[0]->coruseWisePayment[0]->getIncome->paying_amount,2)}}@endif</p>
                    </div>

                    </div>
              @endif

                @foreach($userdetail as $row)
{{--                    <span><b>COURSE NAME : </b>{{$row['course']['course_name']}} <br><b>AGREED AMOUNT: </b>{{ $row['agreed_amount'] }}</span>--}}
                <div class="table-responsive">
                    <table class="table" id="corporates-table">
                        <thead class="thead-dark">
                        <tr>
                        <th>Date</th>
                        <th>Mode Of Payment</th>
                        <th>Amount</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if($type == 'Corporate')
                            @php $total =0; @endphp
                          @foreach($row->coruseWisePayment as $data)
                              @if($data->course_id == $row->course_id)
                            <tr class="table-success">
                                <td width="120">{{date('d-m-Y', strtotime($data->getIncome->created_at))}}
                                <td>{{$data->getIncome->bankAcc->title}}</td>
                                <td>₹ {{$data->getIncome->paying_amount + $data->gst}}</td>

                                </td>
                            </tr>
                            @php
                                $t = $data->getIncome->paying_amount + $data->gst;
                              $total +=$t;
                            @endphp
                              @endif
                          @endforeach
                            <tr class="table-warning">
                                <td></td>
                                <td>Agreed Amount:</td>
                                <td>₹ {{$userdetail[0]->agreed_amount}}</td>

                            </tr>
                          <tr class="table-info">
                              <td></td>
                              <td>Total Pay</td>
                              <td>₹ {{$total}}</td>

                          </tr>
                          <tr class="table-danger">
                              <td></td>
                              <td>Remain Amount</td>
                              <td>₹ {{$userdetail[0]->agreed_amount - $total}}</td>

                          </tr>
                            @elseif($type == 'Student')
                             @php $total =0; @endphp
                            @foreach($row->StudentCoruseWisePayment as $data)
                                @if($data->course_id == $row->course_id)
                                <tr class="table-success">
                                    <td>{{date('d-m-Y', strtotime($data->getIncome->created_at))}}
                                    <td>{{$data->getIncome->bankAcc->title}}</td>
                                    <td>₹ {{$data->getIncome->paying_amount + $data->gst}}</td>


                                </tr>
                                  @php
                                      $t = $data->getIncome->paying_amount + $data->gst;
                                    $total +=$t;
                                  @endphp
                                @endif
                            @endforeach
                             <tr class="table-warning">
                                 <td></td>
                                 <td>Agreed Amount</td>
                                 <td>₹ {{$userdetail[0]->agreed_amount}}</td>

                             </tr>
                            <tr class="table-info">
                                <td></td>
                                <td>Total Pay</td>
                                <td>₹ {{$total}}</td>

                            </tr>
                             <tr class="table-danger">
                                 <td></td>
                             <td>Remain Amount</td>
                             <td>₹ {{$userdetail[0]->agreed_amount - $total}}</td>

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
    <script type="text/javascript">
        $(document).ready(function(){
            var selValue = $('.bank_acc_id').val();
            if(selValue){
                $('.gstinput').show();
            }else{
                $('.gstinput').hide();
            }
        });
        function modeOfPay(el,index) {
            var batch = $('.bank_acc_id option:selected').val();
            console.log(batch);
            $('.pay_amount').attr("readonly", false);
            if(batch){
                $.get("{{ route('count-batch-student') }}?batch= "+batch+"", function( data ) {
                    if(data){
                        if(data['gst']==1){
                            $('.gstinput').show();
                        }else{
                            $('.gstinput').hide();
                        }
                    }
                });
            } else {
                $('.gstinput').hide();
            }
        }
        $(".pay_amount").keyup(function(){
            var firstInstallment = $('.pay_amount').val();
            var Text = "{{site_setting()->gst_per/100+1}}";
            var gstamt  = firstInstallment - firstInstallment/Text;
            $('#vehicle1').val(gstamt.toFixed(2));
           {{--var checkamt = "{{$userdetail[0]->agreed_amount - $total}}";--}}
           {{--if(firstInstallment > checkamt)--}}
           {{--{--}}
           {{--    alert("Enter Small lowest than Remain Amount");--}}
           {{--}--}}

        });
    </script>
@endpush
