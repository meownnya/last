@extends('layouts.app')

@section('content')
<div class="py-4">
    <h3 class="fw-bold mb-2 pb-2 border-bottom">Daftar Audio</h3>

    <!-- Tambah Audio Button -->
    <a href="{{ route('audio.create') }}" class="btn btn-sm btn-primary mb-3">
        <i class="fas fa-plus"></i>
    </a>

    <div class="audio-container">
        @if ($audios->count() > 0)
            @foreach ($audios as $audio)
            <!-- Audio Item -->
            <div class="audio-item">
                <div class="audio-header">
                    <!-- Title -->
                    <div class="audio-title">{{ $audio->title }}</div>

                    <!-- Controls: Play/Pause, Edit, Delete -->
                    <div class="audio-actions">
                        <!-- Play/Pause Button -->
                        <button class="control-button play-button" onclick="toggleAudio({{ $audio->id }})">
                            <i class="fas fa-play"></i>
                        </button>
                        <!-- Edit Button -->
                        <a href="{{ route('audio.edit', $audio->id) }}" class="control-button edit-button">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Delete Button -->
                        <form action="{{ route('audio.destroy', $audio->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="control-button delete-button">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Hidden Audio Element -->
                <audio id="audio-{{ $audio->id }}" src="{{ asset('storage/uploads/audio/' . $audio->audio) }}"></audio>
            </div>
            @endforeach
        @else
        <div class="no-audios">Tidak ada audio yang ditemukan.</div>
        @endif
    </div>
</div>
@endsection

<script>
    function toggleAudio(audioId) {
        const audio = document.getElementById(`audio-${audioId}`);
        const button = document.querySelector(`#audio-${audioId}`).closest('.audio-item').querySelector('.play-button i');

        if (audio.paused) {
            audio.play();
            button.classList.remove('fa-play');
            button.classList.add('fa-pause');
        } else {
            audio.pause();
            button.classList.remove('fa-pause');
            button.classList.add('fa-play');
        }
    }
</script>

<style>

    /* Styling untuk judul Daftar Audio */
h3.fw-bold  {
    font-family: 'poppins', sans-serif;
    display: flex;
    justify-content: center; /* Menyusun elemen secara horizontal di tengah */
    align-items: center; /* Menyusun elemen secara vertikal di tengah */
    font-size: 18px; /* Ukuran font lebih kecil */
    font-weight: normal; /* Tidak tebal seperti yang lain */
    color: #342E37; /* Warna teks */
    margin-top: 10px; /* Jarak atas agar tidak terlalu dekat dengan bagian atas halaman */
    margin-bottom: 30px; /* Jarak bawah agar konsisten */
    position: relative;
    text-align: center; /* Menyusun teks di tengah */
}

h3.fw-bold:before {
    content: '';
    width: 40px;
    height: 4px;
    background: linear-gradient(90deg, var(--blue), #96799c);
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%); /* Menggeser garis ke tengah secara horizontal */
}

/* Styling untuk tombol Tambah Audio */
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
    z-index: 1000; /* Agar selalu di atas */
    transition: transform 0.3s ease, background-color 0.3s ease;
}

.btn-primary:hover {
    transform: scale(1.05);
    background: #1565c0;
}

/* Container Audio */
.audio-container {
    flex: 0 0 300px;
    background-color: #ffffff;
    padding: 20px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    position: sticky;
    top: 20px;
    margin-left: 20px; /* Tambahkan jarak antara sidebar dan audio container */
    opacity: 0;
    animation: fadeIn 1s forwards;
}

.audio-item {
    background-color: #4285f4;
    color: white;
    border-radius: 50px;
    padding: 10px 20px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    opacity: 0;
    animation: fadeIn 0.5s forwards;
    animation-delay: 0.2s;
    margin-bottom: 15px; /* Added margin to create space between audio items */
}


.audio-item:nth-child(even) {
    animation-delay: 0.4s;
}

.audio-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.audio-title {
    font-size: 16px;
    font-weight: normal;
}

.audio-actions {
    display: flex;
    gap: 10px;
}

.control-button {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
}

.control-button:hover {
    transform: scale(1.1);
}

.play-button {
    background-color: white;
    color: #4285f4;
    font-size: 16px;
}

.edit-button {
    background-color: #fbbc05; /* Yellow color */
    color: white;
    font-size: 18px;
}

.delete-button {
    background-color: #ea4335; /* Red color */
    color: white;
    font-size: 18px;
}

.audio-actions .control-button i {
    font-size: 14px;
}

.no-audios {
    text-align: center;
    font-size: 16px;
    color: gray;
}

/* Animations */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
