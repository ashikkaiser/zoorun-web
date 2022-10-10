<?php

namespace App\DataTables\Warehouse;

use App\Models\Parcel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SendTransfarDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query->with(['zone', 'status', 'merchant'])))

            ->setRowId('id')
            ->addColumn('action', function ($booking) {
                return '<button type="button" data-bs-target="#viewModal" data-bs-toggle="modal"  parcel_id="' . $booking->id . '" class="btn btn-primary btn-sm view-modal" >View</button>';
            })
            ->addIndexColumn()
            ->editColumn('checkbox', function ($booking) {
                return '<input type="checkbox" data-name="' . $booking->parcel_id . '" data-runid="' . $booking->pickup_rider_run_id . '" class="form-check-input checkboxPercel" value="' . $booking->id . '">';
            })
            ->rawColumns(['status', 'action', 'checkbox', 'reschedule']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Parcel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Parcel $model): QueryBuilder
    {
        $model = $model->newQuery();
        $model->where('status', 'received-to-warehouse');
        if ($this->request()->has('dst_branch_id') && $this->request()->dst_branch_id != '' && $this->request()->dst_branch_id != null) {
            $model->where('destination_branch_id', $this->request()->dst_branch_id);
        } else {
            $model->where('status', 'none');
        }
        return  $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('booking_table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
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
            [
                'title'          => '<div class="icheck-primary d-inline"> <input type="checkbox" id="checkAllAssign" class="form-check-input"> <label for="checkAllAssign"> All  </label> </div>',
                'data'           => 'checkbox',
                'name'           => 'checkbox',
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => false,
                'width'          => '41px',
                'class' => 'sorting_disabled'
            ],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false, 'shorting' => false],
            ['data' => 'parcel_id', 'name' => 'parcel_id', 'title' => 'Parcel No'],
            ['data' => 'merchant.name', 'name' => 'merchant.name', 'title' => 'Sender Contact'],
            ['data' => 'destination_branch_id', 'name' => 'destination_branch_id', 'title' => 'Receiver Branch'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Parcel_' . date('YmdHis');
    }
}
