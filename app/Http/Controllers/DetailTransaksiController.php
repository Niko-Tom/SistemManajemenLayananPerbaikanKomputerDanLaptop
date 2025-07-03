<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DetailTransaksiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = DetailTransaksi::with(['transaksi.pelanggan']);

            if ($request->has('search')) {
                $search = strtolower($request->search);
                $query->where(function ($q) use ($search) {
                    $q->whereRaw('LOWER(id_detail) LIKE ?', ["%$search%"])
                      ->orWhereRaw('LOWER(id_transaksi) LIKE ?', ["%$search%"])
                      ->orWhereHas('transaksi.pelanggan', function ($sub) use ($search) {
                          $sub->whereRaw('LOWER(nama) LIKE ?', ["%$search%"]);
                      });
                });
            }

            $detailTransaksi = $query->get();
            Log::info('Halaman index detail transaksi diakses', ['jumlah_data' => $detailTransaksi->count()]);
            return view('detailTransaksi.index', compact('detailTransaksi'));

        } catch (\Exception $e) {
            Log::error('Gagal memuat index detail transaksi', ['error' => $e->getMessage()]);
            return redirect('/')->with('error', 'Gagal menampilkan data detail transaksi.');
        }
    }

    public function show($id)
    {
        try {
            $detail = DetailTransaksi::with(['transaksi.pelanggan', 'transaksi.layanan', 'transaksi.admin'])
                        ->where('id_detail', $id)
                        ->firstOrFail();

            Log::info('Menampilkan detail detailTransaksi', ['id' => $id]);
            return view('detailTransaksi.detail', compact('detail'));

        } catch (ModelNotFoundException $e) {
            Log::warning('DetailTransaksi tidak ditemukan saat show', ['id' => $id]);
            return redirect()->route('detailTransaksi.index')->with('error', 'Data detail transaksi tidak ditemukan.');
        }
    }

    public function edit($id)
    {
        try {
            $detail = DetailTransaksi::with('transaksi')->where('id_detail', $id)->firstOrFail();
            Log::info('Akses halaman edit detail transaksi', ['id' => $id]);
            return view('detailTransaksi.edit', compact('detail'));

        } catch (ModelNotFoundException $e) {
            Log::warning('DetailTransaksi tidak ditemukan saat edit', ['id' => $id]);
            return redirect()->route('detailTransaksi.index')->with('error', 'Data detail transaksi tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {

         $request->validate([
            'keterangan' => 'required|string|max:255',
        ]);
        
        try {
            $detail = DetailTransaksi::where('id_detail', $id)->firstOrFail();

            $detail->update([
                'keterangan' => $request->keterangan,
            ]);

            Log::info('Detail transaksi berhasil diupdate', ['id' => $id]);
            return redirect()->route('detailTransaksi.index')->with('success', 'Keterangan berhasil diperbarui.');

        } catch (ModelNotFoundException $e) {
            Log::warning('Gagal update, detail transaksi tidak ditemukan', ['id' => $id]);
            return redirect()->route('detailTransaksi.index')->with('error', 'Data tidak ditemukan untuk diupdate.');
        } catch (\Exception $e) {
            Log::error('Gagal update detail transaksi', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            return redirect()->route('detailTransaksi.index')->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }
}