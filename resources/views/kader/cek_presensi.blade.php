<x-layout-kader>
    <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cek Presensi</title>
  <style>
    body#cek-presensi header-kader {
        display: none;
    }

    body {
        font-family: "Poppins", sans-serif;
        margin: 0;
        padding: 0;
        background-color: #E8F6F3;
      }

      #container {
        font-family: "Poppins", sans-serif;
        padding: 20px;
        margin: 0 auto;
        max-width: 1200px;
      }

      #title-container {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
      }

      #back-button {
        font-size: 24px;
        color: #2c3e50;
        text-decoration: none;
        margin-right: 10px;
      }

      #page-title {
        font-weight: 600;
        font-size: 30px;
        color: #2c3e50;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
      }

      #date-section {
        display: flex; 
        align-items: center; 
        gap: 10px; 
        font-family: "Poppins", sans-serif; 
        font-size: 16px; 
        color: #34495e; 
      }

      #date-input {
        padding: 8px; /* Jarak keseluruhan di dalam input */
        padding-top: 5px; /* Menambahkan ruang di bagian atas agar tulisan lebih ke bawah */
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
        outline: none;
      }

      label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
      }

      #search-container {
        margin-top: -50px; 
        margin-bottom: 20px; 
        display: flex;
        align-items: flex-start;
        justify-content: flex-end;
      }

      #search-container input {
        width: 300px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        outline: none;
      }

      #search-container button {
        margin-left: 10px;
        background-color: #41a99dac;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-family: "Poppins", sans-serif;
        transition: background-color 0.3s ease, transform 0.1s ease;
      }

      #search-container button:hover {
        background-color: #3a928d;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
      }

      #search-container button:active {
        transform: scale(0.95); 
        background-color: #35837f;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
      }

      th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
      }

      th {
        background-color: #41a99dac;
        color: white;
        text-align: center;
        vertical-align: middle;
        
      }

      #save-button {
        margin-left: 10px;
        float: right;
        background-color: #41a99dac;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-family: "Poppins", sans-serif;
        transition: background-color 0.3s ease, transform 0.1s ease;
      }

      #save-button:hover {
        background-color: #3a928d;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
      }

      #save-button:active {
        transform: scale(0.95); 
        background-color: #35837f;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
      }
  </style>
</head>

<body id="cek-presensi">
  <script>
    // Mendapatkan elemen page-title
    const pageTitle = document.getElementById('page-title');

    // Menambahkan teks dan tombol panah ke dalam page-title
    pageTitle.textContent = "Cek Presensi"; // Mengatur teks halaman

    // Menambahkan tombol panah ke dalam pageTitle
    const backButton = document.createElement('button');
    backButton.innerHTML = "←"; // Menambahkan simbol panah
    backButton.style.fontSize = "30px";
    backButton.style.color = "black";
    backButton.style.backgroundColor = "#41a99d"; // Warna tombol
    backButton.style.border = "none";
    backButton.style.padding = "10px";
    backButton.style.width = "50px"; 
    backButton.style.height = "50px";
    backButton.style.borderRadius = "50%"; // Membuat tombol bulat
    backButton.style.cursor = "pointer";
    backButton.style.marginRight = "10px"; // Memberi jarak antara panah dan teks
    backButton.style.transition = "background-color 0.3s ease";

    // Menambahkan efek hover dan klik pada tombol
    backButton.addEventListener('mouseover', () => {
        backButton.style.backgroundColor = "#3a928d"; // Warna saat hover
    });
    backButton.addEventListener('mouseout', () => {
        backButton.style.backgroundColor = "#41a99d"; // Warna saat mouse keluar
    });
    backButton.addEventListener('click', () => {
        window.location.href = 'presensi_bayi'; // Ganti dengan URL yang diinginkan
    });

    // Menambahkan tombol panah sebelum teks di pageTitle
    pageTitle.insertBefore(backButton, pageTitle.firstChild);

    // Mengatur gaya untuk pageTitle
    pageTitle.style.fontFamily = "Poppins, sans-serif";
    pageTitle.style.fontWeight = "600"; 
    pageTitle.style.fontSize = "30px";
    pageTitle.style.color = "#2c3e50"; 
    pageTitle.style.textShadow = "2px 2px 5px rgba(0, 0, 0, 0.2)";
    pageTitle.style.marginTop = "4px";
    pageTitle.style.letterSpacing = "1px";
    pageTitle.style.padding = "10px";
</script>

<div id="container">
  <div id="date-section">
    <label for="date-input" style="display: block; margin-bottom: 2px; text-align: left; font-size: 16px; font-weight: 500; color: #000000;">Tanggal Pelayanan Rutin</label>
    <input type="date" id="date-input" />
  </div>

  <div id="search-container">
    <input type="text" placeholder="Cari nama bayi" />
    <button>Cari</button>
  </div>

  <table>
    <thead>
      <tr>
        <th>NIK</th>
        <th>Nama Bayi</th>
        <th>Kehadiran</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>222212824</td>
        <td>Raditya Dika</td>
        <td></td>
      </tr>
      <tr>
        <td>222212476</td>
        <td>Alfitra Rifa Geandra</td>
        <td></td>
      </tr>
      <tr>
        <td>222212462</td>
        <td>Ricardo Septian</td>
        <td></td>
      </tr>
      <tr>
        <td>221234472</td>
        <td>Gazali Yahya</td>
        <td></td>
      </tr>
      <tr>
        <td>212223472</td>
        <td>Euroea Sugiono Manurung</td>
        <td></td>
      </tr>
      <tr>
        <td>212223346</td>
        <td>Irsanto Kapi Ten</td>
        <td></td>
      </tr>
      <tr>
        <td>222123467</td>
        <td>Angga Suryana Arivia</td>
        <td></td>
      </tr>
    </tbody>
  </table>

  <button id="save-button">Simpan</button>
</div>
</body>
</html>

</x-layout-kader>