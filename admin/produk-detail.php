<?php
    require "../koneksi.php";
    // require "produk.php";

    $id =  $_GET['id']; 
    $queryProdukDetail = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a  
                   JOIN kategori b ON a.id_kategori = b.id where a.id = '$id'");
    $produkDetail = mysqli_fetch_array($queryProdukDetail);
    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id != '$produkDetail[id_kategori]' ");

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
        <h2> Detail Produk </h2>

        <div class="col-12 col-md-6">
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="Nama"> Nama </label>
                        <input type="text" id="nama" name="nama" placeholder="Nama produk" class="form-control"
                         value="<?php echo $produkDetail['nama']; ?> " autocomplete="off" required>
                </div>
                <div>
                    <label for="Kategori"> Kategori </label>
                    <select name="kategori" id="Kategori" class="form-control" required>
                        <option value="<?php echo $produkDetail['id_kategori']; ?>"> <?php echo $produkDetail['nama_kategori']; ?> 
                        </option>
                        <?php 
                            while ($dataKategori=mysqli_fetch_array($queryKategori)) 
                            {
                        ?>
                                <option value=" <?php echo $dataKategori['id']; ?> "> 
                                    <?php echo $dataKategori['nama']; ?> 
                                </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga"> Harga </label>
                    <input type="number" class="form-control" value="<?php echo $produkDetail['harga']; ?>" placeholder="Harga produk" name="harga" required>
                </div>
                <div>
                    <label for="stok"> Stok </label>
                    <select name="stok" id="stok" class="form-control" required> 
                        <option value="<?php echo $produkDetail['stok']; ?>"> 
                            <?php echo $produkDetail['stok']; ?> 
                        </option>
                        <?php
                            if($produkDetail['stok']=='tersedia')
                            {
                        ?>
                            <option value="habis"> Habis </option>
                        <?php
                            }else
                            {
                        ?>
                            <option value="tersedia"> Tersedia </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="gambarNya"> Gambar Produk Sekarang </label>
                    <img src="../image/<?php echo $produkDetail['gambar']; ?>"
                    alt="" width="300px" height="250px">
                </div>
                <div>
                    <label for="gambar"> Gambar </label>
                    <input type="file" name="gambar" id="gambar" class="form-control">
                </div>
                <div>
                    <label for="detail"> Detail </label>
                    <textarea name="detail" id="detail" cols="20" rows="10" class="form-control">
                        <?php echo $produkDetail['detail']; ?>
                    </textarea>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="update"> Update </button>
                    <button type="submit" class="btn btn-danger" name="delete" > Delete </button>
                </div>
                <div class="mt-3 mb-3">
                    <a class="btn btn-warning" href="produk.php"> Kembali </a>
                </div>
            </form>

            <?php
                if (isset($_POST['update']))
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
                        <div class="alert alert-warning mt-3" role="alert">
                            Nama, kategori dan harga wajib diisi
                        </div>
            <?php
                    }else
                    {
                        $queryUpdate = mysqli_query($conn, "UPDATE produk SET id_kategori='$kategori', nama='$nama', harga='$harga', detail='$detail', stok='$stok'
                        WHERE id=$id ");

                        if($nama_file !='')
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
                                    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_dir . $new_name);

                                    $queryUpdate = mysqli_query($conn, "UPDATE produk SET gambar='$new_name' 
                                        WHERE id='$id' ");

                                    if($queryUpdate)
                                    {
            ?>                  
                                        <div class="alert alert-light mt-3" role="alert">
                                            Produk berhasil diperbaharui
                                        </div>

                                        <meta http-equiv="refresh" content="1; url=produk.php" />
            <?php
                                    }else
                                    {
                                        echo mysqli_error($conn);
                                    }
                                }
                            }
                        }   
                    }
                }

                if(isset($_POST['delete']))
                {
                    $queryDelete = mysqli_query($conn, "DELETE FROM produk WHERE id='$id' ");

                    if($queryDelete)
                    {
            ?>
                        <div class="alert alert-warning" role="alert">
                            Produk berhasil dihapus
                        </div>

                        <meta http-equiv="refresh" content="2; url=produk.php" />
            <?php
                    }
                }
            ?>
        </div>
    </div>
    
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>