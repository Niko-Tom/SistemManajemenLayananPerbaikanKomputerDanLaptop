<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Models\Pelanggan;
use App\Models\Layanan;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Admin;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request) 
    {
        $query = Pelanggan::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereRaw("TO_CHAR(id) LIKE ?", ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(keluhan) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $pelanggan = $query->get();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function show($id) 
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            return view('pelanggan.detail', compact('pelanggan'));
        } catch (ModelNotFoundException $e) {
            return redirect('/pelanggan')->with('error', 'Data pelanggan tidak ditemukan');
        }
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'required|string|max:20',
            'keluhan' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Simpan data pelanggan
            $pelanggan = Pelanggan::create($request->only('nama', 'email', 'telepon', 'keluhan'));

            // Simpan data layanan (ID otomatis oleh model)
            $layanan = Layanan::create([
                'id_pelanggan' => $pelanggan->id,
                'jenis_kerusakan' => $request->keluhan ?? 'Belum Diisi',
                'tanggal_masuk' => now(),
                'catatan' => null,
                'harga' => 0,
            ]);

            // Ambil admin pertama
            $admin = Admin::first();
            if (!$admin) {
                throw new \Exception('Data admin tidak tersedia. Tambahkan admin terlebih dahulu.');
            }

            // Simpan data transaksi (ID otomatis oleh model)
            $transaksi = Transaksi::create([
                'id_pelanggan' => $pelanggan->id,
                'id_layanan' => $layanan->id_layanan,
                'id_admin' => $admin->id_admin,
                'total_harga' => 0,
            ]);

            // Simpan data detail transaksi (ID otomatis oleh model)
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'keterangan' => 'Belum Diatur',
            ]);

            DB::commit();

            // LOG INFO
            Log::info('Pelanggan baru ditambahkan', [
                'nama' => $pelanggan->nama,
                'id' => $pelanggan->id,
            ]);

            return redirect('/pelanggan')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();

            // LOG ERROR
            Log::error('Gagal menyimpan data pelanggan', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            return view('pelanggan.edit', compact('pelanggan'));
        } catch (ModelNotFoundException $e) {
            return redirect('/pelanggan')->with('error', 'Data pelanggan tidak ditemukan untuk diedit.');
        }
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|min:10|max:30',
            'email' => 'required|email|max:50',
            'telepon' => 'required|string|min:11|max:15',
            'keluhan' => 'nullable|string|max:100',
        ]);

        $pelanggan->update($validated);
        return redirect('/pelanggan')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.delete', compact('pelanggan'));
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return redirect('/pelanggan')->with('success', 'Data berhasil dihapus');
    }
}
