<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateIncomeTypeRequest;
use App\Http\Requests\Admin\UpdateIncomeTypeRequest;
use App\Repositories\Admin\IncomeTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class IncomeTypeController extends AppBaseController
{
    /** @var IncomeTypeRepository $incomeTypeRepository*/
    private $incomeTypeRepository;

    public function __construct(IncomeTypeRepository $incomeTypeRepo)
    {
        $this->incomeTypeRepository = $incomeTypeRepo;
    }

    /**
     * Display a listing of the IncomeType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $incomeTypes = $this->incomeTypeRepository->paginate(10);

        return view('admin.income_types.index')
            ->with('incomeTypes', $incomeTypes);
    }

    /**
     * Show the form for creating a new IncomeType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.income_types.create');
    }

    /**
     * Store a newly created IncomeType in storage.
     *
     * @param CreateIncomeTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateIncomeTypeRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $incomeType = $this->incomeTypeRepository->create($input);

        Flash::success('Income Type saved successfully.');

        return redirect(route('admin.incomeTypes.index'));
    }

    /**
     * Display the specified IncomeType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $incomeType = $this->incomeTypeRepository->find($id);

        if (empty($incomeType)) {
            Flash::error('Income Type not found');

            return redirect(route('admin.incomeTypes.index'));
        }

        return view('admin.income_types.show')->with('incomeType', $incomeType);
    }

    /**
     * Show the form for editing the specified IncomeType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $incomeType = $this->incomeTypeRepository->find($id);

        if (empty($incomeType)) {
            Flash::error('Income Type not found');

            return redirect(route('admin.incomeTypes.index'));
        }

        return view('admin.income_types.edit')->with('incomeType', $incomeType);
    }

    /**
     * Update the specified IncomeType in storage.
     *
     * @param int $id
     * @param UpdateIncomeTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIncomeTypeRequest $request)
    {
        $incomeType = $this->incomeTypeRepository->find($id);

        if (empty($incomeType)) {
            Flash::error('Income Type not found');

            return redirect(route('admin.incomeTypes.index'));
        }

        $incomeType = $this->incomeTypeRepository->update($request->all(), $id);

        Flash::success('Income Type updated successfully.');

        return redirect(route('admin.incomeTypes.index'));
    }

    /**
     * Remove the specified IncomeType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $incomeType = $this->incomeTypeRepository->find($id);

        if (empty($incomeType)) {
            Flash::error('Income Type not found');

            return redirect(route('admin.incomeTypes.index'));
        }

        $this->incomeTypeRepository->delete($id);

        Flash::success('Income Type deleted successfully.');

        return redirect(route('admin.incomeTypes.index'));
    }
}
