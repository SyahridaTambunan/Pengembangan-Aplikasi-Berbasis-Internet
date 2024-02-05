<?php
require "../koneksi.php";
	
	session_start();
	session_destroy();
	
	header("Location: ../publik/index.php");
	exit; 
?>