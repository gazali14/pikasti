 <!-- Form Tambah Kader -->
 <div class="mt-6 bg-white p-6 rounded shadow">
     <h2 class="text-lg font-semibold mb-4">Tambah Kader</h2>
     <form action="{{ route('admin.kelola_kader') }}" method="POST" class="space-y-4">
         @csrf
         <!-- Input NIK -->
         <div>
             <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
             <input type="text" id="nik" name="nik" placeholder="Masukkan NIK (16 digit)"
                 class="mt-1 block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-teal-300 focus:border-teal-500">
         </div>

         <!-- Input Nama -->
         <div>
             <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
             <input type="text" id="nama" name="nama" placeholder="Masukkan Nama"
                 class="mt-1 block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-teal-300 focus:border-teal-500">
         </div>

         <!-- Input Alamat -->
         <div>
             <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
             <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat"
                 class="mt-1 block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-teal-300 focus:border-teal-500">
         </div>

         <!-- Input Jabatan -->
         <div>
             <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
             <input type="text" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan"
                 class="mt-1 block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-teal-300 focus:border-teal-500">
         </div>

         <!-- Input Password -->
         <div>
             <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
             <input type="password" id="password" name="password" placeholder="Masukkan Password"
                 class="mt-1 block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-teal-300 focus:border-teal-500">
         </div>

         <!-- Tombol Aksi -->
         <div class="flex space-x-4">
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
