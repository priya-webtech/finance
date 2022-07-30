<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateExpenceMasterRequest;
use App\Http\Requests\Admin\UpdateExpenceMasterRequest;
use App\Models\Admin\BankAccount;
use App\Models\Admin\Batch;
use App\Models\Admin\Branch;
use App\Models\Admin\ExpenseTypes;
use App\Models\Admin\ExpenceMaster;
use App\Models\Admin\ModeOfPayment;
use App\Models\Admin\Student;
use App\Models\Admin\Trainer;
use App\Repositories\Admin\ExpenceMasterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Nette\Utils\DateTime;
use phpDocumentor\Reflection\Types\Null_;
use Response;

class ExpenceMasterController extends AppBaseController
{
    /** @var ExpenceMasterRepository $expenceMasterRepository*/
    private $expenceMasterRepository;

    public function __construct(ExpenceMasterRepository $expenceMasterRepo)
    {
        $this->expenceMasterRepository = $expenceMasterRepo;
    }

    /**
     * Display a listing of the ExpenceMaster.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $expenceMasters = $this->expenceMasterRepository->paginate(10);

        $bankAccounts  = ModeOfPayment::where('status',1)->pluck('name','id');
        $expenseTypes  = ExpenseTypes::where('status',1)->pluck('title','id');
        $branch        = Branch::where('status',1)->pluck('title','id');
        $trainer       = Trainer::where('status',1)->pluck('trainer_name','id');
        $batch       = Batch::where('status',1)->pluck('name','id');
        $student       = Student::where('status',1)->pluck('name','id');
        return view('admin.expence_masters.index',compact('bankAccounts','expenseTypes','branch','trainer','batch','student'))
            ->with('expenceMasters', $expenceMasters);
    }
    public function filter(Request $request)
    {   

        $bankAccounts  = ModeOfPayment::where('status',1)->pluck('name','id');
        $expenseTypes  = ExpenseTypes::where('status',1)->pluck('title','id');
        $branch        = Branch::where('status',1)->pluck('title','id');
        $trainer       = Trainer::where('status',1)->pluck('trainer_name','id');
        $batch       = Batch::where('status',1)->pluck('name','id');
        $student       = Student::where('status',1)->pluck('name','id');

        //dd($request);
        $expenceMasters = ExpenceMaster::where('expence_type_id',$request->expence_type_id)->orWhere('bank_ac_id', '=', $request->bank_ac_id)->orWhere('trainer_id', '=',  $request->trainer_id)->paginate(10);

        return view('admin.expence_masters.index',compact('bankAccounts','expenseTypes','branch','trainer','batch','student'))
            ->with('expenceMasters', $expenceMasters);
    }
    

    /**
     * Show the form for creating a new ExpenceMaster.
     *
     * @return Response
     */
    public function create()
    {
        $bankAccounts  = ModeOfPayment::where('status',1)->pluck('name','id');
        $expenseTypes  = ExpenseTypes::where('status',1)->pluck('title','id');
        $branch        = Branch::where('status',1)->pluck('title','id');
        $trainer       = Trainer::where('status',1)->pluck('trainer_name','id');
        $batch       = Batch::where('status',1)->pluck('name','id');
        $student       = Student::where('status',1)->pluck('name','id');
        return view('admin.expence_masters.create',compact('bankAccounts','expenseTypes','branch','trainer','batch','student'));
    }

    /**
     * Store a newly created ExpenceMaster in storage.
     *
     * @param CreateExpenceMasterRequest $request
     *
     * @return Response
     */
    public function store(CreateExpenceMasterRequest $request)
    {

        $request->validate([
            'expence_type_id' => ['required', 'string'],
            'branch_id' => ['required', 'string'],
            'bank_ac_id' => ['required', 'string'],
            'amount' => ['required', 'string'],
            'date' => ['required', 'string'],
        ]);

        $input = $request->all();
        $expenceType = ExpenseTypes::findorfail($input['expence_type_id']);
        $bankAc = $input['bank_ac_id'];
        $ReqDebitAmount = $input['amount'];
        $Bank = ModeOfPayment::findorfail($bankAc);
        $remainAmount = $Bank->opening_balance - $ReqDebitAmount;
        $Bank->opening_balance = $remainAmount;
        $Bank->save();
        if ($expenceType->title != "Trainer Fees") {
            $input['batch_id'] = null;
            $input['trainer_id'] = null;
        } elseif ($expenceType->title != "Student Refund") {
            $input['student_id'] = null;
        }
        if ($expenceType->title == "Trainer Fees"){
            if(isset($input['tds'])){
                $input['tds'] = site_setting()->tds_per*$input['amount']/100;
                $input['amount'] =$input['amount']-$input['tds'];
            }
        }

        $expenceMaster = $this->expenceMasterRepository->create($input);
//        }else{
//
//
//            $bankAc = $input['bank_ac_id'];
//            $ReqDebitAmount = $input['amount'];
//            $Bank = ModeOfPayment::findorfail($bankAc);
//            $remainAmount = $Bank->opening_balance - $ReqDebitAmount;
//            $Bank->opening_balance = $remainAmount;
//            $Bank->save();
//            $expenceMaster = $this->expenceMasterRepository->create($input);
//        }


        Flash::success('Expense Master saved successfully.');

        return redirect(route('admin.expenceMasters.index'));
    }

