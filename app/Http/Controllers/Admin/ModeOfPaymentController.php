<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateModeOfPaymentRequest;
use App\Http\Requests\Admin\UpdateModeOfPaymentRequest;
use App\Repositories\Admin\ModeOfPaymentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ModeOfPaymentController extends AppBaseController
{
    /** @var ModeOfPaymentRepository $modeOfPaymentRepository*/
    private $modeOfPaymentRepository;

    public function __construct(ModeOfPaymentRepository $modeOfPaymentRepo)
    {
        $this->modeOfPaymentRepository = $modeOfPaymentRepo;
    }

    /**
     * Display a listing of the ModeOfPayment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $modeOfPayments = $this->modeOfPaymentRepository->paginate(10);

        return view('admin.mode_of_payments.index')
            ->with('modeOfPayments', $modeOfPayments);
    }

    /**
     * Show the form for creating a new ModeOfPayment.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.mode_of_payments.create');
    }

    /**
     * Store a newly created ModeOfPayment in storage.
     *
     * @param CreateModeOfPaymentRequest $request
     *
     * @return Response
     */
    public function store(CreateModeOfPaymentRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $modeOfPayment = $this->modeOfPaymentRepository->create($input);

        Flash::success('Mode Of Payment saved successfully.');

        return redirect(route('admin.modeOfPayments.index'));
    }

    /**
     * Display the specified ModeOfPayment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modeOfPayment = $this->modeOfPaymentRepository->find($id);

        if (empty($modeOfPayment)) {
            Flash::error('Mode Of Payment not found');

            return redirect(route('admin.modeOfPayments.index'));
        }

        return view('admin.mode_of_payments.show')->with('modeOfPayment', $modeOfPayment);
    }

    /**
     * Show the form for editing the specified ModeOfPayment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modeOfPayment = $this->modeOfPaymentRepository->find($id);

        if (empty($modeOfPayment)) {
            Flash::error('Mode Of Payment not found');

            return redirect(route('admin.modeOfPayments.index'));
        }

        return view('admin.mode_of_payments.edit')->with('modeOfPayment', $modeOfPayment);
    }

    /**
     * Update the specified ModeOfPayment in storage.
     *
     * @param int $id
     * @param UpdateModeOfPaymentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModeOfPaymentRequest $request)
    {
        $modeOfPayment = $this->modeOfPaymentRepository->find($id);

        if (empty($modeOfPayment)) {
            Flash::error('Mode Of Payment not found');

            return redirect(route('admin.modeOfPayments.index'));
        }

        $modeOfPayment = $this->modeOfPaymentRepository->update($request->all(), $id);

        Flash::success('Mode Of Payment updated successfully.');

        return redirect(route('admin.modeOfPayments.index'));
    }

    /**
     * Remove the specified ModeOfPayment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $modeOfPayment = $this->modeOfPaymentRepository->find($id);

        if (empty($modeOfPayment)) {
            Flash::error('Mode Of Payment not found');

            return redirect(route('admin.modeOfPayments.index'));
        }

        $this->modeOfPaymentRepository->delete($id);

        Flash::success('Mode Of Payment deleted successfully.');

        return redirect(route('admin.modeOfPayments.index'));
    }
}
