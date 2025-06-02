<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return view('admin.index', compact('admin'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:100',
            'kontak' => 'required|string|max:20',
        ]);

        Admin::create([
            'nama_admin' => $request->nama_admin,
            'kontak' => $request->kontak,
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.detail', compact('admin'));
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:100',
            'kontak' => 'required|string|max:20',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->update([
            'nama_admin' => $request->nama_admin,
            'kontak' => $request->kontak,
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
    }
}
