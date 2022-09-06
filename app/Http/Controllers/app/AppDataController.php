<?php

namespace App\Http\Controllers\app;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\UserMember;
use App\Models\ExamProjectDate;

class AppDataController extends Controller
{
    public function today_projects(Request $request)
    {
        if (!$user = $request->user()) {
            return response()->json(['error' => "You haven't logged in!"], 401);
        }
        
        $data = UserMember::find($user->id)->todayExamProjects()->get();

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function daily_projects(Request $request, $date)
    {
        if (!$user = $request->user()) {
            return response()->json(['error' => "You haven't logged in!"], 401);
        }
        
        $data = UserMember::find($user->id)->dailyExamProjects($date)->get();

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function project(Request $request, $pid, $date_id)
    {
        if (!$user = $request->user()) {
            return response()->json(['error' => "You haven't logged in."], 401);
        }

        // pid => exam_project_dates
        $data = UserMember::find($user->id)
                            ->examProject($pid, $date_id)
                            ->first();
    
        return response()->json(['data' => $data]);
    }
}