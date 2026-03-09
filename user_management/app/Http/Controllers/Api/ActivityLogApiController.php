<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActivityLogApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->integer('per_page', 20);

        $query = ActivityLog::query()
            ->with('user')
            ->latest();

        if ($request->filled('user_id')) {
            $query->where('user_id', (int) $request->integer('user_id'));
        }

        if ($request->filled('action')) {
            $query->where('action', 'like', '%' . $request->string('action') . '%');
        }

        if ($request->filled('module')) {
            $query->where('module', 'like', '%' . $request->string('module') . '%');
        }

        $logs = $query->paginate(max(1, min($perPage, 100)));

        return response()->json($logs);
    }

    public function show(ActivityLog $activityLog): JsonResponse
    {
        $activityLog->load('user');

        return response()->json($activityLog);
    }

    public function destroy(ActivityLog $activityLog): JsonResponse
    {
        $activityLog->delete();

        return response()->json(['message' => 'Activity log deleted successfully.']);
    }
}
