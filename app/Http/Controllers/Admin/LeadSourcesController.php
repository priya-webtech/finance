<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateLeadSourcesRequest;
use App\Http\Requests\Admin\UpdateLeadSourcesRequest;
use App\Repositories\Admin\LeadSourcesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class LeadSourcesController extends AppBaseController
{
    /** @var LeadSourcesRepository $leadSourcesRepository*/
    private $leadSourcesRepository;

    public function __construct(LeadSourcesRepository $leadSourcesRepo)
    {
        $this->leadSourcesRepository = $leadSourcesRepo;
    }

    /**
     * Display a listing of the LeadSources.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $leadSources = $this->leadSourcesRepository->paginate(10);

        return view('admin.lead_sources.index')
            ->with('leadSources', $leadSources);
    }

    /**
     * Show the form for creating a new LeadSources.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.lead_sources.create');
    }

    /**
     * Store a newly created LeadSources in storage.
     *
     * @param CreateLeadSourcesRequest $request
     *
     * @return Response
     */
    public function store(CreateLeadSourcesRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $leadSources = $this->leadSourcesRepository->create($input);

        Flash::success('Lead Sources saved successfully.');

        return redirect(route('admin.leadSources.index'));
    }

    /**
     * Display the specified LeadSources.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $leadSources = $this->leadSourcesRepository->find($id);

        if (empty($leadSources)) {
            Flash::error('Lead Sources not found');

            return redirect(route('admin.leadSources.index'));
        }

        return view('admin.lead_sources.show')->with('leadSources', $leadSources);
    }

    /**
     * Show the form for editing the specified LeadSources.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $leadSources = $this->leadSourcesRepository->find($id);

        if (empty($leadSources)) {
            Flash::error('Lead Sources not found');

            return redirect(route('admin.leadSources.index'));
        }

        return view('admin.lead_sources.edit')->with('leadSources', $leadSources);
    }

    /**
     * Update the specified LeadSources in storage.
     *
     * @param int $id
     * @param UpdateLeadSourcesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLeadSourcesRequest $request)
    {
        $leadSources = $this->leadSourcesRepository->find($id);

        if (empty($leadSources)) {
            Flash::error('Lead Sources not found');

            return redirect(route('admin.leadSources.index'));
        }

        $leadSources = $this->leadSourcesRepository->update($request->all(), $id);

        Flash::success('Lead Sources updated successfully.');

        return redirect(route('admin.leadSources.index'));
    }

    /**
     * Remove the specified LeadSources from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $leadSources = $this->leadSourcesRepository->find($id);

        if (empty($leadSources)) {
            Flash::error('Lead Sources not found');

            return redirect(route('admin.leadSources.index'));
        }

        $this->leadSourcesRepository->delete($id);

        Flash::success('Lead Sources deleted successfully.');

        return redirect(route('admin.leadSources.index'));
    }
}
