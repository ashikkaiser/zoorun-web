<?php

namespace App\Http\Controllers\Merchant;

use App\DataTables\Branch\MerchantDeliveryPaymentListDataTable;
use App\Http\Controllers\Controller;
use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deliveryPaymentList(MerchantDeliveryPaymentListDataTable $dataTable, Request $request)

    {
        // $html = $builder->columns([
        //     ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false],
        //     ['data' => 'name', 'name' => 'name', 'title' => 'Invoice'],
        //     ['data' => 'sl_no', 'name' => 'sl_no', 'title' => 'Customer Name'],
        //     ['data' => 'number', 'name' => 'number', 'title' => 'Customer Phone'],
        //     ['data' => 'number', 'name' => 'number', 'title' => 'Customer Address'],
        //     ['data' => 'number', 'name' => 'number', 'title' => 'District'],
        //     ['data' => 'number', 'name' => 'number', 'title' => 'Zone'],
        //     ['data' => 'number', 'name' => 'number', 'title' => 'Total Charge'],
        //     ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
        //     ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Action'],
        // ]);
        return $dataTable->render('admin::merchantPanel.account.delivery-payment-list');
        // return view('admin::merchantPanel.account.delivery-payment-list', compact('html'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deliveryParcelList(Builder $builder, Request $request)
    {
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false],
            ['data' => 'parcel_id', 'name' => 'parcel_id', 'title' => 'Invoice'],
            ['data' => 'collection_amount', 'name' => 'collection_amount', 'title' => 'Collectable Account'],
            ['data' => 'customer_phone', 'name' => 'customer_phone', 'title' => 'Cod %'],
            ['data' => 'delivery_address', 'name' => 'delivery_address', 'title' => 'Cod Charge'],
            ['data' => 'district.name', 'name' => 'number', 'title' => 'Weight Package Charge'],
            ['data' => 'delivery_charge', 'name' => 'delivery_charge', 'title' => 'Delivery Charge'],
            ['data' => 'status.message_en', 'name' => 'status', 'title' => 'Return Charge'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Collect'],
            ['data' => 'total', 'name' => 'total', 'title' => 'Total Charge'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Paid'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
        ]);

        if ($request->ajax()) {
            $data = Parcel::query()->where('merchant_id', Auth::user()->merchant->id)->with(['district', 'zone', 'area', 'status'])->where('status', 'delivery-completed')->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->diffForHumans();
                })
                ->addColumn('action', function ($data) {
                    return '<div class="demo-inline-spacing"><a href="" class="btn btn-primary btn-sm">View</a> <a href="" class="btn btn-danger btn-sm">Return</a></div>';
                })
                ->rawColumns(['created_at',  'action'])
                ->make(true);
        }
        return view('admin::merchantPanel.account.delivery-parcel-list', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
