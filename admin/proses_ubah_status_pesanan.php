<?php

include "../koneksi.php";

$id_pesanan = $_POST['id_pesanan'];
$status = $_POST['status'];

$query = " UPDATE pesanan set status = '$status' WHERE id_pesanan = '$id_pesanan'";
// echo $query;
$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
if($sql){ // Cek jika proses simpan ke database sukses atau tidak
  // Jika Sukses, Lakukan :
  echo "<script>alert('Status Pesanan telah diubah.'); window.location.href='daftar_pesanan.php';</script>";
  exit();
  header("location:daftar_pesanan.php"); // Redirect ke halaman index.php
}else
{
  // Jika Gagal, Lakukan :
  echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
  echo "<br><a href='daftar_pesanan.php'>Kembali Ke Form</a>";
}
  
?>