    /**
     * Display the specified ExpenceMaster.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $expenceMaster = $this->expenceMasterRepository->find($id);

        if (empty($expenceMaster)) {
            Flash::error('Expense Master not found');

            return redirect(route('admin.expenceMasters.index'));
        }

        return view('admin.expence_masters.show')->with('expenceMaster', $expenceMaster);
    }

    /**
     * Show the form for editing the specified ExpenceMaster.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $expenceMaster = $this->expenceMasterRepository->find($id);
        $expenceMaster['amount'] = $expenceMaster->amount + $expenceMaster->tds;
        if (empty($expenceMaster)) {
            Flash::error('Expense Master not found');

            return redirect(route('admin.expenceMasters.index'));
        }

        $bankAccounts=ModeOfPayment::where('status',1)->pluck('name','id');
        $expenseTypes=ExpenseTypes::where('status',1)->pluck('title','id');
        $branch = Branch::where('status',1)->pluck('title','id');
        $trainer       = Trainer::where('status',1)->pluck('trainer_name','id');
        $batch       = Batch::where('status',1)->pluck('name','id');
        $student       = Student::where('status',1)->pluck('name','id');

        return view('admin.expence_masters.edit',compact('expenceMaster','bankAccounts','expenseTypes','branch','trainer','batch','student'));
    }

    /**
     * Update the specified ExpenceMaster in storage.
     *
     * @param int $id
     * @param UpdateExpenceMasterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExpenceMasterRequest $request)
    {

        $request->validate([
            'expence_type_id' => ['required', 'string'],
            'branch_id' => ['required', 'string'],
            'bank_ac_id' => ['required', 'string'],
            'amount' => ['required', 'string'],
            'date' => ['required', 'string'],
        ]);
        $input = $request->all();
        $expenceMaster = $this->expenceMasterRepository->find($id);
        if (empty($expenceMaster)) {
            Flash::error('Expense Master not found');
            return redirect(route('admin.expenceMasters.index'));
        }
        $expenceType = ExpenseTypes::findorfail($input['expence_type_id']);
        $Bank = ModeOfPayment::findorfail($expenceMaster->bank_ac_id);
        $remainAmount = $Bank->opening_balance + $expenceMaster->amount+$expenceMaster->tds;
        $Bank->opening_balance = $remainAmount;
        $Bank->save();
        $ReqDebitAmount = $input['amount'];
        $debitAmoutBank = ModeOfPayment::findorfail($input['bank_ac_id']);
        $remainAmount = $debitAmoutBank->opening_balance - $ReqDebitAmount;
        $debitAmoutBank->opening_balance = $remainAmount;
        $debitAmoutBank->save();
        if ($expenceType->title != "Trainer Fees") {
            $input['batch_id'] = null;
            $input['trainer_id'] = null;
        } elseif ($expenceType->title != "Student Refund") {
            $input['student_id'] = null;
        }
        if ($expenceType->title == "Trainer Fees"){
            if(isset($input['tds'])){
                $input['tds'] = site_setting()->tds_per*$input['amount']/100;
                $input['amount'] =$input['amount']-$input['tds'];
            }else{
                $input['tds'] = 0;
            }
        }
        $expenceMaster = $this->expenceMasterRepository->update($input, $id);

        Flash::success('Expense Master updated successfully.');

        return redirect(route('admin.expenceMasters.index'));
    }

    /**
     * Remove the specified ExpenceMaster from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $expenceMaster = $this->expenceMasterRepository->find($id);

        if (empty($expenceMaster)) {
            Flash::error('Expense Master not found');

            return redirect(route('admin.expenceMasters.index'));
        }

        $this->expenceMasterRepository->delete($id);

        Flash::success('Expense Master deleted successfully.');

        return redirect(route('admin.expenceMasters.index'));
    }

    public function trainerBatch()
    {
      $batch  = Batch::where('trainer_id',\request('trainerID'))->pluck('name','id');
      return response()->json($batch);
    }

    public function expenseVerify(Request $request)
    {
        $input = $request->all();
        $input['bank_Acc'];
        $input['amount'];
        $bankAcc = ModeOfPayment::findorfail($input['bank_Acc']);
        $allbank = ModeOfPayment::where('id','!=',$input['bank_Acc'])->get();
        $bankAcc['remain_balance'] = $bankAcc->opening_balance-$input['amount'];
        $verify = view('admin.expence_masters.verify',compact('bankAcc','allbank'))->render();
        return response()->json(["verify"=>$verify]);

    }

}
