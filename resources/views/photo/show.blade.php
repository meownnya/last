@extends('layouts.app')

@section('content')
    <style>
        /* Styling global */
        .py-4 {
            font-family: 'Poppins', sans-serif;
            
        }


        /* Styling untuk judul */
        h3.fw-bold {
            font-size: 22px;
            font-weight: normal;  /* Ganti 'bold' menjadi 'normal' atau angka ringan seperti 400 */
            text-align: center;
            color: #34495e;
            margin-bottom: 20px;
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

        /* Detail Foto */
        .photo-details {
            display: flex;
            gap: 30px;
            align-items: flex-start;
            margin-top: 20px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .photo-image {
            flex: 1;
            max-width: 500px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .photo-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .photo-info {
            flex: 2;
            padding: 10px 20px;
        }

        .photo-title {
            font-size: 22px;
            font-weight: normal;
            color: #34495e;
            margin-bottom: 10px;
        }

        .photo-caption {
            font-size: 16px;
            color: #7f8c8d;
            margin-bottom: 15px;
        }

        .photo-date {
            font-size: 14px;
            color: #95a5a6;
        }

        .divider {
            height: 2px;
            width: 100%;
            background: #e1e4e8;
            margin: 15px 0;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .photo-details {
                flex-direction: column;
                align-items: center;
                padding: 15px;
            }

            .photo-image {
                max-width: 100%;
            }

            .photo-info {
                text-align: center;
            }
        }
    </style>

    <div class="py-4">
        <h3 class="fw-bold">Detail Foto</h3>

        <!-- Tombol Kembali, Edit, Hapus -->
        <div class="button-group">
            <a href="{{ route('photo.index') }}" class="btn">
                <i class='bx bx-arrow-back'></i>
            </a>
            <a href="{{ route('photo.edit', $photo->id) }}" class="btn">
                <i class='bx bx-edit'></i>
            </a>
            <form action="{{ route('photo.destroy', $photo->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn">
                    <i class='bx bx-trash'></i>
                </button>
            </form>
        </div>

        <!-- Detail Foto -->
        <div class="photo-details">
            <!-- Gambar di sebelah kiri -->
            <div class="photo-image">
                <img src="{{ asset('storage/uploads/photos/' . $photo->photo) }}" 
                     alt="{{ $photo->title }}">
            </div>

            <!-- Informasi di sebelah kanan -->
            <div class="photo-info">
                <h4 class="photo-title">{{ $photo->title }}</h4>
                <hr class="divider">
                <p class="photo-caption">{{ $photo->caption ?? 'Tidak ada keterangan.' }}</p>
                <hr class="divider">
                <p class="photo-date">
                    Tanggal: {{ \Carbon\Carbon::parse($photo->from_date)->isoFormat('DD MMMM Y') }}
                </p>
            </div>
        </div>
    </div>
@endsection
