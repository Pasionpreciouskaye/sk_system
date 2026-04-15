<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditTrail::with('user')->latest();

        if ($request->filled('module') && $request->module !== 'all') {
            $query->where('module', $request->module);
        }
        if ($request->filled('action') && $request->action !== 'all') {
            $query->where('action', $request->action);
        }
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('description', 'like', "%$s%")
                  ->orWhere('module', 'like', "%$s%")
                  ->orWhereHas('user', fn($u) => $u->where('first_name', 'like', "%$s%")->orWhere('last_name', 'like', "%$s%"));
            });
        }

        $logs   = $query->paginate(20)->withQueryString();
        $total  = AuditTrail::whereMonth('created_at', now()->month)->count();
        $deletions = AuditTrail::where('action', 'delete')->whereMonth('created_at', now()->month)->count();
        $last   = AuditTrail::with('user')->latest()->first();

        return view('audit.index', compact('logs', 'total', 'deletions', 'last'));
    }

    public function show(AuditTrail $auditTrail)
    {
        $auditTrail->load('user');
        return response()->json($auditTrail);
    }
}
