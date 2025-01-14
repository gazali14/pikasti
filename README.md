# SISTEM MANAJEMEN PELAYANAN POSYANDU PIKASTI

Proyek ini bertujuan untuk membangun sistem Manajemen Pelayanan Posyandu berbasis web menggunakan Laravel 11. Sistem ini dirancang untuk mempermudah kader Posyandu dalam mengelola data bayi, termasuk kehadiran bayi, mencatat perkembangan kesehatan bayi melalui Kartu Menuju Sehat (KMS), serta menyediakan laporan perkembangan bayi secara terstruktur. Pada sistem ini terdapat 3 role pengguna, yaitu admin, kader, dan orang tua bayi. 
Orang Tua bayi dapat melihat informasi umum seputar posyandu pikasti serta dapat melihat kartu KMS bayi yang dimiliki. Admin memiliki peran untuk mengelola akun kader dan bayi, serta melakukan konfigurasi penting pada sistem seperti pengelolaan jadwal kegiatan posyandu. Sedangkan kader dapat mencatat data kesehatan bayi, memantau perkembangan, dan membuat laporan. 
Dengan adanya sistem ini, diharapkan proses pencatatan, pelaporan, dan pemantauan perkembangan bayi menjadi lebih efisien, akurat, dan mudah diakses, sehingga meningkatkan kualitas layanan Posyandu bagi masyarakat.

---

## Fitur Utama

### Login
1. **Login**: Autentikasi login untuk admin, kader, dan bayi.

### Halaman Orang Tua Bayi
1. **Home** : Halaman awal saat pengguna membuka sistm.
2. **Jadwal** : Menampilkan jadwal kegiatan posyandu selama setahun.
3. **Profil Kader** : Menampilkan data kader yang bekerja di Posyandu Pikasti
4. **Dokumentasi** : Menampilakn foto/dokumentasi kegiatan yang ada di Posyandu Pikasti.
5. **Dashboard** : Menampilkan data perkembangan kondisi bayi.

### Halaman Kader 
1. **Dashboard** : Menampilkan grafik kehadiran, rata-rata tinggi badan, dan rata-rata berat badan bayi tiap kegiatan.
2. **Presensi Bayi** : Mencatat bayi yang hadir sesuai dengan kegiatan yang dilaksanakan.
3. **Pendataan Kondisi Bayi** : Input, pembaruan, dan penghapusan untuk pengukuran tinggi badan, berat badan, imunisasi, serta menampilkan Kartu Menuju Sehat(KMS) tiap bayi.
4. **Vitamin dan PMT** : Input, pembaruan, dan penghapusan untuk pemberian vitamin dan makanan tambahan kepada bayi.
5. **Laporan** : Menampilkan dan mengenerate laporan summary pada setiap kegiatan dengan ekstensi .xlsx.

### Halaman Admin
1. **Dashboard** : Menampilkan grafik kehadiiran kader pada tahun terkini.
2. **Kelola Kohort Bayi** : Mengelola akun bayi sekaligus mendaftarkan bayi pada Posyandu Pikasti.
3. **Kelola Kader** : Mengelola akun kader sekaligus mendata seluruh kader yang bekerja di Posyandu Pikasti.
4. **Presensi Kader** : Mencatat kader yang hadir pada jadwal kegiatan Posyandu Pikasti.
5. **Kelola Jadwal** : Input, pembaruan, dan penghapusan jadwal kegiatan Posyandu Pikasti.
6. **Kelola Dokumentasi** : Input, pembaruan, dan penghapusan dokumentasi kegiatan Posyandu Pikasti.
---

## Struktur Direktori

Berikut adalah struktur direktori utama dari repositori proyek ini beserta deskripsinya:

```
.
├── app/              # Berisi logika aplikasi, seperti controller, model, dan middleware
│   ├── Exports/      # Kelas untuk menangani ekspor data (misalnya ke Excel atau CSV)
│   ├── Http/
│   │   ├── Controllers/  # Controller aplikasi
│   │   └── Middleware/   # Middleware aplikasi
│   ├── Models/           # Model database
│   └── ...
├── bootstrap/        # File bootstrap untuk memulai aplikasi
├── config/           # File konfigurasi aplikasi
├── database/         # Berisi migrasi, seeder, dan factory untuk database
│   ├── migrations/   # Skrip migrasi database
│   ├── seeds/        # Seeder untuk data awal
│   ├── database.sqlite # Database yang digunakan pada sistem
│   └── factories/    # Factory untuk membuat data dummy (jika diperlukan)
├── public/           # File publik seperti CSS, JavaScript, dan gambar
├── resources/        # Template view dan file resource lainnya
│   ├── views/        # Blade template
│   │   ├── admin/        # Source code view untuk halaman admin
│   │   ├── components/   # Komponen tampilan yang dapat digunakan ulang
│   │   ├── kader/        # Source code view untuk halaman kader
│   │   └── orang_tua/    # Source code view halaman pengguna bayi
│   ├── css/          # File untuk lokalitas CSS (tidak dapat dilihat publik)
│   └── ...
├── routes/           # File untuk mendefinisikan rute aplikasi
│   ├── web.php       # Rute untuk web
│   ├── api.php       # Rute untuk API
├── storage/          # File yang dihasilkan aplikasi seperti log atau cache
├── tests/            # File untuk pengujian aplikasi
├── vendor/           # Direktori yang berisi dependency Composer
├── .env.example      # Contoh file konfigurasi lingkungan
├── README.md         # Dokumentasi proyek
├── .gitignore        # File untuk menentukan file atau folder yang diabaikan oleh Git
├── tailwind.config.js# Konfigurasi Tailwind CSS
├── vite.config.js    # Konfigurasi Vite untuk build frontend
├── composer.json     # Konfigurasi dependency Composer
├── package.json      # Konfigurasi dependency Node.js
└── ...
```

---

## Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lokal:

1. Clone repositori ini:
   ```bash
   git clone https://github.com/gazali14/pikasti.git
   ```
2. Masuk ke direktori proyek:
   ```bash
   cd repo-proyek
   ```
3. Instal dependency menggunakan Composer:
   ```bash
   composer install
   ```
4. Salin file `.env.example` menjadi `.env` dan konfigurasi sesuai kebutuhan Anda:
   ```bash
   cp .env.example .env
   ```
5. Generate kunci aplikasi:
   ```bash
   php artisan key:generate
   ```
6. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```
7. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

---
