<?php
include("../koneksi.php");
  include("config.php");

  if (empty($_SESSION['username'])) 
  {
    header("location: login.php");

    }else
    {
    }

    if (isset($_GET['id']))
    {
      $id = $_GET['id'];
    }

      $username = $_SESSION['username'];
      $queryProfil = mysqli_query($conn, "SELECT * from user WHERE username ='".$username."' ");
      $profil = mysqli_fetch_array($queryProfil);

      $queryProduk = mysqli_query($conn, "SELECT * from produk WHERE id = '".$id."' ");
      $produk = mysqli_fetch_array($queryProduk);
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
          <br>
            <h1  class="mt-5 text-center"> Detail Pemesanan </h1>

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3"> Pemesanan </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Pemesanan</li>
      </ol>
      <table cellpadding="10" class=" table table-condensed">
        <tr>
            <td width="300">Nama</td>
            <td width="20">:</td>
            <td><?php echo $profil['nama']; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><?php echo $profil['email']; ?></td>
        </tr>
        <tr>
            <td>Nomor Telepon</td>
            <td>:</td>
            <td><?php echo $profil['nomor_telepon']; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $profil['alamat']; ?></td>
        </tr>
        </table>

    <form method="post" action="proses_pesan.php" enctype="multipart/form-data">
        <table cellpadding="10" class=" table table-condensed">
          <tr>
            <td width="300">Kode Pos</td>
            <td width="20">:</td>
            <td><input type="text" class="form-control" style="width: 300px" name="kode_pos" placeholder="Kode Pos"></td>
            </tr>
            <tr>
            <td>Kota/Kecamatan</td>
            <td>:</td>
            <td><input type="text" class="form-control" style="width: 300px" name="kota" placeholder="Kota/Kecamatan"></td>
          </tr>
          <tr>
            <td>Nama Rekening</td>
            <td >:</td>
            <td ><input type="text" class="form-control" style="width: 300px" name="nama_rek" placeholder="Nama Rekening"></td>
          </tr>
          <tr>
              <td>Nomor Rekening</td>
              <td>:</td>
              <td><input type="text" class="form-control" style="width: 300px" name="no_rek" placeholder="Nomor Rekening"></td>
          </tr>
          <tr>
            <td>Bank</td>
            <td>:</td>
            <td>
              <select name="bank" class="form-control" style="width: 300px">
                <option></option>
                <option>BNI</option>
                  <option>BCA</option>
                  <option>BRI</option>
                  <option>Bank Sumut</option>
                  <option>Mandiri</option>
              </select>
            </td>
          </tr>
        </table>
      <table class="table table-hover table-condensed">
        
        <tr>
          <th><center>No</center></th>
          <th><center>Nama Pesanan</center></th>
          <th><center>Jumlah Pesanan</center></th>
        </tr>
        <?php $no = 1; ?>
        <td><center><?php echo $no ++; ?></center></td>
        <td><center><?php echo $produk['nama']; ?></center></td>
        
        <td><center>
          <input name="jlh_pesanan" type="text" class="form-control" style="width:50px; text-align: center" placeholder=""></input>
        </center></td> 
  	</table>
    <input name="id_produk" type="hidden" class="form-control" style="width:50px; text-align: center" placeholder="" value = "<?php echo $produk['id']; ?>" ></input>
                     <a href='proses_pesan.php'><button style='float: right;margin-top: 10px' class='btn btn-primary'>Buat Pemesanan</button></a>
                 </br></br></br></br> 
  </form>
      
     
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>