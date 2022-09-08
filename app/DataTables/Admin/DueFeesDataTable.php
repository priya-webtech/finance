<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Corporate;
use App\Models\Admin\CorporateDetail;
use App\Models\Admin\CorporateFessCollection;
use App\Models\Admin\Income;
use App\Models\Admin\Student;
use App\Models\Admin\StudentDetail;
use App\Models\Admin\columnManage;
use App\Models\Admin\StudentFessCollection;
use Carbon\Carbon;
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
            ->addColumn('due_fees', function ($record){
                if($record->type == 'Student') {
                   $feesCollection = StudentFessCollection::where('student_id', $record->student_id);
                   $payAmount = Income::whereIn('id',$feesCollection->pluck('income_id'))->sum('paying_amount');
                   $agreed_amount = $record->agreed_amount;
                   $dueFees = $agreed_amount - $payAmount;
                   return number_format($dueFees,2);
                }
                elseif ($record->type == 'Corporate'){
                    $feesCollection = CorporateFessCollection::where('corporate_id', $record->student_id);
                    $payAmount = Income::whereIn('id',$feesCollection->pluck('income_id'))->sum('paying_amount');
                    $agreed_amount = $record->agreed_amount;
                    $dueFees = $agreed_amount - $payAmount;
                    return number_format($dueFees,2);
                }
            })->editColumn('pay_amount' , function ($record){
                if($record->type == 'Student') {
                    $feesCollection = StudentFessCollection::where('student_id', $record->student_id);
                    $payAmount = Income::whereIn('id',$feesCollection->pluck('income_id'))->sum('paying_amount');
                    $total = $payAmount;
                    return number_format($total,2);
                }
                elseif ($record->type == 'Corporate'){
                    $feesCollection = CorporateFessCollection::where('corporate_id', $record->student_id);
                    $payAmount = Income::whereIn('id',$feesCollection->pluck('income_id'))->sum('paying_amount');
                    $total = $payAmount;
                    return number_format($total,2);
                }
            })->editColumn('gst',function ($record){
                if($record->type == 'Student') {
                    $feesCollection = StudentFessCollection::where('student_id', $record->student_id);
                    $gst = $feesCollection->sum('gst');
                    return number_format($gst,2);
                }
                elseif ($record->type == 'Corporate'){
                    $feesCollection = CorporateFessCollection::where('corporate_id', $record->student_id);
                    $gst = $feesCollection->sum('gst');
                    return number_format($gst,2);
                }
            })
             ->editColumn('due_date',function ($record){
               if($record->due_date < today()->format('Y-m-d')){
                  return "<span class='text-danger'>$record->due_date</span>";
               }else{
                   return $record->due_date;
               }
           })
            ->addIndexColumn()
            ->rawColumns(['agreed_amount','total_amount','due_fees','action','due_date']);
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

            $a = StudentDetail::when(request('dates'), function ($q) {
                $part = explode("-",request('dates'));
                $start = date('Y-m-d', strtotime($part[0]));
                $end = date('Y-m-d', strtotime($part[1]));
                $q->whereDate('due_date', '>=', $start)
                    ->whereDate('due_date', '<=', $end);
            })->join('students', 'student_detail.student_id', '=', 'students.id')
                ->join('courses', 'student_detail.course_id', '=', 'courses.id')
                ->join('student_fees_collections', 'student_detail.id', '=', 'student_fees_collections.student_detail_id')
                ->join('incomes', 'student_fees_collections.income_id', '=', 'incomes.id')
                ->select('student_detail.id as id','student_detail.student_id as student_id','students.name as name','students.email as email','students.mobile_no as mobile','student_detail.agreed_amount as agreed_amount','courses.course_name as course_name','student_detail.due_date as due_date','incomes.paying_amount as pay_amount','incomes.gst as gst', DB::raw("'Student' AS `type`"));

            $b = CorporateDetail::when(request('dates'), function ($q) {
                $part = explode("-",request('dates'));
                $start = date('Y-m-d', strtotime($part[0]));
                $end = date('Y-m-d', strtotime($part[1]));
                $q->whereDate('due_date', '>=', $start)
                    ->whereDate('due_date', '<=', $end);
            })->join('corporates', 'corporate_detail.corporate_id', '=', 'corporates.id')
            ->join('courses', 'corporate_detail.course_id', '=', 'courses.id')
            ->join('corporate_fees_collections', 'corporate_detail.id', '=', 'corporate_fees_collections.corporate_detail_id')
            ->join('incomes', 'corporate_fees_collections.income_id', '=', 'incomes.id')
          ->select('corporate_detail.id as id','corporate_detail.corporate_id as corporate_id','corporates.company_name as name','corporates.email as email','corporates.contact_no as mobile','corporate_detail.agreed_amount as agreed_amount','courses.course_name as course_name','corporate_detail.due_date as due_date','incomes.paying_amount as pay_amount','incomes.gst as gst', DB::raw("'Corporate' AS `type`"));
        }else{

            $a = StudentDetail::where('student_detail.branch_id',$auth->branch_id)->
                when(request('dates'), function ($q) {
                    $part = explode("-",request('dates'));
                    $start = date('Y-m-d', strtotime($part[0]));
                    $end = date('Y-m-d', strtotime($part[1]));
                    $q->whereDate('due_date', '>=', $start)
                        ->whereDate('due_date', '<=', $end);
                })->join('students', 'student_detail.student_id', '=', 'students.id')
                ->join('courses', 'student_detail.course_id', '=', 'courses.id')
                ->join('student_fees_collections', 'student_detail.id', '=', 'student_fees_collections.student_detail_id')
                ->join('incomes', 'student_fees_collections.income_id', '=', 'incomes.id')
                ->select('student_detail.id as id','students.name as name','students.email as email','students.mobile_no as mobile','student_detail.agreed_amount as agreed_amount','courses.course_name as course_name','student_detail.due_date as due_date','incomes.paying_amount as pay_amount','incomes.gst as gst', DB::raw("'Student' AS `type`"));

            $b = CorporateDetail::where('corporates.branch_id',$auth->branch_id)->
                when(request('dates'), function ($q) {
                    $part = explode("-",request('dates'));
                    $start = date('Y-m-d', strtotime($part[0]));
                    $end = date('Y-m-d', strtotime($part[1]));
                    $q->whereDate('due_date', '>=', $start)
                        ->whereDate('due_date', '<=', $end);
                })->join('corporates', 'corporate_detail.corporate_id', '=', 'corporates.id')
            ->join('courses', 'corporate_detail.course_id', '=', 'courses.id')
            ->join('corporate_fees_collections', 'corporate_detail.id', '=', 'corporate_fees_collections.corporate_detail_id')
            ->join('incomes', 'corporate_fees_collections.income_id', '=', 'incomes.id')
          ->select('corporate_detail.id as id','corporates.company_name as name','corporates.email as email','corporates.contact_no as mobile','corporate_detail.agreed_amount as agreed_amount','courses.course_name as course_name','corporate_detail.due_date as due_date','incomes.paying_amount as pay_amount','incomes.gst as gst', DB::raw("'Corporate' AS `type`"));
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
//                'paging'=> false,
                'stateSave' => true,
                'order' => [[0, 'desc']],
                'fnDrawCallback' => 'function( row, data, start, end, display ) {
                 var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === \'string\' ?
                    i.replace(/[\$,]/g, \'\')*1 :
                    typeof i === \'number\' ?
                        i : 0;
            };
            // Total over all pages
            total = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
   
                $(".alert-msg").html("Total Due Amount Per Page : ₹ "+total).css("color","red")
                    $("body").tooltip({
                        selector: \'[data-toggle="tooltip"]\'
                    })
                }
                ',
