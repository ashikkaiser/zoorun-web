<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Unit;
use App\Models\Vehicle;
use Illuminate\Http\Request;

use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class ParcelSettingController extends Controller
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
    public function vihicle(Request $request, Builder $builder)
    {
        $rowData = Vehicle::query();

        if ($request->status === "trash") {
            $rowData->where('status', false)->get();
        } else {
            $rowData->where('status', true)->get();
        }


        if (request()->ajax()) {
            return DataTables::of($rowData)->addColumn('action', function ($row) {
                return view('themes.frest.parcelSetting.vehicle.action', compact('row'));
            })->editColumn('created_at', '{{date("d-M-Y", strtotime($created_at))}}')->addColumn('status', function ($row) {
                return view('themes.frest.partials.status', compact('row'));
            })->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'sl_no', 'name' => 'sl_no', 'title' => 'Vehicle Sl No'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Vehicle No'],
            ['data' => 'driver_name', 'name' => 'driver_name', 'title' => 'Vehicle Driver Name'],
            ['data' => 'driver_contact', 'name' => 'driver_contact', 'title' => 'Driver Contact Number'],
            ['data' => 'road', 'name' => 'road', 'title' => 'Vehicle Road'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);


        return view('themes.frest.parcelSetting.vehicle.index', compact('html'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function vihiclestore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:vehicles',
            'sl_no' => 'required',
            'number' => 'required',
            'driver_name' => 'required',
            'driver_contact' => 'required',
            'road' => 'required',
        ]);

        //check the name
        $ifExist = Vehicle::where('name', $data['name'])->first();

        if ($ifExist) return redirect()->back()->with('error', 'Vehicle already existed');

        Vehicle::create([
            'name' => $data['name'],
            "sl_no" => $data['name'],
            "number" => $data['number'],
            "driver_name" => $data['driver_name'],
            "driver_contact" => $data['driver_contact'],
            "road" => $data['road'],
            'status' => true
        ]);

        return redirect()->back()->with('success', 'Vehicle added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function vihicleupdate(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'sl_no' => 'required',
            'number' => 'required',
            'driver_name' => 'required',
            'driver_contact' => 'required',
            'road' => 'required',
        ]);

        //check the name
        $ifExistName = Vehicle::where('name', $data['name'])->first();

        if ($ifExistName) {
            if ($ifExistName->id != $id) {
                return redirect()->back()->with('error', 'Vehicle already existed');
            }
        }

        $ifExist = Vehicle::where('id', $id)->first();

        if (!$ifExist) return redirect()->back()->with('error', 'Vehicle doesnt existed');

        $ifExist->name = $data['name'];
        $ifExist->sl_no = $data['sl_no'];
        $ifExist->number = $data['number'];
        $ifExist->driver_name = $data['driver_name'];
        $ifExist->driver_contact = $data['driver_contact'];
        $ifExist->road = $data['road'];
        $ifExist->save();

        return redirect()->back()->with('success', 'Vehicle updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function vihicledestroy(Request $request)
    {

        $id = $request->id;
        $status = $request->status;
        $vehicle = Vehicle::where('id', $id)->first();
        if ($vehicle) {
            $vehicle->status =  $status === "untrash" ? true :  false;
            $vehicle->save();
            return redirect()->back()->with('success', 'Vehicle deleted successfully');
        }
        return redirect()->back()->with('error', 'Vehicle delete operation failed, please try again');
    }


    //Unit --------------------

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unit(Request $request, Builder $builder)
    {
        $rowData = Unit::query();

        if ($request->status === "trash") {
            $rowData->where('status', false)->get();
        } else {
            $rowData->where('status', true)->get();
        }


        if (request()->ajax()) {
            return DataTables::of($rowData)->addColumn('action', function ($row) {
                return view('themes.frest.parcelSetting.unit.action', compact('row'));
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


        return view('themes.frest.parcelSetting.unit.index', compact('html'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unitstore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:units',
        ]);

        //check the name
        $ifExist = Unit::where('name', $data['name'])->first();

        if ($ifExist) return redirect()->back()->with('error', 'Unit already existed');

        Unit::create([
            'name' => $data['name'],
            'status' => true
        ]);

        return redirect()->back()->with('success', 'Unit added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unitupdate(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        //check the name
        $ifExistName = Unit::where('name', $data['name'])->first();

        if ($ifExistName) {
            if ($ifExistName->id != $id) {
                return redirect()->back()->with('error', 'Unit already existed');
            }
        }

        $ifExist = Unit::where('id', $id)->first();

        if (!$ifExist) return redirect()->back()->with('error', 'Unit doesnt existed');

        $ifExist->name = $data['name'];
        $ifExist->save();

        return redirect()->back()->with('success', 'Unit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unitdestroy(Request $request)
    {

        $id = $request->id;
        $status = $request->status;
        $unit = Unit::where('id', $id)->first();
        if ($unit) {
            $unit->status =  $status === "untrash" ? true :  false;
            $unit->save();
            return redirect()->back()->with('success', 'Unit deleted successfully');
        }
        return redirect()->back()->with('error', 'Unit delete operation failed, please try again');
    }

    //Item Category --------------------

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function itemcategory(Request $request, Builder $builder)
    {
        $rowData = ItemCategory::query();

        if ($request->status === "trash") {
            $rowData->where('status', false)->get();
        } else {
            $rowData->where('status', true)->get();
        }


        if (request()->ajax()) {
            return DataTables::of($rowData)->addColumn('action', function ($row) {
                return view('themes.frest.parcelSetting.itemCategory.action', compact('row'));
            })->editColumn('created_at', '{{date("d-M-Y", strtotime($created_at))}}')->addColumn('status', function ($row) {
                return view('themes.frest.partials.status', compact('row'));
            })->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'details', 'name' => 'details', 'title' => 'Details'],
            ['data' => 'rate', 'name' => 'rate', 'title' => 'Rate'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);


        return view('themes.frest.parcelSetting.itemCategory.index', compact('html'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itemcategorystore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:item_categories',
            'rate' => 'required',
            'details' => ''
        ]);

        //check the name
        $ifExist = ItemCategory::where('name', $data['name'])->first();

        if ($ifExist) return redirect()->back()->with('error', 'Item Category already existed');

        ItemCategory::create([
            'name' => $data['name'],
            'details' => $request->details,
            'rate' => $request->rate,
            'status' => true
        ]);

        return redirect()->back()->with('success', 'Item Category added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function itemcategoryupdate(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'details' => '',
            'rate' => 'required'
        ]);

        //check the name
        $ifExistName = ItemCategory::where('name', $data['name'])->first();

        if ($ifExistName) {
            if ($ifExistName->id != $id) {
                return redirect()->back()->with('error', 'Item Category already existed');
            }
        }

        $ifExist = ItemCategory::where('id', $id)->first();

        if (!$ifExist) return redirect()->back()->with('error', 'Item Category doesnt existed');

        $ifExist->name = $data['name'];
        $ifExist->details = $data['details'];
        $ifExist->rate = $data['rate'];
        $ifExist->save();

        return redirect()->back()->with('success', 'Unit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function itemcategorydestroy(Request $request)
    {

        $id = $request->id;
        $status = $request->status;
        $itemCategory = ItemCategory::where('id', $id)->first();
        if ($itemCategory) {
            $itemCategory->status =  $status === "untrash" ? true :  false;
            $itemCategory->save();
            return redirect()->back()->with('success', 'Item Category deleted successfully');
        }
        return redirect()->back()->with('error', 'Item Category delete operation failed, please try again');
    }

    //Item --------------------

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function item(Request $request, Builder $builder)
    {
        $rowData = Item::query()->with('item_category')->with('unit');

        if ($request->status === "trash") {
            $rowData->where('status', false)->get();
        } else {
            $rowData->where('status', true)->get();
        }


        if (request()->ajax()) {
            return DataTables::of($rowData)->addColumn('action', function ($row) {
                return view('themes.frest.parcelSetting.item.action', compact('row'));
            })->editColumn('created_at', '{{date("d-M-Y", strtotime($created_at))}}')->addColumn('status', function ($row) {
                return view('themes.frest.partials.status', compact('row'));
            })->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'item_category.name', 'name' => 'name', 'title' => 'Item Category'],
            ['data' => 'unit.name', 'name' => 'name', 'title' => 'Unit'],
            ['data' => 'od_rate', 'name' => 'od_rate', 'title' => 'OD Rate'],
            ['data' => 'hd_rate', 'name' => 'hd_rate', 'title' => 'HD Rate'],
            ['data' => 'transit_od', 'name' => 'transit_od', 'title' => 'Transit OD'],
            ['data' => 'transit_hd', 'name' => 'transit_hd', 'title' => 'Transit HD'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);

        $itemCategories = ItemCategory::where('status', true)->get();
        $units = Unit::where('status', true)->get();

        return view('themes.frest.parcelSetting.item.index', compact('html', 'itemCategories', 'units'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itemstore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:items',
            'item_category_id' => 'required',
            'unit_id' => 'required',
            'od_rate' => 'required',
            'hd_rate' => 'required',
            'transit_od' => 'required',
            'transit_hd' => 'required',
        ]);

        //check the name
        $ifExist = Item::where('name', $data['name'])->first();

        if ($ifExist) return redirect()->back()->with('error', 'Item already existed');

        Item::create([
            'name' => $data['name'],
            'item_category_id' => $data['item_category_id'],
            'unit_id' => $data['unit_id'],
            'od_rate' => $data['od_rate'],
            'hd_rate' => $data['hd_rate'],
            'transit_od' => $data['transit_od'],
            'transit_hd' => $data['transit_hd'],
            'status' => true
        ]);

        return redirect()->back()->with('success', 'Item added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function itemupdate(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'item_category_id' => 'required',
            'unit_id' => 'required',
            'od_rate' => 'required',
            'hd_rate' => 'required',
            'transit_od' => 'required',
            'transit_hd' => 'required',
        ]);

        //check the name
        $ifExistName = Item::where('name', $data['name'])->first();

        if ($ifExistName) {
            if ($ifExistName->id != $id) {
                return redirect()->back()->with('error', 'Item already existed');
            }
        }

        $ifExist = Item::where('id', $id)->first();

        if (!$ifExist) return redirect()->back()->with('error', 'Item doesnt existed');

        $ifExist->name = $data['name'];
        $ifExist->item_category_id = $data['item_category_id'];
        $ifExist->unit_id = $data['unit_id'];
        $ifExist->od_rate = $data['od_rate'];
        $ifExist->hd_rate = $data['hd_rate'];
        $ifExist->transit_od = $data['transit_od'];
        $ifExist->transit_hd = $data['transit_hd'];
        $ifExist->save();

        return redirect()->back()->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function itemdestroy(Request $request)
    {

        $id = $request->id;
        $status = $request->status;
        $item = Item::where('id', $id)->first();
        if ($item) {
            $item->status =  $status === "untrash" ? true :  false;
            $item->save();
            return redirect()->back()->with('success', 'Item Categry deleted successfully');
        }
        return redirect()->back()->with('error', 'Item  delete operation failed, please try again');
    }
}
