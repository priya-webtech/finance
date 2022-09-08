<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateRevenueTypeRequest;
use App\Http\Requests\Admin\UpdateRevenueTypeRequest;
use App\Repositories\Admin\RevenueTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class RevenueTypeController extends AppBaseController
{
    /** @var RevenueTypeRepository $revenueTypeRepository*/
    private $revenueTypeRepository;

    public function __construct(RevenueTypeRepository $revenueTypeRepo)
    {
        $this->revenueTypeRepository = $revenueTypeRepo;
    }

    /**
     * Display a listing of the RevenueType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $revenueTypes = $this->revenueTypeRepository->paginate(10);

        return view('admin.revenue_types.index')
            ->with('revenueTypes', $revenueTypes);
    }

    /**
     * Show the form for creating a new RevenueType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.revenue_types.create');
    }

    /**
     * Store a newly created RevenueType in storage.
     *
     * @param CreateRevenueTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateRevenueTypeRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $revenueType = $this->revenueTypeRepository->create($input);

        Flash::success('Revenue Type saved successfully.');

        return redirect(route('admin.revenueTypes.index'));
    }

    /**
     * Display the specified RevenueType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $revenueType = $this->revenueTypeRepository->find($id);

        if (empty($revenueType)) {
            Flash::error('Revenue Type not found');

            return redirect(route('admin.revenueTypes.index'));
        }

        return view('admin.revenue_types.show')->with('revenueType', $revenueType);
    }

    /**
     * Show the form for editing the specified RevenueType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $revenueType = $this->revenueTypeRepository->find($id);

        if (empty($revenueType)) {
            Flash::error('Revenue Type not found');

            return redirect(route('admin.revenueTypes.index'));
        }

        return view('admin.revenue_types.edit')->with('revenueType', $revenueType);
    }

    /**
     * Update the specified RevenueType in storage.
     *
     * @param int $id
     * @param UpdateRevenueTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRevenueTypeRequest $request)
    {
        $revenueType = $this->revenueTypeRepository->find($id);

        if (empty($revenueType)) {
            Flash::error('Revenue Type not found');

            return redirect(route('admin.revenueTypes.index'));
        }

        $revenueType = $this->revenueTypeRepository->update($request->all(), $id);

        Flash::success('Revenue Type updated successfully.');

        return redirect(route('admin.revenueTypes.index'));
    }

    /**
     * Remove the specified RevenueType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $revenueType = $this->revenueTypeRepository->find($id);

        if (empty($revenueType)) {
            Flash::error('Revenue Type not found');

            return redirect(route('admin.revenueTypes.index'));
        }

        $this->revenueTypeRepository->delete($id);

        Flash::success('Revenue Type deleted successfully.');

        return redirect(route('admin.revenueTypes.index'));
    }
}
