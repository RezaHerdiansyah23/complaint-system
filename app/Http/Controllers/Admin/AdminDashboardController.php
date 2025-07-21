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
        $sortDir = $request->input('sort_dir', 'desc');

        // GABUNGKAN SEMUA QUERY MENJADI SATU
        $complaints = Complaint::with('user')
            ->filter($request->only(['search', 'status'])) // Memanggil scope filter dari Model
            ->orderBy($sortBy, $sortDir)
            ->paginate(10)
            ->withQueryString();

        return view('admin.dashboard', compact('complaints'));
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


}
