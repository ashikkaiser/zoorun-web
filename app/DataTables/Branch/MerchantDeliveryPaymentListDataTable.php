<?php

namespace App\DataTables\Branch;

use App\Models\MerchantPayment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MerchantDeliveryPaymentListDataTable extends DataTable
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
            ->addColumn('action', 'MerchantPayment.action')
            ->editColumn('branch_id', function ($data) {
                return $data->branch->name;
            })
            ->editColumn('total_parcels', function ($data) {
                return $data->parcels->count();
            })
            ->editColumn('payment_status', function ($data) {
                return view('themes.frest.branchPanel.accounts.action', compact('data'));
            })
            ->rawColumns(['payment_status'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MerchantPayment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MerchantPayment $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('MerchantPayment-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
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

            Column::make('DT_RowIndex')->title('SL'),
            Column::make('invoice_id')->title('Invoice ID'),
            Column::make('branch_id')->title('Branch'),
            Column::make('total_parcels')->title('Total Parcel'),
            Column::make('total_amount')->title('Total Amount'),
            Column::make('discount')->title('Discount'),
            Column::make('payment_date')->title('Payment Date'),
            Column::make('payment_status')->title('Payment Status'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'MerchantPayment_' . date('YmdHis');
    }
}
