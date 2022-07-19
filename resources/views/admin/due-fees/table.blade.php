{{--<div class="table-responsive">--}}
{{--    <table class="table" id="students-table">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Name</th>--}}
{{--        <th>Email</th>--}}
{{--        <th>Mobile No</th>--}}
{{--        <th>Agreed Amount</th>--}}
{{--        <th>Due Amount</th>--}}
{{--        <th>Status</th>--}}
{{--            <th colspan="3">Action</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($dueFees as $student)--}}
{{--            <tr>--}}
{{--                <td>{{ $student->name ??  $student->company_name}}</td>--}}
{{--            <td>{{ $student->email }}</td>--}}
{{--            <td>{{ $student->mobile_no ??  $student->contact_no }}</td>--}}
{{--            <td>{{ $student->agreed_amount }}</td>--}}
{{--            <td>{{ $student->agreed_amount }}</td>--}}
{{--                <td><span class='badge @if($student->status == 1)badge-success @else badge-danger @endif'>{{ $student->status == 1 ? "Active" : "Block" }}</span></td>--}}
{{--                <td width="120">--}}
{{--                    {!! Form::open(['route' => ['admin.students.destroy', $student->id], 'method' => 'delete']) !!}--}}
{{--                    <div class='btn-group'>--}}
{{--                        <a href="{{ route('table.status', [ $student->id,"students", $student->status]) }}" class='btn @if($student->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>--}}
{{--                            <i class="fa @if($student->status==1) fa-ban @else fa-check @endif"></i>--}}
{{--                        </a>--}}
{{--                        <a href="{{ route('admin.students.show', [$student->id]) }}"--}}
{{--                           class='btn btn-default action-btn btn-sm'>--}}
{{--                            <i class="far fa-eye"></i>--}}
{{--                        </a>--}}

{{--                        <a href="{{ route('admin.students.edit', [$student->id]) }}"--}}
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



@push('third_party_stylesheets')
    @include('layouts.datatables_css')
@endpush

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

@push('third_party_scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush