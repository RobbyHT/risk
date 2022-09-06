<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\DeviceExamItem;
use App\Models\DeviceRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Device::with('region')->orderBy('id')->get();
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
        DB::beginTransaction();
        try {
            DeviceExamItem::whereIn('id', $request->deleteList)->delete();
            $device_id = $request->deviceId;
            if($device_id == -1) {
                $device_id = Device::create([
                    'region_id' => $request->deviceRegion,
                    'code' => $request->deviceCode,
                    'name' => $request->deviceName,
                ])->id;
            }
            foreach($request->deviceList as $data) {
                $data['device_id'] = $device_id;
                if($data['id'] == -1) {
                    $data['id'] = DeviceExamItem::max('id') + 1;
                    DeviceExamItem::create($data);
                }else{
                    DeviceExamItem::where('id', $data['id'])->update($data);
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
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Device::with('exam_items')->get()->find($id);
        return response()->json(['data' => $result], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Device::whereIn('id', $request->ids)->delete();
    }
}
