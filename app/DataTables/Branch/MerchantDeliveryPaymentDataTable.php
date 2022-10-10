<?php

namespace App\DataTables\Branch;

use App\Models\Parcel;
use App\Models\PaymentParcel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MerchantDeliveryPaymentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query->with('merchant')))
            ->addColumn('checkbox', function ($data) {
                return '<input type="checkbox"  class="form-check-input checkboxPercel" name="checkbox[]" class="checkbox" value="' . $data->id . '" data-name="' . $data->parcel_id . '"
                data-delivery_charge="' . $data->delivery_charge . '" data-collected_amount="' . $data->collected_amount . '">';
            })
            ->rawColumns(['checkbox', 'action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Parcel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Parcel $model): QueryBuilder
    {
        $parcels = PaymentParcel::pluck('parcel_id');
        $model = $model->newQuery();
        $model->whereNotIn('id', $parcels);
        $model->where('status', 'delivery-completed');
        if ($this->request()->has('merchant_id')) {
            $model->where('merchant_id', $this->request()->get('merchant_id'));
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
            ->setTableId('merchant-delivery-payment-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
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

            Column::make('checkbox')
                ->title('<input type="checkbox" class="form-check-input" id="checkAllAssign">')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)

                ->width(60)
                ->addClass('text-center'),
            Column::make('parcel_id')->title('Invoice No'),
            Column::make('merchant_order_id')->title('Merchant Order'),
            Column::make('merchant.name')->title('Merchant Name'),
            Column::make('merchant.phone')->title('Contact Number'),
            Column::make('collected_amount')->title('Collected'),
            Column::make('total')->title('Payable'),

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
