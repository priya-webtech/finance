<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateFranchiseRequest;
use App\Http\Requests\Admin\UpdateFranchiseRequest;
use App\Repositories\Admin\FranchiseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FranchiseController extends AppBaseController
{
    /** @var FranchiseRepository $franchiseRepository*/
    private $franchiseRepository;

    public function __construct(FranchiseRepository $franchiseRepo)
    {
        $this->franchiseRepository = $franchiseRepo;
    }

    /**
     * Display a listing of the Franchise.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $franchises = $this->franchiseRepository->paginate(10);

        return view('admin.franchises.index')
            ->with('franchises', $franchises);
    }

    /**
     * Show the form for creating a new Franchise.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.franchises.create');
    }

    /**
     * Store a newly created Franchise in storage.
     *
     * @param CreateFranchiseRequest $request
     *
     * @return Response
     */
    public function store(CreateFranchiseRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $franchise = $this->franchiseRepository->create($input);

        Flash::success('Franchise saved successfully.');

        return redirect(route('admin.franchises.index'));
    }

    /**
     * Display the specified Franchise.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $franchise = $this->franchiseRepository->find($id);

        if (empty($franchise)) {
            Flash::error('Franchise not found');

            return redirect(route('admin.franchises.index'));
        }

        return view('admin.franchises.show')->with('franchise', $franchise);
    }

    /**
     * Show the form for editing the specified Franchise.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $franchise = $this->franchiseRepository->find($id);

        if (empty($franchise)) {
            Flash::error('Franchise not found');

            return redirect(route('admin.franchises.index'));
        }

        return view('admin.franchises.edit')->with('franchise', $franchise);
    }

    /**
     * Update the specified Franchise in storage.
     *
     * @param int $id
     * @param UpdateFranchiseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFranchiseRequest $request)
    {
        $franchise = $this->franchiseRepository->find($id);

        if (empty($franchise)) {
            Flash::error('Franchise not found');

            return redirect(route('admin.franchises.index'));
        }

        $franchise = $this->franchiseRepository->update($request->all(), $id);

        Flash::success('Franchise updated successfully.');

        return redirect(route('admin.franchises.index'));
    }

    /**
     * Remove the specified Franchise from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $franchise = $this->franchiseRepository->find($id);

        if (empty($franchise)) {
            Flash::error('Franchise not found');

            return redirect(route('admin.franchises.index'));
        }

        $this->franchiseRepository->delete($id);

        Flash::success('Franchise deleted successfully.');

        return redirect(route('admin.franchises.index'));
    }
}
