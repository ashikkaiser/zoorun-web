<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\PickupAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::active()->get();
        $pickup_points = PickupAddress::where('merchant_id', Auth::user()->id)->get();
        return view('themes.frest.merchantPanel.pickup-point.index', compact('districts', 'pickup_points'));
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
            'address' => 'required',
            'district_id' => 'required',
            'zone_id' => 'required',
            'area_id' => 'required',
            'phone' => 'required'
        ]);
        $pickup_address = PickupAddress::findOrNew($request->id);
        $pickup_address->merchant_id = Auth::user()->id;
        $pickup_address->name = $request->name;
        $pickup_address->address = $request->address;
        $pickup_address->district_id = $request->district_id;
        $pickup_address->zone_id = $request->zone_id;
        $pickup_address->area_id = $request->area_id;
        $pickup_address->phone = $request->phone;
        $pickup_address->alt_phone = $request->alt_phone;
        $pickup_address->status = true;
        $pickup_address->save();
        return redirect()->back()->with('success', 'Pickup Address added successfully');

        // PickupAddress::create([
        //     'merchant_id' => Auth::user()->id,
        //     'name' => $data['name'],
        //     'address' => $data['address'],
        //     'district_id' => $data['district_id'],
        //     'zone_id' => $data['zone_id'],
        //     'area_id' => $data['area_id'],
        //     'phone' => $data['phone'],
        //     'alt_phone' => $request->alt_phone,
        //     'status' => true
        // ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
