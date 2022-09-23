<div class="table-responsive">
    <div class="custom-filter">
    <form data-action="{{ route('admin.courseescoursecolums.coursecolums') }}" method="post" style="margin-top: 20px;" id="batchform">
    @csrf

    <div class="multiselect">
        <div class="selectBox" onclick="showCheckboxes()">
          <select>
            <option>Select an option</option>
          </select>
          <div class="overSelect"></div>
        </div>
        <div id="checkboxes">
          <label for="one">
            <input type="checkbox" class="coursehidecol"  name="course_col_1" @if(!empty($field) && $field->course_col_1 == 1) Checked @endif/>&nbsp;Course Name&nbsp;
          <label for="two">
            <input type="checkbox" class="coursehidecol" name="course_col_2" @if(!empty($field) && $field->course_col_2 == 1) Checked @endif/>&nbsp;Status
        </div>
    </div>

    <input type="hidden" name="course" value="course">
    </form>

    <input type="submit" class="btn btn-danger btn-sm batchsubmit" value="Save">
    </div>
    <div class="row float-right">
        <input id="coursesInput" type="text" class="form-control" placeholder="Search..">
    </div>
    <table class="table" id="courses-table">
        <thead>
        <tr>
            @if(!empty($field) && $field->course_col_1 == 1)<th>S.No</th>@endif
            @if(!empty($field) && $field->course_col_1 == 1)<th>Course Name</th>@endif

{{--        <th>Description</th>--}}
        @if(!empty($field) && $field->course_col_2 == 1)<th>Status</th>@endif
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($courses) >0 )
        @foreach($courses as $key=>$course)


            <tr>
               <th>{{$key + $courses->firstItem()}}</th>
               @if(!empty($field) && $field->course_col_1 == 1) <td>{{ $course->course_name }}</td>@endif

{{--            <td>{{ $course->description }}</td>--}}
               @if(!empty($field) && $field->course_col_2 == 1) <td><span class='badge @if($course->status == 1)badge-success @else badge-danger @endif'>{{ $course->status == 1 ? "Active" : "Block" }}</span></td>@endif
                <td width="120">
                    {!! Form::open(['route' => ['admin.courses.destroy', $course->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('courses_status')
                        <a href="{{ route('table.status', [ $course->id,"courses", $course->status]) }}" class='btn @if($course->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($course->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @endcan
                        @can('courses_view')
                        <a href="{{ route('admin.courses.show', [$course->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('courses_edit')
                        <a href="{{ route('admin.courses.edit', [$course->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('courses_delete')
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
