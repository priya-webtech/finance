<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateTrainerFreeSlabRequest;
use App\Http\Requests\Admin\UpdateTrainerFreeSlabRequest;
use App\Models\Admin\Trainer;
use App\Repositories\Admin\TrainerFreeSlabRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TrainerFreeSlabController extends AppBaseController
{
    /** @var TrainerFreeSlabRepository $trainerFreeSlabRepository*/
    private $trainerFreeSlabRepository;

    public function __construct(TrainerFreeSlabRepository $trainerFreeSlabRepo)
    {
        $this->trainerFreeSlabRepository = $trainerFreeSlabRepo;
    }

    /**
     * Display a listing of the TrainerFreeSlab.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $trainerFreeSlabs = $this->trainerFreeSlabRepository->paginate(10);

        return view('admin.trainer_free_slabs.index')
            ->with('trainerFreeSlabs', $trainerFreeSlabs);
    }

    /**
     * Show the form for creating a new TrainerFreeSlab.
     *
     * @return Response
     */
    public function create()
    {
        $trainer = Trainer::where('status',1)->pluck('trainer_name','id');
        return view('admin.trainer_free_slabs.create',compact('trainer'));
    }

    /**
     * Store a newly created TrainerFreeSlab in storage.
     *
     * @param CreateTrainerFreeSlabRequest $request
     *
     * @return Response
     */
    public function store(CreateTrainerFreeSlabRequest $request)
    {
        $input = $request->all();

        $trainerFreeSlab = $this->trainerFreeSlabRepository->create($input);

        Flash::success('Trainer Free Slab saved successfully.');

        return redirect(route('admin.trainerFreeSlabs.index'));
    }

    /**
     * Display the specified TrainerFreeSlab.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $trainerFreeSlab = $this->trainerFreeSlabRepository->find($id);

        if (empty($trainerFreeSlab)) {
            Flash::error('Trainer Free Slab not found');

            return redirect(route('admin.trainerFreeSlabs.index'));
        }

        return view('admin.trainer_free_slabs.show')->with('trainerFreeSlab', $trainerFreeSlab);
    }

    /**
     * Show the form for editing the specified TrainerFreeSlab.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $trainerFreeSlab = $this->trainerFreeSlabRepository->find($id);

        if (empty($trainerFreeSlab)) {
            Flash::error('Trainer Free Slab not found');

            return redirect(route('admin.trainerFreeSlabs.index'));
        }
        $trainer = Trainer::where('status',1)->pluck('trainer_name','id');
        return view('admin.trainer_free_slabs.edit',compact('trainer','trainerFreeSlab'));
    }

    /**
     * Update the specified TrainerFreeSlab in storage.
     *
     * @param int $id
     * @param UpdateTrainerFreeSlabRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTrainerFreeSlabRequest $request)
    {
        $trainerFreeSlab = $this->trainerFreeSlabRepository->find($id);

        if (empty($trainerFreeSlab)) {
            Flash::error('Trainer Free Slab not found');

            return redirect(route('admin.trainerFreeSlabs.index'));
        }

        $trainerFreeSlab = $this->trainerFreeSlabRepository->update($request->all(), $id);

        Flash::success('Trainer Free Slab updated successfully.');

        return redirect(route('admin.trainerFreeSlabs.index'));
    }

    /**
     * Remove the specified TrainerFreeSlab from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $trainerFreeSlab = $this->trainerFreeSlabRepository->find($id);

        if (empty($trainerFreeSlab)) {
            Flash::error('Trainer Free Slab not found');

            return redirect(route('admin.trainerFreeSlabs.index'));
        }

        $this->trainerFreeSlabRepository->delete($id);

        Flash::success('Trainer Free Slab deleted successfully.');

        return redirect(route('admin.trainerFreeSlabs.index'));
    }
}
