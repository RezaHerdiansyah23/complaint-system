<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil input periode, defaultnya bulan dan tahun sekarang
        $selectedYear = $request->input('year', Carbon::now()->year);
        $selectedMonth = $request->input('month', Carbon::now()->month);

        // 2. Buat query dasar berdasarkan periode yang dipilih
        $baseQuery = Complaint::whereYear('created_at', $selectedYear)
                              ->whereMonth('created_at', $selectedMonth);

        // 3. Hitung statistik untuk tabel ringkasan
        $stats = [
            'total' => (clone $baseQuery)->count(),
            'selesai' => (clone $baseQuery)->where('status', 'resolved')->count(),
            'aktif' => (clone $baseQuery)->where('status', 'in_progress')->count(),
            'ditolak' => (clone $baseQuery)->where('verification_status', 'rejected')->count(),
        ];

        // 4. Siapkan data untuk Chart.js (Jumlah keluhan per status)
        $chartDataQuery = (clone $baseQuery)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
        
        $chartLabels = $chartDataQuery->keys()->map(fn ($status) => Str::title(str_replace('_', ' ', $status)))->all();
        $chartValues = $chartDataQuery->values()->all();

        // 5. Siapkan data untuk filter dropdown di view
        $years = Complaint::select(DB::raw('YEAR(created_at) as year'))
                        ->distinct()
                        ->orderBy('year', 'desc')
                        ->pluck('year');

        return view('admin.statistics.index', compact(
            'stats',
            'chartLabels',
            'chartValues',
            'years',
            'selectedYear',
            'selectedMonth'
        ));
    }
}