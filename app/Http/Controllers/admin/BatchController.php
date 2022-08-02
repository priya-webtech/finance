<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateBatchRequest;
use App\Http\Requests\Admin\UpdateBatchRequest;
use App\Models\Admin\Batch;
use App\Models\Admin\BatchMode;
use App\Models\Admin\BatchType;
use App\Models\Admin\Course;
use App\Models\Admin\Trainer;
use App\Models\Admin\columnManage;
use App\Repositories\Admin\BatchRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class BatchController extends AppBaseController
{
    /** @var BatchRepository $batchRepository*/
    private $batchRepository;

    public function __construct(BatchRepository $batchRepo)
    {
        $this->batchRepository = $batchRepo;
    }

    /**
     * Display a listing of the Batch.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $batches = $this->batchRepository->paginate(10);
        $course =  Course::where('status',1)->pluck('course_name','id');
        $batchMode =  BatchMode::where('status',1)->pluck('title','id');
        $trainer =  Trainer::where('status',1)->pluck('trainer_name','id');
        $batchType = BatchType::where('status',1)->pluck('title','id');
        $columnManage = columnManage::where('table_name','batch')->where('role_id',auth()->user()->role_id)->first();

        $auth =Auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $batches = Batch::paginate(10);
        }else{
            $batches = Batch::whereHas('course', function($q) use($auth){
                $q->where('branch_id', $auth->branch_id);
            })->paginate(10);
        }
        return view('admin.batches.index',compact('course','batchMode','trainer','batchType','columnManage'))
            ->with('batches', $batches);
    }

    public function batchcolums(Request $request)
    {
        $columnManage = columnManage::where('table_name',$request->batch)->where('role_id',auth()->user()->role_id)->first();

        if($columnManage){  

            $field = json_decode($columnManage->field_status); 
            $storejson = array(
                'batch_col_1' => ($request->batch_col_1) ? 1 : null,
                'batch_col_2' => ($request->batch_col_2) ? 1 : null,
                'batch_col_3' => ($request->batch_col_3) ? 1 : null,
                'batch_col_4' => ($request->batch_col_4) ? 1 : null,
                'batch_col_5' => ($request->batch_col_5) ? 1 : null,
                'batch_col_6' => ($request->batch_col_6) ? 1 : null,
                'batch_col_7' => ($request->batch_col_7) ? 1 : null,
                'batch_col_8' => ($request->batch_col_8) ? 1 : null, 
            );

            columnManage::where('id', $columnManage['id'])->update(
                [
                'table_name' => $columnManage['table_name'],
                'field_status' => json_encode($storejson),
                'role_id' => $columnManage['role_id'],        
                ]

            );

        }else{
            $storejson = array('batch_col_1' => $request->batch_col_1,'batch_col_2' => $request->batch_col_2,'batch_col_3' => $request->batch_col_3,'batch_col_4' => $request->batch_col_4,'batch_col_5' => $request->batch_col_5,'batch_col_6' => $request->batch_col_6,'batch_col_7' => $request->batch_col_7,'batch_col_8' => $request->batch_col_8);

             columnManage::insert([
                'table_name' => $request->batch,
                'field_status' => json_encode($storejson),
                'role_id' => auth()->user()->role_id,
             ]);

        }
    }

    public function filter(Request $request)
    {

        $columnManage = columnManage::where('table_name','batch')->where('role_id',auth()->user()->role_id)->first();
        $course =  Course::where('status',1)->pluck('course_name','id');
        $batchMode =  BatchMode::where('status',1)->pluck('title','id');
        $trainer =  Trainer::where('status',1)->pluck('trainer_name','id');
        $batchType = BatchType::where('status',1)->pluck('title','id');
        
        $auth =Auth::user();
        if($request->batch_type_id || $request->trainer_id || $request->batch_mode_id || $request->course_id){

            if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
                $batches = Batch::orWhere('course_id',$request->course_id)->orWhere('batch_mode_id',$request->batch_mode_id)->orWhere('trainer_id',$request->trainer_id)->orWhere('batch_type_id',$request->batch_type_id)->paginate(10);
            }else{
                $batches = Batch::orWhere('course_id',$request->course_id)->orWhere('batch_mode_id',$request->batch_mode_id)->orWhere('trainer_id',$request->trainer_id)->orWhere('batch_type_id',$request->batch_type_id)->whereHas('course', function($q) use($auth){
                    $q->where('branch_id', $auth->branch_id);
                })->paginate(10);
            }
        }else{

            if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $batches = Batch::paginate(10);
            }else{
                $batches = Batch::whereHas('course', function($q) use($auth){
                    $q->where('branch_id', $auth->branch_id);
                })->paginate(10);
            }

        }
        return view('admin.batches.index',compact('course','batchMode','trainer','batchType','columnManage'))
            ->with('batches', $batches);
    }

    /**
     * Show the form for creating a new Batch.
     *
     * @return Response
     */
    public function create()
    {
        $course =  Course::where('status',1)->pluck('course_name','id');
        $batchMode =  BatchMode::where('status',1)->pluck('title','id');
        $trainer =  Trainer::where('status',1)->pluck('trainer_name','id');
        $batchType = BatchType::where('status',1)->pluck('title','id');
        return view('admin.batches.create',compact('course','batchMode','trainer','batchType'));
    }

    /**
     * Store a newly created Batch in storage.
     *
     * @param CreateBatchRequest $request
     *
     * @return Response
     */
    public function store(CreateBatchRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $batch = $this->batchRepository->create($input);

        Flash::success('Batch saved successfully.');

        return redirect(route('admin.batches.index'));
    }

    /**
     * Display the specified Batch.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $batch = $this->batchRepository->find($id);

        if (empty($batch)) {
            Flash::error('Batch not found');

            return redirect(route('admin.batches.index'));
        }

        return view('admin.batches.show')->with('batch', $batch);
    }

    /**
     * Show the form for editing the specified Batch.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $batch = $this->batchRepository->find($id);

        if (empty($batch)) {
            Flash::error('Batch not found');

            return redirect(route('admin.batches.index'));
        }
        $course =  Course::where('status',1)->pluck('course_name','id');
        $batchMode =  BatchMode::where('status',1)->pluck('title','id');
        $trainer =  Trainer::where('status',1)->pluck('trainer_name','id');
        $batchType = BatchType::where('status',1)->pluck('title','id');
        return view('admin.batches.edit',compact('batch','course','batchMode','trainer','batchType'));
    }

    /**
     * Update the specified Batch in storage.
     *
     * @param int $id
     * @param UpdateBatchRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBatchRequest $request)
    {
        $batch = $this->batchRepository->find($id);

        if (empty($batch)) {
            Flash::error('Batch not found');

            return redirect(route('admin.batches.index'));
        }

        $batch = $this->batchRepository->update($request->all(), $id);

        Flash::success('Batch updated successfully.');

        return redirect(route('admin.batches.index'));
    }

    /**
     * Remove the specified Batch from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $batch = $this->batchRepository->find($id);

        if (empty($batch)) {
            Flash::error('Batch not found');

            return redirect(route('admin.batches.index'));
        }

        $this->batchRepository->delete($id);

        Flash::success('Batch deleted successfully.');

        return redirect(route('admin.batches.index'));
    }
}
