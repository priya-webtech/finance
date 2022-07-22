<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateExpenceMasterRequest;
use App\Http\Requests\Admin\UpdateExpenceMasterRequest;
use App\Models\Admin\BankAccount;
use App\Models\Admin\Batch;
use App\Models\Admin\Branch;
use App\Models\Admin\ExpenseTypes;
use App\Models\Admin\ModeOfPayment;
use App\Models\Admin\Trainer;
use App\Repositories\Admin\ExpenceMasterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
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

        return view('admin.expence_masters.index')
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
        return view('admin.expence_masters.create',compact('bankAccounts','expenseTypes','branch','trainer','batch'));
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
        $input = $request->all();
        $bankAc = $input['bank_ac_id'];
        $ReqDebitAmount = $input['amount'];
        $Bank = BankAccount::findorfail($bankAc);
        $remainAmount = $Bank->opening_balance - $ReqDebitAmount;
        $Bank->opening_balance = $remainAmount;
        $Bank->save();
        $expenceMaster = $this->expenceMasterRepository->create($input);

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

        if (empty($expenceMaster)) {
            Flash::error('Expense Master not found');

            return redirect(route('admin.expenceMasters.index'));
        }
        $bankAccounts=BankAccount::where('status',1)->pluck('name','id');
        $expenseTypes=ExpenseTypes::where('status',1)->pluck('title','id');
        $branch = Branch::where('status',1)->pluck('title','id');
        return view('admin.expence_masters.edit',compact('expenceMaster','bankAccounts','expenseTypes','branch'));
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
        $expenceMaster = $this->expenceMasterRepository->find($id);

        if (empty($expenceMaster)) {
            Flash::error('Expense Master not found');

            return redirect(route('admin.expenceMasters.index'));
        }

        $expenceMaster = $this->expenceMasterRepository->update($request->all(), $id);

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
}
