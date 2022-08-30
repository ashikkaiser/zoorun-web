<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;


use Illuminate\Support\Facades\Hash;
use App\Models\District;
use App\Models\User;
use App\Models\Zone;

class BranchController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {

        $rowData = Branch::query()->with('district');

        if ($request->status === "trash") {
            $rowData->where('status', false)->get();
        } else {
            $rowData->where('status', true)->get();
        }



        if (request()->ajax()) {
            return DataTables::of($rowData)
                ->addColumn('action', function ($row) {
                    return view('themes.frest.team.branch.action', compact('row'));
                })
                ->editColumn('created_at', '{{date("d-M-Y", strtotime($created_at))}}')->editColumn('color', function ($row) {
                    return view('themes.frest.partials.color', compact('row'));
                })

                ->editColumn('zone', function ($row) {
                    $zones = json_decode($row->zone_ids);
                    $zone_names = Zone::whereIn('id', $zones)->pluck('name');
                    return $zone_names;
                })
                ->addColumn('status', function ($row) {
                    return view('themes.frest.partials.status', compact('row'));
                })
                ->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'address', 'name' => 'address', 'title' => 'Address'],
            ['data' => 'zone', 'name' => 'zone', 'title' => 'Zone'],
            ['data' => 'district.name', 'name' => 'district', 'title' => 'District'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);


        return view('themes.frest.team.branch.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::where('status', true)->get();
        return view('themes.frest.team.branch.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'district' => 'required',
            'zone' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        //check the name
        $ifExistName = Branch::where('name', $data['name'])->first();

        if ($ifExistName) {
            return redirect()->back()->with('error', 'Branch already existed in this zone');
        }

        $imageName = null;

        if ($request->file) {
            $imageName = time() . '.' . $request->file->extension();

            $request->file->move(public_path('uploads/branch'), $imageName);
        }

        Branch::create(
            [
                'name' => $data['name'],
                'address' => $data['address'],
                'district_id' => $data['district'],
                'zone_ids' => json_encode($data['zone']),
                'phone' => $data['phone'],
                'email' => $request->email,
                "image_url" => $imageName,
                'status' => true
            ]
        );

        return redirect()->back()->with('success', 'Branch added successfully');
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

        $branch = Branch::where('id', $id)->first();
        if (!$branch) return redirect()->back()->with('error', 'Branch doesnt existed');

        $districts = District::where('status', true)->get();
        return view('themes.frest.team.branch.edit', compact('districts', 'branch'));
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
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'district' => 'required',
            'zone' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);



        //check the name
        $ifExistName = Branch::where('name', $data['name'])->first();

        if ($ifExistName) {
            if ($ifExistName->id != $id) {
                return redirect()->back()->with('error', 'Branch already existed in this zone');
            }
        }

        $ifExist = Branch::where('id', $id)->first();

        $imageName = null;

        if ($request->file) {
            $imageName = time() . '.' . $request->file->extension();

            $request->file->move(public_path('uploads/branch'), $imageName);
        }

        if (!$ifExist) return redirect()->back()->with('error', 'Branch doesnt existed');
        $ifExist->name = $data['name'];
        $ifExist->district_id = $data['district'];
        $ifExist->zone_ids = json_encode($data['zone']);
        $ifExist->address = $data['address'];
        $ifExist->email = $data['email'];
        $ifExist->phone = $data['phone'];

        if ($request->file) {
            $ifExist->image_url = $imageName;
        }

        $ifExist->save();
        return redirect()->back()->with('success', 'Branch updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $branch = Branch::where('id', $id)->first();
        if ($branch) {
            $branch->status =  $status === "untrash" ? true :  false;
            $branch->save();
            return redirect()->back()->with('success', 'Branch deleted successfully');
        }

        return redirect()->back()->with('error', 'Branch delete operation failed, please try again');
    }


    //users
    public function  branchUsers(Request $request, Builder $builder)
    {


        if (request()->ajax()) {
            $rowData = User::query()->branchUser()->with('branch');

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
            ['data' => 'branch.name', 'name' => 'branch', 'title' => 'Branch'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'address', 'name' => 'address', 'title' => 'Address'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);


        return view('themes.frest.team.branch.users.index', compact('html'));
    }

    public function branchUsersCreate()
    {
        $branhces = Branch::where('status', true)->get();
        return view('themes.frest.team.branch.users.create', compact('branhces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function branchUsersStore(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'branch' => 'required',
            'phone' => '',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => ['required', 'string', 'min:8'],
        ]);


        $imageName = null;

        if ($request->file) {
            $imageName = time() . '.' . $request->file->extension();

            $request->file->move(public_path('uploads/branch/users'), $imageName);
        }

        User::create(['name' => $data['name'], 'address' => $data['address'], 'branch_id' => $data['branch'], 'username' => $data['username'], 'password' => Hash::make($data['password']), 'phone' => $data['phone'], 'email' => $request->email, "image_url" => $imageName, 'status' => true, 'user_type' => 'branch']);

        return redirect()->back()->with('success', 'Branch user added successfully');
    }
}
