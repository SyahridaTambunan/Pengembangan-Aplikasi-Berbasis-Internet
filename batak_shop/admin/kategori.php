<?php
	require "../koneksi.php";

	$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
	$jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Kategori </title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

</head>

<body>
	<?php require "navbar.php"; ?>

	<div class="container mt-4">

		<div class="my-4 col-12 col-md-4">
			<h3> Tambah Kategori</h3>

			<form action="" method="POST">
				<div>
					<label for="Kategori"> Kategori </label>
					<input type="text" id="Kategori" name="Kategori" 
					placeholder="input nama kategori" class="form-control">
				</div>
				<div class="mt-3">
					<button class="btn btn-primary" type="submit" name="Simpan_Kategori"> Simpan </button>
				</div>
			</form>

			<?php
				if(isset($_POST['Simpan_Kategori']))
				{
					$Kategori = htmlspecialchars($_POST['Kategori']);

					$queryExist = mysqli_query($conn, "SELECT nama FROM kategori 
					WHERE nama = '$Kategori' ");

					$jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

					if($jumlahDataKategoriBaru > 0)
					{
			?>
					<div class="alert alert-warning mt-3 col-md-6" role="alert">
						Kategori sudah ada
					</div>
			<?php
					}else
					{
						$querySimpan = mysqli_query($conn, "INSERT INTO kategori (nama)
						VALUES ('$Kategori') ");
						if($querySimpan)
						{
			?>
						<div class="alert alert-danger mt-3" role="alert">
							Kategori Berhasil Disimpan
						</div>

						<meta http-equiv="refresh" content="1; url=kategori.php" />
			<?php
						}else
						{
							echo mysqli_error($conn);
						}
					}
				}
			?>

		</div>

		<div class="mt-3">
			<h2> List Kategori </h2>

			<div class="table-responsive mt-4">
				<table class="table">
					<thead>
						<tr>
							<th> No </th>
							<th> Nama </th>
							<th> Action </th>
						</tr>
					</thead>
					<tbody>
						<?php
							$number = 1;
							if($jumlahKategori==0)
							{
						?>
							<tr>
								<td colspan=3 class="text-center"> Data kategori tidak tersedia </td>
							</tr>	
						<?php
							}else
							{
								$jumlah = 1;
								while ($data = mysqli_fetch_array($queryKategori))
								{
						?>
								<tr>
									<td> <?php echo $jumlah; ?> </td>
									<td> <?php echo $data['nama']; ?> </td>
									<td>
										<a href="kategori-detail.php?id=<?php echo $data['id']; ?>"  
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