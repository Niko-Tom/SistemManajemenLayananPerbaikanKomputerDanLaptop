<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index() 
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function show($id) 
    {
        $pelanggan = Pelanggan::find($id);
        if(!$pelanggan){
            abort(404);
        }
        return view('pelanggan.pelanggan', compact('pelanggan'));
    }

    public function edit($id) {
        $pelanggan = Pelanggan::find($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }
    
    public function update($id) {
        return redirect("/pelanggan/$id");
    }
    
    public function delete($id) {
        $pelanggan = Pelanggan::find($id);
        return view('pelanggan.hapus', compact('pelanggan'));
    }
    
    public function destroy($id) {
        return redirect('/pelanggan');
    }
}