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
use App\Models\Admin\columnManage;
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
        $columnManage = columnManage::where('table_name','student')->where('role_id',auth()->user()->role_id)->first();
        $auth =Auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
        $students = Student::with('studDetail')->when(request('dates'), function ($q) {
            $part = explode("-",request('dates'));
            $start = date('Y-m-d', strtotime($part[0]));
            $end = date('Y-m-d', strtotime($part[1]));
            $q->whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end);
        })->paginate(20);
        }elseif ($auth->hasRole('student_co-ordinator')){
            $students = Student::with('studDetail')->when(request('dates'), function ($q) {
                $part = explode("-",request('dates'));
                $start = date('Y-m-d', strtotime($part[0]));
                $end = date('Y-m-d', strtotime($part[1]));
                $q->whereDate('created_at', '>=', $start)
                    ->whereDate('created_at', '<=', $end);
            })->where('branch_id',$auth->branch_id)->where('placement','yes')->paginate(20);
        }
        else{
        $students = Student::with('studDetail')->when(request('dates'), function ($q) {
            $part = explode("-",request('dates'));
            $start = date('Y-m-d', strtotime($part[0]));
            $end = date('Y-m-d', strtotime($part[1]));
            $q->whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end);
        })->where('branch_id',$auth->branch_id)->paginate(20);
        }
        $field = [];
        if($columnManage){
            $field = json_decode($columnManage->field_status);
        }

        return view('admin.students.index',compact('field'))->with('students', $students);
    }

    public function studentcolums(Request $request)
    {
        $columnManage = columnManage::where('table_name',$request->student)->where('role_id',auth()->user()->role_id)->first();

        if($columnManage){

            $field = json_decode($columnManage->field_status);
            $storejson = array(
                'student_col_1' => ($request->student_col_1) ? 1 : null,
                'student_col_2' => ($request->student_col_2) ? 1 : null,
                'student_col_3' => ($request->student_col_3) ? 1 : null,
                'student_col_4' => ($request->student_col_4) ? 1 : null,
                'student_col_5' => ($request->student_col_5) ? 1 : null,
                'student_col_6' => ($request->student_col_6) ? 1 : null,
                'student_col_7' => ($request->student_col_7) ? 1 : null,
                'student_col_8' => ($request->student_col_8) ? 1 : null,
            );

            columnManage::where('id', $columnManage['id'])->update(
                [
                'table_name' => $columnManage['table_name'],
                'field_status' => json_encode($storejson),
                'role_id' => $columnManage['role_id'],
                ]

            );

        }else{
            $storejson = array('student_col_1' => $request->student_col_1,'student_col_2' => $request->student_col_2,'student_col_3' => $request->student_col_3,'student_col_4' => $request->student_col_4,'student_col_5' => $request->student_col_5,'student_col_6' => $request->student_col_6,'student_col_7' => $request->student_col_7,'student_col_8' => $request->student_col_8 );

             columnManage::insert([
                'table_name' => $request->student,
                'field_status' => json_encode($storejson),
                'role_id' => auth()->user()->role_id,
             ]);

        }
    }

    /**
     * Show the form for creating a new Student.
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
        $batch = Batch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->whereHas('course', function($query) use ($auth){
                    $query->where('branch_id', '=', $auth->branch_id);
                });
            }
        })->pluck('name','id');
        $user = User::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('branch_id', '=', $auth->branch_id);
                $query->where('role_id', '=', 6);
            }
        })->pluck('name', 'id');
//      $branch =Branch::where('status',1)->pluck('title','id');
//      $batch =  Batch::where('status',1)->pluck('name','id');
      $leadSource =  LeadSources::where('status',1)->pluck('title','id');
      $enquiryType =  EnquiryType::where('status',1)->pluck('title','id');
      $studentType =  StudentType::where('status',1)->pluck('title','id');
//        $user = User::where('role_id',6)->pluck('name','id');
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
        $auth = Auth::user();
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('admin.students.index'));
        }
        $branch = Branch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('id', '=', $auth->branch_id);
            }
        })->pluck('title', 'id');
        $batch = Batch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->whereHas('course', function($query) use ($auth){
                    $query->where('branch_id', '=', $auth->branch_id);
                });
            }
        })->pluck('name','id');
        $user = User::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('branch_id', '=', $auth->branch_id);
                $query->where('role_id', '=', 6);
            }
        })->pluck('name', 'id');
        // $user = User::where('role_id',6)->pluck('name','id');
        //  $batch =  Batch::where('status',1)->pluck('name','id');
        $leadSource =  LeadSources::where('status',1)->pluck('title','id');
        $enquiryType =  EnquiryType::where('status',1)->pluck('title','id');
        $studentType =  StudentType::where('status',1)->pluck('title','id');

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
