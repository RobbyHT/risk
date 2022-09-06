<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RiskWhatIfDevice;
use App\Models\RiskWhatIfSubDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RiskWhatIfSubDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $device = RiskWhatIfDevice::find($request->id);
        $result = RiskWhatIfSubDevice::where('device_id', $request->id)->orderBy('sort_num')->get();
        foreach($result as $data) {
            $data->before_category = array_filter(explode(",", $data->before_category), function($key) {
                return ($key !== NULL && $key !== FALSE && $key !== '');
            });
        }
        return response()->json(['device' => $device->device_name, 'data' => $result], 200);
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
        $deviceList = $request->deviceList;
        $sortArr = $request->sortArr;

        DB::beginTransaction();
        try {
            foreach($deviceList as $key => $data) {
                $sortNum = array_search($key, $sortArr);
                $data['device_id'] = $request->device_id;
                $data['sort_num'] = $sortNum;
                $data['before_category'] = join(",", $data['before_category']);
                //新增, 否則修改
                if($data['id'] == -1) {
                    RiskWhatIfSubDevice::create($data);
                }else{
                    RiskWhatIfSubDevice::where('id', $data['id'])->update($data);
                }
            }
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
     * @param  \App\Models\RiskWhatIfSubDevice  $riskWhatIfSubDevice
     * @return \Illuminate\Http\Response
     */
    public function show(RiskWhatIfSubDevice $riskWhatIfSubDevice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiskWhatIfSubDevice  $riskWhatIfSubDevice
     * @return \Illuminate\Http\Response
     */
    public function edit(RiskWhatIfSubDevice $riskWhatIfSubDevice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiskWhatIfSubDevice  $riskWhatIfSubDevice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiskWhatIfSubDevice $riskWhatIfSubDevice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiskWhatIfSubDevice  $riskWhatIfSubDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        RiskWhatIfSubDevice::whereIn('id', $request->ids)->delete();
    }
}
