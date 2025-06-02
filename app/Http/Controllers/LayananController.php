<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index(Request $request)
    {
    $query = Layanan::with('pelanggan');

    if ($request->has('search')) {
        $search = strtolower($request->search);
        $query->where(function ($q) use ($search) {
            $q->whereRaw('LOWER(id_layanan) LIKE ?', ["%$search%"])
              ->orWhereRaw("TO_CHAR(id_pelanggan) LIKE ?", ["%$search%"])
              ->orWhereHas('pelanggan', function ($sub) use ($search) {
                  $sub->whereRaw('LOWER(nama) LIKE ?', ["%$search%"]);
              });
        });
    }

    $layanan = $query->get();
    return view('layanan.index', compact('layanan'));
    }

    public function show($id)
    {
        $layanan = Layanan::with('pelanggan')->where('id_layanan', $id)->firstOrFail();
        return view('layanan.detail', compact('layanan'));
    }

    public function edit($id)
    {
        $layanan = Layanan::with('pelanggan')->where('id_layanan', $id)->firstOrFail();
        $pelanggan = Pelanggan::all();
        return view('layanan.edit', compact('layanan', 'pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::where('id_layanan', $id)->firstOrFail();

        $request->validate([
            'jenis_kerusakan' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'catatan' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);

        $layanan->update([
            'jenis_kerusakan' => $request->jenis_kerusakan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'catatan' => $request->catatan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil diperbarui.');
    }
}
