@extends('layouts.app')

@section('content')
<div class="home-title">Home</div>
<div class="container">
    <!-- Main Content -->
    <div class="main-content">
        <!-- Video Section -->
        <div>
            <h2 class="section-title"><i class="bx bxs-videos"></i> Your Video</h2>
            <div class="card-row">
                @foreach($videos as $video)
                <div class="card video" onclick="goToDetail('{{ route('video.show', $video->id) }}')">
                    <div class="image">
                        <video muted autoplay loop style="width: 100%; height: 100%; border-radius: 8px;">
                            <source src="{{ asset('storage/uploads/videos/' . $video->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <h3>{{ $video->title }}</h3>
                    <p>{{ $video->description }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Photo Section -->
        <div>
            <h2 class="section-title"><i class="bx bxs-image-alt"></i> Your Photo</h2>
            <div class="card-row-foto">
                @foreach($photos as $photo)
                <div class="card photo" onclick="goToDetail('{{ route('photo.show', $photo->id) }}')">
                    <div class="image" style="background-image: url('{{ asset('storage/uploads/photos/' . $photo->photo) }}');"></div>
                    <h3>{{ $photo->title }}</h3>
                    <p>{{ $photo->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Sidebar Section -->
    <div class="kanan">
        <div class="sidebar">
            <h2 class="section-title"><i class="bx bxs-book-heart"></i> Your Diary</h2>
            @foreach($diaries as $diary)
            <div class="sidebar-item" onclick="goToDetail('{{ route('diary.show', $diary->id) }}')">
                <span>{{ $diary->title }}</span>
            </div>
            @endforeach

            <h2 class="section-title"><i class="bx bxs-music"></i> Your Audio</h2>
            @foreach($audios as $audio)
            <div class="sidebar-item" onclick="goToDetail('{{ route('audio.index', $audio->id) }}')">
                <span>{{ $audio->title }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

<script>
    function goToDetail(url) {
        window.location.href = url;
    }
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap');

/* Menambahkan gaya CSS untuk judul Home */
.home-title {
    font-family: 'poppins', sans-serif;
    display: flex;
    justify-content: center; /* Menyusun elemen secara horizontal di tengah */
    align-items: center; /* Menyusun elemen secara vertikal di tengah */
    font-size: 18px; /* Ukuran font lebih kecil */
    font-weight: normal; /* Tidak tebal seperti yang lain */
    color: #342E37; /* Warna teks */
    margin-top: 10px; /* Jarak atas agar tidak terlalu dekat dengan bagian atas halaman */
    margin-bottom: 5px; /* Jarak bawah agar konsisten */
    position: relative;
    text-align: center; /* Menyusun teks di tengah */
}

.home-title:before {
    content: '';
    width: 40px;
    height: 4px;
    background: linear-gradient(90deg, var(--blue), #96799c);
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%); /* Menggeser garis ke tengah secara horizontal */
}


/* Main Container */
.container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    width: 100%;
    max-width: 1200px;
    padding: 20px;
    margin: 0 auto;
    font-family: 'Poppins', sans-serif;
}

/* Main Content */
.main-content {
    text-align: center;
    flex: 1;
    min-width: 60%;
    background-color: #ffffff;
    border-radius: 8px;
}

/* Sidebar */
.kanan {
    flex: 0 0 300px;
    background-color: #ffffff;
    padding: 20px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    position: sticky;
    top: 20px;
}

/* Section Titles */
.section-title {
    font-size: 20px;
    font-weight: normal;
    color: #342E37;
    margin-bottom: 20px;
    position: relative;
    display: inline-block;
}

.section-title:before {
    content: '';
    width: 40px;
    height: 4px;
    background: linear-gradient(90deg, #1e88e5, #96799c);
    position: absolute;
    bottom: -5px;
    left: 0;
}

/* Card Row Layout */
.card-row-foto, .card-row {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    width: 100%;
    justify-content: space-between;
}

.card-row > .card, .card-row-foto > .card {
    flex: 1 1 20%;
    box-sizing: border-box;
}

.card {
    background-color: #fff;
    text-align: center;
    display: flex;
    flex-direction: column;
    padding: 10px;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    width: 48%;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
}

.card h3 {
    font-size: 14px;
    margin: 10px 0 5px;
    color: #342E37;
}

.card p {
    font-size: 12px;
    margin: 0;
    color: #555;
}

/* Sidebar Item */
.sidebar {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.sidebar-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #1e88e5;
    color: white;
    padding: 10px 15px;
    border-radius: 50px;
    font-size: 12px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.sidebar-item:hover {
    background-color: #1565c0;
    transform: translateX(5px);
}

/* Video Image */
.video .image {
    height: 150px;
    overflow: hidden;
    position: relative;
}

/* Photo Image */
.photo .image {
    height: 120px;
    background-size: cover;
    background-position: center;
}

/* Hover Effect on Video */
.card:hover .image video {
    transform: scale(1.05);
    animation: playVideo 0.5s forwards;
}

@keyframes playVideo {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(1.05);
    }
}

/* Link Styling */
a {
    text-decoration: none;
    color: inherit;
}

/* Responsive Styling */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .main-content {
        min-width: 100%;
    }

    .kanan {
        flex: 0 0 100%;
        margin-top: 20px;
    }

    .card {
        width: 100%;
    }

    .card-row {
        flex-direction: column;
    }

    .section-title {
        font-size: 15px;
    }

    .card h3 {
        font-size: 10px;
    }

    .card p {
        font-size: 8px;
    }

    .sidebar-item {
        font-size: 10px;
    }
}
</style>
