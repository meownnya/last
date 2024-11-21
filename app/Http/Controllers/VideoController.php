<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua video
        $videos = Video::all();
        return view('video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('video.create');
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
            'video' => 'required|mimes:mp4,mkv,avi,flv|max:10000', // Validasi video
        ]);

        // Mengupload video
        $videoName = time() . '.' . $request->video->extension(); // Menyusun nama file berdasarkan waktu
        Storage::putFileAs('uploads/videos/', $request->video, $videoName); // Menyimpan file

        // Menyimpan data ke database
        Video::create([
            'title' => $request->title,
            'caption' => $request->caption, // Caption bisa kosong
            'video' => $videoName, // Menyimpan path video
        ]);

        return redirect()->route('video.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil video berdasarkan ID
        $video = Video::findOrFail($id);

        // Kirim data video ke tampilan
        return view('video.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil video berdasarkan ID
        $video = Video::findOrFail($id);
        return view('video.edit', compact('video'));
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
            'video' => 'nullable|mimes:mp4,mkv,avi,flv|max:10000', // Validasi video
        ]);

        // Ambil video berdasarkan ID
        $video = Video::findOrFail($id);

        // Mengupload video baru jika ada
        if ($request->hasFile('video')) {
            $videoName = time() . '.' . $request->video->extension(); // Menyusun nama file berdasarkan waktu
            Storage::putFileAs('uploads/videos/', $request->video, $videoName); // Menyimpan file
            $video->video = $videoName; // Menyimpan path video baru
        }

        // Menyimpan data yang sudah diupdate ke database
        $video->title = $request->title;
        $video->caption = $request->caption; // Caption bisa kosong
        $video->save();

        return redirect()->route('video.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil video berdasarkan ID
        $video = Video::findOrFail($id);
        
        // Menghapus video dari storage
        Storage::delete('uploads/videos/' . $video->video);
        
        // Menghapus video dari database
        $video->delete();

        return redirect()->route('video.index');
    }
}
