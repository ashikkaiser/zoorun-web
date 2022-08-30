<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function branchDeliveryPaymentList()
    {
        return view('themes.frest.branchPanel.accounts.branch-delivery-payment-list');
    }

    public function merchantDeliveryPayment()
    {
        return view('themes.frest.branchPanel.accounts.branch-delivery-payment-list');
    }

    public function merchantDeliveryPaymentList()
    {
        return view('themes.frest.branchPanel.accounts.branch-delivery-payment-list');
    }
}
