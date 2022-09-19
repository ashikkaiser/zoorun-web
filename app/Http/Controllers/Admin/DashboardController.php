<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Models\Rider;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin.gaurd']);
    }


    public function index()
    {
        $total_branch = Branch::count();
        $total_merchants = Merchant::count();
        $total_riders = Rider::count();
        $total_parcels = Parcel::count();
        return view('themes.frest.dashboard.index', compact('total_branch', 'total_merchants', 'total_riders', 'total_parcels'));
    }
}
