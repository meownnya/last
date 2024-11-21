@extends('layouts.app')

@section('content')
    <div class="py-4">
        <h3 class="fw-bold mb-2 pb-2 border-bottom">Daftar Video</h3>

        <a href="{{ route('video.create') }}" class="btn btn-sm mb-3 btn-primary"><i class='bx bx-plus'></i></a>

        <div class="posts-container">
            @if ($videos->count() > 0)
                @foreach ($videos as $video)
                    <div class="post-item">
                        <a href="{{ route('video.show', $video->id) }}">
                            <video width="100%" controls>
                                <source src="{{ asset('storage/uploads/videos/' . $video->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </a>
                        <h2 class="post-title">{{ $video->title }}</h2>
                        <p class="post-caption">{{ $video->caption }}</p>
                    </div>
                @endforeach
            @else
                <div class="no-posts">Tidak ada video yang ditemukan.</div>
            @endif
        </div>
    </div>
@endsection

<style>
    /* Styling untuk judul Daftar Video */
    h3.fw-bold {
        font-family: 'poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        font-weight: normal;
        color: #342E37;
        margin-top: 10px;
        margin-bottom: 5px;
        position: relative;
        text-align: center;
        opacity: 0;
        animation: fadeIn 1s ease-out forwards; /* Added fadeIn animation */
    }

    h3.fw-bold:before {
        content: '';
        width: 40px;
        height: 4px;
        background: linear-gradient(90deg, var(--blue), #96799c);
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
    }

    /* Fade-in keyframes */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Styling untuk tombol Tambah Video */
    .btn-primary {
        font-family: 'poppins', sans-serif;
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: linear-gradient(90deg, #1e88e5, #96799c);
        color: white;
        font-size: 14px;
        padding: 12px 16px;
        border-radius: 50px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        text-decoration: none;
        z-index: 1000;
        transition: transform 0.3s ease, background-color 0.3s ease;
        animation: fadeIn 1s ease-out forwards; /* Fade-in animation for the button */
    }

    .btn-primary:hover {
        transform: scale(1.05);
        background: #1565c0;
    }

    /* Styling untuk Container Daftar Video */
    .posts-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-top: 20px;
        animation: fadeIn 1s ease-out forwards; /* Added fade-in animation for container */
    }

    /* Styling untuk Card Post */
    .post-item {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        text-align: center;
        width: calc(25% - 10px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        opacity: 0;
        animation: fadeInUp 0.5s ease-out forwards; /* Added fade-in-up animation */
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* New Animation: Hover Effect for Cards */
    .post-item:hover {
        transform: scale(1.05);  /* Slight scale effect */
        box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.15);  /* Increase shadow on hover */
        transition: all 0.3s ease;
    }

    /* Video Styling */
    .post-item video {
        width: 100%;
        height: 180px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    /* Slight zoom effect for video on hover */
    .post-item:hover video {
        transform: scale(1.05);
    }

    .post-title {
        font-family: 'poppins', sans-serif;
        font-size: 16px;
        color: #342E37;
        font-weight: normal;
        margin: 10px 0;
    }

    .post-caption {
        font-size: 12px;
        color: #555;
        margin: 0 10px 10px;
    }

    /* Styling untuk ketika tidak ada video */
    .no-posts {
        font-size: 16px;
        color: #888;
        text-align: center;
        margin-top: 20px;
    }

    /* Responsiveness untuk Daftar Video */
    @media (max-width: 768px) {
        .post-item {
            width: calc(50% - 10px);  /* Adjusting for smaller screens */
        }

        .post-title {
            font-size: 14px;
        }

        .post-caption {
            font-size: 10px;
        }
    }

    @media (max-width: 480px) {
        .post-item {
            width: 100%;  /* Single column layout */
        }

        .post-title {
            font-size: 12px;
        }

        .post-caption {
            font-size: 8px;
        }
    }
</style>
