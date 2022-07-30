<div class="table-responsive">
    <table class="table" id="students-table">
        <thead>
        <tr>
            <th>Name</th>
        <th>Email</th>
        <th>Mobile No</th>
        <th>Enquiry Type</th>
        <th>Student Type</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($students) > 0)
        @foreach($students as $student)
{{--        @if((isset($student['branch_id'])) && in_array($student['branch_id'], auth()->user()->branch_id))--}}
            <tr>

                <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->mobile_no }}</td>
            <td>{{$student->enquiryType->title }}</td>
            <td>{{ $student->studentType->title }}</td>
                <td><span class='badge @if($student->status == 1)badge-success @else badge-danger @endif'>{{ $student->status == 1 ? "Active" : "Block" }}</span></td>
                <td width="120">
                    {!! Form::open(['route' => ['admin.students.destroy', $student->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('students_status')
                        <a href="{{ route('table.status', [ $student->id,"students", $student->status]) }}" class='btn @if($student->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($student->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @endcan
                        @can('students_view')
                        <a href="{{ route('admin.students.show', [$student->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('students_edit')
                        <a href="{{ route('admin.students.edit', [$student->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('students_delete')
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>

        @endforeach
                    @endif
        </tbody>
    </table>
</div>
