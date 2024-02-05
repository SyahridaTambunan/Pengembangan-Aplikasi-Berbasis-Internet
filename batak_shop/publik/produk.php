<?php
    require "../koneksi.php";
    error_reporting(0);
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
    <div class="container-fluid py-5">
        <div class="container">
            <h1 class="text-center mt-5 mb-5"> Daftar Produk </h1>

            <div class="box">
                <?php
                    if($_GET['search'] != '' || $_GET['Kategori'] != '')
                    {
                        $where = "AND nama LIKE '%".$_GET['search']."%' AND id_kategori LIKE '%".$_GET['Kategori']."%' ";
                    }

                    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE stok = 'tersedia' $where ");
                    if(mysqli_num_rows($queryProduk) > 0)
                    {
                        while($produk = mysqli_fetch_array($queryProduk))
                        {
                ?>
                        <a href="produk-detail.php?id=<?php echo $produk['id']; ?>">
                            <div class="col-5 kotak-1 ">
                                <img src="../image/<?php echo $produk['gambar']; ?> ">
                                <p class="nama"> <?php echo $produk['nama']; ?> </p>
                                <p class="detail"> <?php echo $produk['detail']; ?> </p>
                                <p class="harga"> Rp.<?php echo number_format($produk['harga']) ?> </p>
                                <p class="stok"> <?php echo $produk['stok']; ?> </p>
                            </div>
                        </a>
                <?php
                    }}else
                    {
                ?>  
                        <p> Produk Tidak ada </p>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>