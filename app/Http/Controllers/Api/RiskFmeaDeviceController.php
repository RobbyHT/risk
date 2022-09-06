<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RiskFmeaDevice;
use App\Models\RiskFmeaSubDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RiskFmeaDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = RiskFmeaDevice::orderBy('id')->get();
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
            RiskFmeaDevice::create($data);
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
     * @param  \App\Models\RiskFmeaDevice  $riskFmeaDevice
     * @return \Illuminate\Http\Response
     */
    public function show(RiskFmeaDevice $riskFmeaDevice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiskFmeaDevice  $riskFmeaDevice
     * @return \Illuminate\Http\Response
     */
    public function edit(RiskFmeaDevice $riskFmeaDevice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiskFmeaDevice  $riskFmeaDevice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiskFmeaDevice $riskFmeaDevice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiskFmeaDevice  $riskFmeaDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        RiskFmeaDevice::whereIn('id', $request->ids)->delete();
        RiskFmeaSubDevice::whereIn('device_id', $request->ids)->delete();
    }
}
