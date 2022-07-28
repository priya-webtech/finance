<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateStudentRequest;
use App\Http\Requests\Admin\UpdateStudentRequest;
use App\Models\Admin\Batch;
use App\Models\Admin\Branch;
use App\Models\Admin\Corporate;
use App\Models\Admin\EnquiryType;
use App\Models\Admin\LeadSources;
use App\Models\Admin\StudentType;
use App\Models\Admin\Student;
use App\Models\Admin\StudentDetail;
use App\Models\Admin\Trainer;
use App\Models\User;
use App\Repositories\Admin\StudentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class StudentController extends AppBaseController
{
    /** @var StudentRepository $studentRepository*/
    private $studentRepository;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->studentRepository = $studentRepo;
    }

    /**
     * Display a listing of the Student.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //$students = $this->studentRepository->paginate(10);
        $auth =Auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $students = Student::paginate(10);
        }elseif ($auth->hasRole('branch_manager')){
            $students = Student::where('branch_id',$auth->branch_id)->paginate(10);
        }

        return view('admin.students.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new Student.
     *
     * @return Response
     */
    public function create()
    {
      $branch =Branch::where('status',1)->pluck('title','id');
      $batch =  Batch::where('status',1)->pluck('name','id');
      $leadSource =  LeadSources::where('status',1)->pluck('title','id');
      $enquiryType =  EnquiryType::where('status',1)->pluck('title','id');
      $studentType =  StudentType::where('status',1)->pluck('title','id');
        $user = User::where('role_id',6)->pluck('name','id');
      return view('admin.students.create',compact('leadSource','enquiryType','studentType','branch','batch','user'));
    }

    /**
     * Store a newly created Student in storage.
     *
     * @param CreateStudentRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $student = $this->studentRepository->create($input);
        Flash::success('Student saved successfully.');
        return redirect(route('admin.students.index'));
    }

    /**
     * Display the specified Student.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('admin.students.index'));
        }

        return view('admin.students.show')->with('student', $student);
    }

    /**
     * Show the form for editing the specified Student.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('admin.students.index'));
        }
        $branch =Branch::where('status',1)->pluck('title','id');
        $batch =  Batch::where('status',1)->pluck('name','id');
        $leadSource =  LeadSources::where('status',1)->pluck('title','id');
        $enquiryType =  EnquiryType::where('status',1)->pluck('title','id');
        $studentType =  StudentType::where('status',1)->pluck('title','id');
       $user = User::where('role_id',6)->pluck('name','id');
        return view('admin.students.edit',compact('branch','batch','leadSource','enquiryType','studentType','student','user'));
    }

    /**
     * Update the specified Student in storage.
     *
     * @param int $id
     * @param UpdateStudentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentRequest $request)
    {
      
        $student = $this->studentRepository->find($id);
        
        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('admin.students.index'));
        }

        $student = $this->studentRepository->update($request->all(), $id);

        Flash::success('Student updated successfully.');

        return redirect(route('admin.students.index'));
    }

    /**
     * Remove the specified Student from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('admin.students.index'));
        }

        $this->studentRepository->delete($id);

        Flash::success('Student deleted successfully.');

        return redirect(route('admin.students.index'));
    }

    public function dueFees()
    {
       $dueFeesStudent =  Student::where('status',1)->get();
       $dueFeesCorporate =  Corporate::where('status',1)->get();
        $dueFeeses  = $dueFeesStudent->merge($dueFeesCorporate);
        $dueFees = $this->paginate($dueFeeses);
       return view('admin.due-fees.index',compact('dueFees'));
    }
    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
