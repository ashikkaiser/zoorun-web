<?php

namespace App\DataTables\Branch;

use App\Models\Parcel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;

class BranchTransferListDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query->deleviry()->where('branch_id', Auth::user()->branch_id)
            ->whereNot('destination_branch_id', Auth::user()->branch_id)
            ->with(['district', 'zone', 'area', 'status'])))
            ->addIndexColumn()
            ->editColumn('created_at', function ($booking) {
                return $booking->created_at->diffForHumans();
            })
            ->addColumn('action', function ($booking) {
                return view('themes.frest.branchPanel.pickup-percel.action', compact('booking'));
            })
            ->editColumn('delivery_address', function ($booking) {
                return "<span class='wspace'>{$booking->delivery_address}</span>";
            })
            ->editColumn('area.name', function ($booking) {
                return "<span class='wspace'>{$booking->area->name}</span>";
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
            ->rawColumns(['status', 'action', 'delivery_address', 'area.name']);
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
            ->setTableId('transfer-list-table')
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
            Column::make('delivery_address')->title('Customer Address'),
            Column::make('district.name')->title('District'),
            Column::make('zone.name')->title('Zone'),
            Column::make('area.name')->title('Area'),
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
        return 'transfer-list_' . date('YmdHis');
    }
}
