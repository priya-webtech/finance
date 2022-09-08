<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateBankAccountRequest;
use App\Http\Requests\Admin\UpdateBankAccountRequest;
use App\Repositories\Admin\BankAccountRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BankAccountController extends AppBaseController
{
    /** @var BankAccountRepository $bankAccountRepository*/
    private $bankAccountRepository;

    public function __construct(BankAccountRepository $bankAccountRepo)
    {
        $this->bankAccountRepository = $bankAccountRepo;
    }

    /**
     * Display a listing of the BankAccount.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $bankAccounts = $this->bankAccountRepository->paginate(10);

        return view('admin.bank_accounts.index')
            ->with('bankAccounts', $bankAccounts);
    }

    /**
     * Show the form for creating a new BankAccount.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.bank_accounts.create');
    }

    /**
     * Store a newly created BankAccount in storage.
     *
     * @param CreateBankAccountRequest $request
     *
     * @return Response
     */
    public function store(CreateBankAccountRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $bankAccount = $this->bankAccountRepository->create($input);

        Flash::success('Bank Account saved successfully.');

        return redirect(route('admin.bankAccounts.index'));
    }

    /**
     * Display the specified BankAccount.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bankAccount = $this->bankAccountRepository->find($id);

        if (empty($bankAccount)) {
            Flash::error('Bank Account not found');

            return redirect(route('admin.bankAccounts.index'));
        }

        return view('admin.bank_accounts.show')->with('bankAccount', $bankAccount);
    }

    /**
     * Show the form for editing the specified BankAccount.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bankAccount = $this->bankAccountRepository->find($id);

        if (empty($bankAccount)) {
            Flash::error('Bank Account not found');

            return redirect(route('admin.bankAccounts.index'));
        }

        return view('admin.bank_accounts.edit')->with('bankAccount', $bankAccount);
    }

    /**
     * Update the specified BankAccount in storage.
     *
     * @param int $id
     * @param UpdateBankAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBankAccountRequest $request)
    {
        $bankAccount = $this->bankAccountRepository->find($id);

        if (empty($bankAccount)) {
            Flash::error('Bank Account not found');

            return redirect(route('admin.bankAccounts.index'));
        }

        $bankAccount = $this->bankAccountRepository->update($request->all(), $id);

        Flash::success('Bank Account updated successfully.');

        return redirect(route('admin.bankAccounts.index'));
    }

    /**
     * Remove the specified BankAccount from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bankAccount = $this->bankAccountRepository->find($id);

        if (empty($bankAccount)) {
            Flash::error('Bank Account not found');

            return redirect(route('admin.bankAccounts.index'));
        }

        $this->bankAccountRepository->delete($id);

        Flash::success('Bank Account deleted successfully.');

        return redirect(route('admin.bankAccounts.index'));
    }
}
