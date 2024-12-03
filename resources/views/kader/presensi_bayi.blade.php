<x-layout-kader>
    <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Presensi Kegiatan</title>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4fcf7;
    }
    .container {
      padding: 20px;
      margin-top: -45px;
    }
    h1 {
      margin-left: 10px;
      color: #000000;
    }
    .search-box {
      margin: 10px 0;
      display: flex;
      justify-content: flex-start;
    }
    .search-box input {
      width: 50%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .activity-list {
      list-style-type: none;
      padding: 0;
      margin-top: 45px
    }
    .activity-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      margin: 13px 0;
      border-radius: 8px;
      background-color: #41a99dac;
      /*box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);*/
      color: white;
      font-family: "Poppins", sans-serif;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .activity-item:hover {
    transform: scale(1.03); /* Membesar sedikit */
    border-radius: 20px; /* Mengubah sudut menjadi lebih bulat */
    background: linear-gradient(135deg, #5bada4, #5bada9); /* Gradasi warna */
    /*box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Bayangan lebih besar */
    }
    .activity-item .details {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .activity-item button {
      padding: 10px 20px;
      background-color: #4b9df1;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .activity-item button:hover {
      background-color: #3278c7;
    }
    .specific-date {
    margin-right: 450px;
    color: white;
    font-family: "Poppins", sans-serif;
    font-size: 18px
    }

  </style>
</head>

<body>
  <div class="container">
    <div class="search-box">
      <input type="text" id="search" placeholder="Search here..." oninput="filterActivities()">
    </div>
    <ul id="activity-list" class="activity-list">
      <li class="activity-item">
        <div class="details">
          <strong style="font-size: 22px;">Kegiatan 1</strong>
          <span>Imunisasi Campak</span>
        </div>
        <div>
          <strong class="specific-date">27 Januari 2025</strong>
          <button onclick="window.location.href='{{ route('kader.cek_presensi') }}'">Presensi</button>
        </div>
      </li>
      <li class="activity-item">
        <div class="details">
          <strong style="font-size: 22px;">Kegiatan 2</strong>
          <span>Imunisasi Stunting</span>
        </div>
        <div>
          <strong class="specific-date">27 Februari 2025</strong>
          <button onclick="window.location.href='{{ route('kader.cek_presensi') }}'">Presensi</button>
        </div>
      </li>
      <li class="activity-item">
        <div class="details">
          <strong style="font-size: 22px;">Kegiatan 3</strong>
          <span>Imunisasi Stunting</span>
        </div>
        <div>
          <strong class="specific-date">27 Maret 2025</strong>
          <button onclick="window.location.href='{{ route('kader.cek_presensi') }}'">Presensi</button>
        </div>
      </li>
      <li class="activity-item">
        <div class="details">
          <strong style="font-size: 22px;">Kegiatan 4</strong>
          <span>Imunisasi Stunting</span>
        </div>
        <div>
          <strong class="specific-date">27 April 2025</strong>
          <button onclick="window.location.href='{{ route('kader.cek_presensi') }}'">Presensi</button>
        </div>
      </li>
      <li class="activity-item">
        <div class="details">
          <strong style="font-size: 22px;">Kegiatan 5</strong>
          <span>Imunisasi Stunting</span>
        </div>
        <div>
          <strong class="specific-date">27 Mei 2025</strong>
          <button onclick="window.location.href='{{ route('kader.cek_presensi') }}'">Presensi</button>
        </div>
      </li>
      <!--<li class="activity-item">
        <div class="details">
          <strong style="font-size: 22px;">Kegiatan 6</strong>
          <span>Imunisasi Stunting</span>
        </div>
        <div>
          <strong class="specific-date">27 Juni 2025</strong>
          <button onclick="redirectToCekPresensi()">Presensi</button>
        </div>
      </li>
      <li class="activity-item">
        <div class="details">
          <strong style="font-size: 22px;">Kegiatan 7</strong>
          <span>Imunisasi Stunting</span>
        </div>
        <div>
          <strong class="specific-date">27 Juni 2025</strong>
          <button onclick="redirectToCekPresensi()">Presensi</button>
        </div>
      </li>-->
      <!-- Tambahkan kegiatan lain di sini -->
    </ul>
  </div>

  <script>
    document.getElementById('page-title').textContent = "Daftar Presensi Kegiatan";
    const pageTitle = document.getElementById('page-title');
    pageTitle.textContent = "Daftar Presensi Kegiatan";

    // Mengatur font, ketebalan, warna, ukuran, dan lainnya
    pageTitle.style.fontFamily = "Poppins, sans-serif";
    pageTitle.style.fontWeight = "bold"; // Ketebalan: normal, bold, 100-900
    pageTitle.style.fontSize = "30px"; // Ukuran font
    pageTitle.style.color = "#333"; // Warna teks
    pageTitle.style.fontWeight = "600"; 
    pageTitle.style.color = "#2c3e50"; 
    pageTitle.style.textShadow = "2px 2px 5px rgba(0, 0, 0, 0.2)";
    pageTitle.style.marginTop = "4px";
    pageTitle.style.letterSpacing = "1px";
    pageTitle.style.padding = "10px";

    function filterActivities() {
      const searchValue = document.getElementById("search").value.toLowerCase();
      const activities = document.querySelectorAll(".activity-item");
      activities.forEach(activity => {
        const title = activity.querySelector(".details strong").textContent.toLowerCase();
        if (title.includes(searchValue)) {
          activity.style.display = "";
        } else {
          activity.style.display = "none";
        }
      });
    }

    function redirectToCekPresensi() {
      window.location.href = "cek_presensi.blade.php"; // Ganti dengan URL halaman cek presensi Anda
    }
  </script>
</body>
</html>

</x-layout-kader>