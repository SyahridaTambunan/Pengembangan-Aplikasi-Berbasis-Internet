<?php
include("../koneksi.php");

  // if (isset($_GET['id_pesanan'])){
  //   $id = $_GET['id_pesanan'];
  // }
  $id = $_GET['id'];

  // $query1 = mysqli_query($conn, "SELECT *, user.nama as u_nama FROM pesanan JOIN user ON user.id = pesanan.id_user where id_pesanan = '$id'");
  // $pesanan = mysqli_fetch_array($query1);

  $queryPesanan = mysqli_query($conn, "SELECT *, user.nama as u_nama, pesanan.status as p_status FROM pesanan JOIN user ON user.id = pesanan.id_user where id_pesanan = '$id'");
  $pesanan = mysqli_fetch_array($queryPesanan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css"> 
    <title> BatakShop | Home </title>
</head>
<body>
    <?php require "navbar.php"; ?>
    
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <br><br>
      <h1 class="mt-4 mb-3">Detail Pesanan
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"> 
          <a href="index.php">Beranda</a>
        </li>
        <li class="breadcrumb-item active">Detail Pesanan</li>
      </ol>
      <div>
        <p>Data Pesanan:</br>
            <table cellpadding="10" class=" table table-condensed">
              <tr>
                <td width="300">Nama Lengkap</td>
                <td width="20">:</td>
                <td><?php echo $pesanan['u_nama']; ?></td>
              </tr>
              <tr>
                <td>Jenis Pesanan</td>
                <td>:</td>
                <td><?php echo $pesanan['jenis_produk']; ?></td>
              </tr>
              <tr>
                <td>Jumlah Pesanan</td>
                <td>:</td>
                <td><?php echo $pesanan['jumlah_produk']; ?></td>
              </tr>
              <tr>
                <td>Total Harga</td>
                <td>:</td>
                <td>Rp<?php echo number_format($pesanan ['total_harga']); ?></td>
              </tr><tr>
                <td>Total Harga</td>
                <td>:</td>
                <td><?php echo $pesanan ['p_status']; ?></td>
              </tr>
              <tr>
                <td>Nomor Telepon</td>
                <td>:</td>
                <td><?php echo $pesanan['nomor_telepon']; ?></td>
              </tr>
              <tr>
                <td>Bank</td>
                <td>:</td>
                <td><?php echo $pesanan['bank']; ?></td>
              </tr>
              <tr>
                <td>Nomor Rekening</td>
                <td>:</td>
                <td><?php echo $pesanan['no_rek']; ?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $pesanan['alamat']; ?></td>
              </tr>
              <tr>
                <td>Kode Pos</td>
                <td>:</td>
                <td><?php echo $pesanan['kode_pos']; ?></td>
              </tr>
              <tr>
                <td>Kota/Kecamatan</td>
                <td>:</td>
                <td><?php echo $pesanan['kota']; ?></td>
              </tr>
            </table>
            </br>
            <?php
            if ($pesanan['bukti_bayar'] != ""){
              echo 'Bukti Pembayaran:';
              echo '<br><br>';
              echo '<img src="'.$pesanan['bukti_bayar'].'" width="500px" >';
            }else{
              echo '<form id="registration-form" method="post" action="proses_upload_bukti_pembayaran.php" role="form" enctype="multipart/form-data">';
              echo 'Upload Bukti Pembayaran:';
              echo '<br><br>';
              echo '<input name="id_pesanan" type="hidden" class="form-control" style="width:50px; text-align: center" placeholder="" value = "'.$pesanan['id_pesanan'].'" ></input>';
              echo '<input type="file" name="bukti_bayar">';
              echo '<input type="submit" name="submit" value="Upload" class="btn btn-primary btn-block" />';
              echo '<br><br>';
              echo '</form>';
            }
            ?>
            
      </div>
 </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>