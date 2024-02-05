<?php
    require "../koneksi.php";
    error_reporting(0);

    $queryProduk = mysqli_query($conn, "SELECT * from produk WHERE id='".$_GET['id']."' ");
    $produk = mysqli_fetch_object($queryProduk);
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
    

    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1> Batak Shop </h1>
            <h4> Carilah yang Anda inginkan </h4>

            <div class="search">
                <div class="container">
                    <form action="produk.php">
                        <input type="text" name="search" placeholder="Temukan produk yang Anda inginkan">
                        <input type="submit" name="cari" value="Cari Produk">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <h1  class="mt-5 text-center"> Detail Produk </h1>
                    <img src="../image/<?php echo $produk->gambar ?>" align="center" >
            <table cellpadding="10" class=" table table-condensed">
              <tr>
                <td width="300">Nama Produk</td>
                <td width="20">:</td>
                <td><?php echo $produk->nama ?></td>
              </tr>
              <tr>
                <td>Detail Produk</td>
                <td>:</td>
                <td><?php echo $produk->detail ?></td>
              </tr>
              <tr>
                <td>Harga Produk</td>
                <td>:</td>
                <td>Rp.<?php echo number_format($produk->harga) ?></td>
              </tr>
              <tr>
                <td>Stok</td>
                <td>:</td>
                <td><?php echo $produk->stok ?></td>
              </tr>
            </table>

            <?php
                echo "<a href='pemesanan.php?id=".$produk->id."'><button style='float: right;margin-top: 10px' class='btn btn-primary'>Pesan</button></a>";

                // if (empty($_SESSION['username'])) {
                //     echo "<a href='login.php'><button style='float: right;margin-top: 10px' class='btn btn-primary'>Pesan</button></a>";

                //     }else{
                //         echo "<a href='pemesanan.php?id=".$produk->id."'><button style='float: right;margin-top: 10px' class='btn btn-primary'>Pesan</button></a>";
                //     }
                ?>
            <br>
            <br>
            <br>
            <br>
            <!-- <div class="box">
                <div class="col-2">
                    <img src="../image/<?php echo $produk->gambar ?>" width="200%" >
                </div>
                <div class="col-2">
                    <h3> <?php echo $produk->nama ?> </h3>
                    <h3> <?php echo $produk->detail ?> </h3>
                    <h3> Rp.<?php echo number_format($produk->harga) ?> </h3>
                    <h3> Stok : <?php echo $produk->stok ?> </h3>
                </div>
            </div> -->
        </div>
    </div>

    

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>