<div class="table-responsive">
{{--  <div class="custom-filter">--}}
{{--    <form data-action="{{ route('admin.studentesstudentcolums.studentcolums') }}" method="post" style="margin-top: 20px;" id="batchform">--}}
{{--    @csrf--}}

{{--    <div class="multiselect">--}}
{{--        <div class="selectBox" onclick="showCheckboxes()">--}}
{{--          <select>--}}
{{--            <option>Select an option</option>--}}
{{--          </select>--}}
{{--          <div class="overSelect"></div>--}}
{{--        </div>--}}
{{--        <div id="checkboxes">--}}
{{--          <label for="one">--}}
{{--            <input type="checkbox" class="studenthidecol"  name="student_col_1" @if(!empty($field) && $field->student_col_1 == 1) Checked @endif/>&nbsp;Name&nbsp;--}}
{{--          <label for="two">--}}
{{--            <input type="checkbox" class="studenthidecol" name="student_col_2" @if(!empty($field) && $field->student_col_2 == 1) Checked @endif/>&nbsp;Email--}}
{{--          <label for="three">--}}
{{--            <input type="checkbox" class="studenthidecol" name="student_col_3" @if(!empty($field) && $field->student_col_3 == 1) Checked @endif/>&nbsp;Mobile No--}}
{{--          <label for="four">--}}
{{--            <input type="checkbox" class="studenthidecol" name="student_col_4" @if(!empty($field) && $field->student_col_4 == 1) Checked @endif/>&nbsp;Enquiry Type--}}
{{--          <label for="five">--}}
{{--            <input type="checkbox" class="studenthidecol" name="student_col_6" @if(!empty($field) && $field->student_col_6 == 1) Checked @endif/>&nbsp;Student Type--}}
{{--          <label for="seven">--}}
{{--           <input type="checkbox" class="studenthidecol" name="student_col_7" @if(!empty($field) && $field->student_col_7 == 1) Checked @endif/>&nbsp;Status--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <input type="hidden" name="student" value="student">--}}
{{--    </form>--}}

{{--    <input type="submit" class="btn btn-danger btn-sm batchsubmit" value="Save">--}}
{{--  </div>--}}
    <div class="row float-right">
        <input id="studentInput" type="text" class="form-control" placeholder="Search..">
    </div>

    <table class="table" id="students-table">

        <thead>
        <tr>
            <th>Sno.</th>
        @if(!empty($field) && $field->student_col_1 == 1)<th>Name</th>@endif
{{--        @if(!empty($field) && $field->student_col_2 == 1)<th>Email</th>@endif--}}
        @if(!empty($field) && $field->student_col_3 == 1)<th>Mobile No</th>@endif
            <th>Course</th>
            <th>Agreed Course Fees</th>
            <th>Trainer</th>
            <th>Join date</th>
{{--        @if(!empty($field) && $field->student_col_4 == 1)<th>Enquiry Type</th>@endif--}}
{{--        @if(!empty($field) && $field->student_col_5 == 1)<th>Student Type</th>@endif--}}
        @if(!empty($field) && $field->student_col_6 == 1)<th>Status</th>@endif

            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($students) > 0)
        @php $i=1; @endphp
        @foreach($students as $student)
{{--        @if((isset($student['branch_id'])) && in_array($student['branch_id'], auth()->user()->branch_id))--}}
            <tr>
                <th>{{$i++}}</th>
            @if(!empty($field) && $field->student_col_1 == 1)<td>{{ $student->name }}</td>@endif
{{--            @if(!empty($field) && $field->student_col_2 == 1)<td>{{ $student->email }}</td>@endif--}}
            @if(!empty($field) && $field->student_col_3 == 1)<td>{{ $student->mobile_no }}</td>@endif
            @if(!empty($field) && $field->student_col_4 == 1)<td>@if(isset($student->studDetail[0])){{ $student['studDetail'][0]['course']['course_name'] }}@endif</td>@endif
                <td>{{ $student['studDetail'][0]['agreed_amount'] }}</td>
                <td>@if(isset($record->studDetail[0]->studBatchDetail[0])){{ $student->studDetail[0]->studBatchDetail[0]->trainer->trainer_name }}@endif</td>
               
                <td>{{ date('d-m-Y', strtotime($student->created_at)) }}</td>
            @if(!empty($field) && $field->student_col_5 == 1)<td>{{ $student->studentType->title }}</td>@endif
                <td><span class='badge badge-success'>{{$student->status}}</span></td>
{{--                @if(!empty($field) && $field->student_col_6 == 1)<td><span class='badge @if($student->status == 1)badge-success @else badge-danger @endif'>{{ $student->status == 1 ? "Active" : "Block" }}</span></td>@endif--}}
                <td width="120">
                    {!! Form::open(['route' => ['admin.students.destroy', $student->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
{{--                        @can('students_status')--}}
{{--                        <a href="{{ route('table.status', [ $student->id,"students", $student->status]) }}" class='btn @if($student->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>--}}
{{--                            <i class="fa @if($student->status==1) fa-ban @else fa-check @endif"></i>--}}
{{--                        </a>--}}
{{--                        @endcan--}}
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
        @else
        <tr><td colspan="6" class="text-center">No record found</td></tr>
         @endif
        </tbody>
    </table>
</div>
