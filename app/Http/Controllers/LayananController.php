<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Layanan::with('pelanggan');

            if ($request->has('search')) {
                $search = strtolower($request->search);
                $query->where(function ($q) use ($search) {
                    $q->whereRaw('LOWER(id_layanan) LIKE ?', ["%$search%"])
                      ->orWhereRaw("CAST(id_pelanggan AS TEXT) LIKE ?", ["%$search%"])
                      ->orWhereHas('pelanggan', function ($sub) use ($search) {
                          $sub->whereRaw('LOWER(nama) LIKE ?', ["%$search%"]);
                      });
                });
            }

            $layanan = $query->get();
            Log::info('Halaman index layanan diakses', ['jumlah' => $layanan->count()]);
            return view('layanan.index', compact('layanan'));

        } catch (\Exception $e) {
            Log::error('Gagal menampilkan halaman index layanan', [
                'error' => $e->getMessage()
            ]);
            return redirect('/')->with('error', 'Gagal menampilkan data layanan.');
        }
    }

    public function show($id)
    {
        try {
            $layanan = Layanan::with('pelanggan')->where('id_layanan', $id)->firstOrFail();
            Log::info('Menampilkan detail layanan', ['id_layanan' => $id]);
            return view('layanan.detail', compact('layanan'));

        } catch (ModelNotFoundException $e) {
            Log::warning('Layanan tidak ditemukan saat show', ['id_layanan' => $id]);
            return redirect()->route('layanan.index')->with('error', 'Data layanan tidak ditemukan.');
        }
    }

    public function edit($id)
    {
        try {
            $layanan = Layanan::with('pelanggan')->where('id_layanan', $id)->firstOrFail();
            $pelanggan = Pelanggan::all();
            Log::info('Akses form edit layanan', ['id_layanan' => $id]);
            return view('layanan.edit', compact('layanan', 'pelanggan'));

        } catch (ModelNotFoundException $e) {
            Log::warning('Layanan tidak ditemukan saat edit', ['id_layanan' => $id]);
            return redirect()->route('layanan.index')->with('error', 'Data layanan tidak ditemukan untuk diedit.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kerusakan' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'catatan' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);
        
        try {
            $layanan = Layanan::where('id_layanan', $id)->firstOrFail();

            $layanan->update([
                'jenis_kerusakan' => $request->jenis_kerusakan,
                'tanggal_masuk' => $request->tanggal_masuk,
                'catatan' => $request->catatan,
                'harga' => $request->harga,
            ]);

            Log::info('Layanan berhasil diperbarui', ['id_layanan' => $id]);
            return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil diperbarui.');

        } catch (ModelNotFoundException $e) {
            Log::warning('Layanan tidak ditemukan saat update', ['id_layanan' => $id]);
            return redirect()->route('layanan.index')->with('error', 'Data layanan tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error('Gagal update layanan', [
                'id_layanan' => $id,
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Gagal memperbarui data layanan.');
        }
    }
}
