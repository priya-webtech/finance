<?php

namespace App\Http\Controllers\admin;

use App\DataTables\Admin\BankDataTable;
use App\DataTables\Admin\BatchDataTable;
use App\DataTables\Admin\CarmodelDataTable;
use App\DataTables\Admin\CorporateDataTable;
use App\DataTables\Admin\DueFeesDataTable;
use App\DataTables\Admin\ExpenseDataTable;
use App\DataTables\Admin\GstDataTable;
use App\DataTables\Admin\IncomeDataTable;
use App\DataTables\Admin\StudentDataTable;
use App\DataTables\Admin\TrainerDataTable;
use App\DataTables\Admin\UserDataTable;
use App\Http\Requests\Admin;
use Spatie\Permission\Models\Role;
use App\Models\Admin\BatchMode;
use App\Models\Admin\BatchType;
use App\Models\Admin\EnquiryType;
use App\Models\Admin\IncomeType;
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

         $auth =auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin') || $auth->hasRole('branch_manager') || $auth->hasRole('counsellor')) {

            $enquirytype = EnquiryType::pluck('title', 'id');
            $studentType = StudentType::pluck('title', 'id');
            $leadSources = LeadSources::pluck('title', 'id');
            $batchType = BatchType::pluck('title', 'id');
            $batchMode = BatchMode::pluck('title', 'id');
            $incomeType = IncomeType::pluck('title', 'id');
            $course = Course::pluck('course_name', 'id');
            $role = Role::pluck('name', 'id');
            $branch = Branch::pluck('title', 'id');
            $path = public_path('country.json');
                      // dd($path);
            $state = json_decode(file_get_contents($path), true);
          // dd($path);

            return view('admin.dashboard.dashboard', compact('enquirytype', 'studentType', 'leadSources', 'state', 'batchMode', 'batchType', 'incomeType','course','role','branch'));
        }elseif($auth->hasRole('internal_auditor')){
            $incomeType = IncomeType::pluck('title', 'id');
            return view('admin.dashboard.dashboard-internal-auditor',compact('incomeType'));
        }else{
            return view('admin.dashboard.dashboard-student-co-ordinator');
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
        return $StudentDataTable->render('admin.students.datatable');
    }

    public function CorporateDataTable(CorporateDataTable $corporateDataTable)
    {
        return $corporateDataTable->render('admin.students.datatable');
    }
    public function ExpenseDataTable(ExpenseDataTable $expenseDataTable)
    {
        return $expenseDataTable->render('admin.students.datatable');
    }
    public function IncomeDataTable(IncomeDataTable $incomeDataTable)
    {
        return $incomeDataTable->render('admin.students.datatable');
    }

    public function TrainerDataTable(TrainerDataTable $trainerDataTable)
    {
        return $trainerDataTable->render('admin.students.datatable');
    }

    public function BatchDataTable(BatchDataTable $batchDataTable)
    {
        return $batchDataTable->render('admin.students.datatable');
    }

    public function UserDataTable(UserDataTable $UserDataTable)
    {
        return $UserDataTable->render('admin.students.datatable');
    }

    public function BankDataTable(BankDataTable $bankDataTable)
    {
        return $bankDataTable->render('admin.students.datatable');
    }
    public function CashDataTable(BankDataTable $bankDataTable)
    {
        return $bankDataTable->render('admin.students.datatable');
    }

    public function GstDataTable(GstDataTable $gstDataTable)
    {
        return $gstDataTable->render('admin.students.datatable');
    }
    public function dueFeesDataTable(DueFeesDataTable $dueFeesDataTable)
    {
        return $dueFeesDataTable->render('admin.students.datatable');
    }

    public function history()
    {
        $auth  = Auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $income = Income::orderBy('id', 'DESC')->paginate(10);
            $expense = ExpenceMaster::orderBy('id', 'DESC')->paginate(10);
        }else{
            $income = Income::where('branch_id',$auth->branch_id)->orderBy('id', 'DESC')->paginate(10);
            $expense = ExpenceMaster::where('branch_id',$auth->branch_id)->orderBy('id', 'DESC')->paginate(10);
        }
        return view('admin.history.index',compact('expense','income'));
    }
}
