<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateTrainerRequest;
use App\Http\Requests\Admin\UpdateTrainerRequest;
use App\Models\Admin\Batch;
use App\Models\Admin\StudentBatchDetail;
use App\Models\Admin\columnManage;
use App\Models\Admin\Branch;
use App\Models\Admin\Trainer;
use App\Models\Admin\Course;
use App\Models\Admin\ExpenceMaster;
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
        $auth =Auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $trainers = Trainer::when(request('dates'), function ($q) {
            $part = explode("-",request('dates'));
            $start = date('Y-m-d', strtotime($part[0]));
            $end = date('Y-m-d', strtotime($part[1]));
            $q->whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end);
        })->paginate(10);
        }else{
            $trainers = Trainer::where('branch_id',$auth->branch_id)->when(request('dates'), function ($q) {
            $part = explode("-",request('dates'));
            $start = date('Y-m-d', strtotime($part[0]));
            $end = date('Y-m-d', strtotime($part[1]));
            $q->whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end);
        })->paginate(10);
        }
        $course = Course::get();

        $columnManage = columnManage::where('table_name','trainer')->where('role_id',auth()->user()->role_id)->first();
        $field = [];
        if($columnManage){
            $field = json_decode($columnManage->field_status);
        }

        return view('admin.trainers.index',compact('field','course'))
            ->with('trainers', $trainers);
    }

    public function getCourse()
    {

        $result = Course::where('branch_id',\request('batchID'))->pluck('course_name','id');

        return response()->json($result);
    }

    public function trainercolums(Request $request)
    {
        $columnManage = columnManage::where('table_name',$request->trainer)->where('role_id',auth()->user()->role_id)->first();

        if($columnManage){

            $field = json_decode($columnManage->field_status);
            $storejson = array(
                'trainer_col_1' => ($request->trainer_col_1) ? 1 : null,
                'trainer_col_2' => ($request->trainer_col_2) ? 1 : null,
                'trainer_col_3' => ($request->trainer_col_3) ? 1 : null,
                'trainer_col_4' => ($request->trainer_col_4) ? 1 : null,
                'trainer_col_5' => ($request->trainer_col_5) ? 1 : null,
                'trainer_col_6' => ($request->trainer_col_6) ? 1 : null,
                'trainer_col_7' => ($request->trainer_col_7) ? 1 : null,
                'trainer_col_8' => ($request->trainer_col_8) ? 1 : null,
            );

            columnManage::where('id', $columnManage['id'])->update(
                [
                'table_name' => $columnManage['table_name'],
                'field_status' => json_encode($storejson),
                'role_id' => $columnManage['role_id'],
                ]

            );

        }else{
            $storejson = array('trainer_col_1' => $request->trainer_col_1,'trainer_col_2' => $request->trainer_col_2,'trainer_col_3' => $request->trainer_col_3,'trainer_col_4' => $request->trainer_col_4,'trainer_col_5' => $request->trainer_col_5,'trainer_col_6' => $request->trainer_col_6,'trainer_col_7' => $request->trainer_col_7,'trainer_col_8' => $request->trainer_col_8 );

             columnManage::insert([
                'table_name' => $request->trainer,
                'field_status' => json_encode($storejson),
                'role_id' => auth()->user()->role_id,
             ]);

        }
    }

    /**
     * Show the form for creating a new Trainer.
     *
     * @return Response
     */
    public function create()
    {
        $auth = Auth::user();
        //$course =  Course::where('status',1)->pluck('course_name','id');
        $branch = Branch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('id', '=', $auth->branch_id);
            }
        })->pluck('title', 'id');
        $course = Course::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('branch_id', '=', $auth->branch_id);
            }
        })->pluck('course_name','id');
        return view('admin.trainers.create',compact('branch','course'));
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
        $input['course_id'] = json_encode($input['course_id']);
        $input['status'] = 1;
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
        $studentcount = StudentBatchDetail::where('trainer_id', $id)->count();
        $studentbatch = StudentBatchDetail::where('trainer_id', $id)->distinct()->get('batch_id');
        $studentfees = StudentBatchDetail::where('trainer_id', $id)->distinct()->sum('trainer_fees');;
        $ExpenceMaster = ExpenceMaster::where('trainer_id', $id)->distinct()->sum('amount');;

        if (empty($trainer)) {
            Flash::error('Trainer not found');

            return redirect(route('admin.trainers.index'));
        }

        return view('admin.trainers.show',compact('trainer','studentbatch','studentcount','studentfees','ExpenceMaster'));
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
        $auth = Auth::user();
        $trainer = $this->trainerRepository->find($id);

        if (empty($trainer)) {
            Flash::error('Trainer not found');
            return redirect(route('admin.trainers.index'));
        }
        $branch = Branch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('id', '=', $auth->branch_id);
            }
        })->pluck('title', 'id');


        $course = Course::where('branch_id', '=', $trainer->branch_id)->where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('branch_id', '=', $auth->branch_id);
            }
        })->pluck('course_name','id');
        return view('admin.trainers.edit',compact('trainer','branch','course'));
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
