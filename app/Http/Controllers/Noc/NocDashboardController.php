<?php

namespace App\Http\Controllers\Noc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\Response;


class NocDashboardController extends Controller
{
   public function index()
    {
        // Ambil semua complaint yang ditugaskan ke NOC login
        $responses = Response::with('complaint.user')
            ->where('noc_id', Auth::id())
            ->latest()
            ->get();

        return view('noc.dashboard', compact('responses'));
    }

    public function show($id)
    {
        $response = Response::with('complaint.user')->where('noc_id', Auth::id())
                    ->where('complaint_id', $id)
                    ->firstOrFail();

        return view('noc.complaints.show', compact('response'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:in_progress,resolved',
            'notes' => 'nullable|string',
        ]);

        $response = Response::where('noc_id', Auth::id())
                    ->where('complaint_id', $id)
                    ->firstOrFail();

        // Update status complaint
        $complaint = $response->complaint;
        $complaint->status = $request->status;
        $complaint->save();

        // Update notes teknis
        $response->notes = $request->notes;
        $response->save();

        return redirect()->route('noc.dashboard')->with('success', 'Complaint updated successfully.');
    }
}
