<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function index(Request $request)
    {
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
        return view('detailTransaksi.index', compact('detailTransaksi'));
    }

    public function show($id)
    {
        $detail = DetailTransaksi::with(['transaksi.pelanggan', 'transaksi.layanan', 'transaksi.admin'])
            ->where('id_detail', $id)
            ->firstOrFail();

        return view('detailTransaksi.detail', compact('detail'));
    }

    public function edit($id)
    {
        $detail = DetailTransaksi::with('transaksi')->where('id_detail', $id)->firstOrFail();
        return view('detailTransaksi.edit', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        $detail = DetailTransaksi::where('id_detail', $id)->firstOrFail();

        $request->validate([
            'keterangan' => 'required|string|max:255',
        ]);

        $detail->update([
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('detailTransaksi.index')->with('success', 'Keterangan berhasil diperbarui.');
    }
}
