<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use App\Models\Admin\Branch;
use App\Repositories\Admin\CourseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
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
        $courses = $this->courseRepository->paginate(10);

        return view('admin.courses.index')
            ->with('courses', $courses);
    }

    /**
     * Show the form for creating a new Course.
     *
     * @return Response
     */
    public function create()
    {
      $branch =  Branch::where('status',1)->pluck('title','id');
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
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');
            return redirect(route('admin.courses.index'));
        }
        $branch =  Branch::where('status',1)->pluck('title','id');
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
