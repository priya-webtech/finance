<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateBatchModeRequest;
use App\Http\Requests\Admin\UpdateBatchModeRequest;
use App\Repositories\Admin\BatchModeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BatchModeController extends AppBaseController
{
    /** @var BatchModeRepository $batchModeRepository*/
    private $batchModeRepository;

    public function __construct(BatchModeRepository $batchModeRepo)
    {
        $this->batchModeRepository = $batchModeRepo;
    }

    /**
     * Display a listing of the BatchMode.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $batchModes = $this->batchModeRepository->paginate(10);

        return view('admin.batch_modes.index')
            ->with('batchModes', $batchModes);
    }

    /**
     * Show the form for creating a new BatchMode.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.batch_modes.create');
    }

    /**
     * Store a newly created BatchMode in storage.
     *
     * @param CreateBatchModeRequest $request
     *
     * @return Response
     */
    public function store(CreateBatchModeRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $batchMode = $this->batchModeRepository->create($input);

        Flash::success('Batch Mode saved successfully.');

        return redirect(route('admin.batchModes.index'));
    }

    /**
     * Display the specified BatchMode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $batchMode = $this->batchModeRepository->find($id);

        if (empty($batchMode)) {
            Flash::error('Batch Mode not found');

            return redirect(route('admin.batchModes.index'));
        }

        return view('admin.batch_modes.show')->with('batchMode', $batchMode);
    }

    /**
     * Show the form for editing the specified BatchMode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $batchMode = $this->batchModeRepository->find($id);

        if (empty($batchMode)) {
            Flash::error('Batch Mode not found');

            return redirect(route('admin.batchModes.index'));
        }

        return view('admin.batch_modes.edit')->with('batchMode', $batchMode);
    }

    /**
     * Update the specified BatchMode in storage.
     *
     * @param int $id
     * @param UpdateBatchModeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBatchModeRequest $request)
    {
        $batchMode = $this->batchModeRepository->find($id);

        if (empty($batchMode)) {
            Flash::error('Batch Mode not found');

            return redirect(route('admin.batchModes.index'));
        }

        $batchMode = $this->batchModeRepository->update($request->all(), $id);

        Flash::success('Batch Mode updated successfully.');

        return redirect(route('admin.batchModes.index'));
    }

    /**
     * Remove the specified BatchMode from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $batchMode = $this->batchModeRepository->find($id);

        if (empty($batchMode)) {
            Flash::error('Batch Mode not found');

            return redirect(route('admin.batchModes.index'));
        }

        $this->batchModeRepository->delete($id);

        Flash::success('Batch Mode deleted successfully.');

        return redirect(route('admin.batchModes.index'));
    }
}
