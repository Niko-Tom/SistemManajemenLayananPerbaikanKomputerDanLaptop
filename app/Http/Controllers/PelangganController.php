<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index() 
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function show($id) 
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.detail', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:10|max:30',
            'email' => 'required|email|max:50',
            'telepon' => 'required|string|min:11|max:15',
            'keluhan' => 'nullable|string|max:100',
        ]);

        Pelanggan::create($validated);
        return redirect('/pelanggan')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
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
