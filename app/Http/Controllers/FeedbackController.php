<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{



   public function index(Request $request)
    {
        // Ambil hanya keluhan milik user yang statusnya 'resolved'
        // dan yang belum memiliki feedback (relasi 'feedback' nya null)
        $complaints = Complaint::where('user_id', Auth::id())
            ->where('status', 'resolved')
            ->whereDoesntHave('feedback') // Kunci utama: hanya yang belum ada feedback
            ->latest('updated_at') // Urutkan berdasarkan kapan diselesaikan
            ->paginate(10);

        return view('feedback.index', compact('complaints'));
    }


    public function create(Complaint $complaint)
    {
        if ($complaint->user_id !== Auth::id() || $complaint->status !== 'resolved' || $complaint->feedback) {
            abort(403, 'Anda tidak dapat memberikan feedback untuk keluhan ini.');
        }

        return view('feedback.create', compact('complaint'));
    }

    public function store(Request $request, Complaint $complaint)
    {
        if ($complaint->user_id !== Auth::id() || $complaint->status !== 'resolved' || $complaint->feedback) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Feedback::create([
            'complaint_id' => $complaint->id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('dashboard')->with('success', 'Terima kasih atas feedback Anda!');
    }

    public function show(Feedback $feedback)
    {
        // Security Check: Pastikan feedback ini milik pengguna yang login
        if ($feedback->user_id !== Auth::id()) {
            abort(403);
        }

        // Eager load relasi complaint beserta user-nya
        $feedback->load('complaint.user');

        return view('feedback.show', compact('feedback'));
    }
}