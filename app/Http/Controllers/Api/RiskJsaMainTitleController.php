<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RiskJsaDevice;
use App\Models\RiskJsaMainTitle;
use App\Models\RiskJsaSubTitle;
use App\Models\RiskJsaContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RiskJsaMainTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $device = RiskJsaDevice::find($request->id);
        $mains = RiskJsaMainTitle::where('device_id', $request->id)->orderBy('sort_num')->get();
        $result = [];
        foreach($mains as $main) {
            $subs = RiskJsaSubTitle::where('main_id', $main->id)->orderBy('sort_num')->get();
            $subResult = [];
            foreach($subs as $sub) {
                $contents = RiskJsaContent::where('sub_id', $sub->id)->orderBy('sort_num')->get();
                foreach($contents as $content) {
                    $content->before_category = array_filter(explode(",", $content->before_category), function($key) {
                        return ($key !== NULL && $key !== FALSE && $key !== '');
                    });
                }
                $subResult[] = [
                    'id' => $sub->id,
                    'sub_title' => $sub->sub_title,
                    'contentList' => $contents
                ];
            }
            $result[] = [
                'id' => $main->id,
                'main_title' => $main->main_title,
                'subList' => $subResult,
            ];
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
        $mainSortArr = $request->mainSortArr;

        DB::beginTransaction();
        try {
            foreach($deviceList as $x => $main) {
                $main['device_id'] = $request->device_id;
                $main['sort_num'] = array_search(strval($x), $mainSortArr)-1;
                if($main['id'] == -1) {
                    $main_id = RiskJsaMainTitle::create($main)->id;
                }else{
                    RiskJsaMainTitle::where('id', $main['id'])->update([
                        'main_title' => $main['main_title'],
                        'sort_num' => $main['sort_num'],
                    ]);
                    $main_id = $main['id'];
                }
                $subSortArr = $main['subSortArr'];
                foreach($main['subList'] as $y => $sub) {
                    $sub['main_id'] = $main_id;
                    $sub['sort_num'] = array_search("$x-$y", $subSortArr);
                    if($sub['id'] == -1) {
                        $sub_id = RiskJsaSubTitle::create($sub)->id;
                    }else{
                        RiskJsaSubTitle::where('id', $sub['id'])->update([
                            'sub_title' => $sub['sub_title'],
                            'sort_num' => $sub['sort_num'],
                        ]);
                        $sub_id = $sub['id'];
                    }
                    $contentSortArr = $sub['contentSortArr'];
                    foreach($sub['contentList'] as $z => $content) {
                        $content['sub_id'] = $sub_id;
                        $content['sort_num'] = array_search("$x-$y-$z", $contentSortArr);
                        $content['before_category'] = join(",", $content['before_category']);
                        if($content['id'] == -1) {
                            RiskJsaContent::create($content);
                        }else{
                            RiskJsaContent::where('id', $content['id'])->update($content);
                        }
                    }
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
     * @param  \App\Models\RiskJsaMainTitle  $riskJsaMainTitle
     * @return \Illuminate\Http\Response
     */
    public function show(RiskJsaMainTitle $riskJsaMainTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiskJsaMainTitle  $riskJsaMainTitle
     * @return \Illuminate\Http\Response
     */
    public function edit(RiskJsaMainTitle $riskJsaMainTitle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiskJsaMainTitle  $riskJsaMainTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiskJsaMainTitle $riskJsaMainTitle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiskJsaMainTitle  $riskJsaMainTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        RiskJsaMainTitle::whereIn('id', $request->mainDel)->delete();
        RiskJsaSubTitle::whereIn('id', $request->subDel)->delete();
        RiskJsaContent::whereIn('id', $request->contentDel)->delete();
    }
}
