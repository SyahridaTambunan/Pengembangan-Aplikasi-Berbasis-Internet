<?php
    require "../koneksi.php";

    $queryProduk = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a  
                   JOIN kategori b ON a.id_kategori = b.id ");
    $jumlahProduk = mysqli_num_rows($queryProduk);

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for($i =0 ; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Produk </title>
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
            <h2> List Produk </h2>

            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Nama </th>
                            <th> Kategori </th>
                            <th> Harga </th>
                            <th> Stok </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                        
                    <tbody>
                          <?php
                            if($jumlahProduk==0)
                            {
                        ?>  
                                <tr>
                                     <td colspan = 6 class="text-center"> Data Produk Tidak Tersedia </td>
                                </tr>
                        <?php
                            }else
                                {
                                  $jumlah = 1;
                                   while($data=mysqli_fetch_array($queryProduk))
                                {
                        ?>
                                        <tr>
                                        <td> <?php echo $jumlah; ?> </td>
                                        <td> <?php echo $data['nama']; ?> </td>
                                        <td> <?php echo $data['nama_kategori']; ?> </td>
                                        <td> <?php echo $data['harga']; ?> </td>
                                        <td> <?php echo $data['stok']; ?> </td>
                                        <td>
                                            <a href="produk-detail.php?id=<?php echo $data['id']; ?>"  
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
        <div class="my-4 col-12 col-md-6">
            <h3> Tambah Produk </h3>

            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="Nama"> Nama </label>
                        <input type="text" id="nama" name="nama" placeholder="Nama produk" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="Kategori"> Kategori </label>
                    <select name="kategori" id="Kategori" class="form-control" required>
                        <option value=""> Pilih kategori </option>
                        <?php 
                            while ($data=mysqli_fetch_array($queryKategori)) 
                            {
                        ?>
                                <option value=" <?php echo $data['id']; ?> "> <?php echo $data['nama']; ?> </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga"> Harga </label>
                    <input type="number" class="form-control" placeholder="Harga produk" name="harga" required>
                </div>
                <div>
                    <label for="stok"> Stok </label>
                    <select name="stok" id="stok" class="form-control" required> 
                        <option value="tersedia"> Tersedia </option>
                        <option value="habis"> Habis </option>
                    </select>
                </div>
                <div>
                    <label for="gambar"> Gambar </label>
                    <input type="file" name="gambar" id="gambar" class="form-control" required>
                </div>
                <div>
                    <label for="detail"> Detail </label>
                    <textarea name="detail" id="detail" cols="20" rows="10" class="form-control"></textarea>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="Simpan_Produk"> Simpan </button>
                </div>
            </form>

            <?php
                if (isset($_POST['Simpan_Produk']))
                {
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $stok = htmlspecialchars($_POST['stok']);

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["gambar"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $image_size = $_FILES['gambar']['size'];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if($nama=='' || $kategori=='' || $harga=='')
                    {
            ?>
                        <div class="alert alert-secondary mt-3" role="alert">
                            Nama, kategori dan harga wajib diisi
                        </div>
            <?php
                    }else
                    {
                        if($nama_file!='')
                        {
                            if ($image_size > 700000) 
                            {
            ?>
                                <div class="alert alert-success" role="alert">
                                    File terlalu besar
                                </div>
            <?php 
                            }else
                            {
                                if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'jfif')
                                {
            ?>
                                    <div class="alert alert-info" role="alert">
                                        File harus tipe jpg, png, jpeg dan jfif
                                    </div>
            <?php
                                }else
                                {
                                    move_uploaded_file($_FILES["gambar"]["tmp_name"], 
                                        $target_dir . $new_name);
                                }
                            }
                        }
                        
                        $queryTamba = mysqli_query($conn, 
                            "INSERT INTO produk (id_kategori, nama, harga, gambar, detail, stok) 
                            VALUES ('$kategori', '$nama', '$harga', '$new_name' , '$detail', '$stok' ) ");

                        if($queryTamba)
                        {
            ?>              <div class="alert alert-danger mt-3" role="alert">
                                Produk Berhasil Disimpan
                            </div>

                            <meta http-equiv="refresh" content="1; url=produk.php" />
            <?php
                        }
                        else
                        {
                            echo mysqli_error($conn);
                        }
                    }
                }
            ?>

        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>

