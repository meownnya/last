@extends('layouts.app')

@section('content')
    <div class="edit-video-py-4">
        <h3 class="edit-video-fw-bold mb-2 pb-2 border-bottom">Edit Video</h3>

        <!-- Tombol Kembali dengan ikon -->
        <a href="{{ route('video.show', $video->id) }}" class="btn btn-sm btn-secondary mb-3">
            <i class='bx bx-arrow-back'></i>
        </a>

        <!-- Form untuk mengedit video -->
        <div class="edit-video-isi">
            <form action="{{ route('video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="edit-video-form-group">
                    <label for="title" class="edit-video-form-label">Judul Video<span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $video->title) }}" class="edit-video-form-control @error('title') is-invalid @enderror" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="edit-video-form-group">
                    <label for="caption" class="edit-video-form-label">Keterangan Video</label>
                    <textarea name="caption" id="caption" class="edit-video-form-control @error('caption') is-invalid @enderror">{{ old('caption', $video->caption) }}</textarea>
                    @error('caption')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="edit-video-form-group">
                    <label for="video" class="edit-video-form-label">Ganti Video</label>
                    <div class="custom-file-upload">
                        <input type="file" name="video" id="video" class="edit-video-form-control @error('video') is-invalid @enderror" accept="video/*" onchange="updateFileName(this)" style="display: none;">
                        <label for="video" class="upload-icon">
                            <i class='bx bx-upload'></i> Unggah Video
                        </label>
                        <span id="file-name" class="ml-2 text-muted">Tidak ada file yang dipilih</span>
                    </div>
                    @error('video')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="edit-video-form-group">
                    <label for="current_video" class="edit-video-form-label">Video Saat Ini</label><br>
                    <video width="320" height="240" controls>
                        <source src="{{ asset('storage/uploads/videos/' . $video->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <button type="submit" class="btn">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection

<style>
    /* Styling global */
    .edit-video-py-4 {
        font-family: 'Poppins', sans-serif;
    }

    /* Styling untuk judul */
    h3.edit-video-fw-bold {
        font-size: 22px;
        font-weight: normal;
        text-align: center;
        color: #34495e;
        margin-bottom: 20px;
        position: relative;
    }

    h3.edit-video-fw-bold::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: #1e88e5;
        margin: 10px auto;
        border-radius: 5px;
    }

    /* Form styling */
    .edit-video-isi {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: auto;
    }

    .edit-video-form-group {
        margin-bottom: 15px;
    }

    .edit-video-form-label {
        font-size: 14px;
        font-weight: normal;
        color: #34495e;
        display: block;
        margin-bottom: 5px;
    }

    .edit-video-form-control {
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ced4da;
        font-size: 14px;
        color: #495057;
    }

    .edit-video-form-control:focus {
        border-color: #1e88e5;
        box-shadow: 0 0 5px rgba(30, 136, 229, 0.5);
    }

    .invalid-feedback {
        color: #e74c3c;
        font-size: 12px;
    }

    /* Tombol */
    .btn {
        background: linear-gradient(90deg, #1e88e5, #96799c);
        color: white;
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 10px;
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn:hover {
        transform: scale(1.05);
        background: #1565c0;
        box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.2);
    }

    .btn:active {
        transform: scale(0.95);
    }

    video {
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 100%;
    }

    /* Styling untuk custom upload */
    .custom-file-upload {
        display: flex;
        align-items: center;
    }

    .upload-icon {
        cursor: pointer;
        background-color: #f1f1f1;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 16px;
        color: #1e88e5;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .upload-icon:hover {
        background-color: #e1e1e1;
    }

    /* Icon */
    

    #file-name {
        font-size: 14px;
        color: #34495e;
    }
</style>

<script>
    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : 'Tidak ada file yang dipilih';
        document.getElementById('file-name').innerText = fileName;
    }
</script>

<link href="https://cdn.jsdelivr.net/npm/boxicons/css/boxicons.min.css" rel="stylesheet">
