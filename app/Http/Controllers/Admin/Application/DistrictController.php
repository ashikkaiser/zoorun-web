<?php

namespace App\Http\Controllers\Admin\Application;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class DistrictController extends Controller
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
        $rowData = District::query();

        if ($request->status === "trash") {
            $rowData->where('status', false)->get();
        } else {
            $rowData->where('status', true)->get();
        }


        if (request()->ajax()) {
            return DataTables::of($rowData)->addColumn('action', function ($row) {
                return view('themes.frest.application.district.action', compact('row'));
            })->editColumn('created_at', '{{date("d-M-Y", strtotime($created_at))}}')->addColumn('status', function ($row) {
                return view('themes.frest.partials.status', compact('row'));
            })->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);

        return view('themes.frest.application.district.index', compact('html'));
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
        $data = $request->validate([
            'name' => 'required'
        ]);

        //check the name
        $ifExist = District::where('name', $data['name'])->first();

        if ($ifExist) return redirect()->back()->with('error', 'District already existed');

        District::create(['name' => $data['name'], 'status' => true]);

        return redirect()->back()->with('success', 'District added successfully');
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
        $data = $request->validate([
            'name' => 'required'
        ]);

        //check the name
        $ifExistName = District::where('name', $data['name'])->first();

        if ($ifExistName) {
            if ($ifExistName->id != $id) {
                return redirect()->back()->with('error', 'District already existed');
            }
        }

        $ifExist = District::where('id', $id)->first();

        if (!$ifExist) return redirect()->back()->with('error', 'District doesnt existed');

        $ifExist->name = $data['name'];
        $ifExist->save();

        return redirect()->back()->with('success', 'District updated successfully');
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
        $district = District::where('id', $id)->first();
        if ($district) {
            $district->status =  $status === "untrash" ? true :  false;
            $district->save();
            return redirect()->back()->with('success', 'District deleted successfully');
        }
        return redirect()->back()->with('error', 'District delete operation failed, please try again');
    }
}
