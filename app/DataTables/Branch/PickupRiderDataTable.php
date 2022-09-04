<?php

namespace App\DataTables\Branch;

use App\Models\RiderRun;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PickupRiderDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('created_at', function ($riderRun) {
                return $riderRun->created_at->format('d-m-Y');
            })
            ->editColumn('updated_at', function ($riderRun) {
                return $riderRun->updated_at->format('d-m-Y');
            })
            ->editColumn('rider.name', function ($riderRun) {
                return $riderRun->rider ? $riderRun->rider->name : 'N/A';
            })
            ->editColumn('rider.phone', function ($riderRun) {
                return $riderRun->rider ? $riderRun->rider->phone : 'N/A';
            })
            ->editColumn('status', function ($riderRun) {
                if ($riderRun->status == 1) {
                    return '<span class="badge bg-info">Pick Up Created</span>';
                } else if ($riderRun->status == 2) {
                    return '<span class="badge bg-primary">Picup Started</span>';
                } else if ($riderRun->status == 3) {
                    return '<span class="badge bg-success">Picup Completed</span>';
                }
            })
            ->editColumn('action', function ($riderRun) {
                return view('themes.frest.branchPanel.pickup-rider.action', compact('riderRun'));
            })
            ->rawColumns(['status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RiderRun $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RiderRun $model): QueryBuilder
    {

        $model = $model->newQuery();
        if ($this->request()->has('status') && $this->request()->get('status') != null && $this->request()->get('status') != '') {
            $model = $model->where('status', $this->request()->get('status'));
        }
        if ($this->request()->has('rider_id') && $this->request()->get('rider_id') != null && $this->request()->get('rider_id') != '') {
            $model = $model->where('rider_id', $this->request()->get('rider_id'));
        }


        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pickupRiderList')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'initComplete' => 'function() {
                    $("[data-toggle=\'tooltip\']").tooltip();
                }',
            ])
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {

        return [
            Column::make('DT_RowIndex')->title('SL')->orderable(false)->searchable(false),
            Column::make('run_id')->title('Consignment'),
            Column::make('rider.name')->title('Rider Name'),
            Column::make('rider.phone')->title('Rider Phone'),
            Column::make('created_at')->title('Create Date'),
            Column::make('updated_at')->title('Complete Date'),
            Column::make('total_parcel')->title('Total Parcel'),
            Column::make('complete_parcel')->title('Complete Parcel'),
            Column::make('status')->title('Status'),
            Column::make('action')->title('Action')->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'pickupRiderList_' . date('YmdHis');
    }
}
