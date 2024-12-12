<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kader</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Kader</h1>

        @if (session('success'))
            <p class="text-green-500">{{ session('success') }}</p>
        @endif

        <form action="{{ route('admin.kelola_kader') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="flex flex-wrap md:flex-nowrap gap-6">
                <!-- Kolom Kiri: Form -->
                <div class="w-full md:w-2/3 space-y-4">
                    <div>
                        <label for="nik" class="block text-gray-700 font-medium">NIK</label>
                        <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            placeholder="Masukkan NIK">
                        @error('nik')
                            <span class="text-red-500 text-sm">* {{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="nama" class="block text-gray-700 font-medium">Nama</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            placeholder="Masukkan Nama">
                        @error('nama')
                            <span class="text-red-500 text-sm">* {{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="alamat" class="block text-gray-700 font-medium">Alamat</label>
                        <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            placeholder="Masukkan Alamat">
                        @error('alamat')
                            <span class="text-red-500 text-sm">* {{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="jabatan" class="block text-gray-700 font-medium">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            placeholder="Masukkan Jabatan">
                        @error('jabatan')
                            <span class="text-red-500 text-sm">* {{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 font-medium">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            placeholder="Masukkan Password">
                        @error('password')
                            <span class="text-red-500 text-sm">* {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan: Foto -->
                <div class="w-full md:w-1/3 flex flex-col items-center space-y-4">
                    <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder"
                        class="w-48 h-60 object-cover border rounded shadow">
                    <input type="file" name="pas_foto" id="pas_foto"
                        class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none">
                    @error('pas_foto')
                        <span class="text-red-500 text-sm">* {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-center gap-4">
                <button type="reset"
                    class="px-4 py-2 bg-red-500 text-white rounded shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                    Reset
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-teal-500 text-white rounded shadow hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</body>

</html>