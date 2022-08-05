<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use App\Models\Admin\Batch;
use App\Models\Admin\Branch;
use App\Models\Admin\Course;
use App\Repositories\Admin\CourseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Admin\columnManage;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class CourseController extends AppBaseController
{
    /** @var CourseRepository $courseRepository*/
    private $courseRepository;

    public function __construct(CourseRepository $courseRepo)
    {
        $this->courseRepository = $courseRepo;
    }

    /**
     * Display a listing of the Course.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $columnManage = columnManage::where('table_name','course')->where('role_id',auth()->user()->role_id)->first();
        $courses = $this->courseRepository->paginate(10);
        $auth =Auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $courses = Course::paginate(10);
        }elseif ($auth->hasRole('branch_manager')){
            $courses = Course::where('branch_id',$auth->branch_id)->paginate(10);
        }

         $field = [];
        if($columnManage){
            $field = json_decode($columnManage->field_status);
        }
        return view('admin.courses.index',compact('field'))
            ->with('courses', $courses);
    }

    public function coursecolums(Request $request)
    {
        $columnManage = columnManage::where('table_name',$request->course)->where('role_id',auth()->user()->role_id)->first();

        if($columnManage){

            $field = json_decode($columnManage->field_status);
            $storejson = array(
                'course_col_1' => ($request->course_col_1) ? 1 : null,
                'course_col_2' => ($request->course_col_2) ? 1 : null,
                'course_col_3' => ($request->course_col_3) ? 1 : null,
                'course_col_4' => ($request->course_col_4) ? 1 : null,
                'course_col_5' => ($request->course_col_5) ? 1 : null,
                'course_col_6' => ($request->course_col_6) ? 1 : null,
                'course_col_7' => ($request->course_col_7) ? 1 : null,
                'course_col_8' => ($request->course_col_8) ? 1 : null,
            );

            columnManage::where('id', $columnManage['id'])->update(
                [
                'table_name' => $columnManage['table_name'],
                'field_status' => json_encode($storejson),
                'role_id' => $columnManage['role_id'],
                ]

            );

        }else{
            $storejson = array('course_col_1' => $request->course_col_1,'course_col_2' => $request->course_col_2,'course_col_3' => $request->course_col_3,'course_col_4' => $request->course_col_4,'course_col_5' => $request->course_col_5,'course_col_6' => $request->course_col_6,'course_col_7' => $request->course_col_7,'course_col_8' => $request->course_col_8 );

             columnManage::insert([
                'table_name' => $request->course,
                'field_status' => json_encode($storejson),
                'role_id' => auth()->user()->role_id,
             ]);

        }
    }

    /**
     * Show the form for creating a new Course.
     *
     * @return Response
     */
    public function create()
    {
        $auth = Auth::user();
        $branch = Branch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('id', '=', $auth->branch_id);
            }
        })->pluck('title', 'id');
      return view('admin.courses.create',compact('branch'));
    }

    /**
     * Store a newly created Course in storage.
     *
     * @param CreateCourseRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $input['created_by'] = Auth::id();
        $course = $this->courseRepository->create($input);

        Flash::success('Course saved successfully.');

        return redirect(route('admin.courses.index'));
    }

    /**
     * Display the specified Course.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('admin.courses.index'));
        }

        return view('admin.courses.show')->with('course', $course);
    }

    /**
     * Show the form for editing the specified Course.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $auth = Auth::user();
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');
            return redirect(route('admin.courses.index'));
        }

        $branch = Branch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('id', '=', $auth->branch_id);
            }
        })->pluck('title', 'id');
        return view('admin.courses.edit',compact('branch','course'));
    }

    /**
     * Update the specified Course in storage.
     *
     * @param int $id
     * @param UpdateCourseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseRequest $request)
    {
        $course = $this->courseRepository->find($id);
        $input = $request->all();
        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('admin.courses.index'));
        }
        $input['updated_by'] = Auth::id();
        $course = $this->courseRepository->update($input, $id);

        Flash::success('Course updated successfully.');

        return redirect(route('admin.courses.index'));
    }

    /**
     * Remove the specified Course from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('admin.courses.index'));
        }

        $this->courseRepository->delete($id);

        Flash::success('Course deleted successfully.');

        return redirect(route('admin.courses.index'));
    }
}