//                '$(".alert-msg").html(oSettings.json)',
                'buttons' => [
//                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
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
        $columnManage = columnManage::where('table_name','due_fees')->where('role_id',auth()->user()->role_id)->first();
        $field = [];
        if($columnManage){
        $field = json_decode($columnManage->field_status);
        }

        $result =
            ['DT_RowIndex' => ['title'=>'SNo.','orderable'=> false, 'searchable'=>false]] +
        ((!empty($field) && $field->due_fees_col_1 == 1) ? ['name' => ['searchable' => false]] : [] )  +
        ((!empty($field) && $field->due_fees_col_2 == 1) ? ['mobile' => ['searchable' => false]] : [] ) +
        ((!empty($field) && $field->due_fees_col_3 == 1) ? ['course_name' => ['searchable' => false]] : [] ) +
        ((!empty($field) && $field->due_fees_col_4 == 1) ? ['due_date' => ['searchable' => false]] : [] ) +
        ((!empty($field) && $field->due_fees_col_5 == 1) ? ['agreed_amount' => ['searchable' => false]] : [] ) +
        ((!empty($field) && $field->due_fees_col_6 == 1) ? ['pay_amount' => ['searchable' => false]] : [] ) +
        ((!empty($field) && $field->due_fees_col_7 == 1) ? ['gst' => ['searchable' => false]] : [] ) +
        ((!empty($field) && $field->due_fees_col_8 == 1) ? ['due_fees' => ['searchable' => false]] : [] );
//        ((!empty($field) && $field->due_fees_col_9 == 1) ? ['type' => ['searchable' => false]] : [] );

        return $result;


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
