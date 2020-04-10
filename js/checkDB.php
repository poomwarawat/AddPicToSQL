<?php
// add code here
    session_start();
    $servername = "localhost";
    $username = "test1";
    $password = "test1";
	$db = "UserData";
    
    $user = $_POST['username'];
    $pass = md5($_POST['password']);
    $conn = mysqli_connect($servername, $username, $password, $db);
    
    $sql = "SELECT * FROM User;";
    $result = mysqli_query($conn, $sql);
    $result_check = mysqli_num_rows($result);

    if($result_check > 0){
        while($row = mysqli_fetch_assoc($result)){
            if($user == (string)$row['user'] && $pass == (string)$row['password']){
                $_SESSION['username'] = $user;
                header("Location: ../feed.php");
                exit;
            }
        }       
    }
    header('Location: ../login.html?error=1');
?>