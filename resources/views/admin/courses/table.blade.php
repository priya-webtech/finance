<div class="table-responsive">
    <table class="table" id="courses-table">
        <thead>
        <tr>
            <th>Course Name</th>

{{--        <th>Description</th>--}}
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($courses) >0 )
        @foreach($courses as $course)


            <tr>
                <td>{{ $course->course_name }}</td>

{{--            <td>{{ $course->description }}</td>--}}
                <td><span class='badge @if($course->status == 1)badge-success @else badge-danger @endif'>{{ $course->status == 1 ? "Active" : "Block" }}</span></td>
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
