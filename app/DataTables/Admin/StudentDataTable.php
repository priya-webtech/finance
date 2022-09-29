<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Carcompany;
use App\Models\Admin\Student;
use App\Models\Admin\StudentDetail;
use App\Models\Admin\StudentBatchDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class StudentDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', ' ')
            ->editColumn('branch_id', function ($record){
                return $record->branch->title;
            })
            ->editColumn('student_type', function ($record){
                return $record->studentType->title;
            })
            ->editColumn('enquiry_type', function ($record){
                return $record->enquiryType->title;
            })
            ->editColumn('lead_source_id', function ($record){
                return $record->leadSource->title;
            })
            ->editColumn('status', function ($record){
                return $status = "<span class='badge badge-success'>".$record->status."</span>";
            })
            ->editColumn('course', function ($record){

                 $student_detail = StudentDetail::where('student_id',$record->id)->first();
                return $student_detail->course->course_name;
               
            })
            ->editColumn('agreed_amount', function ($record){

                 $student_detail = StudentDetail::where('student_id',$record->id)->first();
                return $student_detail->agreed_amount;
            })
            ->editColumn('trainer_name', function ($record){

                 $student_detail = StudentDetail::where('student_id',$record->id)->first();
                 $student_batch_detail = StudentBatchDetail::where('student_detail_id',$student_detail->id)->first();

                 if($student_batch_detail){
                     return $student_batch_detail->trainer->trainer_name;
                 }else{
                     return 'N/A';
                 }
            })
            ->editColumn('created_at', function ($record){
                return $record->created_at;
                 
            })

            ->filter(function ($record){
                $record->where(function ($q) {
                    if (request('enquiry_type')) {
                     $q->where('enquiry_type', request('enquiry_type'));
                    }
                    if (request('student_type')) {
                        $q->where('student_type', request('student_type'));
                    }
                     if (request('lead_source')) {
                         $q->where('lead_source_id', request('lead_source'));
                     }
                    if (request('state')){
                        $q->where('state', request('state'));
                    }
                    if (request('dates')){
                        $part = explode("-",request('dates'));
                        $start = date('Y-m-d', strtotime($part[0]));
                        $end = date('Y-m-d', strtotime($part[1]));
                            $q->whereDate('created_at', '>=', $start)
                                ->whereDate('created_at', '<=', $end);
                    }
                });
               if (request('status')){
                   if (request('status') == 'assigned'){
                       $record->whereHas('studDetail', function($q) {
                           $q->whereHas('studBatchDetail');
                       });
                   }elseif (request('status') == 'unassigned'){

                       $record->whereHas('studDetail', function($q) {
                           $q->doesntHave('studBatchDetail');

                       });
                   }
               }
            })
            ->addColumn('slno','row_num',1)
            ->rawColumns(['action','status','course','agreed_amount','trainer_name']);
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
        DB::statement(DB::raw('set @rownum=0'));
        if ($auth->hasRole('super_admin') || $auth->hasRole('admin')){
           // $model = Student::query();

            $model = Student::select([DB::raw('@rownum := @rownum + 1 AS rank'),'id','name','email','mobile_no', 'placement', 'student_type', 'enquiry_type','lead_source_id','branch_id','state','status','created_at']);
        }else{
            $model =  Student::where('branch_id',$auth->branch_id)->select([DB::raw('@rownum := @rownum + 1 AS rank'),'id','name','email','mobile_no', 'placement', 'student_type', 'enquiry_type','lead_source_id','branch_id','state','status','created_at']);
        }
        return  $model->newQuery();
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
//                'buttons' => [
//                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
//                ],
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
            'mobile_no',
            'student_type',
            'enquiry_type',
            'lead_source_id',
            'branch_id',
            'agreedcourse',
            'state',
            'status',
            'remark',
            'placement',
            'created_at'
            //'type' => ['searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'students_datatable_' . time();
    }
}
