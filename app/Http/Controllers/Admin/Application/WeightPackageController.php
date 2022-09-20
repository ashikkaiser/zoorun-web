<?php

namespace App\Http\Controllers\Admin\Application;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\WeightPackage;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class WeightPackageController extends Controller
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


        $rowData = WeightPackage::query()->with('unit');

        if ($request->status === "trash") {
            $rowData->where('status', false)->get();
        } else {
            $rowData->where('status', true)->get();
        }


        if (request()->ajax()) {
            return DataTables::of($rowData)->addColumn('action', function ($row) {
                return view('themes.frest.application.weightPackage.action', compact('row'));
            })->editColumn('created_at', '{{date("d-M-Y", strtotime($created_at))}}')->addColumn('status', function ($row) {
                return view('themes.frest.partials.status', compact('row'));
            })->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
            ['data' => 'unit.name', 'name' => 'name', 'title' => 'unit'],
            ['data' => 'rate', 'name' => 'rate', 'title' => 'Rate'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);

        $units = Unit::all();

        return view('themes.frest.application.weightPackage.index', compact('html', 'units'));
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
            'name' => 'required',
            'title' => 'required',
            'rate' => 'required',
            'weight_package' => 'required',
            'description' => '',
        ]);

        //check the name
        $ifExist = WeightPackage::where('name', $data['name'])->first();

        if ($ifExist) return redirect()->back()->with('error', 'Weight pakcage already existed');

        WeightPackage::create(['name' => $data['name'], 'title' => $data['title'], 'rate' => $data['rate'], 'description' => $data['description'], 'unit_id' => $data['weight_package'], 'status' => true]);

        return redirect()->back()->with('success', 'Weight Package added successfully');
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
            'name' => 'required',
            'title' => 'required',
            'rate' => 'required',
            'weight_package' => 'required',
            'description' => '',
        ]);

        //check the name
        // $ifExistName = WeightPackage::where('name', $data['name'])->first();

        // if ($ifExistName) {
        //     if ($ifExistName->id != $id) {
        //         return redirect()->back()->with('error', 'Weight Package already existed');
        //     }
        // }

        $ifExist = WeightPackage::where('id', $id)->first();

        if (!$ifExist) return redirect()->back()->with('error', 'Weight Package doesnt existed');

        $ifExist->name = $data['name'];
        $ifExist->title = $data['title'];
        $ifExist->rate = $data['rate'];
        $ifExist->unit_id = $data['weight_package'];
        $ifExist->description = $data['description'];
        $ifExist->save();

        return redirect()->back()->with('success', 'Weight Package updated successfully');
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
        $wPackage = WeightPackage::where('id', $id)->first();
        if ($wPackage) {
            $wPackage->status =  $status === "untrash" ? true :  false;
            $wPackage->save();
            return redirect()->back()->with('success', 'Weight Package deleted successfully');
        }

        return redirect()->back()->with('error', 'Weight Package delete operation failed, please try again');
    }
}
