<?php
// Pastikan library Dompdf sudah di-load
require 'vendor/autoload.php';
use Dompdf\Dompdf;

// 1. TANGKAP DATA DARI FORM HTML
$nama = $_POST['nama'];
$nim = $_POST['nim'];
$fakultas = $_POST['fakultas'];
$lomba = $_POST['bidang_lomba'];

// 2. KONEKSI DAN SIMPAN KE DATABASE MYSQL
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_mtq";

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi Database Gagal: " . $koneksi->connect_error);
}

// Simpan data
$sql = "INSERT INTO pengajuan_surat (nama, nim, fakultas, bidang_lomba) 
        VALUES ('$nama', '$nim', '$fakultas', '$lomba')";

if ($koneksi->query($sql) === TRUE) {
    
    // 3. JIKA TERSIMPAN, MULAI BUAT PDF-NYA
    $dompdf = new Dompdf();
    
    // Desain isi surat (Bisa menggunakan tag HTML & CSS biasa)
    $isi_surat = "
    <div style='font-family: Arial, sans-serif; padding: 20px;'>
        <h2 style='text-align: center;'>SURAT KETERANGAN DELEGASI</h2>
        <hr>
        <p>Dengan hormat, yang bertanda tangan di bawah ini Panitia MTQ Universitas Brawijaya XIX 2026, menerangkan bahwa mahasiswa berikut:</p>
        <table style='margin-left: 20px;'>
            <tr><td>Nama</td><td>: <strong>$nama</strong></td></tr>
            <tr><td>NIM</td><td>: $nim</td></tr>
            <tr><td>Fakultas</td><td>: $fakultas</td></tr>
            <tr><td>Cabang Lomba</td><td>: $lomba</td></tr>
        </table>
        <p>Merupakan delegasi resmi yang mengikuti perlombaan MTQ UB XIX 2026. Surat ini dapat dipergunakan sebagaimana mestinya.</p>
        <br><br>
        <p style='text-align: right;'>Malang, " . date('d F Y') . "<br>Panitia MTQ UB</p>
    </div>
    ";

    $dompdf->loadHtml($isi_surat);
    
    // Atur ukuran kertas dan orientasi
    $dompdf->setPaper('A4', 'portrait');
    
    // Render HTML ke PDF
    $dompdf->render();
    
    // 4. OUTPUT DOWNLOAD FILE PDF
    $nama_file = "Surat_Delegasi_" . str_replace(' ', '_', $nama) . ".pdf";
    $dompdf->stream($nama_file, array("Attachment" => true)); 
    // Attachment => true membuat file otomatis terdownload
    
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>