<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateBatchTypeRequest;
use App\Http\Requests\Admin\UpdateBatchTypeRequest;
use App\Repositories\Admin\BatchTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BatchTypeController extends AppBaseController
{
    /** @var BatchTypeRepository $batchTypeRepository*/
    private $batchTypeRepository;

    public function __construct(BatchTypeRepository $batchTypeRepo)
    {
        $this->batchTypeRepository = $batchTypeRepo;
    }

    /**
     * Display a listing of the BatchType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $batchTypes = $this->batchTypeRepository->paginate(10);

        return view('admin.batch_types.index')
            ->with('batchTypes', $batchTypes);
    }

    /**
     * Show the form for creating a new BatchType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.batch_types.create');
    }

    /**
     * Store a newly created BatchType in storage.
     *
     * @param CreateBatchTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateBatchTypeRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $batchType = $this->batchTypeRepository->create($input);

        Flash::success('Batch Type saved successfully.');

        return redirect(route('admin.batchTypes.index'));
    }

    /**
     * Display the specified BatchType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $batchType = $this->batchTypeRepository->find($id);

        if (empty($batchType)) {
            Flash::error('Batch Type not found');

            return redirect(route('admin.batchTypes.index'));
        }

        return view('admin.batch_types.show')->with('batchType', $batchType);
    }

    /**
     * Show the form for editing the specified BatchType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $batchType = $this->batchTypeRepository->find($id);

        if (empty($batchType)) {
            Flash::error('Batch Type not found');

            return redirect(route('admin.batchTypes.index'));
        }

        return view('admin.batch_types.edit')->with('batchType', $batchType);
    }

    /**
     * Update the specified BatchType in storage.
     *
     * @param int $id
     * @param UpdateBatchTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBatchTypeRequest $request)
    {
        $batchType = $this->batchTypeRepository->find($id);

        if (empty($batchType)) {
            Flash::error('Batch Type not found');

            return redirect(route('admin.batchTypes.index'));
        }

        $batchType = $this->batchTypeRepository->update($request->all(), $id);

        Flash::success('Batch Type updated successfully.');

        return redirect(route('admin.batchTypes.index'));
    }

    /**
     * Remove the specified BatchType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $batchType = $this->batchTypeRepository->find($id);

        if (empty($batchType)) {
            Flash::error('Batch Type not found');

            return redirect(route('admin.batchTypes.index'));
        }

        $this->batchTypeRepository->delete($id);

        Flash::success('Batch Type deleted successfully.');

        return redirect(route('admin.batchTypes.index'));
    }
}
