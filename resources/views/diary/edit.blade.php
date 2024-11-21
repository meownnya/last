@extends('layouts.app')

@section('content')
    <div class="edit-diary-py-4">
        <h3 class="edit-diary-fw-bold mb-2 pb-2 border-bottom">Edit Diary</h3>

        <!-- Tombol Kembali dengan ikon -->
        <a href="{{ route('diary.index') }}" class="btn btn-sm btn-secondary mb-3">
            <i class='bx bx-arrow-back'></i>
        </a>

        <!-- Form untuk mengedit diary -->
        <div class="edit-diary-isi">
            <form action="{{ route('diary.update', $diary->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="edit-diary-form-group">
                    <label for="title" class="edit-diary-form-label">Judul Diary<span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $diary->title) }}" class="edit-diary-form-control @error('title') is-invalid @enderror" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="edit-diary-form-group">
                    <label for="text" class="edit-diary-form-label">Teks Diary<span class="text-danger">*</span></label>
                    <textarea name="text" id="text" class="edit-diary-form-control @error('text') is-invalid @enderror" rows="5" required>{{ old('text', $diary->text) }}</textarea>
                    @error('text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection

<style>
    /* Styling global */
    .edit-diary-py-4 {
        font-family: 'Poppins', sans-serif;
    }

    /* Styling untuk judul */
    h3.edit-diary-fw-bold {
        font-size: 22px;
        font-weight: normal;
        text-align: center;
        color: #34495e;
        margin-bottom: 20px;
        position: relative;
    }

    h3.edit-diary-fw-bold::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: #1e88e5;
        margin: 10px auto;
        border-radius: 5px;
    }

    /* Form styling */
    .edit-diary-isi {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: auto;
    }

    .edit-diary-form-group {
        margin-bottom: 15px;
    }

    .edit-diary-form-label {
        font-size: 14px;
        font-weight: normal;
        color: #34495e;
        display: block;
        margin-bottom: 5px;
    }

    .edit-diary-form-control {
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ced4da;
        font-size: 14px;
        color: #495057;
    }

    .edit-diary-form-control:focus {
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
</style>

<link href="https://cdn.jsdelivr.net/npm/boxicons/css/boxicons.min.css" rel="stylesheet">
