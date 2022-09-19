<?php

namespace App\Http\Controllers\Admin\Application;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Zone;
use App\Models\District;
use App\Models\ServiceArea;
use Illuminate\Http\Request;

use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class AreaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'admin.gaurd']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder, Request $request)
    {


        $districts = District::where('status', true)->get();
        $zones = Zone::where('status', true)->get();
        $service_areas = ServiceArea::where('status', true)->get();


        if (request()->ajax()) {
            $rowData = Area::query();
            if ($request->status === "trash") {
                $rowData->where('status', false);
            } else {
                $rowData->where('status', true);
            }
            return
                DataTables::of($rowData)
                ->addColumn('action', function ($row) {
                    return view('themes.frest.application.area.action', compact('row'));
                })
                ->editColumn('created_at', '{{date("d-M-Y", strtotime($created_at))}}')

                ->addColumn('status', function ($row) {
                    return view('themes.frest.partials.status', compact('row'));
                })
                ->editColumn('zone_id', function ($row) {
                    return $row->zone->name;
                })
                ->editColumn('district_id', function ($row) {
                    return $row->district->name;
                })
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'zone_id', 'name' => 'zone_id', 'title' => 'Zone'],
            ['data' => 'district_id', 'name' => 'district_id', 'title' => 'District'],
            ['data' => 'postal_code', 'name' => 'postal_code', 'title' => 'Postal Code'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);

        // dd($service_areas);
        return view('themes.frest.application.area.index', compact('html', 'districts', 'service_areas'));
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
            'zone' => 'required',
            'postal_code' => 'required',
        ]);

        //check the name
        $ifExist = Area::where('name', $data['name'])->where('zone_id', $data['zone'])->first();

        if ($ifExist) return redirect()->back()->with('error', 'Area already existed in this zone');

        Area::create([
            'name' => $data['name'],
            'district_id' => $data['district'],
            'zone_id' => $data['zone'],
            'service_area_ids' => json_encode($request->service_area_ids),
            'postal_code' => $data['postal_code'],
            'status' => true
        ]);

        return redirect()->back()->with('success', 'Area added successfully');
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
            'zone' => 'required',
            'postal_code' => 'required',
            'service_area_ids' => 'required'
        ]);

        //check the name
        $ifExistName = Area::where('name', $data['name'])->where('zone_id', $data['zone'])->first();

        if ($ifExistName) {
            if ($ifExistName->id != $id) {
                return redirect()->back()->with('error', 'Area already existed in this zone');
            }
        }


        $ifExist = Area::where('id', $id)->first();

        if (!$ifExist) return redirect()->back()->with('error', 'Area doesnt existed');
        $ifExist->name = $data['name'];
        $ifExist->district_id = $data['district'];
        $ifExist->zone_id = $data['zone'];
        $ifExist->postal_code = $data['postal_code'];
        $ifExist->service_area_ids = json_encode($request->service_area_ids);
        $ifExist->save();
        return redirect()->back()->with('success', 'Area updated successfully');
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
        $area = Area::where('id', $id)->first();
        if ($area) {
            $area->status =  $status === "untrash" ? true :  false;
            $area->save();
            return redirect()->back()->with('success', 'Area deleted successfully');
        }

        return redirect()->back()->with('error', 'Area delete operation failed, please try again');
    }
    /**
     * Get all the zone under a district
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getzone(Request $request)
    {
        $district = $request->district;
        $zones = Zone::where('status', true)->where('district_id', $district)->get();
        return $zones;
    }
    /**
     * Get all the zone under a district
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getarea(Request $request)
    {
        $zone = $request->zone;
        $district = $request->district;
        if ($zone) {
            $areas = Area::where('status', true)->where('zone_id', $zone)->get();
            return $areas;
        }
        if ($district) {
            $areas = Area::where('status', true)->where('district_id', $district)
                ->where('name', 'ILIKE', '%' . $request->search . '%')->get();
            return $areas;
        }
    }
}
