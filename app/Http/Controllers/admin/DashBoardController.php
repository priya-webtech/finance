<?php

namespace App\Http\Controllers\admin;

use App\DataTables\Admin\CarmodelDataTable;
use App\DataTables\Admin\CorporateDataTable;
use App\DataTables\Admin\StudentDataTable;
use App\Http\Requests\Admin;
use App\Models\Admin\EnquiryType;
use App\Models\Admin\LeadSources;
use App\Models\Admin\StudentType;
use App\Models\User;
use App\Models\Admin\Batch;
use App\Models\Admin\Branch;
use App\Models\Admin\Trainer;
use App\Models\Admin\Corporate;
use App\Models\Admin\Course;
use App\Models\Admin\Student;
use App\Models\Admin\Income;
use App\Models\Admin\ExpenceMaster;
use App\Http\Requests\Admin\CreateCarmodelRequest;
use App\Http\Requests\Admin\UpdateCarmodelRequest;
use App\Repositories\Admin\CarmodelRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends AppBaseController
{
    public $Getbranchwise;
    /** @var CarmodelRepository $carmodelRepository*/
//    private $carmodelRepository;
//
//    public function __construct(CarmodelRepository $carmodelRepo)
//    {
//        $this->carmodelRepository = $carmodelRepo;
//    }

    /**
     * Display a listing of the Carmodel.
     *
     * @param CarmodelDataTable $carmodelDataTable
     *
     * @return Response
     */
    public function index()
    {
       // dd(auth()->user()->role_id);
         $auth =auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){

           $enquirytype = EnquiryType::pluck('title','id');
           $studentType = StudentType::pluck('title','id');
           $leadSources =  LeadSources::pluck('title','id');
            $path = asset('country.json');
            $state = json_decode(file_get_contents(public_path() . "\country.json"), true);
        return view('admin.dashboard.dashboard',compact('enquirytype','studentType','leadSources','state'));
        }elseif (auth()->user()->role_id == 3) {
           $auth =auth::user();
        $user =  User::where('branch_id',$auth->branch_id)->count();
            $branch =  Branch::where('id',$auth->branch_id)->count();
            $trainer =  Trainer::where('branch_id',$auth->branch_id)->count();
            $corporate =  Corporate::where('branch_id',$auth->branch_id)->count();
            $student =  Student::where('branch_id',$auth->branch_id)->count();
            $course =  Course::where('branch_id',$auth->branch_id)->count();
            $batch =   Batch::whereHas('course', function($q) use($auth){
                $q->where('branch_id', $auth->branch_id);
            })->count();
            $studentincome = Student::where('branch_id',$auth->branch_id)->with('StudentIncome')->whereHas('StudentIncome')->get()->toArray();
            $corporateincome = Corporate::where('branch_id',$auth->branch_id)->with('corporateIncome')->whereHas('corporateIncome')->get()->toArray();
            $merge = Income::where('branch_id',$auth->branch_id)->doesntHave('corporateStudFees')->doesntHave('incomeStudFees')->get()->toArray();
            $counter = array_merge($studentincome, $corporateincome,$merge);
            $income = count($counter);
            $expenceMaster =  ExpenceMaster::where('branch_id',$auth->branch_id)->count();
            return view('admin.dashboard.dashboard-branch-manager',compact('user','branch','trainer','corporate','student','course','batch','income','expenceMaster'));
        }elseif (auth()->user()->role_id == 4) {
              $auth =auth::user();
        $user =  User::where('branch_id',$auth->branch_id)->count();
            $branch =  Branch::where('id',$auth->branch_id)->count();
            $trainer =  Trainer::where('branch_id',$auth->branch_id)->count();
            $corporate =  Corporate::where('branch_id',$auth->branch_id)->count();
            $student =  Student::where('branch_id',$auth->branch_id)->count();
            $course =  Course::where('branch_id',$auth->branch_id)->count();
            $batch =   Batch::whereHas('course', function($q) use($auth){
                $q->where('branch_id', $auth->branch_id);
            })->count();
            $studentincome = Student::where('branch_id',$auth->branch_id)->with('StudentIncome')->whereHas('StudentIncome')->get()->toArray();
            $corporateincome = Corporate::where('branch_id',$auth->branch_id)->with('corporateIncome')->whereHas('corporateIncome')->get()->toArray();
            $merge = Income::where('branch_id',$auth->branch_id)->doesntHave('corporateStudFees')->doesntHave('incomeStudFees')->get()->toArray();
            $counter = array_merge($studentincome, $corporateincome,$merge);
            $income = count($counter);
             $expenceMaster =  ExpenceMaster::where('branch_id',$auth->branch_id)->count();
            return view('admin.dashboard.dashboard-counsellor',compact('user','branch','trainer','corporate','student','course','batch','income','expenceMaster'));
        }elseif (auth()->user()->role_id == 5) {
              $auth =auth::user();
        $user =  User::where('branch_id',$auth->branch_id)->count();
            $branch =  Branch::where('id',$auth->branch_id)->count();
            $trainer =  Trainer::where('branch_id',$auth->branch_id)->count();
            $corporate =  Corporate::where('branch_id',$auth->branch_id)->count();
            $student =  Student::where('branch_id',$auth->branch_id)->count();
            $course =  Course::where('branch_id',$auth->branch_id)->count();
            $batch =   Batch::whereHas('course', function($q) use($auth){
                $q->where('branch_id', $auth->branch_id);
            })->count();
            $studentincome = Student::where('branch_id',$auth->branch_id)->with('StudentIncome')->whereHas('StudentIncome')->get()->toArray();
            $corporateincome = Corporate::where('branch_id',$auth->branch_id)->with('corporateIncome')->whereHas('corporateIncome')->get()->toArray();
            $merge = Income::where('branch_id',$auth->branch_id)->doesntHave('corporateStudFees')->doesntHave('incomeStudFees')->get()->toArray();
            $counter = array_merge($studentincome, $corporateincome,$merge);
            $income = count($counter);
             $expenceMaster =  ExpenceMaster::where('branch_id',$auth->branch_id)->count();
            return view('admin.dashboard.dashboard-internal-auditor',compact('user','branch','trainer','corporate','student','course','batch','income','expenceMaster'));
        }elseif (auth()->user()->role_id == 6) {
              $auth =auth::user();
        $user =  User::where('branch_id',$auth->branch_id)->count();
            $branch =  Branch::where('id',$auth->branch_id)->count();
            $trainer =  Trainer::where('branch_id',$auth->branch_id)->count();
            $corporate =  Corporate::where('branch_id',$auth->branch_id)->count();
            $student =  Student::where('branch_id',$auth->branch_id)->count();
            $course =  Course::where('branch_id',$auth->branch_id)->count();
            $batch =   Batch::whereHas('course', function($q) use($auth){
                $q->where('branch_id', $auth->branch_id);
            })->count();
            $studentincome = Student::where('branch_id',$auth->branch_id)->with('StudentIncome')->whereHas('StudentIncome')->get()->toArray();
            $corporateincome = Corporate::where('branch_id',$auth->branch_id)->with('corporateIncome')->whereHas('corporateIncome')->get()->toArray();
            $merge = Income::where('branch_id',$auth->branch_id)->doesntHave('corporateStudFees')->doesntHave('incomeStudFees')->get()->toArray();
            $counter = array_merge($studentincome, $corporateincome,$merge);
            $income = count($counter);
             $expenceMaster =  ExpenceMaster::where('branch_id',$auth->branch_id)->count();
            return view('admin.dashboard.dashboard-student-co-ordinator',compact('user','branch','trainer','corporate','student','course','batch','income','expenceMaster'));
        }else{
            return view('admin.dashboard.dashboard');
        }
    }

    public function Getbranchwise(){
        $auth =auth::user();
        $user =  User::where('branch_id',$auth->branch_id)->count();
            $branch =  Branch::where('id',$auth->branch_id)->count();
            $trainer =  Trainer::where('branch_id',$auth->branch_id)->count();
            $corporate =  Corporate::where('branch_id',$auth->branch_id)->count();
            $student =  Student::where('branch_id',$auth->branch_id)->count();
            $course =  Course::where('branch_id',$auth->branch_id)->count();
            $batch =   Batch::whereHas('course', function($q) use($auth){
                $q->where('branch_id', $auth->branch_id);
            })->count();
            $studentincome = Student::where('branch_id',$auth->branch_id)->with('StudentIncome')->whereHas('StudentIncome')->get()->toArray();
            $corporateincome = Corporate::where('branch_id',$auth->branch_id)->with('corporateIncome')->whereHas('corporateIncome')->get()->toArray();
            $merge = Income::where('branch_id',$auth->branch_id)->doesntHave('corporateStudFees')->doesntHave('incomeStudFees')->get()->toArray();
            $counter = array_merge($studentincome, $corporateincome,$merge);
            $income = count($counter);

    }

    public function StudentDataTable(StudentDataTable $StudentDataTable)
    {
        //dd($StudentDataTable);
        return $StudentDataTable->render('admin.students.datatable');
//        return $dataTable;
    }

    public function CorporateDataTable(CorporateDataTable $corporateDataTable)
    {
        //dd($StudentDataTable);
        return $corporateDataTable->render('admin.students.datatable');
//        return $dataTable;
    }
}
