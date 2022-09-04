<?php

namespace App\DataTables\Merchant;

use App\Models\Parcel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MerchantBookingDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query->with(['district', 'area'])))
            ->addIndexColumn()
            ->addColumn('action', function ($booking) {
                return view('themes.frest.merchantPanel.booking.action', compact('booking'));
            })
            ->editColumn('status', function ($booking) {
                if ($booking->is_return) {
                    return '<span class="badge bg-success">' . $booking->return_status . '</span>';
                } else {
                    if ($booking->is_hold) {
                        return '<span class="badge bg-warning">Hold</span>';
                    } else {
                        return '<span class="badge bg-success">' . $booking->status . '</span>';
                    }
                }
            })
            ->editColumn('created_at', function ($booking) {
                return $booking->created_at->format('d M, Y');
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
        $model->where('merchant_id', Auth::user()->merchant->id);
        if ($this->request()->has('status') && $this->request()->status != '' && $this->request()->status != null) {
            $model->where('status', $this->request()->status);
        }
        if ($this->request()->has('date_range')    && $this->request()->date_range != '' && $this->request()->date_range != null) {
            $date_range = explode('to', $this->request()->date_range);
            $model->whereBetween('created_at', [date('Y-m-d', strtotime($date_range[0])), date('Y-m-d', strtotime($date_range[1]))]);
        }
        if ($this->request()->has('customer_phone') && $this->request()->customer_phone != null && $this->request()->customer_phone != '') {
            $model->where('customer_phone', $this->request()->customer_phone);
        }
        if ($this->request()->has('parcel_id') && $this->request()->parcel_id != null && $this->request()->parcel_id != '') {
            $model->where('parcel_id', $this->request()->parcel_id);
        }
        if ($this->request()->has('merchant_order_id') && $this->request()->merchant_order_id != null && $this->request()->merchant_order_id != '') {
            $model->where('merchant_order_id', $this->request()->merchant_order_id);
        }
        return  $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('booking-table')
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
            Column::make('DT_RowIndex')->title('SL')->orderable(false)->searchable(false),
            Column::make('parcel_id')->title('Parcel'),
            Column::make('customer_name')->title('Customer Name'),
            Column::make('customer_phone')->title('Customer Phone'),
            Column::make('delivery_address')->title('Customer Address')->width("20%")->className('wspace'),
            Column::make('district.name')->title('District'),
            Column::make('area.name')->title('Area'),
            Column::make('status')->title('Status'),
            Column::make('created_at')->title('Date'),
            Column::make('action')->title('Actions')->orderable(false)->searchable(false)->width(20),


        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'booking-table_' . date('YmdHis');
    }
}
