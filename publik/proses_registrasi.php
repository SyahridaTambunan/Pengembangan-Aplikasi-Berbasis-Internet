<?php
// Load file koneksi.php
include "../koneksi.php";
include "config.php";
// Ambil Data yang Dikirim dari Form
$nama = $_POST['nama'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$nomor_telepon = $_POST['nomor_telepon'];
$alamat = $_POST['alamat'];


$query = "INSERT INTO user (nama, username, email, password, nomor_telepon, alamat, foto_profil, status)
          VALUES('".$nama."', '".$username."', '".$email."', '".$password."', '".$nomor_telepon."', '".$alamat."', 'image/default_picture.jpg', 'user')";
$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
if($sql){ // Cek jika proses simpan ke database sukses atau tidak
  // Jika Sukses, Lakukan :
  // header("location:daftar_pesanan.php"); // Redirect ke halaman index.php
  echo "<script>alert('Akun anda telah didaftarkan. Silahkan login kembail.'); window.location.href='login.php';</script>";
      exit();
}else{
  // Jika Gagal, Lakukan :
  echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
  echo "<br><a href='registrasi.php'>Kembali Ke Form</a>";
}

?>