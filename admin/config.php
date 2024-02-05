<?php
	session_start();
	// include("../Klinik-IT-Del/config/connection.php");
	require "../koneksi.php";
	
	function secure($str,$sqlHandle)
	{
		$secured = strip_tags($str);
		$secured = htmlspecialchars($secured);
		$secured = mysqli_real_escape_string($sqlHandle,$secured);
		
		return $secured;
	}

	function getUserId($username)
    {
      	global $conn;
        $query = "SELECT id FROM user WHERE username='$username'";
        $query_run = mysqli_query($conn, $query);
        $fetched_id = mysqli_fetch_array($query_run);
        // Get the id
        $id = $fetched_id['id'];
        return $id;
    }

	// function getUserStatus($username)
    // {
    //   	global $connect;
    //     $query = "SELECT status FROM user WHERE username='$username'";
    //     $query_run = mysqli_query($connect, $query);
    //     $fetched_id = mysqli_fetch_array($query_run);
    //     // Get the id
    //     $status = $fetched_id['status'];
    //     return $status;
    // }
?>