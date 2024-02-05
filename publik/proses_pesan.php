<?php
// Load file koneksi.php
include "../koneksi.php";
include "config.php";
// Ambil Data yang Dikirim dari Form
$id_produk = $_POST['id_produk'];
$kode_pos = $_POST['kode_pos'];
$kota = $_POST['kota'];
$nama_rek = $_POST['nama_rek'];
$no_rek = $_POST['no_rek'];
$bank = $_POST['bank'];
$jlh_pesanan = $_POST['jlh_pesanan'];
$username = $_SESSION['username'];
echo $username;
$queryProfil = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
$profil  = mysqli_fetch_array($queryProfil);
$id_user = $profil['id'];

$queryProduk = mysqli_query($conn, "SELECT * FROM produk where id = '$id_produk'");
$produk  = mysqli_fetch_array($queryProduk);
// $id_produk = $produk['id'];
$jenis_pesanan = $produk['nama'];
$harga_produk = $produk['harga'];
$total_harga = $jlh_pesanan * $harga_produk;

$query = "INSERT INTO pesanan (id_user, id_produk, kode_pos, kota, nama_rek, no_rek, bank, jenis_produk, harga_produk, jumlah_produk, total_harga)
          VALUES('".$id_user."', '".$id_produk."', '".$kode_pos."', '".$kota."', '".$nama_rek."', '".$no_rek."', '".$bank."', '".$jenis_pesanan."', '".$harga_produk."', '".$jlh_pesanan."',  '".$total_harga."')";
$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
if($sql){ // Cek jika proses simpan ke database sukses atau tidak
  // Jika Sukses, Lakukan :
  // header("location:daftar_pesanan.php"); // Redirect ke halaman index.php
  echo "<script>alert('Pesanan anda telah ditambahkan, Silakan lalukan pembayaran.'); window.location.href='daftar_pesanan.php';</script>";
      exit();
}else{
  // Jika Gagal, Lakukan :
  echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
  echo "<br><a href='pemesanan.php'>Kembali Ke Form</a>";
}

?>