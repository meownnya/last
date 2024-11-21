@extends('layouts.app')

@section('content')
    <div class="py-4">
        <!-- Judul Daftar Foto -->
        <h3 class="fw-bold mb-2 pb-2 border-bottom">Daftar Foto</h3>

        <!-- Tombol Tambah Foto -->
        <a href="{{ route('photo.create') }}" class="btn btn-sm btn-primary"><i class='bx bx-plus'></i></a>

        <!-- Container Daftar Foto -->
        <div class="posts-container">
            @if ($photos->count() > 0)
                @foreach ($photos as $photo)
                    <div class="post-item">
                        <a href="{{ route('photo.show', $photo->id) }}">
                            <img src="{{ asset('storage/uploads/photos/' . $photo->photo) }}" 
                                 alt="{{ $photo->title }}" class="post-image">
                        </a>
                        <h2 class="post-title">{{ $photo->title }}</h2>
                        <p class="post-caption">{{ Str::limit($photo->caption, 10) }}</p>
                    </div>
                @endforeach
            @else
                <div class="no-posts">Tidak ada foto yang ditemukan.</div>
            @endif
        </div>
    </div>
@endsection

<style>
    /* Styling untuk judul Daftar Foto */
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
        animation: fadeIn 1s ease-out forwards;
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

    /* Styling untuk tombol Tambah Foto */
    .btn-primary {
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
        animation: fadeIn 1s ease-out forwards;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        background: #1565c0;
    }

    /* Styling untuk Container Daftar Foto */
    .posts-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-top: 20px;
        animation: fadeIn 1s ease-out forwards;
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
        animation: slideUp 0.6s ease-out forwards; /* Card slide-up effect */
    }

    /* Slide-up animation for cards */
    @keyframes slideUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .post-item:hover {
        transform: scale(1.05); /* Slightly scale up on hover */
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    }

    .post-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .post-item:hover .post-image {
        transform: scale(1.1); /* Slightly zoom image on hover */
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

    /* Styling untuk ketika tidak ada foto */
    .no-posts {
        font-size: 16px;
        color: #888;
        text-align: center;
        margin-top: 20px;
    }

    /* Responsiveness untuk Daftar Foto */
    @media (max-width: 768px) {
        .post-item {
            width: calc(50% - 10px);
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
            width: 100%;
        }

        .post-title {
            font-size: 12px;
        }

        .post-caption {
            font-size: 8px;
        }
    }
</style>
