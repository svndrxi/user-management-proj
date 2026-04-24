<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(Request $request): View
    {
        $query = ActivityLog::query()
            ->with('user')
            ->latest();

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->integer('user_id'));
        }

        if ($request->filled('action')) {
            $search = $this->escapeLike($request->string('action'));
            $query->where('action', 'like', '%' . $search . '%');
        }

        if ($request->filled('module')) {
            $search = $this->escapeLike($request->string('module'));
            $query->where('module', 'like', '%' . $search . '%');
        }

        $logs = $query->paginate(20)->withQueryString();

        return view('activity-logs.index', compact('logs'));
    }

    public function show(ActivityLog $activityLog): View
    {
        $activityLog->load('user');

        return view('activity-logs.show', compact('activityLog'));
    }

    public function destroy(ActivityLog $activityLog): RedirectResponse
    {
        Gate::authorize('delete-activity-logs');

        $activityLog->delete();

        return redirect()
            ->route('activity-logs.index')
            ->with('success', 'Activity log deleted successfully.');
    }

    /**
     * Escape special LIKE wildcard characters to prevent
     * users from crafting expensive wildcard queries.
     */
    private function escapeLike(string $value): string
    {
        return str_replace(['%', '_'], ['\%', '\_'], $value);
    }
}
