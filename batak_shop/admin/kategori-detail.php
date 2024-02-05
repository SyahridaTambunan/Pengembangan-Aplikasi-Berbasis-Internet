<?php
	require "../koneksi.php";

	$id =  $_GET['id']; 
	$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id = '$id' ");
	$kategori = mysqli_fetch_array($queryKategori);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <title> Detail Kategori </title>
</head>
<body>
	<?php require "navbar.php"; ?>

	<div class="container mt-4">
		<h2> Detail Kategori </h2>

	    <div class="col-12 col-md-6">
	    	<form action="" method="POST">
		    	<div>
		    		<label for="Kategori"> Kategori </label>
			    	<input type="text" name="Kategori" id="Kategori" class="form-control mt-2" 
			    	 value="<?php echo $kategori['nama']; ?> ">
		    	</div>
		    	<div class="mt-3">
	    			<button type="submit" class="btn btn-primary" name="editBTN" > Edit </button>
	    			<button type="submit" class="btn btn-danger" name="deleteBTN" > Delete </button>
	    		</div>
	    		<div class="mt-3 mb-3">
	    			<a class="btn btn-warning" href="kategori.php"> Kembali </a>
	    		</div>
		    </form>	

		    <?php
		    	if (isset($_POST['editBTN']))
		    	{
		    		$Kategori = htmlspecialchars($_POST['Kategori']);

		    		if ($data['nama']==$Kategori) 
		    		{
		    		}else
		    		{
		    			$query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama='$Kategori' ");
		    			$jumlahData = mysqli_num_rows($query);

		    			if ($jumlahData > 0) 
		    			{
		    ?>
		    				<div class="alert alert-primary mt-3 col-md-6" role="alert">
								Kategori sudah ada
							</div>
			<?php
		    			}else
		    			{
		    				$querySimpan = mysqli_query($conn, "UPDATE kategori SET nama='$Kategori' 
		    				WHERE id='$id' ");

							if($querySimpan)
							{
			?>
								<div class="alert alert-danger mt-3 col-md-8" role="alert">
									Kategori berhasil di edit
								</div>

								<meta http-equiv="refresh" content="2; url=kategori.php" />
			<?php
							}else
							{
								echo mysqli_error($conn);
							}
		    			}
		    		}
		    	}

		    	if (isset($_POST['deleteBTN']))
		    	{
		    		$queryCheck = mysqli_query($conn, "SELECT * FROM produk WHERE id_kategori = '$id' ");
		    		$daftarData = mysqli_num_rows($queryCheck);

		    		if($daftarData > 0)
		    		{
		    ?>
		    			<div class="alert alert-warning" role="alert">
							Kategori tidak bisa dihapus, karena sudah ada produk
						</div>
			<?php
					die();
		    		}

		    		$queryDelete = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id' ");
		    		
		    		if ($queryDelete) 
		    		{
		    ?>
		    		<div class="alert alert-light" role="alert">
						Kategori Berhasil Dihapus
					</div>

					<meta http-equiv="refresh" content="1; url=kategori.php" />
			<?php
		    		}else
		    		{
		    			echo mysqli_error($conn);
		    		}
		    	}

		    ?>
	    </div>
	</div>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>