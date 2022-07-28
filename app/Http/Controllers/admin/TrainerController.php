<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateTrainerRequest;
use App\Http\Requests\Admin\UpdateTrainerRequest;
use App\Models\Admin\Batch;
use App\Models\Admin\Branch;
use App\Models\Admin\Trainer;
use App\Models\User;
use App\Repositories\Admin\TrainerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Response;

class TrainerController extends AppBaseController
{
    /** @var TrainerRepository $trainerRepository*/
    private $trainerRepository;

    public function __construct(TrainerRepository $trainerRepo)
    {
        $this->trainerRepository = $trainerRepo;
    }

    /**
     * Display a listing of the Trainer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
//        $trainers = $this->trainerRepository->paginate(10);
        $auth =Auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $trainers = Trainer::paginate(10);
        }elseif ($auth->hasRole('branch_manager')){
            $trainers = Trainer::where('branch_id',$auth->branch_id)->paginate(10);
        }
        return view('admin.trainers.index')
            ->with('trainers', $trainers);
    }

    /**
     * Show the form for creating a new Trainer.
     *
     * @return Response
     */
    public function create()
    {
      //  $batch  = Batch::where('status',1)->pluck('name','id');
        $branch = Branch::where('status',1)->pluck('title','id');
        return view('admin.trainers.create',compact('branch'));
    }

    /**
     * Store a newly created Trainer in storage.
     *
     * @param CreateTrainerRequest $request
     *
     * @return Response
     */
    public function store(CreateTrainerRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;

        /*if ($request->hasFile("profile_pic")) {
            $img = $request->file("profile_pic");
            $img->store('public/trainer');
            $input['profile_pic'] = $img->hashName();
        }*/
        $input['created_by'] = Auth::id();
        $trainer = $this->trainerRepository->create($input);

        Flash::success('Trainer saved successfully.');

        return redirect(route('admin.trainers.index'));
    }

    /**
     * Display the specified Trainer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $trainer = $this->trainerRepository->find($id);

        if (empty($trainer)) {
            Flash::error('Trainer not found');

            return redirect(route('admin.trainers.index'));
        }

        return view('admin.trainers.show')->with('trainer', $trainer);
    }

    /**
     * Show the form for editing the specified Trainer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $trainer = $this->trainerRepository->find($id);

        if (empty($trainer)) {
            Flash::error('Trainer not found');
            return redirect(route('admin.trainers.index'));
        }
        //$batch  = Batch::where('status',1)->pluck('name','id');
        $branch = Branch::where('status',1)->pluck('title','id');
        return view('admin.trainers.edit',compact('trainer','branch'));
    }

    /**
     * Update the specified Trainer in storage.
     *
     * @param int $id
     * @param UpdateTrainerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTrainerRequest $request)
    {
        $trainer = $this->trainerRepository->find($id);
       $input = $request->all();
        if (empty($trainer)) {
            Flash::error('Trainer not found');

            return redirect(route('admin.trainers.index'));
        }
        /*if ($request->hasFile("profile_pic")) {
            $img = $request->file("profile_pic");
            if (Storage::exists('/public/trainer/' . $trainer->profile_pic)) {
                Storage::delete('/public/trainer/' . $trainer->profile_pic);
            }
            $img->store('public/trainer');
            $input['profile_pic'] = $img->hashName();
        }*/
        $input['updated_by'] = Auth::id();
        $trainer = $this->trainerRepository->update($input, $id);

        Flash::success('Trainer updated successfully.');

        return redirect(route('admin.trainers.index'));
    }

    /**
     * Remove the specified Trainer from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $trainer = $this->trainerRepository->find($id);

        if (empty($trainer)) {
            Flash::error('Trainer not found');

            return redirect(route('admin.trainers.index'));
        }

        $this->trainerRepository->delete($id);

        Flash::success('Trainer deleted successfully.');

        return redirect(route('admin.trainers.index'));
    }
}
