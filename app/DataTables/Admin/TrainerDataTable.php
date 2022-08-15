<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Carcompany;
use App\Models\Admin\Corporate;
use App\Models\Admin\CorporateFessCollection;
use App\Models\Admin\ExpenceMaster;
use App\Models\Admin\ExpenseTypes;
use App\Models\Admin\Income;
use App\Models\Admin\IncomeType;
use App\Models\Admin\Student;
use App\Models\Admin\StudentBatchDetail;
use App\Models\Admin\StudentFessCollection;
use App\Models\Admin\Trainer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class TrainerDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', ' ')

            ->editColumn('course_id', function ($record) {
             return $record->Course->course_name ?? "N/A";
           })
            ->addColumn('fees', function ($record){
                $ids = $record->courseWiseTrainerFee()->pluck('id')->toArray();
                $trainerfees = StudentBatchDetail::whereIn('student_detail_id',$ids)->where('trainer_id',$record->id)->sum('trainer_fees');
                return number_format($trainerfees,2);
            })
            ->addColumn('paid', function ($record){
              $trainerPaid = ExpenceMaster::where('trainer_id',$record->id);
               $paid = $trainerPaid->sum('amount');
              return number_format($paid+$trainerPaid->sum('tds'),2);
            })
            ->addColumn('out_Standing', function ($record){
                $ids = $record->courseWiseTrainerFee()->pluck('id')->toArray();
                $trainerfees = StudentBatchDetail::whereIn('student_detail_id',$ids)->where('trainer_id',$record->id);
                $trainerPaid = ExpenceMaster::where('trainer_id',$record->id)->whereIn('batch_id',$trainerfees->pluck('batch_id')->toArray());
                $paid = $trainerPaid->sum('amount');
                $paidFees = $paid+$trainerPaid->sum('tds');
                return number_format($trainerfees->sum('trainer_fees') - $paidFees,2) ;
            })
            ->addColumn('payment_status', function ($record){
                $ids = $record->courseWiseTrainerFee()->pluck('id')->toArray();
                $trainerfees = StudentBatchDetail::whereIn('student_detail_id',$ids)->where('trainer_id',$record->id);
                $trainerPaid = ExpenceMaster::where('trainer_id',$record->id)->whereIn('batch_id',$trainerfees->pluck('batch_id')->toArray());
                $paid = $trainerPaid->sum('amount');
                $paidFees = $paid+$trainerPaid->sum('tds');
               $remain= $trainerfees->sum('trainer_fees') -$paidFees;
                if ($remain <= 0){
                    $status = "<span class='badge badge-success'>Paid</span>";
                }else{
                    $status = "<span class='badge badge-danger'>Pending</span>";
                }
                return $status;
            })
//            ->filter(function ($record){
//                $record->where(function ($q) {
//                    if (request('dates')){
//                        $part = explode("-",request('dates'));
//                        $start = date('Y-m-d', strtotime($part[0]));
//                        $end = date('Y-m-d', strtotime($part[1]));
//                            $q->whereDate('created_at', '>=', $start)
//                                ->whereDate('created_at', '<=', $end);
//                    }
//                });
//            })
            ->rawColumns(['action','out_Standing','paid','payment_status','fees']);
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
            $model = Trainer::query();
        }else{
            $model =  Trainer::where('branch_id',$auth->branch_id);
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
           'trainer_name',
            'course_id'

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'trainers_datatable_' . time();
    }
}
