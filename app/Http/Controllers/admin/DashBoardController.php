<?php

namespace App\Http\Controllers\admin;

use App\DataTables\Admin\CarmodelDataTable;
use App\Http\Requests\Admin;
use App\Models\User;
use App\Models\Admin\Branch;
use App\Http\Requests\Admin\CreateCarmodelRequest;
use App\Http\Requests\Admin\UpdateCarmodelRequest;
use App\Repositories\Admin\CarmodelRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DashBoardController extends AppBaseController
{
    /** @var CarmodelRepository $carmodelRepository*/
//    private $carmodelRepository;
//
//    public function __construct(CarmodelRepository $carmodelRepo)
//    {
//        $this->carmodelRepository = $carmodelRepo;
//    }

    /**
     * Display a listing of the Carmodel.
     *
     * @param CarmodelDataTable $carmodelDataTable
     *
     * @return Response
     */
    public function index()
    {
       // dd(auth()->user()->role_id);
        if(auth()->user()->role_id == 1){
            $user =  User::count();
            $branch =  Branch::count();
             return view('admin.dashboard.dashboard',compact('user','branch'));
        }elseif (auth()->user()->role_id == 2) {
            return view('admin.dashboard.dashboard-admin');
        }elseif (auth()->user()->role_id == 3) {
            return view('admin.dashboard.dashboard-branch-manager');
        }elseif (auth()->user()->role_id == 4) {
            return view('admin.dashboard.dashboard-counsellor');
        }elseif (auth()->user()->role_id == 5) {
            return view('admin.dashboard.dashboard-internal-auditor');
        }elseif (auth()->user()->role_id == 6) {
            return view('admin.dashboard.dashboard-student-co-ordinator');
        }elseif (auth()->user()->role_id == 0) {
            $user =  User::count();
            $branch =  Branch::count();
            return view('admin.dashboard.dashboard',compact('user','branch'));
        }else{
            return view('admin.dashboard.dashboard');
        }
    }


}
