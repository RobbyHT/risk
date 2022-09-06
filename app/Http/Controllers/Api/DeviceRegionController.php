<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DeviceRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class DeviceRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = DeviceRegion::orderBy('id')->get();
        return response()->json(['data' => $result], 200);
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
        $data = $request->all();
        DB::beginTransaction();
        try {
            DeviceRegion::create($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['errors' => $e->getMessage()], 400);
        }
        return response()->json(['success' => 'Create successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeviceRegion  $deviceRegion
     * @return \Illuminate\Http\Response
     */
    public function show(DeviceRegion $deviceRegion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeviceRegion  $deviceRegion
     * @return \Illuminate\Http\Response
     */
    public function edit(DeviceRegion $deviceRegion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeviceRegion  $deviceRegion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DeviceRegion::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeviceRegion  $deviceRegion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DeviceRegion::whereIn('id', $request->ids)->delete();
    }
}
