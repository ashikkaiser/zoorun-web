<?php

namespace App\Http\Controllers\Admin\Application;

use App\Http\Controllers\Controller;
use App\Models\ServiceArea;
use App\Models\ServiceWeightPackageSetting;
use App\Models\Unit;
use App\Models\WeightPackage;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class ServiceAreaSettingController extends Controller
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


        if (request()->ajax()) {
            $rowData = ServiceWeightPackageSetting::query()->with('serviceArea');
            if ($request->status === "trash") {
                $rowData->where('status', false);
            } else {
                $rowData->where('status', true);
            }
            return DataTables::of($rowData)
                ->addIndexColumn()
                ->editColumn('name', function ($data) {
                    return $data->serviceArea->name;
                })
                ->editColumn('weight_package_id', function ($data) {
                    $packages = array();

                    foreach (json_decode($data->weight_package_id) as $p) {
                        array_push($packages, WeightPackage::find($p)->name);
                    };
                    $type = 'name';
                    return view('themes.frest.application.serviceAreaSettings.packages', compact('packages', 'type'));
                })
                ->editColumn('rates', function ($data) {
                    $rates = json_decode($data['rates']);
                    $type = 'rate';
                    return view('themes.frest.application.serviceAreaSettings.packages', compact('rates', 'type'));
                })
                ->addColumn('status', function ($row) {
                    return view('themes.frest.partials.status', compact('row'));
                })
                ->addColumn('action', function ($row) {
                    return view('themes.frest.application.serviceAreaSettings.action', compact('row'));
                })

                ->rawColumns(['weight_package_id', 'rates'])
                ->toJson();
        }


        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'DT_RowIndex' => 'name', 'title' => 'SL', 'orderable' => false, 'searchable' => false,],
            ['data' => 'name', 'name' => 'name', 'title' => 'Service Area'],
            ['data' => 'weight_package_id', 'name' => 'weight_package_id', 'title' => 'Weight Package'],
            ['data' => 'rates', 'name' => 'rates', 'title' => 'Package Rate'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);

        $units = Unit::all();

        return view('themes.frest.application.serviceAreaSettings.index', compact('html', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $serviceAreas = ServiceArea::where('status', true)->get();
        $weightPackages = WeightPackage::where('status', true)->get();
        return view('themes.frest.application.serviceAreaSettings.create', compact('serviceAreas', 'weightPackages'));
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
            'service_area_id' => 'required'
        ]);


        $new = new ServiceWeightPackageSetting();
        $new->service_area_id = $request->service_area_id;
        $new->weight_package_id = json_encode($request->weight_package_id);
        $new->rates = json_encode($request->rates);
        $new->status = true;
        $new->save();
        // $ifExist = ServiceWeightPackageSetting::where('service_area_id', $data["service_area_id"])->first();


        // if ($ifExist) {
        //     $request->validate(["service_area_id" => 'unique:service_weight_package_settings'], ["service_area_id" . '.exist' => "This service area is already added to a service area setting"]);
        //     // $request->validate(["service_area_id" => 'unique:service_weight_package_settings'], ["service_area_id" . '.exist' => "This service area is already added to a service area setting"]);
        // }


        // $weightPackages = WeightPackage::where('status', true)->get();

        // $count = 0;
        // foreach ($weightPackages as $field) {
        //     $keyName = 'packagerate' . $field->id;
        //     if (!$request->$keyName || $request->$keyName == "") {
        //         $count += 1;
        //     }
        // }

        // if ($count === count($weightPackages)) {
        //     $request->validate([$keyName => 'required'], [$keyName . '.required' => "Please enable atleast one weight package by clicking the checkbox"]);
        // }

        // foreach ($weightPackages as $field) {
        //     $keyName = 'packagerate' . $field->id;
        //     if ($request->$keyName !== "" && $request->$keyName !== null) {
        //         $data = new ServiceWeightPackageSetting([
        //             "service_area_id" => $data["service_area_id"],
        //             "weight_package_id" => $field->id,
        //             "weight_package_status" => true,
        //             "rate" => $request->$keyName,
        //             "status" => true,
        //         ]);

        //         $data->save();
        //     }
        //     // else {
        //     //     $data = new ServiceWeightPackageSetting([
        //     //         "service_area_id" => $data["service_area_id"],
        //     //         "weight_package_id" => $field->id,
        //     //         "weight_package_status" => false,
        //     //         "rate" => $field->rate,
        //     //         "status" => false,
        //     //     ]);
        //     //     $data->save();
        //     // }
        // }

        return redirect()->route('admin.application.service.area.setting')->with('success', 'Service area setting added successfully');
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

        $sass = ServiceWeightPackageSetting::find($id);

        if (!$sass) return redirect()->back()->with('error', 'Service area settings is not founded');

        $serviceAreas = ServiceArea::where('status', true)->get();
        $weightPackages = WeightPackage::where('status', true)->get();
        return view('themes.frest.application.serviceAreaSettings.edit', compact('serviceAreas', 'weightPackages', 'sass'));
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
            'service_area_id' => 'required'
        ]);


        $new = ServiceWeightPackageSetting::find($id);
        $new->service_area_id = $request->service_area_id;
        $new->weight_package_id = json_encode($request->weight_package_id);
        $new->rates = json_encode($request->rates);
        $new->status = true;
        $new->save();

        // $ifExist = ServiceWeightPackageSetting::where('service_area_id', $data["service_area_id"])->first();


        // // if (!$ifExist) {
        // //     return redirect()->back()->with('error', 'Service area is not founded');
        // // }


        // $weightPackages = WeightPackage::where('status', true)->get();

        // $count = 0;
        // foreach ($weightPackages as $field) {
        //     $keyName = 'packagerate' . $field->id;
        //     if (!$request->$keyName || $request->$keyName == "") {
        //         $count += 1;
        //     }
        // }

        // if ($count === count($weightPackages)) {
        //     $request->validate([$keyName => 'required'], [$keyName . '.required' => "Please enable atleast one weight package by clicking the checkbox"]);
        // }

        // foreach ($ifExist->serviceArea->weightPackages as $package) {
        //     $package->delete();
        // }

        // foreach ($weightPackages as $field) {
        //     $keyName = 'packagerate' . $field->id;
        //     if ($request->$keyName !== "" && $request->$keyName !== null) {
        //         $data = new ServiceWeightPackageSetting([
        //             "service_area_id" => $data["service_area_id"],
        //             "weight_package_id" => $field->id,
        //             "weight_package_status" => true,
        //             "rate" => $request->$keyName,
        //             "status" => true,
        //         ]);

        //         $data->save();
        //     }
        // }

        return redirect()->route('admin.application.service.area.setting')->with('success', 'Service area setting updated successfully');
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
        $swarea = ServiceWeightPackageSetting::where('service_area_id', $id)->get();

        foreach ($swarea as $area) {
            $area->delete();
        }

        return redirect()->back()->with('success', 'Service area settings deleted successfully');
    }
}
