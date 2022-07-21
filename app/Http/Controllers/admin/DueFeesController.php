<?php

namespace App\Http\Controllers\admin;

use App\DataTables\Admin\DueFeesDataTable;
use App\DataTables\Admin\CorporateDueFeesDataTable;

use App\Http\Controllers\Controller;
use App\Models\Admin\Corporate;
use App\Models\Admin\Student;
use App\Models\User;
use App\Rule\CurrentPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class DueFeesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DueFeesDataTable $dueFeesDataTable, CorporateDueFeesDataTable $corporateDueFeesDataTable)
    {

        return $dueFeesDataTable->render('admin.due-fees.index');
        // return $corporateDueFeesDataTable->render('admin.due-fees.index');

    }
    public function searchRecord()
    {
      if(\request('type') == 'Retail Training'){
        $student = Student::where('mobile_no',\request('mobile'))->first();

//        if ($student){
//            if ($student->due_payment > 0){
//                $duePay = true;
//            }else{
//                $duePay = false;
//            }
            return response()->json(['student'=>$student]);
//        }
      }
        if(\request('type') == 'Corporate Training'){
            $corporate = Corporate::where('contact_no',\request('mobile'))->first();
            if ($corporate){
                if ($corporate->due_payment > 0){
                    $duePay = true;
                }else{
                    $duePay = false;
                }
                return response()->json(['student'=>$student,'duePay'=>$duePay]);
            }
        }
    }


}
