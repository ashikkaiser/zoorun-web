<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class WarehouseController extends Controller
{
    public function index(Request $request, Builder $builder)
    {



        if (request()->ajax()) {
            $rowData = Warehouse::query()->with('branch');

            if ($request->status === "trash") {
                $rowData->where('status', false)->get();
            } else {
                $rowData->where('status', true)->get();
            }

            return DataTables::of($rowData)
                ->addIndexColumn()->addColumn('action', function ($row) {
                    return view('themes.frest.team.warehouse.action', compact('row'));
                })->editColumn('created_at', '{{date("d-M-Y", strtotime($created_at))}}')->editColumn('color', function ($row) {
                    return view('themes.frest.partials.color', compact('row'));
                })->addColumn('status', function ($row) {
                    return view('themes.frest.partials.status', compact('row'));
                })->toJson();
        }

        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'DT_RowIndex' => 'name', 'title' => 'SL', 'orderable' => false, 'searchable' => false,],

            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],


            ['data' => 'address', 'name' => 'address', 'title' => 'Address'],
            ['data' => 'branch.name', 'name' => 'zone', 'title' => 'Branch'],

            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);
        return view('themes.frest.team.warehouse.index', compact('html'));
    }
    public function create()
    {
        $branchs = Branch::where('status', true)->get();
        return view('themes.frest.team.warehouse.create', compact('branchs'));
    }


    public function edit($id)
    {
        $branchs = Branch::where('status', true)->get();
        $warehouse = Warehouse::find($id);
        return view('themes.frest.team.warehouse.edit', compact('branchs', 'warehouse'));
    }

    public function modify(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'branch_id' => 'required'
        ]);

        $house = Warehouse::findOrNew($request->id);
        $house->name = $request->name;
        $house->address = $request->address;
        $house->branch_id = $request->branch_id;
        $house->save();
        return redirect()->route('admin.team.warehouse')->with('success', 'Warehouse Modifyed successfully');
    }

    public function delete()
    {
    }


    public function user(Request $request, Builder $builder)
    {

        if (request()->ajax()) {
            $rowData = User::query()->warehouseUser()->with('warehouse');

            if ($request->status === "trash") {
                $rowData->trash();
            } else {
                $rowData->active();
            }
            return DataTables::of($rowData)
                ->addColumn('action', function ($row) {
                    return view('themes.frest.team.branch.action', compact('row'));
                })
                ->editColumn('created_at', '{{date("d-M-Y", strtotime($created_at))}}')
                ->addColumn('status', function ($row) {
                    return view('themes.frest.partials.status', compact('row'));
                })
                ->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'warehouse.name', 'name' => 'Warehouse', 'title' => 'Warehouse'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'address', 'name' => 'address', 'title' => 'Address'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);

        return view('themes.frest.team.warehouse.users.index', compact('html'));
    }
    public function userCreate()
    {
        $warehouses = Warehouse::all();
        return view('themes.frest.team.warehouse.users.create', compact('warehouses'));
    }
    public function userModify(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'warehouse_id' => 'required',
            'phone' => '',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => ['required', 'string', 'min:8'],
        ]);


        $imageName = null;

        if ($request->file) {
            $imageName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads/warehouse/users'), $imageName);
        }


        $user = User::findOrNew($request->id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->username = $request->username;
        $user->password = Hash::make($data['password']);
        $user->phone = $request->phone;
        $user->email = $request->email;
        // $user->branch_id = $request->branch_id;
        $user->warehouse_id = $request->warehouse_id;
        $user->image_url = $imageName;
        $user->status = true;
        $user->user_type = 'warehouse';

        $user->save();


        // User::create(['name' => $data['name'], 'address' => $data['address'], 'branch_id' => $data['branch'], 'username' => $data['username'], 'password' => Hash::make($data['password']), 'phone' => $data['phone'], 'email' => $request->email, "image_url" => $imageName, 'status' => true, 'user_type' => 'branch']);

        return redirect()->back()->with('success', ' user added successfully');
    }
    public function userEdit($id)
    {
        $user = User::find($id);
        $warehouses = Warehouse::all();
        return view('themes.frest.team.warehouse.users.edit', compact('warehouses', 'user'));
    }
    public function userDestroy()
    {
    }
}
