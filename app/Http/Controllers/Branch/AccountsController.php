<?php

namespace App\Http\Controllers\Branch;

use App\DataTables\Branch\MerchantDeliveryPaymentDataTable;
use App\DataTables\Branch\MerchantDeliveryPaymentListDataTable;


use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\MerchantPayment;
use App\Models\Parcel;
use App\Models\PaymentMethod;
use App\Models\PaymentParcel;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Builder;

class AccountsController extends Controller
{
    public function branchDeliveryPaymentList(Builder $builder)
    {
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Invoice ID'],
            ['data' => 'sl_no', 'name' => 'sl_no', 'title' => 'Branch'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Payment Parcel'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Recieved Payment Parcel'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Payment Amount'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Recieved Payment Amount'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Action'],
        ]);
        return view('themes.frest.branchPanel.accounts.branch-delivery-payment-list', compact('html'));
    }

    public function merchantDeliveryPayment(MerchantDeliveryPaymentDataTable $dataTable, Request $request)
    {
        $merchants = Merchant::active()->get();
        $pending = PaymentParcel::pluck('id');
        $parcels = Parcel::where('status', 'delivery-completed')->get();

        return $dataTable->render('themes.frest.branchPanel.accounts.merchant-delivery-payment', compact('merchants', 'parcels'));

        // return view('themes.frest.branchPanel.accounts.merchant-delivery-payment', compact('merchants', 'parcels'));
    }

    public function storeMerchantPayment(Request $request)
    {

        $request->validate([
            'merchant_id' => 'required',
            'payment_date' => 'required',
            'total_payment_amount' => 'required',
            'parcels' => 'required',
        ]);
        $merchant = Merchant::find($request->merchant_id);
        $parcels = Parcel::whereIn('id', $request->parcels)->get();
        $lastid = MerchantPayment::orderBy('id', 'desc')->first();
        $invoice_id = $lastid ? $lastid->id + 1000 : 1000;
        $payment = new MerchantPayment();
        $payment->invoice_id = $invoice_id;
        $payment->merchant_id = $merchant->id;
        // $payment->branch_id = Auth::user()->branch_id;
        $payment->total_parcel = $parcels->count();
        $payment->total_amount = $request->total_payment_amount;
        $payment->discount = $request->discount_amount ?? 0;
        $payment->payment_date = $request->payment_date;
        if ($payment->save()) {

            foreach ($parcels as $parcel) {
                $paymentParcel = new PaymentParcel();
                $paymentParcel->merchant_payment_id = $payment->id;
                $paymentParcel->parcel_id = $parcel->id;
                $paymentParcel->amount = $parcel->collected_amount - $parcel->delivery_charge;
                $paymentParcel->save();
            }
        }


        return redirect()->back()->with('success', 'Payment added successfully');
    }




    public function merchantDeliveryPaymentList(MerchantDeliveryPaymentListDataTable $dataTable, Request $request)
    {
        $merchants = Merchant::active()->get();
        $pending = PaymentParcel::pluck('id');
        $parcels = Parcel::where('status', 'delivery-completed')->get();
        return $dataTable->render('themes.frest.branchPanel.accounts.merchant-delivery-payment-list', compact('merchants', 'parcels'));
    }
    public function paymentModal($id)
    {
        $payment_id = MerchantPayment::find($id);
        $payment_method = PaymentMethod::all();
        return view('themes.frest.branchPanel.accounts.payment-modal', compact('payment_id', 'payment_method'));
    }
    public function submitPaymentModal($id, Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'payment_slip' => 'required',
        ]);

        $payment_id = MerchantPayment::find($id);
        $payment_id->payment_method = $request->payment_method;
        $payment_id->payment_slip = $request->payment_slip;
        $payment_id->payment_note = $request->payment_note;
        $payment_id->payment_status = 'paid';
        // dd($payment_id);
        $payment_id->save();
        return redirect()->back()->with('success', 'Payment added successfully');
    }
    public function ViewModal($id)
    {
        $payment_id = MerchantPayment::find($id);
        $site = SiteSetting::first();
        return view('themes.frest.branchPanel.accounts.view-modal', compact('payment_id', 'site'));
    }

    public function getMerchant(Request $request)
    {
        $merchant = Merchant::find($request->merchant_id);
        return response()->json($merchant);
    }
}
