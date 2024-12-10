<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kader</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-4">Daftar Jadwal Posyandu</h1>
        <!-- Container untuk search box dan tombol tambah -->
        <div class="flex items-center justify-between mb-4">
            <!-- Form pencarian -->
            <form class="flex items-center w-2/4">
                <input type="text" id="search"
                    class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-gray-300 text-gray-700 text-sm"
                    placeholder="Search here" />
                <button type="submit"
                    class="ml-2 bg-[#41a99dac] text-white px-4 py-2 rounded-md hover:bg-[#3a928d] transition active:scale-95">
                    Cari
                </button>
            </form>
            <!-- Tombol tambah -->
            <button class="ml-4 bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                Tambah
            </button>
        </div>
        <!-- Tabel -->
        <table id="jadwalPosyanduTable" class="w-full border-collapse border border-[#62BCB1]">
            <thead>
                <tr>
                    <th class="text-white border bg-[#62BCB1] border-[#62BCB1] py-2 px-4">Nama
                        Kegiatan</th>
                    <th class="text-white border bg-[#62BCB1] border-[#62BCB1] py-2 px-4">Edit</th>
                    <th class="text-white border bg-[#62BCB1] border-[#62BCB1] py-2 px-4">Hapus</th>
                </tr>
            </thead>
            <tbody class= "bg-white">
                <tr class="text-center">
                    <td class="border border-[#62BCB1] py-2 px-4">Kegiatan 1</td>
                    <td class="border border-[#62BCB1] py-2 px-4">
                        <button
                            class="bg-teal-500 text-white px-3 py-1 rounded-md hover:bg-teal-600 transition">Edit</button>
                    </td>
                    <td class="border border-[#62BCB1] py-2 px-4">
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">Hapus</button>
                    </td>
                </tr>
                <tr class="text-center">
                    <td class="border border-[#62BCB1] py-2 px-4">Kegiatan 2</td>
                    <td class="border border-[#62BCB1] py-2 px-4">
                        <button
                            class="bg-teal-500 text-white px-3 py-1 rounded-md hover:bg-teal-600 transition">Edit</button>
                    </td>
                    <td class="border border-[#62BCB1] py-2 px-4">
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">Hapus</button>
                    </td>
                </tr>
                <!-- Tambahkan baris kegiatan lain di sini -->
            </tbody>
        </table>
    </div>


</body>

</html>
