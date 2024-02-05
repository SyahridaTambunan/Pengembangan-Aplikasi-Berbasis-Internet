<?php
	require "../koneksi.php";

	// session_start(); 
	include 'config.php';

	if (empty($_SESSION['username'])) {
		header('Location: login.php');
		exit;
	}


	$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
	$jumlahKategori = mysqli_num_rows($queryKategori);

	$queryProduk = mysqli_query($conn, "SELECT * FROM produk");
	$jumlahProduk = mysqli_num_rows($queryProduk);

	$queryPesanan = mysqli_query($conn, "SELECT * FROM pesanan");
	$jumlahPesanan = mysqli_num_rows($queryPesanan);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	<title> Home </title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>

<style>
	.kotak
	{
		border: solid;
	}
	.summary-kategori
	{
		background-color: #318923;
		border-radius: 10px;
	}
	.summary-produk
	{
		background-color: #26336d;
		border-radius: 10px;
	}
	.summary-pesanan
	{
		background-color: #a8a232;
		border-radius: 10px;
	}
	.no decoration
	{
		text-decoration: none;
	}


</style>

<body>
	<?php require "navbar.php"; ?>

	<div class="container mt-5">
		<div class="container" mt-5>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12 mb-4">	
					<div class="summary-kategori p-3">
						<div class="row">
							<div class="col-6 text-white">
								<h3 class="font-size-2"> Kategori </h3>
									<p class="font-size-4">
										<?php echo $jumlahKategori; ?> Kategori
									</p>
									<p>
										<a href="kategori.php" class="text-white no decoration"> Lihat Detail </a>
									</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 col-12 mb-4">
					<div class="summary-produk p-3">
						<div class="row">
							<div class="col-6 text-white">
								<h3 class="font-size-2"> Produk </h3>
									<p class="font-size-4">
										<?php echo $jumlahProduk; ?> Produk
									</p>
									<p>
										<a href="kategori.php" class="text-white no decoration"> Lihat Detail </a>
									</p>
							</div>
						</div>
					</div>	
				</div>

				<div class="col-lg-4 col-md-6 col-12 mb-4">	
					<div class="summary-pesanan p-3">
						<div class="row">
							<div class="col-6 text-white">
								<h3 class="font-size-2"> Pesanan </h3>
									<p class="font-size-4">
										<?php echo $jumlahPesanan; ?> Pesanan
									</p>
									<p>
										<a href="daftar_pesanan.php" class="text-white no decoration"> Lihat Detail </a>
									</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>