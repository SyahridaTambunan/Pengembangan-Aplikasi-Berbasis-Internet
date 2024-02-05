<?php

include "../koneksi.php";

$id_pesanan = $_POST['id_pesanan'];
$bukti_bayar = $_FILES['bukti_bayar']['name'];
$tmp = $_FILES['bukti_bayar']['tmp_name'];


// Set path folder tempat menyimpan profile_picturenya
// $path = "image/upload/".$profile_picture;
$path = "image/bukti_pembayaran/";

$path_file = $path.$bukti_bayar;
move_uploaded_file($tmp, $path_file);

$bukti_bayar_upload = 'image/bukti_pembayaran/'.$bukti_bayar; 

$query = " UPDATE pesanan set bukti_bayar = '$bukti_bayar_upload', status = 'Sudah Dibayar' WHERE id_pesanan = '$id_pesanan'";
// echo $query;
$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
if($sql){ // Cek jika proses simpan ke database sukses atau tidak
  // Jika Sukses, Lakukan :
  echo "<script>alert('Bukti pembayaran sudah di-upload. Silahkan menunggu respon admin.'); window.location.href='daftar_pesanan.php';</script>";
  exit();
  header("location:daftar_pesanan.php"); // Redirect ke halaman index.php
}else{
  // Jika Gagal, Lakukan :
  echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
  echo "<br><a href='daftar_pesanan.php'>Kembali Ke Form</a>";
}
  
?>