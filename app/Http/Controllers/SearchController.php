<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\Diary;
use Illuminate\Http\Request;
use App\Models\Photo; // Ganti dengan model terkait
use App\Models\Video; // Tambahkan model lain jika diperlukan

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Contoh pencarian di beberapa model
        $photos = Photo::where('title', 'LIKE', "%{$query}%")->get();
        $videos = Video::where('title', 'LIKE', "%{$query}%")->get();
        $audio = Audio::where('title', 'LIKE', "%{$query}%")->get();
        $diary = Diary::where('title', 'LIKE', "%{$query}%")->get();

        // Kirim hasil ke view
        return view('search.results', compact('photos', 'videos', 'audio', 'diary', 'query'));
    }
}

