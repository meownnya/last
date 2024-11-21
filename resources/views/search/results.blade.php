@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hasil Pencarian untuk: "{{ $query }}"</h1>
    
    @if($photos->isEmpty() && $videos->isEmpty() && $diary->isEmpty() && $audio->isEmpty())
        <p>Tidak ada hasil yang ditemukan.</p>
    @else
        <div class="search-results">
            {{-- Tampilkan hasil untuk Photos --}}
            @if(!$photos->isEmpty())
                <h2>Foto</h2>
                <div class="results-section">
                    @foreach($photos as $photo)
                        <div class="result-item">
                            <img src="{{ asset('storage/uploads/photos/' . $photo->photo) }}" alt="{{ $photo->title }}" width="200">
                            <p>{{ $photo->title }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Tampilkan hasil untuk Videos --}}
            @if(!$videos->isEmpty())
                <h2>Video</h2>
                <div class="results-section">
                    @foreach($videos as $video)
                        <div class="result-item">
                            <video width="200" controls>
                                <source src="{{ asset('storage/uploads/videos/' . $video->video) }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutar video.
                            </video>
                            <p>{{ $video->title }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Tampilkan hasil untuk Diary --}}
            @if(!$diary->isEmpty())
                <h2>Diary</h2>
                <div class="results-section">
                    @foreach($diary as $entry)
                        <div class="result-item">
                            <p><strong>{{ $entry->title }}</strong></p>
                            <p>{{ \Illuminate\Support\Str::limit($entry->content, 100) }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Tampilkan hasil untuk Audio --}}
            @if(!$audio->isEmpty())
                <h2>Audio</h2>
                <div class="results-section">
                    @foreach($audio as $track)
                        <div class="result-item">
                            <p>{{ $track->title }}</p>
                            <audio controls>
                                <source src="{{ asset('storage/uploads/audio/' . $track->audio) }}" type="audio/mpeg">
                                Browser Anda tidak mendukung pemutar audio.
                            </audio>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
<style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    /* Root Variables */
    :root {
        --primary-color: #1e88e5;
        --secondary-color: #96799c;
        --background-color: #f9f9f9;
        --text-color: #342E37;
        --text-light: #555;
        --shadow-color: rgba(0, 0, 0, 0.1);
        --shadow-hover: rgba(0, 0, 0, 0.15);
        --font-family: 'Poppins', sans-serif;
    }
    
    /* General Styling */
    body {
        font-family: var(--font-family);
        margin: 0;
        padding: 0;
        background-color: var(--background-color);
        color: var(--text-color);
    }
    
    .container {
        width: 100%;
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    /* Titles */
    h1, h2 {
        font-weight: 600;
        color: var(--primary-color);
    }
    
    h1 {
        font-size: 24px;
        text-align: center;
        margin-bottom: 20px;
    }
    
    h2 {
        font-size: 20px;
        margin: 20px 0 10px;
        position: relative;
    }
    
    h2:before {
        content: '';
        width: 40px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        position: absolute;
        bottom: -5px;
        left: 0;
    }
    
    /* Main Content Styling */
    .main-content, .kanan {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px var(--shadow-color);
    }
    
    .main-content {
        flex: 1;
    }
    
    .kanan {
        flex: 0 0 300px;
        position: sticky;
        top: 20px;
    }
    
    /* Card Styling */
    .card-row, .results-section {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .card, .result-item {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        box-shadow: 0 2px 5px var(--shadow-color);
        transition: transform 0.2s, box-shadow 0.2s;
        flex: 1 1 20%;
    }
    
    .card:hover, .result-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px var(--shadow-hover);
    }
    
    .card h3, .result-item p {
        margin: 10px 0;
        font-size: 16px;
        color: var(--text-color);
    }
    
    .card p, .result-item p {
        font-size: 14px;
        color: var(--text-light);
    }
    
    /* Media Content */
    .card img, .result-item img, .card video, .result-item video {
        width: 100%;
        border-radius: 4px;
        height: auto;
        margin-bottom: 10px;
    }
    
    /* Sidebar Items */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .sidebar-item {
        padding: 10px 15px;
        border-radius: 50px;
        background-color: var(--primary-color);
        color: #fff;
        font-size: 14px;
        text-align: left;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }
    
    .sidebar-item:hover {
        background-color: darken(var(--primary-color), 10%);
        transform: translateX(5px);
    }
    
    /* Audio Player */
    audio {
        width: 100%;
        margin-top: 10px;
    }
    
    /* Responsive Styling */
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }
    
        .main-content {
            flex: 1 1 100%;
        }
    
        .kanan {
            flex: 1 1 100%;
            margin-top: 20px;
        }
    
        .card, .result-item {
            flex: 1 1 100%;
        }
    }
    </style>