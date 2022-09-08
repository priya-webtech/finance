<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateExpenseTypesRequest;
use App\Http\Requests\Admin\UpdateExpenseTypesRequest;
use App\Repositories\Admin\ExpenseTypesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ExpenseTypesController extends AppBaseController
{
    /** @var Expense TypesRepository $expenseTypesRepository*/
    private $expenseTypesRepository;

    public function __construct(ExpenseTypesRepository $expenseTypesRepo)
    {
        $this->expenseTypesRepository = $expenseTypesRepo;
    }

    /**
     * Display a listing of the Expense Types.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $expenseTypes = $this->expenseTypesRepository->paginate(10);

        return view('admin.expense_types.index')
            ->with('expenseTypes', $expenseTypes);
    }

    /**
     * Show the form for creating a new Expense Types.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.expense_types.create');
    }

    /**
     * Store a newly created Expense Types in storage.
     *
     * @param CreateExpense TypesRequest $request
     *
     * @return Response
     */
    public function store(CreateExpenseTypesRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $expenseTypes = $this->expenseTypesRepository->create($input);

        Flash::success('Expense Types saved successfully.');

        return redirect(route('admin.expenseTypes.index'));
    }

    /**
     * Display the specified Expense Types.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $expenseTypes = $this->expenseTypesRepository->find($id);

        if (empty($expenseTypes)) {
            Flash::error('Expense Types not found');

            return redirect(route('admin.expenseTypes.index'));
        }

        return view('admin.expense_types.show')->with('expenseTypes', $expenseTypes);
    }

    /**
     * Show the form for editing the specified Expense Types.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $expenseTypes = $this->expenseTypesRepository->find($id);

        if (empty($expenseTypes)) {
            Flash::error('Expense Types not found');

            return redirect(route('admin.expenseTypes.index'));
        }

        return view('admin.expense_types.edit')->with('expenseTypes', $expenseTypes);
    }

    /**
     * Update the specified Expense Types in storage.
     *
     * @param int $id
     * @param UpdateExpense TypesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExpenseTypesRequest $request)
    {
        $expenseTypes = $this->expenseTypesRepository->find($id);

        if (empty($expenseTypes)) {
            Flash::error('Expense Types not found');

            return redirect(route('admin.expenseTypes.index'));
        }

        $expenseTypes = $this->expenseTypesRepository->update($request->all(), $id);

        Flash::success('Expense Types updated successfully.');

        return redirect(route('admin.expenseTypes.index'));
    }

    /**
     * Remove the specified Expense Types from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $expenseTypes = $this->expenseTypesRepository->find($id);

        if (empty($expenseTypes)) {
            Flash::error('Expense Types not found');

            return redirect(route('admin.expenseTypes.index'));
        }

        $this->expenseTypesRepository->delete($id);

        Flash::success('Expense Types deleted successfully.');

        return redirect(route('admin.expenseTypes.index'));
    }
}
