<style>
    h1 {
        margin-top: 20px;
        text-align: left;
        margin-bottom: 10px;
        font-weight: bold;
        font-size: xx-large
    }

    form {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
    }

    .form-section {
        width: 70%;
        padding: 10px;
    }

    .photo-section {
        width: 30%;
        padding: 10px;
        text-align: center;
    }

    .form-group {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .form-group label {
        width: 30%;
        font-weight: bold;
    }

    .form-group input {
        width: 70%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group .error {
        color: red;
        font-size: 12px;
        margin-left: 10px;
    }

    .photo-section img {
        width: 200px;
        height: 240px;
        object-fit: cover;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
        width: 100%;
    }

    .buttons button {
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        color: #fff;
        cursor: pointer;
    }

    .buttons .reset {
        background-color: #f44336;
    }

    .buttons .submit {
        background-color: #4caf50;
    }

    .form-section,
    .photo-section {
        height: auto;
        overflow: visible;
    }
</style>
</head>

<body>
    <h1>Tambah Kader</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.kelola_kader') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Kolom Kiri: Form -->
        <div class="form-section">
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK">
                @error('nik')
                    <span class="error">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                    placeholder="Masukkan Nama">
                @error('nama')
                    <span class="error">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
                    placeholder="Masukkan Alamat">
                @error('alamat')
                    <span class="error">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}"
                    placeholder="Masukkan Jabatan">
                @error('jabatan')
                    <span class="error">* {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan Password">
                @error('password')
                    <span class="error">* {{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Kolom Kanan: Foto -->
        <div class="photo-section">
            <label for="pas_foto"></label>
            <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder">
            <input type="file" name="pas_foto" id="pas_foto">
            @error('pas_foto')
                <span class="error">* {{ $message }}</span>
            @enderror
        </div>

        <!-- Tombol -->
        <div class="flex justify-center gap-4 mt-6 w-full">
            <button
                class="px-4 py-2 text-sm bg-red-500 text-white rounded w-32 h-10 hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Reset</button>
            <button
                class="px-4 py-2 text-sm bg-green-500 text-white rounded w-32 h-10 hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Simpan</button>
        </div>

    </form>
