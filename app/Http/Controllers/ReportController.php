<?php

namespace App\Http\Controllers;

use App\Exports\ReportsExport;
use App\Models\Report;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::where('user_id', auth()->user()->id)->get();
        return view('reports.index', compact('reports'));
    }

    public function export()
    {
        $export = new ReportsExport(Report::where('user_id', auth()->user()->id)->get()->toArray());

        return Excel::download($export, 'reports.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportRequest $request)
    {
        $validatedRequest = $request->validated();
        Report::create([
            'user_id' => auth()->user()->id,
            'latitude' => $validatedRequest['latitude'],
            'longitude' => $validatedRequest['longitude'],
            'information' => $validatedRequest['information'],
        ]);
        return redirect()->route('reports.index')
        ->with('success','Laporan berhasil dibuat!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report): View
    {
        if ($report->user->id !== auth()->user()->id) {
           return  abort(403, 'Unauthorized');
        }
        return view('reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        $validatedRequest = $request->validated();
        if ($report->user->id !== auth()->user()->id) {
            return  abort(403, 'Unauthorized');
         }
        //  dd($validatedRequest['latitude'], );
        $report->update([
            'user_id' => auth()->user()->id,
            'latitude' => $validatedRequest['latitude'],
            'longitude' => $validatedRequest['longitude'],
            'information' => $validatedRequest['information'],
        ]);
        return redirect()->route('reports.index')
                        ->with('success','Laporan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        if ($report->user->id !== auth()->user()->id) {
            return  abort(403, 'Unauthorized');
         }
        $report->delete();

        return redirect()->route('reports.index')
                        ->with('success','Laporan berhasil dihapus!');
    }
}
