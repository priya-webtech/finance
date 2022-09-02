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
                    <input type="hidden" name="course_id" value="{{$user->course_id}}">
                        <input type="hidden" name="branch_id" value="@if(isset($user->student)){{$user->student->branch_id}} @elseif(isset($user->corporate)) {{$user->corporate->branch_id}} @endif">
                    <div class="form-group col-sm-2">
                        {!! Form::label('bank_acc_id', 'Bank:') !!}
                        {!! Form::select('bank_acc_id',$bank,null, ['class' => 'form-control bank_acc_id','placeholder'=>'Select Bank','onclick'=>"modeOfPay(this, 51)",'id'=>"batch51"]) !!}
                        <span class="error text-danger">{{ $errors->first('bank_acc_id') }}</span>
                    </div>
                        <div class="form-group col-sm-2">
                        {!! Form::label('pay_amount', 'Amount:') !!}
                        {!! Form::text('paying_amount',null, ['class' => 'form-control pay_amount','placeholder'=>'Enter Amount']) !!}
                        <span class="error text-danger">{{ $errors->first('pay_amount') }}</span>
                            <span class="msg text-danger"></span>
                    </div>
                        <div class="form-group col-sm-2 trainer gstinput">
                            {!! Form::label('gst', 'GST:') !!}
                            <input step=".01" name="gst" class="form-control gst" id="vehicle1" type="number">

                            <!-- <input type="checkbox" id="vehicle1" class="checkgst" name="gst"> -->
                            <span class="error text-danger">{{ $errors->first('gst') }}</span>
                        </div>
                    <div class="form-group col-sm-1"><br>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id'=>'fsubmit','style'=>"margin-top: 7px;"]) !!}
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
                                <td>₹ {{$userdetail[0]->agreed_amount}}</td>

                            </tr>
                          <tr class="table-info">
                              <td></td>
                              <td>Total Pay</td>
                              <td>₹ {{$total}}</td>

                          </tr>
                          <tr class="table-danger">
                              <td></td>
                              <td>Payment Due</td>
                              <td>₹ {{$userdetail[0]->agreed_amount - $total}}</td>

                          </tr>
                            @elseif($type == 'Student')
                             @php $total =0; @endphp
                            @foreach($row->StudentCoruseWisePayment as $data)
                                @if($data->course_id == $row->course_id)
                                <tr class="table-success">
                                    <td>{{date('d-m-Y', strtotime($data->getIncome->created_at))}}
                                    <td>{{$data->getIncome->bankAcc->title}}</td>
                                    <td>₹ {{$data->getIncome->paying_amount}}</td>


                                </tr>
                                  @php
                                      $t = $data->getIncome->paying_amount;
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
                             <td>Payment Due</td>
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
            {{--var Text = "{{site_setting()->gst_per/100+1}}";--}}
            {{--var gstamt  = firstInstallment - firstInstallment/Text;--}}
            {{--$('#vehicle1').val(gstamt.toFixed(2));--}}
           var checkamt = "{{$userdetail[0]->agreed_amount - $total}}";
           // alert(firstInstallment);
           if(parseInt(checkamt) < parseInt(firstInstallment))
           {
               $('#fsubmit').hide();
               $('.msg').text("Amount must be less than or equal  remain amount");
           }else{
               $('#fsubmit').show();
               $('.msg').text(" ");
           }

        });
    </script>
@endpush
