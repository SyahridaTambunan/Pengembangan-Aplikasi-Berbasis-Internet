<?php
    require "../koneksi.php";

    $queryPesanan = mysqli_query($conn, "SELECT *, user.nama as u_nama, pesanan.status as p_status FROM pesanan JOIN user ON user.id = pesanan.id_user");
    $jumlahPesanan = mysqli_num_rows($queryPesanan);

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Daftar Pesanan | Admin </title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

</head>

<style type="text/css">
    .no decoration
    {
        text-decoration: none;
    }
    form div
    {
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-4">
        <div class="mt-3">
            <h2> List Pesanan </h2>

            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Nama Pemesan</th>
                            <th> Nama Produk </th>
                            <th> Jumlah Barang </th>
                            <th> Total Harga </th>
                            <th> Status </th>
                            <th> Rincian </th>
                        </tr>
                    </thead>
                        
                    <tbody>
                          <?php
                            if($jumlahPesanan==0)
                            {
                        ?>  
                                <tr>
                                     <td colspan = 6 class="text-center"> Data Produk Tidak Tersedia </td>
                                </tr>
                        <?php
                            }else
                                {
                                  $jumlah = 1;
                                   while($data=mysqli_fetch_array($queryPesanan))
                                {
                        ?>
                                        <tr>
                                        <td> <?php echo $jumlah; ?> </td>
                                        <td> <?php echo $data['u_nama']; ?> </td>
                                        <td> <?php echo $data['jenis_produk']; ?> </td>
                                        <td> <?php echo $data['jumlah_produk']; ?> </td>
                                        <td> Rp<?php echo number_format($data['total_harga']); ?> </td>
                                        <td> <?php echo $data['p_status']; ?> </td>
                                        <td>
                                            <a href="detail_pesanan.php?id=<?php echo $data['id_pesanan']; ?>"  
                                            class="btn btn-info"> 
                                                <i class="bi bi-search">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                    </svg>
                                                </i> 
                                            </a>
                                        </td>
                                    </tr>
                        <?php
                                $jumlah++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>

