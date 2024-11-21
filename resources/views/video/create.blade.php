@extends('layouts.app')

@section('content')
    <div class="add-video-container py-4">
        <h3 class="form-title fw-bold mb-2 pb-2 border-bottom">Tambah Video</h3>

        <!-- Tombol Kembali dengan ikon -->
        <a href="{{ route('video.index') }}" class="btn btn-sm btn-secondary mb-2">
            <i class='bx bx-arrow-back'></i>
        </a>

        <div class="isi">
            <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-2">
                    <label for="title" class="form-label">Judul Video<span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" /> 
                    @error('title')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="caption" class="form-label">Caption Video<span class="text-danger">*</span></label>
                    <textarea name="caption" id="caption" class="form-control @error('caption') is-invalid @enderror" rows="3">{{ old('caption') }}</textarea>
                    @error('caption')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="video" class="form-label">Video<span class="text-danger">*</span></label>
                    <div class="custom-file-upload">
                        <input type="file" name="video" id="video" class="form-control @error('video') is-invalid @enderror" accept="video/*" onchange="updateFileName(this)" style="display: none;">
                        <label for="video" class="upload-icon">
                            <i class='bx bx-upload'></i> Unggah Video
                        </label>
                        <span id="file-name" class="ml-2 text-muted">Tidak ada file yang dipilih</span>
                    </div>
                    @error('video')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mb-3">Simpan</button>
                <a href="{{ route('video.index') }}" class="btn btn-secondary mb-3">Batal</a>
            </form>
        </div>
    </div>
@endsection

<style>
    /* Styling global */
    .add-video-container {
        font-family: 'Poppins', sans-serif;
    }

    /* Styling untuk judul */
    .form-title {
        font-size: 22px;
        font-weight: normal;
        text-align: center;
        color: #34495e;
        margin-bottom: 20px;
        position: relative;
    }

    .form-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: #1e88e5;
        margin: 10px auto;
        border-radius: 5px;
    }

    /* Form styling */
    .isi {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: auto;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-label {
        font-size: 14px;
        font-weight: normal;
        color: #34495e;
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ced4da;
        font-size: 14px;
        color: #495057;
    }

    .form-control:focus {
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

    /* Styling untuk file input */
    .form-control[type="file"] {
        padding: 8px 10px;
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

    .text-danger {
        color: #e74c3c;
    }
</style>

<script>
    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : 'Tidak ada file yang dipilih';
        document.getElementById('file-name').innerText = fileName;
    }
</script>

<link href="https://cdn.jsdelivr.net/npm/boxicons/css/boxicons.min.css" rel="stylesheet">
