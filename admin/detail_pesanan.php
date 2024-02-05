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
    <title> Produk Detail </title>
</head>

<style>
     form div
    {
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-4">
        <h2> Detail Pesanan </h2>


          <div>
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
            if ($pesanan['bukti_bayar'] != "")
            {
              echo 'Bukti Pembayaran:';
              echo '<br><br>';
              echo '<img src="../publik/'.$pesanan['bukti_bayar'].'" width="500px" >';
            }else
            {
              echo 'Bukti Pembayaran:';
              echo '<br>';
              echo "Pembeli belum meng-upload bukti pembayaran";
            }
            ?>
            <br>
            <br>
            <form id="registration-form" method="post" action="proses_ubah_status_pesanan.php" role="form" enctype="multipart/form-data">
                Ubah Status Pesanan:
                <br><br>
                <input name="id_pesanan" type="hidden" class="form-control" style="width:50px; text-align: center" placeholder="" value = "<?php echo $pesanan['id_pesanan'] ?>" ></input>
                <select name="status" class="form-control" style="width: 300px">
                    <option>--Select--</option>
                    <option>Diproses</option>
                    <option>Dikirim</option>
                    <option>Ditolak</option>
                </select><br>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block" />
                <br><br>
                </form>  
          </div>
        </div>      
    
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>