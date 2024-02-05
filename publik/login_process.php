<?php
include("config.php");

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        // $query = "UPDATE user set login_status = '1' WHERE username = '".$username."' ";
        // $sql = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if ($username == 'admin'){
            $_SESSION['username'] = $row['username'];
            header("Location: ../admin/index.php");

        }else{
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
        }
        
    } else {
        echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!'); window.location.href='login.php';</script>";
    }
}
?>