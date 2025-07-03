<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Layanan;
use App\Models\Transaksi;
use App\Models\Admin;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Total Data
            $totalPelanggan = Pelanggan::count();
            $totalLayanan   = Layanan::count();
            $totalTransaksi = Transaksi::count();
            $totalAdmin     = Admin::count();

            // Progress Pengerjaan
            $layananSelesai = Layanan::where('harga', '>', 0)->count();
            $layananBelum   = Layanan::where('harga', 0)->count();

            // Pie Chart: Distribusi Role Admin
            $roleCounts = Admin::selectRaw('role, COUNT(*) as total')
                                ->groupBy('role')
                                ->pluck('total', 'role');

            // Line Chart: Jumlah pelanggan baru 6 bulan terakhir
            $pelangganPerBulan = Pelanggan::selectRaw("TO_CHAR(created_at, 'YYYY-MM') as bulan, COUNT(*) as total")
                ->groupByRaw("TO_CHAR(created_at, 'YYYY-MM')")
                ->orderByRaw("TO_CHAR(created_at, 'YYYY-MM')")
                ->pluck('total', 'bulan');

            // Log aktivitas dashboard
            Log::info('Dashboard diakses oleh admin');

            return view('dashboard.index', compact(
                'totalPelanggan',
                'totalLayanan',
                'totalTransaksi',
                'totalAdmin',
                'layananSelesai',
                'layananBelum',
                'roleCounts',
                'pelangganPerBulan'
            ));

        } catch (\Exception $e) {
            Log::error('Gagal memuat dashboard', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect('/')->with('error', 'Gagal memuat dashboard.');
        }
    }
}
