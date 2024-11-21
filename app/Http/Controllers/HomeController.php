<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Photo;
use App\Models\Diary;
use App\Models\Audio;

class HomeController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->take(2)->get();
        $photos = Photo::latest()->take(5)->get();
        $diaries = Diary::latest()->take(5)->get();
        $audios = Audio::latest()->take(5)->get();

        return view('home.index', compact('videos', 'photos', 'diaries', 'audios'));
    }
}
