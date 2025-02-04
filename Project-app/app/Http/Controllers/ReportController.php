<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

/**
 * Šis kontrolieris pārvalda lietotāju ziņojumus par nepiemērotu saturu.
 * Administratoriem ir iespēja apskatīt, dzēst un pārvaldīt ziņojumus.
 *
 * This controller manages user reports on inappropriate content.
 * Administrators have the ability to view, delete, and manage reports.
 */
class ReportController extends Controller
{
    /**
     * Parāda visus lietotāju iesniegtos ziņojumus administratoram.
     *
     * Displays all user-submitted reports for the admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $reports = Report::latest()->with('user', 'reportable')->paginate(10);
        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Saglabā jaunu lietotāja ziņojumu par nepiemērotu saturu.
     *
     * Stores a new user report on inappropriate content.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'reportable_id'   => 'required|integer', // Ziņojamā objekta ID | Reported object's ID || For example if review has ID "8" and it got reported,it will have  reportable_id -"8"
            'reportable_type' => 'required|string', 
            'reason'          => 'nullable|string|max:255', 
        ]);
        Report::create([
            'user_id'         => auth()->id(), 
            'reportable_id'   => $request->reportable_id,
            'reportable_type' => $request->reportable_type,
            'reason'          => $request->reason,
        ]);
        return back()->with('success', 'Report submitted successfully.');
    }

    /**
     * Dzēš ziņojumu no sistēmas.
     *
     * Deletes a report from the system.
     *
     * @param Report $report
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Report $report)
    {
        $report->delete();

        return back()->with('success', 'Report deleted successfully.');
    }

    /**
     * Parāda konkrēta ziņojuma informāciju administratoram.
     *
     * Displays a specific report's details to the admin.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $report = Report::with('user', 'reportable')->findOrFail($id);
        return view('admin.reports.show', compact('report'));
    }
}
