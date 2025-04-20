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
        return view('pelanggan.detail', compact('pelanggan'));
    }

    public function create() {
        return view('pelanggan.create');
    }
    
    public function store(Request $request) {
        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil ditambahkan (dummy)');
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
        return view('pelanggan.delete', compact('pelanggan'));
    }
    
    public function destroy($id) {
        return redirect('/pelanggan');
    }
}