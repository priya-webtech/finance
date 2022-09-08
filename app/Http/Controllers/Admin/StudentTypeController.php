<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateStudentTypeRequest;
use App\Http\Requests\Admin\UpdateStudentTypeRequest;
use App\Repositories\Admin\StudentTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class StudentTypeController extends AppBaseController
{
    /** @var StudentTypeRepository $studentTypeRepository*/
    private $studentTypeRepository;

    public function __construct(StudentTypeRepository $studentTypeRepo)
    {
        $this->studentTypeRepository = $studentTypeRepo;
    }

    /**
     * Display a listing of the StudentType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $studentTypes = $this->studentTypeRepository->paginate(10);

        return view('admin.student_types.index')
            ->with('studentTypes', $studentTypes);
    }

    /**
     * Show the form for creating a new StudentType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.student_types.create');
    }

    /**
     * Store a newly created StudentType in storage.
     *
     * @param CreateStudentTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentTypeRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $studentType = $this->studentTypeRepository->create($input);

        Flash::success('Student Type saved successfully.');

        return redirect(route('admin.studentTypes.index'));
    }

    /**
     * Display the specified StudentType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $studentType = $this->studentTypeRepository->find($id);

        if (empty($studentType)) {
            Flash::error('Student Type not found');

            return redirect(route('admin.studentTypes.index'));
        }

        return view('admin.student_types.show')->with('studentType', $studentType);
    }

    /**
     * Show the form for editing the specified StudentType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $studentType = $this->studentTypeRepository->find($id);

        if (empty($studentType)) {
            Flash::error('Student Type not found');

            return redirect(route('admin.studentTypes.index'));
        }

        return view('admin.student_types.edit')->with('studentType', $studentType);
    }

    /**
     * Update the specified StudentType in storage.
     *
     * @param int $id
     * @param UpdateStudentTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentTypeRequest $request)
    {
        $studentType = $this->studentTypeRepository->find($id);

        if (empty($studentType)) {
            Flash::error('Student Type not found');

            return redirect(route('admin.studentTypes.index'));
        }

        $studentType = $this->studentTypeRepository->update($request->all(), $id);

        Flash::success('Student Type updated successfully.');

        return redirect(route('admin.studentTypes.index'));
    }

    /**
     * Remove the specified StudentType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $studentType = $this->studentTypeRepository->find($id);

        if (empty($studentType)) {
            Flash::error('Student Type not found');

            return redirect(route('admin.studentTypes.index'));
        }

        $this->studentTypeRepository->delete($id);

        Flash::success('Student Type deleted successfully.');

        return redirect(route('admin.studentTypes.index'));
    }
}
