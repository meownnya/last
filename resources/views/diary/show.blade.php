@extends('layouts.app')

@section('content')
    <style>
        /* Styling global */
        .py-4 {
            font-family: 'Poppins', sans-serif;
        }

        /* Styling untuk judul */
        h3.fw-bold {
            font-size: 18px;
            font-weight: normal;  /* Ganti 'bold' menjadi 'normal' atau angka ringan seperti 400 */
            text-align: center;
            color: #34495e;
            margin-top: 10px; /* Jarak atas agar tidak terlalu dekat dengan bagian atas halaman */
            margin-bottom: 30px; /* Jarak bawah agar konsisten */
            position: relative;
        }

        h3.fw-bold::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: #1e88e5;
            margin: 10px auto;
            border-radius: 5px;
        }

        /* Tombol aksi */
        .button-group {
            display: flex;
            gap: 15px;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .btn {
            background: linear-gradient(90deg, #1e88e5, #96799c);
            color: white;
            font-size: 18px;
            padding: 12px 14px;
            border-radius: 50%; /* Tombol bundar */
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn:hover {
            transform: scale(1.1); /* Membesar sedikit saat hover */
            background: #1565c0;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: scale(0.95); /* Efek saat tombol ditekan */
        }

        /* Styling for Diary Details */
        .diary-details {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        /* Diary Title */
        .diary-title h4 {
            font-size: 22px;
            font-weight: normal;
            color: #34495e;
            margin-bottom: 15px;
        }

        /* Diary Text */
        .diary-text p {
            font-size: 16px;
            color: #7f8c8d;
            line-height: 1.6;
        }

        /* Divider for better separation */
        .divider {
            height: 2px;
            width: 100%;
            background: #e1e4e8;
            margin: 20px 0;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .button-group {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
        }
    </style>

    <div class="py-4">
        <h3 class="fw-bold">Detail Diary</h3>

        <!-- Tombol Kembali, Edit, Hapus -->
        <div class="button-group">
            <a href="{{ route('diary.index') }}" class="btn">
                <i class='bx bx-arrow-back'></i>
            </a>
            <a href="{{ route('diary.edit', $diary->id) }}" class="btn">
                <i class='bx bx-edit'></i>
            </a>
            <form action="{{ route('diary.destroy', $diary->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn">
                    <i class='bx bx-trash'></i>
                </button>
            </form>
        </div>

        <!-- Detail Diary -->
        <div class="diary-details">
            <div class="diary-title">
                <h4>{{ $diary->title }}</h4>
            </div>

            <div class="diary-text">
                <p>{{ $diary->text }}</p>
            </div>

            <hr class="divider">
        </div>
    </div>
@endsection
