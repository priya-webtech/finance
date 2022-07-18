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
//        $student = Student::get();
        return view('admin.incomes.index')
            ->with('incomes', $incomes);
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
        //$bankAccount = BankAccount::where('status',1)->pluck('name','id');
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
//        dd($input);
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
//        elseif ($incomeType->title == 'Corporate Training'){
//            $request->validate([
//                'name' => 'required',
//                'email' => 'required',
//                'mobile_no' => 'required|unique:corporates,contact_no,',
//                'batch_id'=> 'required',
//                'lead_source'=> 'required',
//                'enquiry_type'=> 'required',
//                'web_site'=> 'required',
//                'trainer_amount'=> 'required',
//                'address'=> 'required',
//                'state'=> 'required',
//                'city'=> 'required',
//                'agreed_amount'=> 'required',
//                'reg_for_month'=> 'required',
//                'trainer_name'=> 'required',
//                'paying_amount'=> 'required',
//            ]);
//            $input['company_name'] = $input['name'];
//            $input['trainer_id'] = $input['trainer_name'];
//            $input['contact_no'] = $input['mobile_no'];
//            $input['lead_source_id'] = $input['lead_source'];
//            $input['enquiry_type_id'] = $input['enquiry_type'];
//            $input['status'] = 1;
//            $corporate = Corporate::create($input);
//            $totalPay = $input['paying_amount'];
//            if (isset($input['gst'])){
//                $gst =  site_setting()->gst_per/100+1;
//                $data['gst'] = $input['paying_amount'] - $input['paying_amount']/$gst;
//                $input['paying_amount'] = $input['paying_amount']/$gst;
//                $input['gst'] = $data['gst'];
//            }else{
//                $input['gst'] = 0;
//            }
//            $bank = ModeOfPayment::where('id',$input['mode_of_payment'])->first();
//            $old_balance = $bank->opening_balance;
//            $bank->opening_balance = $old_balance+$totalPay;
//            $bank->save();
//            $input['bank_acc_id'] = $input['mode_of_payment'];
//            $input['registration_taken_by'] = Auth::id();
//            $corporate->income()->create($input);
//        }

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



        $income = Income::get();
        if (empty($income)) {
            Flash::error('Income not found');
            return redirect(route('admin.incomes.index'));
        }
        $course =  Course::where('status',1)->pluck('course_name','id');
        $incomeType =  IncomeType::where('status',1)->pluck('title','id');
        $student =  Student::where('status',1)->pluck('name','id');
        $batch =  Batch::where('status',1)->pluck('name','id');
        $branch = Branch::where('status',1)->pluck('title','id');
        $bankAccount = BankAccount::where('status',1)->pluck('name','id');
        $modeOfPayment= ModeOfPayment::where('status',1)->pluck('title','id');
        $corporate = Corporate::where('status',1)->pluck('company_name','id');
        $franchise = Franchise::where('status',1)->pluck('title','id');
        $studentType =  StudentType::where('status',1)->pluck('title','id');
        $enquiryType = EnquiryType::where('status',1)->pluck('title','id');
        $leadSources = LeadSources::where('status',1)->pluck('title','id');
        $trainer = Trainer::where('status',1)->pluck('trainer_name','id');
        if($income->incomeStudFees){
            $income['batch_id'] = $income->incomeStudFees->batch_id;
            $income['student_id'] = $income->incomeStudFees->student_id;
        }else if ($income->corporateStudFees){
            $income['batch_id'] = $income->corporateStudFees->batch_id;
            $income['corporate_id'] = $income->corporateStudFees->corporate_id;
        }
        return view('admin.incomes.edit',compact('course','trainer','leadSources','studentType','enquiryType','branch','bankAccount','incomeType','student','batch','income','modeOfPayment','corporate','franchise'));
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
        $income = $this->incomeRepository->find($id);

        if (empty($income)) {
            Flash::error('Income not found');

            return redirect(route('admin.incomes.index'));
        }

        $income = $this->incomeRepository->update($request->all(), $id);

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
            'email' => 'required',
            'mobile_no' => 'required',
            'lead_source_id'=> 'required',
            'student_type'=> 'required',
            'enquiry_type'=> 'required',
            'state'=> 'required',
//            'agreed_amount'=> 'required',
//            'placement'=> 'required',
//            'reg_taken_id'=> 'required',
//            'reg_for_month'=> 'required',
//            'paying_amount'=> 'required',
//            'register_date'=> 'required',
//            'course_id'=> 'required',

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
