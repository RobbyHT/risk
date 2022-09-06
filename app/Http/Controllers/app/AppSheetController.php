<?php

namespace App\Http\Controllers\app;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use App\Models\UserMember;
use App\Models\ExamSheet;
use App\Models\ExamSheetDeviceItem;

class AppSheetController extends Controller
{
    protected function store_file($id, $item)
    {
        $f = $item['file'];

        if ($f === null) { return [null, null]; }

        $name = Str::random(30);
        $ext = pathinfo($f->getClientOriginalName(), PATHINFO_EXTENSION) ?? 'jpg';

        $fullname = "$name.$ext";

        $path = "sheet/$id/$fullname";
        $content = file_get_contents($f->getRealPath());

        Storage::disk('public')->put($path, $content);

        return [$path, $fullname];
    }
    
    protected function store_sheet_item($sid, $item, $path, $name)
    {
        $deviceId = $item['user_device_id'];
        $bool = $item['value_boolean'] ?? null;
        $v = $item['value'] ?? null;
        $desc = $item['description'] ?? null;

        return ExamSheetDeviceItem::create([
            'exam_sheet_id' => $sid,
            'user_device_id' => $deviceId,
            'img_path' => $path,
            'img_name' => $name,
            'value_boolean' => $bool,
            'value' => $v,
            'description' => $desc
        ]);
    }

    public function upload(Request $request)
    {
        if (!$user = $request->user()) {
            return response()->json(['error' => "You haven't logged in!"], 401);
        }

        $pid = $request->project_id;
        $pdateid = $request->project_date_id;
        $sheet = ExamSheet::create(['exam_project_id' => $pid, 'exam_project_date_id' => $pdateid]);

        $items = $request->items;

        foreach($items as $item) {
            [$path, $name] = $this->store_file($sheet->id, $item);
            
            if ($path && $name) {
                $this->store_sheet_item($sheet->id, $item, $path, $name);
            }
        }

        return response()->json(['success' => true]);
    }

    public function sheet(Request $request, $sid)
    {
        if (!$user = $request->user()) {
            return response()->json(['error' => "You haven't logged in!"], 401);
        }

        $data = ExamSheet::find($sid)->with('devices_items')->first();

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function history(Request $request)
    {
        if (!$user = $request->user()) {
            return response()->json(['error' => "You haven't logged in!"], 401);
        }
        
        $data = $user->sheets;
    
        return response()->json(['success' => true, 'data' => $data]);
    }
}
