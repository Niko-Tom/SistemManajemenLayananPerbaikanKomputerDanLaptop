<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function create()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $image = Image::create([
            'title' => $request->title,
            'image_path' => $imagePath,
        ]);

        return view('upload', ['image' => $image])
            ->with('success', 'Gambar berhasil diupload!');
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        if (\Storage::disk('public')->exists($image->image_path)) {
            \Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return redirect('/upload')->with('success', 'Gambar berhasil dihapus.');
    }
}
