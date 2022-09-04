<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $site_setting = SiteSetting::first();
        return view('themes.frest.site-setting.index', compact('site_setting'));
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
        if ($request->has('id')) {
            $site_setting = SiteSetting::findOrNew($request->id);
        } else {
            $site_setting = new SiteSetting();
        }
        $site_setting->name = $request->name;
        $site_setting->email = $request->email;
        $site_setting->phone = $request->phone;
        $site_setting->address = $request->address;
        if ($request->hasFile('logo')) {
            $site_setting->logo = $request->logo->store('site_settings');
        }
        if ($request->hasFile('favicon')) {
            $site_setting->favicon = $request->favicon->store('site_settings');
        }
        $site_setting->copyright = $request->copyright;
        $site_setting->facebook = $request->facebook;
        $site_setting->meta_title = $request->meta_title;
        $site_setting->meta_description = $request->meta_description;
        $site_setting->meta_keywords = $request->meta_keywords;
        $site_setting->google_map = $request->google_map;
        $site_setting->save();
        return redirect()->route('site.setting')->with('success', 'Site Setting Updated Successfully');
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
