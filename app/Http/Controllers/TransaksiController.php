<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Admin;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Transaksi::with(['pelanggan', 'layanan', 'admin']);

            if ($request->has('search')) {
                $search = strtolower($request->search);
                $query->where(function ($q) use ($search) {
                    $q->whereRaw('LOWER(id_transaksi) LIKE ?', ["%$search%"])
                      ->orWhereRaw('LOWER(id_layanan) LIKE ?', ["%$search%"])
                      ->orWhereRaw('CAST(id_pelanggan AS TEXT) LIKE ?', ["%$search%"])
                      ->orWhereHas('pelanggan', function ($sub) use ($search) {
                          $sub->whereRaw('LOWER(nama) LIKE ?', ["%$search%"]);
                      });
                });
            }

            $transaksi = $query->get();
            Log::info('Akses halaman index transaksi', ['jumlah' => $transaksi->count()]);
            return view('transaksi.index', compact('transaksi'));

        } catch (\Exception $e) {
            Log::error('Gagal memuat transaksi', ['error' => $e->getMessage()]);
            return redirect('/')->with('error', 'Gagal menampilkan data transaksi.');
        }
    }

    public function show($id)
    {
        try {
            $transaksi = Transaksi::with(['pelanggan', 'layanan', 'admin', 'detailTransaksi'])
                                  ->where('id_transaksi', $id)
                                  ->firstOrFail();

            Log::info('Detail transaksi ditampilkan', ['id_transaksi' => $id]);
            return view('transaksi.detail', compact('transaksi'));
        } catch (ModelNotFoundException $e) {
            Log::warning('Transaksi tidak ditemukan saat show', ['id' => $id]);
            return redirect()->route('transaksi.index')->with('error', 'Data transaksi tidak ditemukan.');
        }
    }

    public function edit($id)
    {
        try {
            $transaksi = Transaksi::with(['pelanggan', 'layanan', 'admin'])->where('id_transaksi', $id)->firstOrFail();
            $adminStaff = Admin::where('role', 'Staff')->get();

            Log::info('Akses halaman edit transaksi', ['id_transaksi' => $id]);
            return view('transaksi.edit', compact('transaksi', 'adminStaff'));

        } catch (ModelNotFoundException $e) {
            Log::warning('Transaksi tidak ditemukan saat edit', ['id' => $id]);
            return redirect()->route('transaksi.index')->with('error', 'Data transaksi tidak ditemukan untuk diedit.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $transaksi = Transaksi::where('id_transaksi', $id)->firstOrFail();

            $request->validate([
                'total_harga' => 'required|numeric|min:0',
                'id_admin' => 'required|exists:admins,id_admin',
            ]);

            $transaksi->update([
                'total_harga' => $request->total_harga,
                'id_admin' => $request->id_admin,
            ]);

            Log::info('Transaksi berhasil diperbarui', ['id_transaksi' => $id]);
            return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil diperbarui.');
        } catch (ModelNotFoundException $e) {
            Log::warning('Gagal update - transaksi tidak ditemukan', ['id' => $id]);
            return redirect()->route('transaksi.index')->with('error', 'Data transaksi tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui transaksi', [
                'id' => $id,
                'error' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Gagal memperbarui transaksi.');
        }
    }
}
