<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
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

    public function merchantDeliveryPayment()
    {
        $merchants = Merchant::where('status', 1)->get();
        return view('themes.frest.branchPanel.accounts.merchant-delivery-payment', compact('merchants'));
    }

    public function merchantDeliveryPaymentList(Builder $builder)
    {
        $merchants = Merchant::where('status', 1)->where('branch_id', Auth::user()->branch_id)->get();
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
        return view('themes.frest.branchPanel.accounts.merchant-delivery-payment-list', compact('html', 'merchants'));
    }
}
