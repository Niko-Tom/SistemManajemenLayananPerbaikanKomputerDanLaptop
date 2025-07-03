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
        try {
            $query = Pelanggan::query();

            if ($request->has('search')) {
                $search = $request->search;
                $query->whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($search) . '%'])
                      ->orWhereRaw("CAST(id AS TEXT) LIKE ?", ['%' . $search . '%'])
                      ->orWhereRaw('LOWER(keluhan) LIKE ?', ['%' . strtolower($search) . '%']);
            }

            $pelanggan = $query->get();

            Log::info('Halaman index pelanggan diakses', ['total_data' => $pelanggan->count()]);
            return view('pelanggan.index', compact('pelanggan'));
        } catch (\Exception $e) {
            Log::error('Gagal memuat halaman index pelanggan', [
                'error' => $e->getMessage()
            ]);
            return redirect('/')->with('error', 'Gagal menampilkan data pelanggan.');
        }
    }

    public function show($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            Log::info('Menampilkan detail pelanggan', ['id' => $id]);
            return view('pelanggan.detail', compact('pelanggan'));
        } catch (ModelNotFoundException $e) {
            Log::warning('Pelanggan tidak ditemukan saat akses detail', ['id' => $id]);
            return redirect('/pelanggan')->with('error', 'Data pelanggan tidak ditemukan');
        }
    }

    public function create()
    {
        Log::info('Halaman form tambah pelanggan diakses');
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'required|string|min:11|max:20',
            'keluhan' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $pelanggan = Pelanggan::create($request->only('nama', 'email', 'telepon', 'keluhan'));

            $layanan = Layanan::create([
                'id_pelanggan' => $pelanggan->id,
                'jenis_kerusakan' => $request->keluhan ?? 'Belum Diisi',
                'tanggal_masuk' => now(),
                'catatan' => null,
                'harga' => 0,
            ]);

            $admin = Admin::first();
            if (!$admin) {
                throw new \Exception('Admin tidak tersedia.');
            }

            $transaksi = Transaksi::create([
                'id_pelanggan' => $pelanggan->id,
                'id_layanan' => $layanan->id_layanan,
                'id_admin' => $admin->id_admin,
                'total_harga' => 0,
            ]);

            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'keterangan' => 'Belum Diatur',
            ]);

            DB::commit();
            Log::info('Pelanggan baru berhasil ditambahkan', ['id' => $pelanggan->id]);
            return redirect('/pelanggan')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan data pelanggan', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            Log::info('Akses halaman edit pelanggan', ['id' => $id]);
            return view('pelanggan.edit', compact('pelanggan'));
        } catch (ModelNotFoundException $e) {
            Log::warning('Pelanggan tidak ditemukan saat edit', ['id' => $id]);
            return redirect('/pelanggan')->with('error', 'Data pelanggan tidak ditemukan untuk diedit.');
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:10|max:30',
            'email' => 'required|email|max:50',
            'telepon' => 'required|string|min:11|max:15',
            'keluhan' => 'nullable|string|max:100',
        ]);

        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->update($validated);

            Log::info('Data pelanggan diperbarui', ['id' => $id]);
            return redirect('/pelanggan')->with('success', 'Data berhasil diperbarui');
        } catch (ModelNotFoundException $e) {
            Log::warning('Gagal update - pelanggan tidak ditemukan', ['id' => $id]);
            return redirect('/pelanggan')->with('error', 'Data pelanggan tidak ditemukan untuk diupdate.');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat update pelanggan', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat update data.');
        }
    }

    public function delete($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            Log::info('Akses halaman konfirmasi hapus pelanggan', ['id' => $id]);
            return view('pelanggan.delete', compact('pelanggan'));
        } catch (ModelNotFoundException $e) {
            Log::warning('Pelanggan tidak ditemukan saat akses halaman hapus', ['id' => $id]);
            return redirect('/pelanggan')->with('error', 'Data pelanggan tidak ditemukan untuk dihapus.');
        }
    }

    public function destroy($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->delete();
            Log::info('Pelanggan berhasil dihapus', ['id' => $id]);
            return redirect('/pelanggan')->with('success', 'Data berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            Log::warning('Gagal hapus - pelanggan tidak ditemukan', ['id' => $id]);
            return redirect('/pelanggan')->with('error', 'Data pelanggan tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat menghapus pelanggan', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            return redirect('/pelanggan')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}