<?php

namespace App\DataTables\Branch;

use App\Models\Parcel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;

class PickupParcelDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query->branch()->pickup()->with(['district', 'zone', 'area', 'status'])))
            ->addIndexColumn()
            ->editColumn('created_at', function ($booking) {
                return $booking->created_at->diffForHumans();
            })
            ->addColumn('action', function ($booking) {
                return view('themes.frest.branchPanel.pickup-percel.action', compact('booking'));
            })
            ->editColumn('status', function ($booking) {
                if ($booking->is_return) {
                    return '<span class="badge badge-success">Return</span>';
                } else {
                    if ($booking->is_hold) {
                        return '<span class="badge bg-warning">Hold</span>';
                    } else {
                        return '<span class="badge bg-success">' . $booking->status . '</span>';
                    }
                }
            })
            ->rawColumns(['status', 'action']);
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
        $model = $model;
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
            ->setTableId('pickup-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('lrtip')
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
            Column::make('DT_RowIndex')->title('SL')->orderable(false)->searchable(false),
            Column::make('parcel_id')->title('Parcel'),
            Column::make('customer_name')->title('Customer Name'),
            Column::make('customer_phone')->title('Customer Phone'),
            Column::make('delivery_address')->title('Customer Address')->width("30%")->className('wspace'),
            Column::make('district.name')->title('District'),
            Column::make('zone.name')->title('Zone'),
            Column::make('area.name')->title('Area')->width("10%")->className('wspace'),
            Column::make('status')->title('Status'),
            Column::make('created_at')->title('Date'),
            Column::make('action')->title('Actions')->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'pickup-table_' . date('YmdHis');
    }
}
