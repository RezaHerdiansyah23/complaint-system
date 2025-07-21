<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Mengambil input untuk filter dan sortir
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDir = $request->input('sort_dir', 'desc');
        $search = $request->input('search', '');
        $statusFilter = $request->input('status', '');

        // 2. Query untuk menghitung jumlah status (Ini sudah benar)
        $rawStatusCounts = Complaint::where('user_id', Auth::id())
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
            
        $statusCounts = $rawStatusCounts->mapWithKeys(function ($total, $status) {
            $displayStatus = match (strtolower($status)) {
                'in_progress' => 'In Progress',
                'resolved' => 'Completed',
                default => Str::title($status),
            };
            return [$displayStatus => $total];
        });

        // 3. Query utama untuk tabel dengan LOGIKA FILTER STATUS YANG DIPERBAIKI
                $complaints = Complaint::where('user_id', Auth::id())
            ->filter($request->only(['search', 'status'])) // PANGGIL SCOPE DI SINI
            ->orderBy($sortBy, $sortDir)
            ->paginate(5)
            ->withQueryString();

        return view('dashboard', compact('complaints', 'search', 'statusCounts'));
    }
}