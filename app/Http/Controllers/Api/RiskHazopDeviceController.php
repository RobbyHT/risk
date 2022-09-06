<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RiskHazopDevice;
use App\Models\RiskHazopSubDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RiskHazopDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = RiskHazopDevice::orderBy('id')->get();
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
            RiskHazopDevice::create($data);
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
     * @param  \App\Models\RiskHazopDevice  $riskHazopDevice
     * @return \Illuminate\Http\Response
     */
    public function show(RiskHazopDevice $riskHazopDevice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiskHazopDevice  $riskHazopDevice
     * @return \Illuminate\Http\Response
     */
    public function edit(RiskHazopDevice $riskHazopDevice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiskHazopDevice  $riskHazopDevice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiskHazopDevice $riskHazopDevice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiskHazopDevice  $riskHazopDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        RiskHazopDevice::whereIn('id', $request->ids)->delete();
        RiskHazopSubDevice::whereIn('device_id', $request->ids)->delete();
    }
}
