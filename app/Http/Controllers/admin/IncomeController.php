<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateIncomeRequest;
use App\Http\Requests\Admin\UpdateIncomeRequest;
use App\Models\Admin\BankAccount;
use App\Models\Admin\Batch;
use App\Models\Admin\Branch;
use App\Models\Admin\Corporate;
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
        $incomes = $this->incomeRepository->paginate(10);
        $student = Student::get();
        $corporate = Corporate::get();
        return view('admin.incomes.index',compact('student','incomes','corporate'));
    }

    /**
     * Show the form for creating a new Income.
     *
     * @return Response
     */
    public function create()
    {
        $course =  Course::where('status',1)->pluck('course_name','id');
        $incomeType =  IncomeType::where('status',1)->pluck('title','id');
        $student =  Student::where('status',1)->pluck('name','id');
        $batch =  Batch::where('status',1)->pluck('name','id');
        $branch = Branch::where('status',1)->pluck('title','id');
        $modeOfPayment= ModeOfPayment::where('status',1)->pluck('name','id');
        $corporate = Corporate::where('status',1)->pluck('company_name','id');
        $franchise = Franchise::where('status',1)->pluck('title','id');
        $studentType =  StudentType::where('status',1)->pluck('title','id');
        $user = User::where('role_id',constant('student_co-ordinator'))->pluck('name','id');
        $leadSources = LeadSources::where('status',1)->pluck('title','id');
        $enquiryType = EnquiryType::where('status',1)->pluck('title','id');
        $trainer = Trainer::where('status',1)->pluck('trainer_name','id');
        $path = asset('country.json');
        $country = json_decode(file_get_contents(public_path() . "\country.json"), true);

        return view('admin.incomes.create',compact('course','incomeType','student','batch','branch','modeOfPayment','corporate','franchise','studentType','user','enquiryType','leadSources','trainer','country'));
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
                   // $input['gst'] = $data['gst'];
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
//                $studentBatchDetail->batchTrainerDetail()->createMany($studBatch['batch']);
            }

//            $input['bank_acc_id'] = $input['mode_of_payment'];
//            $input['registration_taken_by'] = Auth::id();
//            $income = Income::create($input);
//            $val['student_id'] = $student->id;
//            $val['course_id'] = $input['course_id'];
//            $val['gst'] = $input['gst'];
//            $income->incomeStudFees()->create($val);
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
                    // $input['gst'] = $data['gst'];
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
//                $studentBatchDetail->batchTrainerDetail()->createMany($studBatch['batch']);
            }
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
    public function edit($student_id)
    {
        if (\request('type') == 'corporate') {
            $students = Corporate::findorfail($student_id);
            $students['name'] = $students['company_name'];
            $students['mobile_no'] = $students['contact_no'];
            $students['enquiry_type'] = $students['enquiry_type_id'];
            $students['income_type_id']= $students->corporateDetail[0]->corpoFeesColl->getIncome->income_type_id;
        } else {
        $students = Student::findorfail($student_id);
        $students['income_type_id'] = $students->studDetail[0]->studFeesColl->getIncome->income_type_id;
        $students['branch_id'] = $students->studDetail[0]->branch_id;
    }
        $course =  Course::where('status',1)->pluck('course_name','id');
        $incomeType =  IncomeType::where('status',1)->pluck('title','id');
        $student =  Student::where('status',1)->pluck('name','id');
        $batch =  Batch::where('status',1)->pluck('name','id');
        $branch = Branch::where('status',1)->pluck('title','id');
        $bankAccount = BankAccount::where('status',1)->pluck('name','id');
        $modeOfPayment= ModeOfPayment::where('status',1)->pluck('name','id');
        $corporate = Corporate::where('status',1)->pluck('company_name','id');
        $franchise = Franchise::where('status',1)->pluck('title','id');
        $studentType =  StudentType::where('status',1)->pluck('title','id');
        $enquiryType = EnquiryType::where('status',1)->pluck('title','id');
        $leadSources = LeadSources::where('status',1)->pluck('title','id');
        $trainer = Trainer::where('status',1)->pluck('trainer_name','id');
        $path = asset('country.json');
        $country = json_decode(file_get_contents(public_path() . "\country.json"), true);
        return view('admin.incomes.edit',compact('course','trainer','students','leadSources','studentType','enquiryType','branch','bankAccount','country','incomeType','student','batch','modeOfPayment','corporate','franchise'));
    }

    /**
     * Update the specified Income in storage.
     *
     * @param int $id
     * @param UpdateIncomeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIncomeRequest $request)
    {
       $input = $request->all();

        $incomeType = IncomeType::where('id',$input['income_type_id'])->first();
        if($incomeType->title == 'Retail Training') {
            $student = Student::findorfail($id);
            $this->validator($request->all())->validate();
            $student = Student::where('mobile_no', $input['mobile_no'])->first();
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
                }else{
                    $old_amount = 0;
                }

                $bank = ModeOfPayment::where('id', $studBatch['mode_of_payment'])->first();
                $old_balance = $bank->opening_balance-$old_amount;
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
