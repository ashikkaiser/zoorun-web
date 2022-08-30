<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\District;
use App\Models\Merchant;
use App\Models\Rider;
use App\Models\ServiceArea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class RiderController extends Controller
{
    public function  index(Request $request, Builder $builder)
    {
        $rowData = Rider::query()->with('district')->with('branch');

        if ($request->status === "trash") {
            $rowData->where('status', false)->get();
        } else {
            $rowData->where('status', true)->get();
        }
        if (request()->ajax()) {
            return DataTables::of($rowData)->addColumn('action', function ($row) {
                return view('admin::team.rider.action', compact('row'));
            })->editColumn('created_at', '{{date("d-M-Y", strtotime($created_at))}}')->editColumn('color', function ($row) {
                return view('themes.frest.partials.color', compact('row'));
            })->addColumn('status', function ($row) {
                return view('themes.frest.partials.status', compact('row'));
            })
                ->addIndexColumn()->toJson();
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'DT_RowIndex' => 'name', 'title' => 'SL', 'orderable' => false, 'searchable' => false,],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'branch.name', 'name' => 'branch', 'title' => 'Branch'],
            ['data' => 'district.name', 'name' => 'district', 'title' => 'District'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);
        return view('admin::team.rider.index', compact('html'));
    }

    public function create()
    {
        $districts = District::all();
        $serviceAreas = ServiceArea::all();
        $branchs = Branch::all();
        return view('admin::team.rider.create', compact('districts', 'serviceAreas', 'branchs',));
    }

    public function modify(Request $request)
    {
        $rider = Rider::findOrNew($request->id);
        $rider->name = $request->name;
        $rider->address = $request->address;
        $rider->district_id = $request->district_id;
        $rider->branch_id = $request->branch_id;
        $rider->phone = $request->phone;
        $rider->email = $request->email;
        if ($request->hasFile('image')) {
            $rider->image = $request->image;
        }
        $rider->created_by = Auth::user()->id;
        if ($rider->save()) {
            $user = User::firstOrNew(['user_type' => 'rider', 'branch_id' => $request->branch_id, 'email' => $request->email]);
            $user->user_type = 'rider';
            $user->branch_id = $rider->branch_id;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = true;
            $user->save();
            $rider->user_id = $user->id;
            $rider->save();
            return redirect()->route('admin.team.rider')->with('success', 'Rider Modify successfully');
        }
    }
}
