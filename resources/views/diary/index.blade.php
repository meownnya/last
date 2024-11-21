@extends('layouts.app')

@section('content')
<div class="py-4">
    <h3 class="fw-bold mb-2 pb-2 border-bottom">Daftar Diary</h3>

    <!-- Tambah Diary Button -->
    <a href="{{ route('diary.create') }}" class="btn btn-sm btn-primary mb-3">
        <i class="fas fa-plus"></i>
    </a>

    <div class="diary-container">
        @if ($diaries->count() > 0)
            @foreach ($diaries as $diary)
            <!-- Diary Item -->
            <div class="diary-item">
                <div class="diary-header">
                    <!-- Title (Link to show the Diary) -->
                    <a href="{{ route('diary.show', $diary->id) }}" class="diary-title">{{ $diary->title }}</a>
                </div>

                <!-- Diary Content (Text) -->
                <p class="diary-text">{{ \Illuminate\Support\Str::limit($diary->text, 10) }}</p>

                <!-- Controls: Edit, Delete -->
                <div class="diary-actions">
                    <!-- Edit Button -->
                    <a href="{{ route('diary.edit', $diary->id) }}" class="control-button edit-button">
                        <i class="fas fa-edit"></i>
                    </a>
                    <!-- Delete Button -->
                    <form action="{{ route('diary.destroy', $diary->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="control-button delete-button">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        @else
        <div class="no-diaries">Tidak ada diary yang ditemukan.</div>
        @endif
    </div>
</div>
@endsection

<script>
    // JavaScript functionality for interactions (if any) can go here
</script>

<style>
    /* Styling for the Diary List Title */
    h3.fw-bold {
        font-family: 'poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        font-weight: normal;
        color: #342E37;
        margin-top: 10px;
        margin-bottom: 30px;
        position: relative;
        text-align: center;
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

    /* Styling for Add Diary Button */
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
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        background: #1565c0;
    }

    /* Diary Container */
    .diary-container {
        background-color: #ffffff;
        padding: 20px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        opacity: 0;
        animation: fadeIn 1s forwards;
        margin-left: 20px;
    }

    /* Diary Item */
    .diary-item {
        background-color: #4285f4;
        color: white;
        border-radius: 50px;
        padding: 15px;
        display: flex;
        align-items: center;  /* Align items horizontally */
        gap: 20px;  /* Space between elements */
        opacity: 0;
        animation: fadeIn 0.5s forwards;
        animation-delay: 0.2s;
        margin-bottom: 15px;
    }

    .diary-item:nth-child(even) {
        animation-delay: 0.4s;
    }

    /* Diary Header */
    .diary-header {
        display: flex;
        flex: 1;
        align-items: center;
    }

    .diary-title {
        font-size: 16px;
        font-weight: normal;
        color: white;
        text-decoration: none; /* Remove underline from link */
        flex: 1;  /* Allow title to take up available space */
    }

    .diary-title:hover {
        color: #ffcc00; /* Change color on hover */
    }

    /* Diary Text */
    .diary-text {
        font-size: 14px;
        color: #e0e0e0;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        flex: 3;  /* Allow text to take up more space */
    }

    /* Diary Actions */
    .diary-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    /* Control Buttons (Edit, Delete) */
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

    /* Edit Button */
    .edit-button {
        background-color: #fbbc05; /* Yellow */
        color: white;
        font-size: 18px;
    }

    /* Delete Button */
    .delete-button {
        background-color: #ea4335; /* Red */
        color: white;
        font-size: 18px;
    }

    /* No Diaries Message */
    .no-diaries {
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
