<?php
require "../koneksi.php";
	// if(isset($_GET['username'])){
	// 	$username = $_GET['username']; 
	// }else{
	// 	$username = "username tidak ada";
	// }

	// $query = "UPDATE user set login_status = '0' WHERE username = '".$username."' ";
    // $sql = mysqli_query($conn, $query);

	session_start();
	session_destroy();
	
	header("Location: index.php");
	exit; 
?>