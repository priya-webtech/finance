<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Carcompany;
use App\Models\Admin\Corporate;
use App\Models\Admin\CorporateDetail;
use App\Models\Admin\CorporateFessCollection;
use App\Models\Admin\Income;
use App\Models\Admin\Student;
use App\Models\Admin\StudentDetail;
use App\Models\Admin\StudentFessCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class DueFeesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', 'admin.due-fees.datatables_actions')
            // ->addColumn('agreed_amount', function ($record){
            //     if($record->type == 'Student'){
            //         $stud_id=$record->id;
            //         return $agreed_amount=StudentDetail::where('student_id',$stud_id)->sum('agreed_amount');
            //     }elseif ($record->type == 'Corporate'){
            //         $corporate_id=$record->id;
            //         return $agreed_amount=CorporateDetail::where('corporate_id',$corporate_id)->sum('agreed_amount');
            //     }
            // })

            // ->addColumn('due_date', function ($record){
            //     if($record->type == 'Student'){
            //         $stud_id=$record->id;
            //         return $due_date=StudentDetail::where('student_id',$stud_id)->pluck('due_date')->toArray();
            //     }elseif ($record->type == 'Corporate'){
            //         $corporate_id=$record->id;
            //         return $due_date=CorporateDetail::where('corporate_id',$corporate_id)->pluck('due_date')->toArray();
            //     }
            // })

            // ->addColumn('total_amount', function ($record){
            //     if($record->type == 'Student') {
            //         $gst = StudentFessCollection::where('student_id', $record->id)->sum('gst');
            //         $paying_amount = StudentFessCollection::where('student_id', $record->id)->pluck('income_id')->toArray();
            //         $payAmount = Income::whereIn('id', $paying_amount)->sum('paying_amount');
            //         return $payAmount + $gst;
            //     }else{
            //         $gst = CorporateFessCollection::where('corporate_id', $record->id)->sum('gst');
            //         $paying_amount = CorporateFessCollection::where('corporate_id', $record->id)->pluck('income_id')->toArray();
            //         $payAmount = Income::whereIn('id', $paying_amount)->sum('paying_amount');
            //         return $payAmount + $gst;
            //     }
            // })
            // ->addColumn('due_fees', function ($record){
            //     $stud_id=$record->id;
            //     if($record->type == 'Student') {
            //         $gst = StudentFessCollection::where('student_id', $record->id)->sum('gst');
            //         $paying_amount = StudentFessCollection::where('student_id', $record->id)->pluck('income_id')->toArray();
            //         $payAmount = Income::whereIn('id', $paying_amount)->sum('paying_amount');
            //         return $payAmount + $gst;
            //     }
            //     elseif ($record->type == 'Corporate'){
            //         $corporate_id=$record->id;
            //         $gst = CorporateFessCollection::where('corporate_id',$corporate_id)->sum('gst');
            //         $paying_amount = CorporateFessCollection::where('corporate_id',$corporate_id)->pluck('income_id')->toArray();
            //         $payAmount = Income::whereIn('id',$paying_amount)->sum('paying_amount');
            //         $total_amount = $payAmount + $gst;
            //         return round($total_amount, 2);
            //     }
            // })
            // ->addColumn('due_fees', function ($record){
            //     if($record->type == 'Student') {
            //         $stud_id = $record->id;
            //         $agreed_amount = StudentDetail::where('student_id', $stud_id)->sum('agreed_amount');
            //         $gst = StudentFessCollection::where('student_id', $record->id)->sum('gst');
            //         $paying_amount = StudentFessCollection::where('student_id', $record->id)->pluck('income_id')->toArray();
            //         $payAmount = Income::whereIn('id', $paying_amount)->sum('paying_amount');
            //         $total = $payAmount + $gst;
            //         $dueFees = $agreed_amount - $total;
            //         return $dueFees;
            //     }
            //     elseif ($record->type == 'Corporate'){
            //         $corporate_id=$record->id;
            //         $agreed_amount=CorporateDetail::where('corporate_id',$corporate_id)->sum('agreed_amount');
            //         $gst = CorporateFessCollection::where('corporate_id',$record->id)->sum('gst');
            //         $paying_amount = CorporateFessCollection::where('corporate_id',$record->id)->pluck('income_id')->toArray();
            //         $payAmount = Income::whereIn('id',$paying_amount)->sum('paying_amount');
            //         $total = $payAmount + $gst;
            //         $dueFees = $agreed_amount - $total;
            //         return $dueFees;
            //     }
            // })
            ->rawColumns(['agreed_amount','total_amount','due_fees','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Carcompany $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
       $auth = Auth::user();
        if ($auth->hasRole('super_admin') || $auth->hasRole('admin')){

        //    $a = StudentDetail::select('id','student_id as name','course_id','agreed_amount', DB::raw("'Student' AS `type`"));

            $a = StudentDetail::join('students', 'student_detail.student_id', '=', 'students.id')
                ->join('courses', 'student_detail.course_id', '=', 'courses.id')
                ->join('student_fees_collections', 'student_detail.id', '=', 'student_fees_collections.student_detail_id')
                ->join('incomes', 'student_fees_collections.income_id', '=', 'incomes.id')
                ->select('student_detail.id as id','students.name as name','students.email as email','student_detail.agreed_amount as agreed_amount','courses.course_name as course_name','student_detail.due_date as due_date','incomes.paying_amount as pay_amount','incomes.gst as gst', DB::raw("'Student' AS `type`"));

            $b = CorporateDetail::join('corporates', 'corporate_detail.corporate_id', '=', 'corporates.id')
            ->join('courses', 'corporate_detail.course_id', '=', 'courses.id')
            ->join('corporate_fees_collections', 'corporate_detail.id', '=', 'corporate_fees_collections.corporate_detail_id')
            ->join('incomes', 'corporate_fees_collections.income_id', '=', 'incomes.id')
          ->select('corporate_detail.id as id','corporates.company_name as name','corporates.email as email','corporate_detail.agreed_amount as agreed_amount','courses.course_name as course_name','corporate_detail.due_date as due_date','incomes.paying_amount as pay_amount','incomes.gst as gst', DB::raw("'Corporate' AS `type`"));
        }else{

            $a = StudentDetail::where('student_detail.branch_id',$auth->branch_id)->join('students', 'student_detail.student_id', '=', 'students.id')
                ->join('courses', 'student_detail.course_id', '=', 'courses.id')
                ->join('student_fees_collections', 'student_detail.id', '=', 'student_fees_collections.student_detail_id')
                ->join('incomes', 'student_fees_collections.income_id', '=', 'incomes.id')
                ->select('student_detail.id as id','students.name as name','students.email as email','student_detail.agreed_amount as agreed_amount','courses.course_name as course_name','student_detail.due_date as due_date','incomes.paying_amount as pay_amount','incomes.gst as gst', DB::raw("'Student' AS `type`"));

            $b = CorporateDetail::where('corporates.branch_id',$auth->branch_id)->join('corporates', 'corporate_detail.corporate_id', '=', 'corporates.id')
            ->join('courses', 'corporate_detail.course_id', '=', 'courses.id')
            ->join('corporate_fees_collections', 'corporate_detail.id', '=', 'corporate_fees_collections.corporate_detail_id')
            ->join('incomes', 'corporate_fees_collections.income_id', '=', 'incomes.id')
          ->select('corporate_detail.id as id','corporates.company_name as name','corporates.email as email','corporate_detail.agreed_amount as agreed_amount','courses.course_name as course_name','corporate_detail.due_date as due_date','incomes.paying_amount as pay_amount','incomes.gst as gst', DB::raw("'Corporate' AS `type`"));
         
         //   $a = Student::where('branch_id',$auth->branch_id)->select('id','name','email','mobile_no', DB::raw("'Student' AS `type`"));
         //   $b = Corporate::where('branch_id',$auth->branch_id)->select('id','company_name','email','contact_no', DB::raw("'Corporate' AS `type`"));
        }



        return $a->union($b)->orderBy('type');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom' => 'Bfrtip',
                'stateSave' => true,
                'order' => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['searchable' => false],
            'name',
            'email',
            'course_name',
            'due_date',
            // 'course_id',
          //  'due_date',
            'agreed_amount'  => ['searchable' => false],
            'pay_amount'  => ['searchable' => false],
            'gst'  => ['searchable' => false],
           // 'total_amount' => ['searchable' => false],
           // 'due_fees' => ['searchable' => false],
            'type' => ['searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'duefees_datatable_' . time();
    }
}
