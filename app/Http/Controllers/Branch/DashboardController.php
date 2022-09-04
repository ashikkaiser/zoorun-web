<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Models\Rider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index()
    {
        $total_merchants = Merchant::where('branch_id', Auth::user()->branch_id)->where('status', true)->count();
        $total_riders = Rider::where('branch_id', Auth::user()->branch_id)->where('status', true)->count();
        $total_parcels = Parcel::where('branch_id', Auth::user()->branch_id)->count();
        $total_pickup_pending = 1;
        $total_delivery_parcel_pending = 0;
        $total_delivery_parcel_complete = 0;
        return view('themes.frest.branchPanel.dashboard.index', compact('total_parcels', 'total_pickup_pending', 'total_delivery_parcel_pending', 'total_delivery_parcel_complete', 'total_merchants', 'total_riders'));
    }
}
