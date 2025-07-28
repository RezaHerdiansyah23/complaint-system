<?php

namespace App\Http\Controllers\Noc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\Response;


class NocDashboardController extends Controller
{
   public function index(Request $request)
    {
        // 1. Ambil input untuk filter dan sortir
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDir = $request->input('sort_dir', 'desc');
        $search = $request->input('search', '');
        $statusFilter = $request->input('status', '');

        // 2. Ambil ID keluhan yang ditugaskan ke NOC yang sedang login
        $assignedComplaintIds = Response::where('noc_id', Auth::id())->pluck('complaint_id');

         $stats = [
            'aktif' => Complaint::whereIn('id', $assignedComplaintIds)->where('status', 'in_progress')->count(),
            'selesai' => Complaint::whereIn('id', $assignedComplaintIds)->where('status', 'resolved')->count(),
        ];
        // 3. Buat query untuk mengambil data keluhan
        $complaints = Complaint::whereIn('id', $assignedComplaintIds)
            ->with('user') // Eager load relasi user
            ->filter($request->only(['search', 'status'])) // Gunakan scope filter yang sudah ada
            ->orderBy($sortBy, $sortDir)
            ->paginate(10)
            ->withQueryString();

        return view('noc.dashboard', compact('complaints', 'stats'));
    }

    public function show($id)
{
    // 1. Cari keluhan berdasarkan ID, langsung ambil semua relasi yang dibutuhkan
    $complaint = Complaint::with(['user', 'response.noc'])->findOrFail($id);

    // 2. Security Check: Pastikan keluhan ini benar-benar ditugaskan ke NOC yang sedang login
    if (!$complaint->response || $complaint->response->noc_id !== Auth::id()) {
        abort(403, 'Anda tidak memiliki akses ke keluhan ini.');
    }

    // 3. Kirim variabel $complaint yang sudah lengkap ke view
    return view('noc.complaints.show', compact('complaint'));
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
