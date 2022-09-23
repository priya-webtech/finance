<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateCorporateRequest;
use App\Http\Requests\Admin\UpdateCorporateRequest;
use App\Models\Admin\Batch;
use App\Models\Admin\Branch;
use App\Models\Admin\Corporate;
use App\Models\Admin\EnquiryType;
use App\Models\Admin\LeadSources;
use App\Models\Admin\columnManage;
use App\Models\Admin\Trainer;
use App\Repositories\Admin\CorporateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class CorporateController extends AppBaseController
{
    /** @var CorporateRepository $corporateRepository*/
    private $corporateRepository;

    public function __construct(CorporateRepository $corporateRepo)
    {
        $this->corporateRepository = $corporateRepo;
    }

    /**
     * Display a listing of the Corporate.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //$corporates = $this->corporateRepository->paginate(10);
        $enquiryType = EnquiryType::where('status',1)->pluck('title','id');
        $leadsouce =LeadSources::where('status',1)->pluck('title','id');
        $auth =Auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $corporates = Corporate::when(request('dates'), function ($q) {
            $part = explode("-",request('dates'));
            $start = date('Y-m-d', strtotime($part[0]));
            $end = date('Y-m-d', strtotime($part[1]));
            $q->whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end);
        })->paginate(10);
        }else{
            $corporates = Corporate::where('branch_id',$auth->branch_id)->when(request('dates'), function ($q) {
            $part = explode("-",request('dates'));
            $start = date('Y-m-d', strtotime($part[0]));
            $end = date('Y-m-d', strtotime($part[1]));
            $q->whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end);
        })->paginate(10);
        }

        $columnManage = columnManage::where('table_name','corporat')->where('role_id',auth()->user()->role_id)->first();
        $field = [];
        if($columnManage){ 
            $field = json_decode($columnManage->field_status); 
        }
        return view('admin.corporates.index',compact('leadsouce','enquiryType','field'))
            ->with('corporates', $corporates);
    }

    public function filter(Request $request)
    {
        // dd($request->enquiry_type_id);
       // $batches = $this->batchRepository->paginate(10);
        //$corporates = $this->corporateRepository->paginate(10);
        $enquiryType = EnquiryType::where('status',1)->pluck('title','id');
        $leadsouce =LeadSources::where('status',1)->pluck('title','id');
        $auth =Auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $corporates = Corporate::orWhere('enquiry_type_id',$request->enquiry_type_id)->orWhere('lead_source_id',$request->lead_source_id)->paginate(10);
        }else{
            //dd($auth->branch_id);
            //$corporates = Corporate::Where('branch_id',$auth->branch_id)->Where('enquiry_type_id','=',$request->enquiry_type_id)->orWhere('lead_source_id',$request->lead_source_id)->paginate(10);
            $corQuery=Corporate::query();
             $corQuery->where('branch_id',$auth->branch_id);
             $corporates  = $corQuery->where(function($query) use($request,$auth){
                            
                                       $query->where('enquiry_type_id',$request['enquiry_type_id'])
                                      ->orWhere('lead_source_id',$request['lead_source_id']);
                            })->paginate(10);
             

        }

        $columnManage = columnManage::where('table_name','corporat')->where('role_id',auth()->user()->role_id)->first();
        $field = [];
        if($columnManage){ 
            $field = json_decode($columnManage->field_status); 
        }

        return view('admin.corporates.index',compact('leadsouce','enquiryType','corporates','field'));
    }

    public function corporatecolums(Request $request)
    {
        $columnManage = columnManage::where('table_name',$request->corporat)->where('role_id',auth()->user()->role_id)->first();

        if($columnManage){  

            $field = json_decode($columnManage->field_status); 
            $storejson = array(
                'corporat_col_1' => ($request->corporat_col_1) ? 1 : null,
                'corporat_col_2' => ($request->corporat_col_2) ? 1 : null,
                'corporat_col_3' => ($request->corporat_col_3) ? 1 : null,
                'corporat_col_4' => ($request->corporat_col_4) ? 1 : null,
                'corporat_col_5' => ($request->corporat_col_5) ? 1 : null,
                'corporat_col_6' => ($request->corporat_col_6) ? 1 : null,
                'corporat_col_7' => ($request->corporat_col_7) ? 1 : null,
                'corporat_col_8' => ($request->corporat_col_8) ? 1 : null, 
            );

            columnManage::where('id', $columnManage['id'])->update(
                [
                'table_name' => $columnManage['table_name'],
                'field_status' => json_encode($storejson),
                'role_id' => $columnManage['role_id'],        
                ]

            );

        }else{
            $storejson = array('corporat_col_1' => $request->corporat_col_1,'corporat_col_2' => $request->corporat_col_2,'corporat_col_3' => $request->corporat_col_3,'corporat_col_4' => $request->corporat_col_4,'corporat_col_5' => $request->corporat_col_5,'corporat_col_6' => $request->corporat_col_6,'corporat_col_7' => $request->corporat_col_7,'corporat_col_8' => $request->corporat_col_8 );

             columnManage::insert([
                'table_name' => $request->corporat,
                'field_status' => json_encode($storejson),
                'role_id' => auth()->user()->role_id,
             ]);

        }
    }

    /**
     * Show the form for creating a new Corporate.
     *
     * @return Response
     */
    public function create()
    {
        $branch =Branch::where('status',1)->pluck('title','id');
        $batch =  Batch::where('status',1)->pluck('name','id');
        $leadsouce =LeadSources::where('status',1)->pluck('title','id');
        $enquiryType = EnquiryType::where('status',1)->pluck('title','id');
        return view('admin.corporates.create',compact('branch','batch','leadsouce','enquiryType'));
    }

    /**
     * Store a newly created Corporate in storage.
     *
     * @param CreateCorporateRequest $request
     *
     * @return Response
     */
    public function store(CreateCorporateRequest $request)
    {
        $input = $request->all();
        $input['status'] =1;
        $corporate = $this->corporateRepository->create($input);

        Flash::success('Corporate saved successfully.');

        return redirect(route('admin.corporates.index'));
    }

    /**
     * Display the specified Corporate.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $corporate = $this->corporateRepository->find($id);

        if (empty($corporate)) {
            Flash::error('Corporate not found');

            return redirect(route('admin.corporates.index'));
        }

        return view('admin.corporates.show')->with('corporate', $corporate);
    }

    /**
     * Show the form for editing the specified Corporate.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $corporate = $this->corporateRepository->find($id);

        if (empty($corporate)) {
            Flash::error('Corporate not found');

            return redirect(route('admin.corporates.index'));
        }
        $branch =Branch::where('status',1)->pluck('title','id');
        $batch =  Batch::where('status',1)->pluck('name','id');
        $leadsouce =LeadSources::where('status',1)->pluck('title','id');
        $enquiryType = EnquiryType::where('status',1)->pluck('title','id');
        return view('admin.corporates.edit',compact('branch','batch','leadsouce','enquiryType','corporate'));
    }

    /**
     * Update the specified Corporate in storage.
     *
     * @param int $id
     * @param UpdateCorporateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCorporateRequest $request)
    {
        $corporate = $this->corporateRepository->find($id);

        if (empty($corporate)) {
            Flash::error('Corporate not found');

            return redirect(route('admin.corporates.index'));
        }

        $corporate = $this->corporateRepository->update($request->all(), $id);

        Flash::success('Corporate updated successfully.');

        return redirect(route('admin.corporates.index'));
    }

    /**
     * Remove the specified Corporate from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $corporate = $this->corporateRepository->find($id);

        if (empty($corporate)) {
            Flash::error('Corporate not found');

            return redirect(route('admin.corporates.index'));
        }

        $this->corporateRepository->delete($id);

        Flash::success('Corporate deleted successfully.');

        return redirect(route('admin.corporates.index'));
    }
}
