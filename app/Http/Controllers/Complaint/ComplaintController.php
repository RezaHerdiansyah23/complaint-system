<?php

namespace App\Http\Controllers\Complaint;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ComplaintController extends Controller
{
    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
        }

        Complaint::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'company_name' => $request->company_name,
            'description' => $request->description,
            'attachment' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Complaint submitted successfully.');
    }

    public function show($id)
        {
            $complaint = Complaint::where('id', $id)
                ->where('user_id', auth()->id()) // biar cuma customer yg punya yg bisa lihat
                ->firstOrFail();

            return view('complaints.show', compact('complaint'));
        }

}


