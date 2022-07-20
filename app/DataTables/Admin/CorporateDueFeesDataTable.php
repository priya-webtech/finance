<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Carcompany;
use App\Models\Admin\Income;
use App\Models\Admin\Corporate;
use App\Models\Admin\CorporateDetail;
use App\Models\Admin\CorporateFessCollection;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CorporateDueFeesDataTable extends DataTable
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
//        return $dataTable->addColumn('action', 'admin.due-fees.datatables_actions');
//        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'admin.due-fees.datatables_actions')
            ->addColumn('agreed_amount', function ($record){
                $corporate_id=$record->id;
                return $agreed_amount=CorporateDetail::where('corporate_id',$corporate_id)->sum('agreed_amount');
            })
            ->addColumn('total_amount', function ($record){
                $corporate_id=$record->id;
                $gst = CorporateFessCollection::where('corporate_id',$corporate_id)->sum('gst');
                 $paying_amount = CorporateFessCollection::where('corporate_id',$corporate_id)->pluck('income_id')->toArray();
                 $payAmount = Income::whereIn('id',$paying_amount)->sum('paying_amount');
                 $total_amount = $payAmount + $gst;
                 return round($total_amount, 2);
            })
            ->rawColumns(['agreed_amount','total_amount','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Carcompany $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Corporate $model)
    {
        return $model->newQuery();
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
            ->minifiedAjax(route('due-fees-corporate'))
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
            'company_name',
            'email',
            'contact_no',
            'agreed_amount',
            'total_amount',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'corporateduefees_datatable_' . time();
    }
}
