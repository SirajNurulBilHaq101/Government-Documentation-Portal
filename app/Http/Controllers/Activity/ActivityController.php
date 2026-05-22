<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can view activity logs.');
        }

        $query = ActivityLog::with(['user', 'document']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('action')) {
            $query->where('action', 'like', $request->action . '%');
        }

        $activities = $query->latest()->paginate(15)->withQueryString();
        $users      = User::orderBy('name')->get();

        return view('activity.index', compact('activities', 'users'));
    }
}
