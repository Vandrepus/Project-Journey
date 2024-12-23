<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Display all reports for admin
    public function index()
    {
        $reports = Report::latest()->with('user', 'reportable')->paginate(10);
        return view('admin.reports.index', compact('reports'));
    }

    // Store a new report
    public function store(Request $request)
    {
        $request->validate([
            'reportable_id' => 'required|integer',
            'reportable_type' => 'required|string',
            'reason' => 'nullable|string|max:255',
        ]);

        Report::create([
            'user_id' => auth()->id(),
            'reportable_id' => $request->reportable_id,
            'reportable_type' => $request->reportable_type,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Report submitted successfully.');
    }

    // Delete a report
    public function destroy(Report $report)
    {
        $report->delete();
        return back()->with('success', 'Report deleted successfully.');
    }

    public function show($id)
    {
        $report = Report::with('user', 'reportable')->findOrFail($id);

        return view('admin.reports.show', compact('report'));
    }

}
