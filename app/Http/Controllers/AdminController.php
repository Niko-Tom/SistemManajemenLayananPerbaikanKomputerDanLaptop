<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminController extends Controller
{
    public function index()
    {
        try {
            $admin = Admin::all();
            Log::info('Halaman daftar admin diakses.', ['jumlah' => $admin->count()]);
            return view('admin.index', compact('admin'));
        } catch (\Exception $e) {
            Log::error('Gagal memuat daftar admin.', [
                'error' => $e->getMessage()
            ]);
            return redirect('/')->with('error', 'Gagal memuat data admin.');
        }
    }

    public function create()
    {
        Log::info('Form tambah admin diakses.');
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:100',
            'kontak' => 'required|string|min:11|max:20',
            'role' => 'required|in:Admin,Manager,Staff',
            'password' => 'required|string|min:6',
        ]);

        try {
            $admin = Admin::create([
                'nama_admin' => $request->nama_admin,
                'kontak' => $request->kontak,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            Log::info('Admin baru ditambahkan.', ['id_admin' => $admin->id_admin]);
            return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan admin.', [
                'error' => $e->getMessage(),
                'input' => $request->all()
            ]);
            return redirect()->back()->with('error', 'Gagal menambahkan admin.');
        }
    }

    public function show($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            Log::info('Detail admin diakses.', ['id_admin' => $id]);
            return view('admin.detail', compact('admin'));
        } catch (ModelNotFoundException $e) {
            Log::warning('Admin tidak ditemukan saat akses detail.', ['id_admin' => $id]);
            return redirect()->route('admin.index')->with('error', 'Data admin tidak ditemukan.');
        }
    }

    public function edit($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            Log::info('Form edit admin diakses.', ['id_admin' => $id]);
            return view('admin.edit', compact('admin'));
        } catch (ModelNotFoundException $e) {
            Log::warning('Admin tidak ditemukan saat edit.', ['id_admin' => $id]);
            return redirect()->route('admin.index')->with('error', 'Data admin tidak ditemukan untuk diedit.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:100',
            'kontak' => 'required|string|min:11|max:20',
            'role' => 'required|in:Admin,Manager,Staff',
        ]);

        try {
            $admin = Admin::findOrFail($id);
            $admin->update([
                'nama_admin' => $request->nama_admin,
                'kontak' => $request->kontak,
                'role' => $request->role,
            ]);

            Log::info('Data admin diperbarui.', ['id_admin' => $id]);
            return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui.');
        } catch (ModelNotFoundException $e) {
            Log::warning('Gagal update - admin tidak ditemukan.', ['id_admin' => $id]);
            return redirect()->route('admin.index')->with('error', 'Data admin tidak ditemukan untuk diperbarui.');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat memperbarui admin.', [
                'error' => $e->getMessage(),
                'id_admin' => $id
            ]);
            return redirect()->route('admin.index')->with('error', 'Terjadi kesalahan saat memperbarui admin.');
        }
    }

    public function destroy($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            $admin->delete();
            Log::info('Admin berhasil dihapus.', ['id_admin' => $id]);
            return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
        } catch (ModelNotFoundException $e) {
            Log::warning('Gagal hapus - admin tidak ditemukan.', ['id_admin' => $id]);
            return redirect()->route('admin.index')->with('error', 'Data admin tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat menghapus admin.', [
                'error' => $e->getMessage(),
                'id_admin' => $id
            ]);
            return redirect()->route('admin.index')->with('error', 'Terjadi kesalahan saat menghapus data admin.');
        }
    }
}