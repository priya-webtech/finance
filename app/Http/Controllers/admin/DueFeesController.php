<?php

namespace App\Http\Controllers\admin;

use App\DataTables\Admin\DueFeesDataTable;
use App\DataTables\Admin\CorporateDueFeesDataTable;

use App\Http\Controllers\Controller;
use App\Models\Admin\Corporate;
use App\Models\Admin\CorporateDetail;
use App\Models\Admin\Income;
use App\Models\Admin\IncomeType;
use App\Models\Admin\Student;
use App\Models\Admin\StudentDetail;
use App\Models\Admin\Branch;
use App\Models\Admin\ModeOfPayment;
use App\Models\Admin\Course;
use App\Models\User;
use App\Rule\CurrentPassword;
use App\Models\Admin\columnManage;
use Carbon\Carbon;
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

        $columnManage = columnManage::where('table_name','due_fees')->where('role_id',auth()->user()->role_id)->first();
        $field = [];
        if($columnManage){
        $field = json_decode($columnManage->field_status);
        }

        return $dueFeesDataTable->render('admin.due-fees.index',compact('field'));
    }

    public function due_feescolums(Request $request)
    {
        $columnManage = columnManage::where('table_name',$request->due_fees)->where('role_id',auth()->user()->role_id)->first();

        if($columnManage){

            $field = json_decode($columnManage->field_status);
            $storejson = array(
                'due_fees_col_1' => ($request->due_fees_col_1) ? 1 : null,
                'due_fees_col_2' => ($request->due_fees_col_2) ? 1 : null,
                'due_fees_col_3' => ($request->due_fees_col_3) ? 1 : null,
                'due_fees_col_4' => ($request->due_fees_col_4) ? 1 : null,
                'due_fees_col_5' => ($request->due_fees_col_5) ? 1 : null,
                'due_fees_col_6' => ($request->due_fees_col_6) ? 1 : null,
                'due_fees_col_7' => ($request->due_fees_col_7) ? 1 : null,
                'due_fees_col_8' => ($request->due_fees_col_8) ? 1 : null,
                'due_fees_col_9' => ($request->due_fees_col_9) ? 1 : null,
                'due_fees_col_10' => ($request->due_fees_col_10) ? 1 : null,
            );

            columnManage::where('id', $columnManage['id'])->update(
                [
                'table_name' => $columnManage['table_name'],
                'field_status' => json_encode($storejson),
                'role_id' => $columnManage['role_id'],
                ]

            );

        }else{
            $storejson = array('due_fees_col_1' => $request->due_fees_col_1,'due_fees_col_2' => $request->due_fees_col_2,'due_fees_col_3' => $request->due_fees_col_3,'due_fees_col_4' => $request->due_fees_col_4,'due_fees_col_5' => $request->due_fees_col_5,'due_fees_col_6' => $request->due_fees_col_6,'due_fees_col_7' => $request->due_fees_col_7,'due_fees_col_8' => $request->due_fees_col_8,'due_fees_col_9' => $request->due_fees_col_9,'due_fees_col_10' => $request->due_fees_col_10);

             columnManage::insert([
                'table_name' => $request->due_fees,
                'field_status' => json_encode($storejson),
                'role_id' => auth()->user()->role_id,
             ]);

        }
    }

    public function edit($id,$type)
    {

        $auth = Auth::user();
        if ($type == 'Corporate'){

         $user =  CorporateDetail::findorfail($id);
         $editid = $user->corporate_id;
       //  dd($user);
        $userdetail =  CorporateDetail::with('course')->where('id',$id)->get();

        }elseif($type == 'Student'){
         $user = StudentDetail::findorfail($id);
          $editid = $user->student_id;
         $userdetail =  StudentDetail::with('course')->where('id',$id)->get();
        }
        $branch = Branch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('id', '=', $auth->branch_id);
            }
        })->pluck('title', 'id');
        $course = Course::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('branch_id', '=', $auth->branch_id);
            }
        })->pluck('course_name','id');
//        $branch = Branch::pluck('title','id');
//        $course = Course::pluck('course_name','id');
        $bank = ModeOfPayment::pluck('title','id');


     //   dd($userdetail[0]['course']['course_name']);
     return view('admin.due-fees.edit',compact('user','userdetail','type','branch','course','bank','editid'));
    }

    public function update(Request $request,$id,$type)
    {


        $input = $request->all();
        if ($type == 'Corporate') {
            $incomeType = IncomeType::where('title', 'Corporate Training')->first();
        }elseif ($type == 'Student'){
            $incomeType = IncomeType::where('title', 'Retail Training')->first();
        }
        $totalPay = $input['pay_amount'];
        if (isset($input['gst'])){
            $gst =  site_setting()->gst_per/100+1;
            $data['gst'] = $input['pay_amount'] - $input['pay_amount']/$gst;
            $input['paying_amount'] = $input['pay_amount']/$gst;
        }else{
            $data['gst'] = 0;
            $input['paying_amount'] = $totalPay;
        }
        $input['gst'] = 0;
        $bank = ModeOfPayment::where('id',$input['bank_acc_id'])->first();
        $old_balance = $bank->opening_balance;
        $bank->opening_balance = $old_balance+$totalPay;
        $bank->save();
        $input['register_date'] = Carbon::now();
        $input['income_type_id'] =$incomeType->id;
        $input['registration_taken_by'] = Auth::id();
        $input = Income::create($input);
        if ($type == 'Corporate'){
            $data['corporate_id'] = $id;
            $data['course_id'] =$input['course_id'];
            $input->corporateStudFees()->create($data);
        }elseif($type == 'Student'){
            $data['student_id'] = $id;
            $data['course_id'] =$input['course_id'];
            $input->incomeStudFees()->create($data);
        }
        return redirect()->route('due-fees');

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
