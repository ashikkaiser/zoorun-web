<?php

namespace App\Http\Controllers\Admin\Application;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Models\District;
use Illuminate\Http\Request;

use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class ZoneController extends Controller
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

        $rowData = Zone::query()->with('district');

        if ($request->status === "trash") {
            $rowData->where('status', false)->get();
        } else {
            $rowData->where('status', true)->get();
        }

        $districts = District::all();


        if (request()->ajax()) {
            return DataTables::of($rowData)->addColumn('action', function ($row) use ($districts) {
                return view('themes.frest.application.zone.action', compact('row', 'districts'));
            })->editColumn('created_at', '{{date("d-M-Y", strtotime($created_at))}}')->addColumn('status', function ($row) {
                return view('themes.frest.partials.status', compact('row'));
            })
                ->editColumn('color', function ($row) {
                    return view('themes.frest.partials.color', compact('row'));
                })
                ->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'district.name', 'name' => 'district', 'title' => 'District'],
            ['data' => 'color', 'name' => 'color', 'title' => 'Color'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);


        return view('themes.frest.application.zone.index', compact('html', 'districts'));
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
            'district' => 'required',
            'color' => 'required',
        ]);

        //check the name
        $ifExist = Zone::where('name', $data['name'])->where('district_id', $data['district'])->first();

        if ($ifExist) return redirect()->back()->with('error', 'Zone already existed');

        Zone::create(['name' => $data['name'], 'district_id' => $data['district'], 'color' => $data['color'], 'status' => true]);

        return redirect()->back()->with('success', 'Zone added successfully');
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
            'district' => 'required',
            'color' => 'required',
        ]);

        //check the name
        $ifExistName = Zone::where('name', $data['name'])->where('district_id', $data['district'])->first();

        if ($ifExistName) {
            if ($ifExistName->id != $id) {
                return redirect()->back()->with('error', 'Zone already existed');
            }
        }

        $ifExist = Zone::where('id', $id)->first();

        if (!$ifExist) return redirect()->back()->with('error', 'Zone doesnt existed');
        $ifExist->name = $data['name'];
        $ifExist->district_id = $data['district'];
        $ifExist->color = $data['color'];

        $ifExist->save();
        return redirect()->back()->with('success', 'Zone updated successfully');
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
        $zone = Zone::where('id', $id)->first();
        if ($zone) {
            $zone->status =  $status === "untrash" ? true :  false;
            $zone->save();
            return redirect()->back()->with('success', 'Zone deleted successfully');
        }

        return redirect()->back()->with('error', 'Zone delete operation failed, please try again');
    }
}
