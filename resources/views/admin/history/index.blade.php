@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>History</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <div class="row mb-2">
                        <div class="col-sm-9">
                            <h5>Revenue History</h5>
                        </div>
                        <div class="col-sm-3">
                            <input id="franchisesInput" type="text" class="form-control float-right" placeholder="Search..">
                        </div>
                    </div>
                    <table class="table" id="franchises-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Course</th>
                            <th>Paid Fees</th>
                            <th>Agreed Fees</th>
                            <th>Mode of Payment</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($income as $data)
                            <tr>
                                <td>@if($data->incomeStudFees){{$data->incomeStudFees->student->name}}@elseif($data->corporateStudFees){{$data->corporateStudFees->corporate->company_name}}@elseif($data->franchise) {{$data->franchise->title}} @else - @endif</td>
                                <td>{{$data->incomeType->title ?? " "}}</td>
                                <td>{{$data->course->course_name ?? " "}}</td>
                                <td>{{"₹ ".PayAmount($data->id)}}</td>
                                <td>@if($data->incomeStudFees){{$data->incomeStudFees->studentDetail->agreed_amount ?? "N/A"}}@elseif($data->corporateStudFees){{$data->corporateStudFees->corporateDetail->agreed_amount?? "N/A"}} @else - @endif</td>
                                <td>{{$data->bankAcc->title}}</td>
                                <td>{{date_format($data->created_at,"d-m-Y")}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $income])
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <div class="row mb-2">
                        <div class="col-sm-9">
                            <h5> Expense History </h5>
                        </div>
                        <div class="col-sm-3">
                            <input id="franchisesInput" type="text" class="form-control float-right" placeholder="Search..">
                        </div>
                    </div>
                    <table class="table" id="franchises-table">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Expense Amount</th>
                            <th>Towards</th>
                            <th>Transaction type</th>
                            <th> Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expense as $ex)
                            <tr>

                                <td>{{$ex->expenceType->title}}</td>
                                <td>{{"₹ ".number_format($ex->amount+$ex->tds,2)}}</td>
                                <td>{{$ex->remark}}</td>
                                <td>{{$ex->bankAcc->title}}</td>
                                <td>{{date_format($ex->date,"d-m-Y")}}</td>
                                {{--                                <td width="120">--}}
                                {{--                                    {!! Form::open(['route' => ['admin.franchises.destroy', $franchise->id], 'method' => 'delete']) !!}--}}
                                {{--                                    <div class='btn-group'>--}}
                                {{--                                        <a href="{{ route('table.status', [ $franchise->id,"franchises", $franchise->status]) }}" class='btn @if($franchise->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>--}}
                                {{--                                            <i class="fa @if($franchise->status==1) fa-ban @else fa-check @endif"></i>--}}
                                {{--                                        </a>--}}
                                {{--                                        @can('franchises_view')--}}
                                {{--                                            <a href="{{ route('admin.franchises.show', [$franchise->id]) }}"--}}
                                {{--                                               class='btn btn-default action-btn btn-sm'>--}}
                                {{--                                                <i class="far fa-eye"></i>--}}
                                {{--                                            </a>--}}
                                {{--                                        @endcan--}}
                                {{--                                        @can('franchises_edit')--}}
                                {{--                                            <a href="{{ route('admin.franchises.edit', [$franchise->id]) }}"--}}
                                {{--                                               class='btn btn-primary action-btn btn-sm'>--}}
                                {{--                                                <i class="far fa-edit"></i>--}}
                                {{--                                            </a>--}}
                                {{--                                        @endcan--}}
                                {{--                                        @can('franchises_delete')--}}
                                {{--                                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                                {{--                                        @endcan--}}
                                {{--                                    </div>--}}
                                {{--                                    {!! Form::close() !!}--}}
                                {{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $expense])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
