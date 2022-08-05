<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateIncomeRequest;
use App\Http\Requests\Admin\UpdateIncomeRequest;
use App\Models\Admin\BankAccount;
use App\Models\Admin\Batch;
use App\Models\Admin\Branch;
use App\Models\Admin\Corporate;
use App\Models\Admin\CorporateBatchDetail;
use App\Models\Admin\CorporateDetail;
use App\Models\Admin\Course;
use App\Models\Admin\EnquiryType;
use App\Models\Admin\Franchise;
use App\Models\Admin\Income;
use App\Models\Admin\IncomeType;
use App\Models\Admin\LeadSources;
use App\Models\Admin\ModeOfPayment;
use App\Models\Admin\Student;
use App\Models\Admin\StudentBatchDetail;
use App\Models\Admin\StudentDetail;
use App\Models\Admin\StudentType;
use App\Models\Admin\columnManage;
use App\Models\Admin\Trainer;
use App\Models\User;
use App\Repositories\Admin\IncomeRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Response;

class IncomeController extends AppBaseController
{
    /** @var IncomeRepository $incomeRepository*/
    private $incomeRepository;

    public function __construct(IncomeRepository $incomeRepo)
    {
        $this->incomeRepository = $incomeRepo;
    }

    /**
     * Display a listing of the Income.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $auth =Auth::user();

          $inType = IncomeType::where('title','!=','Retail Training')->Where('title','!=','Corporate Training')->pluck('id')->toArray();
         $columnManage = columnManage::where('table_name','income')->where('role_id',auth()->user()->role_id)->first();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $student = Student::with('StudentIncome')->whereHas('StudentIncome')->get()->toArray();
            $corporate = Corporate::with('corporateIncome')->whereHas('corporateIncome')->get()->toArray();
             $incomes = Income::whereIn('income_type_id',$inType)->get()->toArray();
       
        }else{
            $student = Student::where('branch_id',$auth->branch_id)->with('StudentIncome')->whereHas('StudentIncome')->get()->toArray();
           
            $corporate = Corporate::where('branch_id',$auth->branch_id)->with('corporateIncome')->whereHas('corporateIncome')->get()->toArray();
            $incomes = Income::where('branch_id',$auth->branch_id)->whereIn('income_type_id',$inType)->get()->toArray();
        }

        $merge = array_merge($student, $corporate,$incomes);
        $incomeType =  IncomeType::where('status',1)->pluck('title','id');
        $modeOfPayment= ModeOfPayment::where('status',1)->pluck('name','id');

        $field = [];
        if($columnManage){
            $field = json_decode($columnManage->field_status);
        }


        return view('admin.incomes.index',compact('student','incomes','corporate','merge','incomeType','modeOfPayment','field'));
    }

    public function incomecolums(Request $request)
    {
        $columnManage = columnManage::where('table_name',$request->income)->where('role_id',auth()->user()->role_id)->first();

        if($columnManage){

            $field = json_decode($columnManage->field_status);
            $storejson = array(
                'income_col_1' => ($request->income_col_1) ? 1 : null,
                'income_col_2' => ($request->income_col_2) ? 1 : null,
                'income_col_3' => ($request->income_col_3) ? 1 : null,
                'income_col_4' => ($request->income_col_4) ? 1 : null,
                'income_col_5' => ($request->income_col_5) ? 1 : null,
                'income_col_6' => ($request->income_col_6) ? 1 : null,
                'income_col_7' => ($request->income_col_7) ? 1 : null,
                'income_col_8' => ($request->income_col_8) ? 1 : null,
            );

            columnManage::where('id', $columnManage['id'])->update(
                [
                'table_name' => $columnManage['table_name'],
                'field_status' => json_encode($storejson),
                'role_id' => $columnManage['role_id'],
                ]

            );

        }else{
            $storejson = array('income_col_1' => $request->income_col_1,'income_col_2' => $request->income_col_2,'income_col_3' => $request->income_col_3,'income_col_4' => $request->income_col_4,'income_col_5' => $request->income_col_5,'income_col_6' => $request->income_col_6,'income_col_7' => $request->income_col_7,'income_col_8' => $request->income_col_8 );

             columnManage::insert([
                'table_name' => $request->income,
                'field_status' => json_encode($storejson),
                'role_id' => auth()->user()->role_id,
             ]);

        }
    }
    public function filter(Request $request)
    {
        $columnManage = columnManage::where('table_name','income')->where('role_id',auth()->user()->role_id)->first();

        $incomeType =  IncomeType::where('status',1)->pluck('title','id');
        $modeOfPayment= ModeOfPayment::where('status',1)->pluck('name','id');

        $auth =Auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $student = Student::with('StudentIncome')->whereHas('StudentIncome')->get()->toArray();
            $corporate = Corporate::with('corporateIncome')->whereHas('corporateIncome')->get()->toArray();
            $incomes = Income::orwhere('income_type_id',$request->income_type_id)->orWhere('mode_of_payment', '=', $request->mode_of_payment)->get()->toArray();
        }else{
            $student = Student::where('branch_id',$auth->branch_id)->with('StudentIncome')->whereHas('StudentIncome')->get()->toArray();
            $corporate = Corporate::where('branch_id',$auth->branch_id)->with('corporateIncome')->whereHas('corporateIncome')->get()->toArray();

             $incomesQuery=Income::query();
             $incomesQuery->where('branch_id',$auth->branch_id);
             $incomes  = $incomesQuery->where(function($query) use($request,$auth){
                            
                                       $query->orwhere('income_type_id',$request['income_type_id'])
                                      ->orWhere('mode_of_payment',$request['mode_of_payment'])
                                      ->doesntHave('corporateStudFees')->doesntHave('incomeStudFees');
                            })->get()->toArray();


          //  $incomes = Income::where('branch_id',$auth->branch_id)->orwhere('income_type_id',$request->income_type_id)->orWhere('mode_of_payment', '=', $request->mode_of_payment)->doesntHave('corporateStudFees')->doesntHave('incomeStudFees')->get()->toArray();
        }

        $merge = array_merge($student, $corporate,$incomes);

        $field = [];
        if($columnManage){
            $field = json_decode($columnManage->field_status);
        }

        return view('admin.incomes.index',compact('student','incomes','corporate','merge','incomeType','modeOfPayment','field'));
    }

    /**
     * Show the form for creating a new Income.
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
        $course = Course::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('branch_id', '=', $auth->branch_id);
            }
        })->pluck('course_name','id');
        $batch = Batch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->whereHas('course', function($query) use ($auth){
                    $query->where('branch_id', '=', $auth->branch_id);
                });
            }
        })->pluck('name','id');
        $trainer = Trainer::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('branch_id', '=', $auth->branch_id);
            }
        })->pluck('trainer_name', 'id');
        $corporate = Corporate::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('branch_id', '=', $auth->branch_id);
            }
        })->pluck('company_name', 'id');
        $user = User::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('branch_id', '=', $auth->branch_id);
                $query->where('role_id', '=', 6);
            }
        })->pluck('name', 'id');
      //  $course =  Course::where('status',1)->pluck('course_name','id');
      //  $batch =  Batch::where('status',1)->pluck('name','id');
//        $branch = Branch::where('status',1)->pluck('title','id');
       // $corporate = Corporate::where('status',1)->pluck('company_name','id');
      //  $user = User::where('role_id',6)->pluck('name','id');
       // $trainer = Trainer::where('status',1)->pluck('trainer_name','id');


        $incomeType =  IncomeType::where('status',1)->pluck('title','id');
        $modeOfPayment= ModeOfPayment::where('status',1)->pluck('name','id');
        $studentType =  StudentType::where('status',1)->pluck('title','id');
        $leadSources = LeadSources::where('status',1)->pluck('title','id');
        $enquiryType = EnquiryType::where('status',1)->pluck('title','id');
        $path = asset('country.json');
        $country = json_decode(file_get_contents(public_path() . "\country.json"), true);

        return view('admin.incomes.create',compact('course','incomeType','batch','branch','modeOfPayment','corporate','studentType','user','enquiryType','leadSources','trainer','country'));
    }

    public function store(CreateIncomeRequest $request)
    {
        $input = $request->all();
        $incomeType = IncomeType::where('id',$input['income_type_id'])->first();
        if($incomeType->title == 'Retail Training') {
            $this->validator($request->all())->validate();
            $student = Student::where('mobile_no',$input['mobile_no'])->first();
            if(empty($student)){
                $input['status'] = 1;
                $student = Student::create($input);
            }
            foreach ($input['student'] as $studBatch){
                $studBatch['branch_id'] = $input['branch_id'];
                $studBatch['reg_taken_id'] = Auth::id();
                $studentDetail = $student->studDetail()->create($studBatch);
                $totalPay = $studBatch['pay_amount'];
                if (isset($studBatch['gst'])){
                    $gst =  site_setting()->gst_per/100+1;
                    $data['gst'] = $studBatch['pay_amount'] - $studBatch['pay_amount']/$gst;
                    $input['paying_amount'] = $studBatch['pay_amount']/$gst;
                }else{
                    $data['gst'] = 0;
                    $input['paying_amount'] = $totalPay;
                }
                $bank = ModeOfPayment::where('id',$studBatch['mode_of_payment'])->first();
                $old_balance = $bank->opening_balance;
                $bank->opening_balance = $old_balance+$totalPay;
                $bank->save();
                $input['bank_acc_id'] = $studBatch['mode_of_payment'];
                $input['course_id'] = $studBatch['course_id'];
                $input['register_date'] = Carbon::now();
                $input['registration_taken_by'] = Auth::id();
                $income = Income::create($input);
                $val['student_id'] = $student->id;
                $val['course_id'] = $studBatch['course_id'];
                $val['gst'] = $data['gst'];
                $val['student_detail_id'] = $studentDetail->id;
                $income->incomeStudFees()->create($val);
                if (empty($studBatch['no_batch'])){
                    $studentBatchDetail = $studentDetail->studBatchDetail()->createMany($studBatch['course']);
                }
            }
        }
        elseif ($incomeType->title == 'Corporate Training'){
            $corporate = Corporate::where('contact_no',$input['mobile_no'])->first();
            if(empty($student)){
                $input['company_name'] = $input['name'];
                $input['contact_no'] = $input['mobile_no'];
                $input['enquiry_type_id'] = $input['enquiry_type'];
                $input['status'] = 1;$now = Carbon::now();
                $input['reg_for_month'] = $now->month.'/'.$now->year;
                $corporate = Corporate::create($input);
            }
            foreach ($input['student'] as $studBatch){
                $studBatch['branch_id'] = $input['branch_id'];
                $studBatch['reg_taken_id'] = Auth::id();
                $studBatch['reg_for_month'] = $now->month.'/'.$now->year;
                $corporateDetail = $corporate->corporateDetail()->create($studBatch);
                $totalPay = $studBatch['pay_amount'];
                if (isset($studBatch['gst'])){
                    $gst =  site_setting()->gst_per/100+1;
                    $data['gst'] = $studBatch['pay_amount'] - $studBatch['pay_amount']/$gst;
                    $input['paying_amount'] = $studBatch['pay_amount']/$gst;
                }else{
                    $data['gst'] = 0;
                    $input['paying_amount'] = $totalPay;
                }
                $bank = ModeOfPayment::where('id',$studBatch['mode_of_payment'])->first();
                $old_balance = $bank->opening_balance;
                $bank->opening_balance = $old_balance+$totalPay;
                $bank->save();
                $input['bank_acc_id'] = $studBatch['mode_of_payment'];
                $input['course_id'] = $studBatch['course_id'];
                $input['register_date'] = Carbon::now();
                $input['registration_taken_by'] = Auth::id();
                $income = Income::create($input);
                $val['corporate_id'] = $corporate->id;
                $val['course_id'] = $studBatch['course_id'];
                $val['gst'] = $data['gst'];
                $val['corporate_detail_id'] = $corporateDetail->id;
                $income->corporateStudFees()->create($val);
                if (empty($studBatch['no_batch'])){
                    $studentBatchDetail = $corporateDetail->corporateBatchDetail()->createMany($studBatch['course']);
                }
            }
        }
//        elseif ($incomeType->title == 'Others' ){
//            $validated = $request->validate([
//                'branch_id' => 'required',
//                'register_date' => 'required',
//                'paying_amount' => 'required',
//                'mode_of_payment' => 'required',
//            ]);
//            $totalPay = $input['paying_amount'];
//            if (isset($input['gst'])){
//                $gst =  site_setting()->gst_per/100+1;
//                $data['gst'] = $input['paying_amount'] - $input['paying_amount']/$gst;
//                $input['paying_amount'] = $input['paying_amount']/$gst;
//                $input['gst'] = $data['gst'];
//            }else{
//                $input['gst'] = 0;
//                $input['paying_amount'] = $totalPay;
//            }
//        }
        elseif ($incomeType->title == 'Others' || $incomeType->title == 'Digital Marketing' || $incomeType->title == 'HR Consultancy'){

            $validated = $request->validate([
                'branch_id' => 'required',
                'register_date' => 'required',
                'paying_amount' => 'required',
                'mode_of_payment' => 'required',
            ]);
            $totalPay = $input['paying_amount'];
            if (isset($input['gst'])){
                $gst =  site_setting()->gst_per/100+1;
                $data['gst'] = $input['paying_amount'] - $input['paying_amount']/$gst;
                $input['paying_amount'] = $input['paying_amount']/$gst;
                $input['gst'] = $data['gst'];
            }else{
                $input['gst'] = 0;
                $input['paying_amount'] = $totalPay;
            }
            $bank = ModeOfPayment::where('id',$input['mode_of_payment'])->first();
            $old_balance = $bank->opening_balance;
            $bank->opening_balance = $old_balance+$totalPay;
            $bank->save();
            $input['bank_acc_id'] = $input['mode_of_payment'];
            $input['registration_taken_by'] = Auth::id();
            $income = Income::create($input);
        }elseif ($incomeType->title == 'Franchise Royalty'){
            $validated = $request->validate([
                'branch_id' => 'required',
                'register_date' => 'required',
                'title' => 'required',
                'paying_amount' => 'required',
                'mode_of_payment' => 'required',
            ]);
            $input['status'] = 1;
            $franchise = Franchise::create($input);
            $totalPay = $input['paying_amount'];
            if (isset($input['gst'])){
                $gst =  site_setting()->gst_per/100+1;
                $data['gst'] = $input['paying_amount'] - $input['paying_amount']/$gst;
                $input['paying_amount'] = $input['paying_amount']/$gst;
                $input['gst'] = $data['gst'];
            }else{
                $input['gst'] = 0;
                $input['paying_amount'] = $totalPay;
            }
            $bank = ModeOfPayment::where('id',$input['mode_of_payment'])->first();
            $old_balance = $bank->opening_balance;
            $bank->opening_balance = $old_balance+$totalPay;
            $bank->save();
            $input['bank_acc_id'] = $input['mode_of_payment'];
            $input['registration_taken_by'] = Auth::id();
            $franchise->franchiseIncome()->create($input);
        }

        Flash::success('Income saved successfully.');

        return redirect(route('admin.incomes.index'));
    }

    /**
     * Display the specified Income.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $income = $this->incomeRepository->find($id);

        if (empty($income)) {
            Flash::error('Income not found');

            return redirect(route('admin.incomes.index'));
        }

        return view('admin.incomes.show')->with('income', $income);
    }

    /**
     * Show the form for editing the specified Income.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $students = ' ';
        $corporate = ' ';
        $income = ' ';
   if (\request('type') == 'corporate') {
      
            $corporate = Corporate::findorfail($id);
       $corporate['name'] = $corporate['company_name'];
       $corporate['mobile_no'] = $corporate['contact_no'];
       $corporate['enquiry_type'] = $corporate['enquiry_type_id'];
       $corporate['income_type_id']= $corporate->corporateDetail[0]->corpoFeesColl->getIncome->income_type_id;

   } else if(\request('type') == 'student') {

        $students = Student::findorfail($id);
        $students['income_type_id'] = $students->studDetail[0]->studFeesColl->getIncome->income_type_id;
        $students['branch_id'] = $students->studDetail[0]->branch_id;
    }else{
       $income = Income::findorfail($id);
       $income['paying_amount'] =  $income->paying_amount+$income->gst;
       $income['title'] =  $income->franchise->title ?? ' ';
   }

        $auth = Auth::user();
        $branch = Branch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('id', '=', $auth->branch_id);
            }
        })->pluck('title', 'id');
        $course = Course::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('branch_id', '=', $auth->branch_id);
            }
        })->pluck('course_name','id');
        $batch = Batch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->whereHas('course', function($query) use ($auth){
                    $query->where('branch_id', '=', $auth->branch_id);
                });
            }
        })->pluck('name','id');
        $trainer = Trainer::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('branch_id', '=', $auth->branch_id);
            }
        })->pluck('trainer_name', 'id');

      //  $course =  Course::where('status',1)->pluck('course_name','id');
        $incomeType =  IncomeType::where('status',1)->pluck('title','id');
        //$student =  Student::where('status',1)->pluck('name','id');
        //$batch =  Batch::where('status',1)->pluck('name','id');
       // $branch = Branch::where('status',1)->pluck('title','id');
       // $bankAccount = BankAccount::where('status',1)->pluck('name','id');
        $modeOfPayment= ModeOfPayment::where('status',1)->pluck('name','id');
//        $corporate = Corporate::where('status',1)->pluck('company_name','id');
        $franchise = Franchise::where('status',1)->pluck('title','id');
        $studentType =  StudentType::where('status',1)->pluck('title','id');
        $enquiryType = EnquiryType::where('status',1)->pluck('title','id');
        $leadSources = LeadSources::where('status',1)->pluck('title','id');
       // $trainer = Trainer::where('status',1)->pluck('trainer_name','id');
        $path = asset('country.json');
        $country = json_decode(file_get_contents(public_path() . "\country.json"), true);
        return view('admin.incomes.edit',compact('course','trainer','students','leadSources','studentType','enquiryType','branch','country','incomeType','batch','modeOfPayment','corporate','franchise','income'));
    }
    public function update($id, UpdateIncomeRequest $request)
    {
       $input = $request->all();

        $incomeType = IncomeType::where('id',$input['income_type_id'])->first();
        if($incomeType->title == 'Retail Training') {
            $student = Student::findorfail($id);
        //    $this->validator($request->all())->validate();
//            $student = Student::where('mobile_no', $input['mobile_no'])->first();
            $student->update($input);
            foreach ($input['student'] as $studBatch){
                $studBatch['branch_id'] = $input['branch_id'];
                $studBatch['reg_taken_id'] = Auth::id();
                if (isset($studBatch['studDetail_id'])){
                    $studentDetail = StudentDetail::findorfail($studBatch['studDetail_id']);
                    $studentDetail->update($studBatch);
                }else{
                    $studentDetail = $student->studDetail()->create($studBatch);
                }
                $totalPay = $studBatch['pay_amount'];
                if (isset($studBatch['gst'])) {
                    $gst = site_setting()->gst_per / 100 + 1;
                    $data['gst'] = $studBatch['pay_amount'] - $studBatch['pay_amount'] / $gst;
                    $input['paying_amount'] = $studBatch['pay_amount'] / $gst;
                    // $input['gst'] = $data['gst'];
                } else {
                    $data['gst'] = 0;
                    $input['paying_amount'] = $totalPay;
                }
                if (isset($studBatch['in_id'])){
                     $income = Income::findorfail($studBatch['in_id']);
                     $old_amount = $income->paying_amount + $income->incomeStudFees->gst;
                     $setBank = ModeOfPayment::where('id',$income->bank_acc_id)->first();
                     $setBank->opening_balance =  $setBank->opening_balance - $old_amount;
                     $setBank->save();
                }
                $bank = ModeOfPayment::where('id', $studBatch['mode_of_payment'])->first();
                $old_balance = $bank->opening_balance;
                $bank->opening_balance = $old_balance + $totalPay;
                $bank->save();
                $input['bank_acc_id'] = $studBatch['mode_of_payment'];
                $input['course_id'] = $studBatch['course_id'];
                $input['register_date'] = Carbon::now();
                $input['registration_taken_by'] = Auth::id();
                $val['student_id'] = $student->id;
                $val['course_id'] = $studBatch['course_id'];
                $val['gst'] = $data['gst'];
                $val['student_detail_id'] = $studentDetail->id;
                if (isset($studBatch['in_id'])) {
                    $income->update($input);
                    $income->incomeStudFees()->update($val);
                }else{
                    $income = Income::create($input);
                    $income->incomeStudFees()->create($val);
                }

                if (empty($studBatch['no_batch'])) {
                    foreach ($studBatch['course'] as $couse){
                        if (isset($couse['bat_id'])){
                        $studentBatchDetail = StudentBatchDetail::findorfail($couse['bat_id']);
                        $studentBatchDetail->update($couse);
                        }else {
                            $studentDetail->studBatchDetail()->createMany($studBatch['course']);
                        }
                    }
                }
            }
        }elseif ($incomeType->title == 'Corporate Training'){
            $corporate = Corporate::findorfail($id);
            //$this->validator($request->all())->validate();
//            $student = Student::where('mobile_no', $input['mobile_no'])->first();
            $input['company_name'] = $input['name'];
            $input['contact_no'] = $input['mobile_no'];
            $input['enquiry_type_id'] = $input['enquiry_type'];
            $corporate->update($input);
            foreach ($input['student'] as $studBatch){
                $studBatch['branch_id'] = $input['branch_id'];
                $studBatch['reg_taken_id'] = Auth::id();

                if (isset($studBatch['corpoDetail_id'])){
                    $corporateDetail = CorporateDetail::findorfail($studBatch['corpoDetail_id']);
                    $corporateDetail->update($studBatch);
                }else{
                    $now = Carbon::now();
                    $studBatch['reg_for_month'] = $now->month.'/'.$now->year;
                    $corporateDetail = $corporate->corporateDetail()->create($studBatch);
                }
                $totalPay = $studBatch['pay_amount'];

                if (isset($studBatch['gst'])) {

                    $gst = site_setting()->gst_per / 100 + 1;

                    $data['gst'] = ($studBatch['pay_amount']) - ($studBatch['pay_amount'] / $gst);

                    $input['paying_amount'] = $studBatch['pay_amount'] / $gst;
                    // $input['gst'] = $data['gst'];
                } else {
                    $data['gst'] = 0;
                    $input['paying_amount'] = $totalPay;
                }
                if (isset($studBatch['in_id'])){
                    $income = Income::findorfail($studBatch['in_id']);
                    $old_amount = $income->paying_amount + $income->corporateStudFees->gst;
                    $setBank = ModeOfPayment::where('id',$income->bank_acc_id)->first();
                    $setBank->opening_balance =  $setBank->opening_balance - $old_amount;
                    $setBank->save();
                }

                $bank = ModeOfPayment::where('id', $studBatch['mode_of_payment'])->first();
                $old_balance = $bank->opening_balance-$old_amount;
                $bank->opening_balance = $old_balance + $totalPay;
                $bank->save();
                $input['bank_acc_id'] = $studBatch['mode_of_payment'];
                $input['course_id'] = $studBatch['course_id'];
                $input['register_date'] = Carbon::now();
                $input['registration_taken_by'] = Auth::id();
                $val['corporate_id'] = $corporate->id;
                $val['course_id'] = $studBatch['course_id'];
                $val['gst'] = $data['gst'];
                $val['corporate_detail_id'] = $corporateDetail->id;
                if (isset($studBatch['in_id'])) {
                    $income->update($input);
                    $income->corporateStudFees()->update($val);
                }else{
                    $income = Income::create($input);
                    $income->corporateStudFees()->create($val);
                }

                if (empty($studBatch['no_batch'])) {
                    foreach ($studBatch['course'] as $couse){
                        if (isset($couse['bat_id'])){
                            $corporateBatchDetail = CorporateBatchDetail::findorfail($couse['bat_id']);
                            $corporateBatchDetail->update($couse);
                        }else {
                            $corporateDetail->corporateBatchDetail()->createMany($studBatch['course']);
                        }
                    }
                }
            }
        }elseif ($incomeType->title == 'Others' || $incomeType->title == 'Franchise Royalty' || $incomeType->title == 'Digital Marketing' || $incomeType->title == 'HR Consultancy' ){
            $validated = $request->validate([
                'branch_id' => 'required',
                'register_date' => 'required',
                'paying_amount' => 'required',
                'mode_of_payment' => 'required',
            ]);
            $income = Income::findorfail($id);
            $totalPay = $input['paying_amount'];
            if (isset($input['gst'])){
                $gst =  site_setting()->gst_per/100+1;
                $data['gst'] = $input['paying_amount'] - $input['paying_amount']/$gst;
                $input['paying_amount'] = $input['paying_amount']/$gst;
                $input['gst'] = $data['gst'];
            }else{
                $input['gst'] = 0;
                $input['paying_amount'] = $totalPay;
            }
            $old_amount = $income->paying_amount + $income->gst;
            $setBank = ModeOfPayment::where('id',$income->bank_acc_id)->first();
            $setBank->opening_balance =  $setBank->opening_balance - $old_amount;
            $setBank->save();
            $bank = ModeOfPayment::where('id',$input['mode_of_payment'])->first();
            $old_balance = $bank->opening_balance;
            $bank->opening_balance = $old_balance+$totalPay;
            $bank->save();
            $input['bank_acc_id'] = $input['mode_of_payment'];
            $income->update($input);
        }

        Flash::success('Income updated successfully.');

        return redirect(route('admin.incomes.index'));
    }

    /**
     * Remove the specified Income from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $income = $this->incomeRepository->find($id);
        if (empty($income)) {
            Flash::error('Income not found');
            return redirect(route('admin.incomes.index'));
        }
        $this->incomeRepository->delete($id);
        Flash::success('Income deleted successfully.');
        return redirect(route('admin.incomes.index'));
    }

    public function countStud()
    {
       $batch_id =  \request('batch');
       $tStud = Student::whereHas('studDetail', function ($q) use ($batch_id) {
                    return $q->where('batch_id', $batch_id);
            })->count();
        return response()->json($tStud);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile_no' => 'required',
            'lead_source_id'=> 'required',
            'student_type'=> 'required',
            'enquiry_type'=> 'required',
            'state'=> 'required',
        ]);
    }

    public function getBatch()
    {
        $result= Batch::where('course_id',\request('courseID'))->pluck('name','id');
        return response()->json($result);
    }
    public function getTrainer()
    {
        $batch= Batch::where('id',\request('batchID'))->first();
        $result = Trainer::where('id',$batch->trainer_id)->pluck('trainer_name','id');
        return response()->json($result);
    }
}
