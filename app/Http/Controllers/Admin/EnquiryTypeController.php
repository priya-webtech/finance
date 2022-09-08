<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateEnquiryTypeRequest;
use App\Http\Requests\Admin\UpdateEnquiryTypeRequest;
use App\Repositories\Admin\EnquiryTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class EnquiryTypeController extends AppBaseController
{
    /** @var EnquiryTypeRepository $enquiryTypeRepository*/
    private $enquiryTypeRepository;

    public function __construct(EnquiryTypeRepository $enquiryTypeRepo)
    {
        $this->enquiryTypeRepository = $enquiryTypeRepo;
    }

    /**
     * Display a listing of the EnquiryType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $enquiryTypes = $this->enquiryTypeRepository->paginate(10);

        return view('admin.enquiry_types.index')
            ->with('enquiryTypes', $enquiryTypes);
    }

    /**
     * Show the form for creating a new EnquiryType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.enquiry_types.create');
    }

    /**
     * Store a newly created EnquiryType in storage.
     *
     * @param CreateEnquiryTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateEnquiryTypeRequest $request)
    {

        $input = $request->all();
        $input['status'] = 1;
        $enquiryType = $this->enquiryTypeRepository->create($input);

        Flash::success('Enquiry Type saved successfully.');

        return redirect(route('admin.enquiryTypes.index'));
    }

    /**
     * Display the specified EnquiryType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $enquiryType = $this->enquiryTypeRepository->find($id);

        if (empty($enquiryType)) {
            Flash::error('Enquiry Type not found');

            return redirect(route('admin.enquiryTypes.index'));
        }

        return view('admin.enquiry_types.show')->with('enquiryType', $enquiryType);
    }

    /**
     * Show the form for editing the specified EnquiryType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $enquiryType = $this->enquiryTypeRepository->find($id);

        if (empty($enquiryType)) {
            Flash::error('Enquiry Type not found');

            return redirect(route('admin.enquiryTypes.index'));
        }

        return view('admin.enquiry_types.edit')->with('enquiryType', $enquiryType);
    }

    /**
     * Update the specified EnquiryType in storage.
     *
     * @param int $id
     * @param UpdateEnquiryTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEnquiryTypeRequest $request)
    {
        $enquiryType = $this->enquiryTypeRepository->find($id);

        if (empty($enquiryType)) {
            Flash::error('Enquiry Type not found');

            return redirect(route('admin.enquiryTypes.index'));
        }

        $enquiryType = $this->enquiryTypeRepository->update($request->all(), $id);

        Flash::success('Enquiry Type updated successfully.');

        return redirect(route('admin.enquiryTypes.index'));
    }

    /**
     * Remove the specified EnquiryType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $enquiryType = $this->enquiryTypeRepository->find($id);

        if (empty($enquiryType)) {
            Flash::error('Enquiry Type not found');

            return redirect(route('admin.enquiryTypes.index'));
        }

        $this->enquiryTypeRepository->delete($id);

        Flash::success('Enquiry Type deleted successfully.');

        return redirect(route('admin.enquiryTypes.index'));
    }
}
