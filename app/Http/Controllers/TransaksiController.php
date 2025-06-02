<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['pelanggan', 'layanan', 'admin']);

        if ($request->has('search')) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(id_transaksi) LIKE ?', ["%$search%"])
                ->orWhereRaw('LOWER(id_layanan) LIKE ?', ["%$search%"])
                ->orWhereRaw('TO_CHAR(id_pelanggan) LIKE ?', ["%$search%"])
                ->orWhereHas('pelanggan', function ($sub) use ($search) {
                    $sub->whereRaw('LOWER(nama) LIKE ?', ["%$search%"]);
                });
            });
        }

        $transaksi = $query->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'layanan', 'admin', 'detailTransaksi'])
                              ->where('id_transaksi', $id)
                              ->firstOrFail();
        return view('transaksi.detail', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'layanan', 'admin'])->where('id_transaksi', $id)->firstOrFail();
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::where('id_transaksi', $id)->firstOrFail();

        $request->validate([
            'total_harga' => 'required|numeric|min:0',
        ]);

        $transaksi->update([
            'total_harga' => $request->total_harga,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil diperbarui.');
    }
}
