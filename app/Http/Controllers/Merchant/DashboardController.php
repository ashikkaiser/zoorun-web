<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $merchant_id = Auth::user()->merchant->id;
        $total_parcels = Parcel::where('merchant_id', $merchant_id)->count(); //completed
        $total_cancel_parcels = Parcel::where('merchant_id', $merchant_id)->count();
        $total_delivery_parcels = Parcel::where('merchant_id', $merchant_id)->count();
        $total_return_parcels = Parcel::where('merchant_id', $merchant_id)->count();
        $total_pickup_pending = Parcel::where('merchant_id', $merchant_id)->whereIn('status', ['pickup-pending', 'pickup-assigned'])->count(); //completed
        $total_delivery_parcel_pending = Parcel::where('merchant_id', $merchant_id)->whereIn('status', ['pickup-completed', 'received-to-warehouse', 'dispatched-to-rider', 'delivery-in-progress'])->count();
        $total_delivery_parcel_complete = Parcel::where('merchant_id', $merchant_id)->where('status', 'delivery-completed')->count();
        $total_return_parcel_complete = Parcel::where('merchant_id', $merchant_id)->where('status', 'delivery-completed')->count(); //completed
        $total_pending_collect_amount = Parcel::where('merchant_id', $merchant_id)->where('status', 'delivery-completed')->count();
        $total_collect_amount = Parcel::where('merchant_id', $merchant_id)->where('status', 'delivery-completed')->count();

        return view('themes.frest.merchantPanel.dashboard.index', compact('total_parcels', 'total_pickup_pending', 'total_delivery_parcel_pending', 'total_delivery_parcel_complete', 'total_return_parcel_complete', 'total_pending_collect_amount', 'total_collect_amount'));
    }
}
