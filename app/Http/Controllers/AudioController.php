<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller
{
    public function index()
    {
        // Mengambil semua data audio dari database
        $audios = Audio::all();
        
        // Mengirim data audio ke tampilan
        return view('audio.index', compact('audios'));
    }

    public function create()
    {
        // Menampilkan form untuk menambah audio baru
        return view('audio.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:32', // Judul audio harus ada dan max 32 karakter
            'audio' => 'required|mimes:mp3,wav,ogg|max:10240', // Validasi file audio
            
        ]);

        // Mengupload file audio
        $audioName = time() . '.' . $request->audio->extension(); // Menyusun nama file berdasarkan waktu
        // Menyimpan file audio ke storage publik
        $request->audio->storeAs('/uploads/audio', $audioName);

        // Menyimpan data audio baru ke database
        Audio::create([
            'title' => $request->title,
            'audio' => $audioName,

        ]);

        // Redirect ke halaman daftar audio
        return redirect()->route('audio.index')->with('success', 'Audio uploaded successfully.');
    }

    public function edit($id)
    {
        // Ambil data audio berdasarkan ID
        $audio = Audio::findOrFail($id);
        
        // Menampilkan form edit untuk audio
        return view('audio.edit', compact('audio'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:32', // Judul audio harus ada dan max 32 karakter
            'audio' => 'nullable|mimes:mp3,wav,ogg|max:10240', // Validasi file audio (optional)
            
        ]);

        // Ambil data audio berdasarkan ID
        $audio = Audio::findOrFail($id);
        
        // Update data audio
        $audio->title = $request->title;

        // Jika ada file audio yang diupload
        if ($request->hasFile('audio')) {
            // Hapus file lama jika ada
            Storage::delete('/uploads/audio/' . $audio->audio);
            
            // Mengupload file audio baru
            $audioName = time() . '.' . $request->audio->extension();
            $request->audio->storeAs('/uploads/audio', $audioName);
            $audio->audio = $audioName;
        }

        // Simpan perubahan
        $audio->save();

        // Redirect ke halaman daftar audio
        return redirect()->route('audio.index')->with('success', 'Audio updated successfully.');
    }

    public function destroy($id)
    {
        // Ambil data audio berdasarkan ID
        $audio = Audio::findOrFail($id);

        // Hapus file audio dari storage
        Storage::delete('public/uploads/audio/' . $audio->audio);

        // Hapus data audio dari database
        $audio->delete();

        // Redirect ke halaman daftar audio
        return redirect()->route('audio.index')->with('success', 'Audio deleted successfully.');
    }
}
