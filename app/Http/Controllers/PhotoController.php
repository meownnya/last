<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::all();
        return view('photo.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('photo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:32',
            'caption' => 'nullable|max:225',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
        ]);

        // Mengupload foto
        $imageName = time() . '.' . $request->photo->extension(); // Menyusun nama file berdasarkan waktu
        Storage::putFileAs('uploads/photos/', $request->photo, $imageName); // Menyimpan file

        // Menyimpan data ke database
        Photo::create([
            'title' => $request->title,
            'caption' => $request->caption, // Caption bisa kosong
            'photo' => $imageName, // Menyimpan path foto
        ]);

        return redirect()->route('photo.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // Ambil foto berdasarkan ID
    $photo = Photo::findOrFail($id);

    // Kirim data foto ke tampilan
    return view('photo.show', compact('photo'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $photo = Photo::findOrFail($id);
        return view('photo.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:32',
            'caption' => 'nullable|max:225',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
        ]);

        // Ambil foto berdasarkan ID
        $photo = Photo::findOrFail($id);

        // Mengupload foto
        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension(); // Menyusun nama file berdasarkan waktu
            Storage::putFileAs('uploads/photos/', $request->photo, $imageName); // Menyimpan file
            $photo->photo = $imageName; // Menyimpan path foto
        }

        // Menyimpan data ke database
        $photo->title = $request->title;
        $photo->caption = $request->caption; // Caption bisa kosong
        $photo->save();

        return redirect()->route('photo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();
        return redirect()->route('photo.index');
    }
}
