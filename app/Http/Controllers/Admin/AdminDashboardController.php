<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\User;
use App\Models\Response;



class AdminDashboardController extends Controller
{
    //this function will be used to display the admin dashboard
     public function index(Request $request)
    {
         $sortBy = $request->input('sort_by', 'created_at');
         $sortDir = $request->input('sort_dir', 'asc');
         $stats = [
        'verified' => Complaint::where('verification_status', 'accepted')->count(),
        'distributed' => Complaint::whereHas('response')->count(),
        'completed' => Complaint::where('status', 'resolved')->count(),
    ];
        // GABUNGKAN SEMUA QUERY MENJADI SATU
        $complaints = Complaint::with('user')
    ->filter($request->only(['search', 'status', 'verification_status'])) // <-- filtering
            ->orderBy($sortBy, $sortDir)
            ->paginate(10)
            ->withQueryString();

         return view('admin.dashboard', compact('complaints', 'stats'));
    }

    public function show($id)
        {
            $complaint = Complaint::with(['user', 'response.noc'])->findOrFail($id);

            $nocs = User::where('role', 'noc')->get(); // ambil semua teknisi

            return view('admin.complaints.show', compact('complaint', 'nocs'));
        }

public function assign(Request $request, $id)
{
    $request->validate([
        'noc_id' => 'required|exists:users,id',
        'notes' => 'nullable|string',
    ]);

    $complaint = Complaint::findOrFail($id);

    // Cegah assign dua kali
    if ($complaint->response) {
        return back()->with('error', 'This complaint has already been assigned.');
    }

    // Buat respon distribusi
    Response::create([
        'complaint_id' => $complaint->id,
        'noc_id' => $request->noc_id,
        'notes' => $request->notes,
    ]);

    return back()->with('success', 'Complaint has been assigned to technician.');
}

public function verify(Complaint $complaint)
    {
        // Cek apakah sudah pernah diverifikasi
        if ($complaint->verified_at) {
            return back()->with('error', 'Complaint has already been verified.');
        }

        // Lakukan verifikasi
        $complaint->verified_at = now();
        $complaint->verified_by = auth()->id();
        $complaint->save();

        return back()->with('success', 'Complaint has been successfully verified.');
    }


    public function accept(Complaint $complaint)
    {
        if ($complaint->verification_status !== 'pending') {
            return back()->with('error', 'This complaint has already been reviewed.');
        }
        $complaint->verification_status = 'accepted';
        $complaint->save();
        return back()->with('success', 'Complaint has been accepted and is ready to be assigned.');
    }

    public function reject(Complaint $complaint)
    {
        if ($complaint->verification_status !== 'pending') {
            return back()->with('error', 'This complaint has already been reviewed.');
        }
        $complaint->verification_status = 'rejected';
        $complaint->save();
        return back()->with('success', 'Complaint has been rejected.');
    }

}
