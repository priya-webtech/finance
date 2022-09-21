<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Batch;
use App\Models\User;
use App\Models\Admin\Carcompany;
use App\Models\Admin\CorporateFessCollection;
use App\Models\Admin\ExpenceMaster;
use App\Models\Admin\ExpenseTypes;
use App\Models\Admin\Income;
use App\Models\Admin\IncomeType;
use App\Models\Admin\Student;
use App\Models\Admin\StudentFessCollection;
use App\Models\Admin\Trainer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UserDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', ' ')

            ->editColumn('role_id', function ($record){
                return $record->role->name;
            })
            ->editColumn('branch_id', function ($record){
                return $record->branch->title;
            })
            ->editColumn('status', function ($record){
                if ($record->status == 1){
                  $status = "Active";
                }else{
                    $status = "Block";
                }
                return $status;
            })
            ->filter(function ($record){
                $record->where(function ($q) {
                    if (request('dates')){
                        $part = explode("-",request('dates'));
                        $start = date('Y-m-d', strtotime($part[0]));
                        $end = date('Y-m-d', strtotime($part[1]));
                            $q->whereDate('created_at', '>=', $start)
                                ->whereDate('created_at', '<=', $end);
                    }
                    if (request('role_id')){
                        $q->where('role_id',request('role_id'));
                    }
                    if (request('branch_id')){
                        $q->where('branch_id',request('branch_id'));
                    }
                });
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Carcompany $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $auth = Auth::user();
        DB::statement(DB::raw('set @rownum=0'));
        if ($auth->hasRole('super_admin') || $auth->hasRole('admin')){

           $model = User::where('role_id','!=',0)->select([DB::raw('@rownum := @rownum + 1 AS rank'),'name', 'mobile_no', 'email', 'status', 'role_id','branch_id']);

        }else{
            $model = User::where('role_id','!=',0)->where('branch_id',$auth->branch_id)->select([DB::raw('@rownum := @rownum + 1 AS rank'),'name', 'mobile_no', 'email', 'status', 'role_id', 'branch_id']);

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
            'role_id',
            'mobile_no',
            'branch_id',
            'status',

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'users_datatable_' . time();
    }
}
