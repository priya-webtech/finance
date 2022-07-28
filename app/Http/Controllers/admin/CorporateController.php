<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateCorporateRequest;
use App\Http\Requests\Admin\UpdateCorporateRequest;
use App\Models\Admin\Batch;
use App\Models\Admin\Branch;
use App\Models\Admin\Corporate;
use App\Models\Admin\EnquiryType;
use App\Models\Admin\LeadSources;
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
//        $corporates = $this->corporateRepository->paginate(10);
        $auth =Auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $corporates = Corporate::paginate(10);
        }elseif ($auth->hasRole('branch_manager')){
            $corporates = Corporate::where('branch_id',$auth->branch_id)->paginate(10);
        }
        return view('admin.corporates.index')
            ->with('corporates', $corporates);
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
