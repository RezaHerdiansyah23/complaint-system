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
         $sortBy = $request->input('sort_by', 'created_at');
         $sortDir = $request->input('sort_dir', 'asc');

         $assignedComplaintIds = Response::where('noc_id', Auth::id())->pluck('complaint_id');

         $stats = [
             'aktif' => Complaint::whereIn('id', $assignedComplaintIds)->where('status', 'in_progress')->count(),
             'selesai' => Complaint::whereIn('id', $assignedComplaintIds)->where('status', 'resolved')->count(),
         ];

         $complaints = Complaint::whereIn('id', $assignedComplaintIds)
             ->with('user')
             ->filter($request->only(['search', 'status']))
             ->orderBy($sortBy, $sortDir)
             ->paginate(10)
             ->withQueryString();

         return view('noc.dashboard', compact('complaints', 'stats'));
     }

    public function show($id)
    {
        // 1. Cari keluhan berdasarkan ID, langsung ambil semua relasi yang dibutuhkan
        $complaint = Complaint::with(['user', 'response.noc', 'feedback'])->findOrFail($id);

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

        $complaint = $response->complaint;

        // Validasi FIFO hanya jika status mau diubah ke 'resolved'
        if ($request->status === 'resolved') {
            // Ambil semua ID keluhan yang ditugaskan ke NOC ini
            $assignedComplaintIds = Response::where('noc_id', Auth::id())
                ->where('complaint_id', '!=', $id) // Kecuali keluhan ini sendiri
                ->pluck('complaint_id');

            // Cek apakah ada keluhan yang masuk lebih dulu tapi belum 'resolved'
            $olderPending = Complaint::whereIn('id', $assignedComplaintIds)
                ->where('status', '!=', 'resolved')
                ->where('created_at', '<', $complaint->created_at)
                ->first();

            if ($olderPending) {
                $formattedTime = $olderPending->created_at->format('d M Y H:i');
                return back()->with('error', "Maaf, silakan selesaikan keluhan yang lebih lama terlebih dahulu (Keluhan: \"{$olderPending->title}\" pada {$formattedTime}).");
            }
        }

        // Update status complaint
        $complaint->status = $request->status;
        $complaint->save();

        // Update notes teknis
        $response->notes = $request->notes;
        $response->save();

        return redirect()->route('noc.dashboard')->with('success', 'Complaint updated successfully.');
    }
}
