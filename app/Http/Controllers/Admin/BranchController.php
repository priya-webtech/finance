<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateBranchRequest;
use App\Http\Requests\Admin\UpdateBranchRequest;
use App\Repositories\Admin\BranchRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BranchController extends AppBaseController
{
    /** @var BranchRepository $branchRepository*/
    private $branchRepository;

    public function __construct(BranchRepository $branchRepo)
    {
        $this->branchRepository = $branchRepo;
    }

    /**
     * Display a listing of the Branch.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $branches = $this->branchRepository->paginate(10);

        return view('admin.branches.index')
            ->with('branches', $branches);
    }

    /**
     * Show the form for creating a new Branch.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.branches.create');
    }

    /**
     * Store a newly created Branch in storage.
     *
     * @param CreateBranchRequest $request
     *
     * @return Response
     */
    public function store(CreateBranchRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $branch = $this->branchRepository->create($input);

        Flash::success('Branch saved successfully.');

        return redirect(route('admin.branches.index'));
    }

    /**
     * Display the specified Branch.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            Flash::error('Branch not found');

            return redirect(route('admin.branches.index'));
        }

        return view('admin.branches.show')->with('branch', $branch);
    }

    /**
     * Show the form for editing the specified Branch.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            Flash::error('Branch not found');

            return redirect(route('admin.branches.index'));
        }

        return view('admin.branches.edit')->with('branch', $branch);
    }

    /**
     * Update the specified Branch in storage.
     *
     * @param int $id
     * @param UpdateBranchRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBranchRequest $request)
    {
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            Flash::error('Branch not found');

            return redirect(route('admin.branches.index'));
        }

        $branch = $this->branchRepository->update($request->all(), $id);

        Flash::success('Branch updated successfully.');

        return redirect(route('admin.branches.index'));
    }

    /**
     * Remove the specified Branch from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            Flash::error('Branch not found');

            return redirect(route('admin.branches.index'));
        }

        $this->branchRepository->delete($id);

        Flash::success('Branch deleted successfully.');

        return redirect(route('admin.branches.index'));
    }
}
