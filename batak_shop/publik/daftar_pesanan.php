<?php
include("../koneksi.php");
      
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
    
    <section class="py-5">
                <div class="container px-5">

                    <?php
                     $username = $_SESSION['username'];
                     $id = getUserId($username);
                        $query = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_user = '$id' ");
                        // $data  = mysqli_fetch_array($query);
                        
                    ?>
                    <div class="text-center mb-5">
                        <br>
                        <br>
                        <!-- <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div> -->
                        <h1 class="fw-bolder">Daftar Pesanan</h1>
                        <!-- <p class="lead fw-normal text-muted mb-0">add text here</p> -->
                    </div>

                    <div class="table-responsive">
                        <table class="table table-fixed table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" class="col-1">#</th>
                                    <th scope="col" class="col-2">Nama Produk</th>
                                    <th scope="col" class="col-2">Jumlah Produk</th>
                                    <th scope="col" class="col-2">Total Harga</th>
                                    <th scope="col" class="col-2">Status Pembayaran</th>
                                    <th scope="col" class="col-3">Upload Bukti Pembayaran</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $no = 1;
                                    while ($data = mysqli_fetch_assoc($query))
                                    
                                    {
                                        echo '<tr>
                                                <td>'.$no.'</td>
                                                <td>'.$data['jenis_produk'].'</td>
                                                <td>'.$data['jumlah_produk'].'</td>
                                                <td>Rp'.number_format($data['total_harga']).'</td>
                                                <td>'.$data['status'].'</td>
                                                <td class="right"><a href="detail_pesanan.php?id='.$data['id_pesanan'].'">Detail</a></td>

                                            </tr>';
                                    $no++;
                                        }
                            ?>
                            </tbody>
                        </table>
                    </div><!-- End -->
                
                </div>
            </section>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>