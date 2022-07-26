<?php

namespace App\Http\Controllers\admin;

use App\DataTables\Admin\DueFeesDataTable;
use App\DataTables\Admin\CorporateDueFeesDataTable;

use App\Http\Controllers\Controller;
use App\Models\Admin\Corporate;
use App\Models\Admin\CorporateDetail;
use App\Models\Admin\Student;
use App\Models\Admin\StudentDetail;
use App\Models\Admin\Branch;
use App\Models\Admin\ModeOfPayment;
use App\Models\Admin\Course;
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
    public function index(DueFeesDataTable $dueFeesDataTable)
    {
        return $dueFeesDataTable->render('admin.due-fees.index');
    }

    public function edit($id,$type)
    {
        if ($type == 'Corporate'){
         $user =  Corporate::with('branch')->findorfail($id);
         $userdetail =  CorporateDetail::with('course')->where('corporate_id',$id)->get();
        }elseif($type == 'Student'){
         $user = Student::findorfail($id);
         $userdetail =  StudentDetail::with('course')->where('StudentDetail',$id)->get();
        }
        $branch = Branch::pluck('title','id');
        $course = Course::pluck('course_name','id');
        $bank = ModeOfPayment::pluck('name','id');

     //   dd($userdetail[0]['course']['course_name']);
     return view('admin.due-fees.edit',compact('user','type','userdetail','branch','course','bank'));
    }
    public function corpodatatable(CorporateDueFeesDataTable $corporateDueFeesDataTable)
    {
        return $corporateDueFeesDataTable->render('admin.due-fees.copro-table');
    }
    public function searchRecord()
    {
      if(\request('type') == 'Retail Training'){
        $student = Student::where('mobile_no',\request('mobile'))->first();
        return response()->json(['student'=>$student]);
      }
        if(\request('type') == 'Corporate Training'){
            $student = Corporate::where('contact_no',\request('mobile'))->first();
            return response()->json(['student'=>$student]);
        }
    }


}
